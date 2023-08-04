<?php
declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Database;

/**
 * Interface DatabaseInterface
 * @package Veeqtoh\DoorAccess\Database
 */
interface DatabaseInterface
{
    /**
     * Store the code associated with the team member in the database.
     *
     * @param string $teamMemberId
     * @param string $code
     * @return void
     */
    public function store(string $teamMemberId, string $code): void;

    /**
     * Retrieve the code associated with the team member from the database.
     *
     * @param string $teamMemberId
     * @return string|null
     */
    public function retrieve(string $teamMemberId): ?string;

    /**
     * Delete the code from the database.
     *
     * @param string $code
     * @return bool
     */
    public function delete(string $code): bool;
}
