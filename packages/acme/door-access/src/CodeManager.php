<?php
declare(strict_type=1);

namespace Veeqtoh\DoorAccess;

class CodeManager
{
    /**
     * Allocate a code to a team member.
     *
     * @param string $teamMemberId
     * @return string|null
     */
    public function allocateCode(string $teamMemberId): ?string
    {
        $generator = app('code.generator');
        return $generator->generateCode();
    }

    /**
     * Reset a code and make it available for reallocation.
     *
     * @param string $code
     * @return bool
     */
    public function resetCode(string $code): bool
    {
        return true;
    }
}