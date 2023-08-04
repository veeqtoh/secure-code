<?php
declare(strict_types=1);

namespace Veeqtoh\DoorAccess;

use Illuminate\Support\Facades\DB;

class CodeManager
{
    public function __construct(private CodeGenerator $codeGenerator, private array $rules)
    {
        $this->codeGenerator = $codeGenerator;
        $this->rules         = $rules;
    }

    /**
     * Allocate a code to a team member.
     *
     * @param string $teamMemberId
     * @return string|null
     */
    public function allocateCode(string $teamMemberId): ?string
    {
        // Check if a code is already allocated to the team member in the database
        $existingCode = DB::table('door_access_codes')
            ->where('team_member_id', $teamMemberId)
            ->value('code');

        if ($existingCode) {
            return $existingCode;
        }

        $code = $this->codeGenerator->generateCode($this->rules);

        // Store the generated code for the team member in the database
        DB::table('door_access_codes')->insert([
            'team_member_id' => $teamMemberId,
            'code'           => $code,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);

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
        $teamMemberId = DB::table('door_access_codes')
            ->where('code', $code)
            ->value('team_member_id');

        if ($teamMemberId) {
            // Remove the code from the database
            DB::table('door_access_codes')
                ->where('code', $code)
                ->delete();

            return true;
        }

        return false;
    }
}
