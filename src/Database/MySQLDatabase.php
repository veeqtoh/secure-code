<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Database;

use Illuminate\Support\Facades\DB;

/**
 * Class MySQLDatabase
 * @package Veeqtoh\DoorAccess\Database
 */
class MySQLDatabase implements DatabaseInterface
{
    /**
     * Store the code associated with the team member in the MySQL database.
     *
     * @param string $teamMemberId
     * @param string $code
     * @return void
     */
    public function store(string $teamMemberId, string $code): void
    {
        DB::table('door_access_codes')->insert([
            'team_member_id' => $teamMemberId,
            'code' => $code,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    /**
     * Retrieve the code associated with the team member from the MySQL database.
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
     * Retrieve the team member id associated with a given code from the MySQL database.
     *
     * @param string $code
     * @return int|null
     */
    public function retrieveTeamMemberId(string $code): ?string
    {
        return DB::table('door_access_codes')
            ->where('code', $code)
            ->value('team_member_id');
    }

    /**
     * Delete the code from the MySQL database.
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
