<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Database;

use Veeqtoh\DoorAccess\Database\MySQLDatabase;
use Veeqtoh\DoorAccess\Database\SQLiteDatabase;

/**
 * Class DatabaseFactory
 * @package Veeqtoh\DoorAccess\Database
 */
class DatabaseFactory
{
    /**
     * Create a new database instance based on the provided connection parameters.
     *
     * @param string $type The type of database (e.g., 'mysql', 'sqlite', etc.).
     * @param array $connectionParameters The connection parameters for the database.
     * @return DatabaseInterface A new instance of the database implementing the DatabaseInterface.
     * @throws \InvalidArgumentException If an unsupported database type is provided.
     */
    public static function create(string $type, array $connectionParameters): DatabaseInterface
    {
        switch ($type) {
            case 'mysql':
                return new MySQLDatabase(...$connectionParameters);
            case 'sqlite':
                return new SQLiteDatabase(...$connectionParameters);
            default:
                throw new \InvalidArgumentException("Unsupported database type: $type");
        }
    }
}
