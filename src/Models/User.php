<?php

declare(strict_types=1);

namespace App\Models;

use App\Database\Database;
use stdClass;

/**
 * User Model with modern PHP practices
 * 
 * @package App\Models
 */
class User
{
    private Database $db;

    public function __construct()
    {
        $this->db = Database::getInstance();
    }

    /**
     * Find user by username
     * 
     * @param string $username
     * @return stdClass|null
     */
    public function findByUsername(string $username): ?stdClass
    {
        $query = "SELECT * FROM users WHERE username = ? AND inactive = 0";
        $result = $this->db->query($query, [$username]);
        
        if (!$result) {
            return null;
        }

        $row = Database::fetchOne($result);
        return $row ? (object)$row : null;
    }

    /**
     * Find user by ID
     * 
     * @param int $userId
     * @return stdClass|null
     */
    public function findById(int $userId): ?stdClass
    {
        $query = "SELECT * FROM users WHERE user_id = ? AND inactive = 0";
        $result = $this->db->query($query, [$userId]);
        
        if (!$result) {
            return null;
        }

        $row = Database::fetchOne($result);
        return $row ? (object)$row : null;
    }

    /**
     * Get user modules/permissions
     * 
     * @param int $userId
     * @return array
     */
    public function getUserModules(int $userId): array
    {
        $query = "
            SELECT DISTINCT ur.module 
            FROM users u
            INNER JOIN user_roles ur ON ur.role_id = u.user_role
            WHERE u.user_id = ?
        ";
        
        $result = $this->db->query($query, [$userId]);
        
        if (!$result) {
            return [];
        }

        $modules = [];
        foreach (Database::fetchAll($result) as $row) {
            $modules[] = $row['module'];
        }

        return $modules;
    }

    /**
     * Get user role
     * 
     * @param int $roleId
     * @return stdClass|null
     */
    public function getRole(int $roleId): ?stdClass
    {
        $query = "SELECT * FROM user_roles WHERE role_id = ?";
        $result = $this->db->query($query, [$roleId]);
        
        if (!$result) {
            return null;
        }

        $row = Database::fetchOne($result);
        return $row ? (object)$row : null;
    }

    /**
     * Create new user
     * 
     * @param array $data
     * @return int|false
     */
    public function create(array $data): int|false
    {
        $query = "
            INSERT INTO users (username, password, user_role, email, inactive)
            VALUES (?, ?, ?, ?, ?)
        ";

        $result = $this->db->query($query, [
            $data['username'] ?? '',
            $data['password'] ?? '',
            $data['user_role'] ?? 0,
            $data['email'] ?? '',
            $data['inactive'] ?? 0,
        ]);

        return $result ? $this->db->lastInsertId() : false;
    }

    /**
     * Update user
     * 
     * @param int $userId
     * @param array $data
     * @return bool
     */
    public function update(int $userId, array $data): bool
    {
        $fields = [];
        $values = [];

        foreach ($data as $key => $value) {
            $fields[] = "$key = ?";
            $values[] = $value;
        }

        $values[] = $userId;

        $query = "UPDATE users SET " . implode(', ', $fields) . " WHERE user_id = ?";
        return (bool)$this->db->query($query, $values);
    }
}
