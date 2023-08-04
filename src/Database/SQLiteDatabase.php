<?php
declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Database;

use Illuminate\Support\Facades\DB;

/**
 * Class SQLiteDatabase
 * @package Veeqtoh\DoorAccess\Database
 */
class SQLiteDatabase implements DatabaseInterface
{
    /**
     * Store the code associated with the team member in the SQLite database.
     *
     * @param string $teamMemberId
     * @param string $code
     * @return void
     */
    public function store(string $teamMemberId, string $code): void
    {
        DB::table('door_access_codes')->insert([
            'team_member_id' => $teamMemberId,
            'code'           => $code,
            'created_at'     => now(),
            'updated_at'     => now(),
        ]);
    }

    /**
     * Retrieve the code associated with the team member from the SQLite database.
     *
     * @param string $teamMemberId
     * @return string|null
     */
    public function retrieve(string $teamMemberId): ?string
    {
        return DB::table('door_access_codes')
            ->where('team_member_id', $teamMemberId)
            ->value('code');
    }

    /**
     * Delete the code from the SQLite database.
     *
     * @param string $code
     * @return bool
     */
    public function delete(string $code): bool
    {
        return (bool) DB::table('door_access_codes')
            ->where('code', $code)
            ->delete();
    }
}
