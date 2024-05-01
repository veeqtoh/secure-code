<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Classes;

use Veeqtoh\DoorAccess\Classes\Traits\ConfigTrait;
use Veeqtoh\DoorAccess\CodeGenerator;
use Veeqtoh\DoorAccess\Database\DatabaseInterface;

/**
 * Class CodeManager
 * This class is used for managing generated codes.
 *
 * @package Veeqtoh\DoorAccess\Classes
 */
class CodeManager
{
    use ConfigTrait;

    private CodeGenerator $codeGenerator;
    private DatabaseInterface $database;

    public function __construct(CodeGenerator $codeGenerator, DatabaseInterface $database)
    {
        $this->codeGenerator = $codeGenerator;
        $this->database = $database;
    }

    /**
     * Allocate a code to a team member.
     *
     * @param string $teamMemberId
     *
     * @return ?string
     */
    public function allocateCode(string $teamMemberId): ?string
    {
        // Check if a code is already allocated to the team member in the database
        $existingCode = $this->database->retrieve($teamMemberId);

        if ($existingCode) {
            return $existingCode;
        }

        $code = $this->codeGenerator->generateCode();

        // Store the generated code for the team member in the database
        $this->database->store($teamMemberId, $code);

        return $code;
    }

    /**
     * Reset a code and make it available for reallocation.
     *
     * @param string $code
     * @return bool
     */
    public function resetCode(string $code): bool
    {
        // Find the team member ID associated with the code in the database
        $teamMemberId = $this->database->retrieveTeamMemberId($code);

        if ($teamMemberId) {
            // Remove the code from the database
            return $this->database->delete($code);
        }

        return false;
    }
}
