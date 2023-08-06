<?php

declare(strict_types=1);

namespace Veeqtoh\DoorAccess\Database;

use PDO;
use PDOException;

/**
 * Class SQLiteDatabase
 * @package Veeqtoh\DoorAccess\Database
 */
class SQLiteDatabase implements DatabaseInterface
{
    private PDO $connection;

    public function __construct(
        private string $databasePath,
        private string $table
    ) {
        $this->connect();
    }

    private function connect(): void
    {
        try {
            $dsn = "sqlite:{$this->databasePath}";
            $this->connection = new PDO($dsn);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            throw new \RuntimeException('Failed to connect to the database: ' . $e->getMessage());
        }
    }

    public function store(string $teamMemberId, string $code): void
    {
        try {
            $sql = "INSERT INTO {$this->table} (team_member_id, code, created_at, updated_at) VALUES (?, ?, datetime('now'), datetime('now'))";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$teamMemberId, $code]);
        } catch (PDOException $e) {
            throw new \RuntimeException('Failed to store the code: ' . $e->getMessage());
        }
    }

    public function retrieve(string $teamMemberId): ?string
    {
        try {
            $sql = "SELECT code FROM {$this->table} WHERE team_member_id = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$teamMemberId]);
            return $stmt->fetchColumn() ?: null;
        } catch (PDOException $e) {
            throw new \RuntimeException('Failed to retrieve the code: ' . $e->getMessage());
        }
    }

    public function retrieveTeamMemberId(string $code): ?string
    {
        try {
            $sql = "SELECT team_member_id FROM {$this->table} WHERE code = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$code]);
            return $stmt->fetchColumn() ?: null;
        } catch (PDOException $e) {
            throw new \RuntimeException('Failed to retrieve the team member ID: ' . $e->getMessage());
        }
    }

    public function delete(string $code): bool
    {
        try {
            $sql = "DELETE FROM {$this->table} WHERE code = ?";
            $stmt = $this->connection->prepare($sql);
            $stmt->execute([$code]);
            return $stmt->rowCount() > 0;
        } catch (PDOException $e) {
            throw new \RuntimeException('Failed to delete the code: ' . $e->getMessage());
        }
    }
}
