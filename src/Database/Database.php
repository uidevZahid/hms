<?php

declare(strict_types=1);

namespace App\Database;

use mysqli;
use mysqli_result;
use Exception;
use App\Config\Config;

/**
 * Modern Database Connection Handler
 * 
 * @package App\Database
 */
class Database
{
    private static $instance = null;
    private mysqli $connection;

    private function __construct()
    {
        $this->connect();
    }

    /**
     * Establish database connection
     * 
     * @throws Exception
     */
    private function connect(): void
    {
        $config = [
            'host' => Config::get('database.host'),
            'port' => Config::get('database.port'),
            'user' => Config::get('database.username'),
            'password' => Config::get('database.password'),
            'database' => Config::get('database.database'),
            'charset' => Config::get('database.charset'),
        ];

        $this->connection = new mysqli(
            $config['host'],
            $config['user'],
            $config['password'],
            $config['database'],
            $config['port']
        );

        if ($this->connection->connect_error) {
            throw new Exception("Database connection failed: " . $this->connection->connect_error);
        }

        $this->connection->set_charset($config['charset']);
    }

    /**
     * Get singleton instance
     */
    public static function getInstance(): self
    {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    /**
     * Get mysqli connection
     */
    public function getConnection(): mysqli
    {
        return $this->connection;
    }

    /**
     * Execute prepared statement
     * 
     * @param string $query
     * @param array $params
     * @return mysqli_result|bool
     * @throws Exception
     */
    public function query(string $query, array $params = []): mysqli_result|bool
    {
        if (empty($params)) {
            return $this->connection->query($query);
        }

        $stmt = $this->connection->prepare($query);
        if (!$stmt) {
            throw new Exception("Query preparation failed: " . $this->connection->error);
        }

        if (!empty($params)) {
            $types = $this->getParamTypes($params);
            $stmt->bind_param($types, ...$params);
        }

        if (!$stmt->execute()) {
            throw new Exception("Query execution failed: " . $stmt->error);
        }

        return $stmt->get_result();
    }

    /**
     * Get parameter types string for bind_param
     * 
     * @param array $params
     * @return string
     */
    private function getParamTypes(array $params): string
    {
        $types = '';
        foreach ($params as $param) {
            if (is_int($param)) {
                $types .= 'i';
            } elseif (is_float($param)) {
                $types .= 'd';
            } else {
                $types .= 's';
            }
        }
        return $types;
    }

    /**
     * Fetch associative array from result
     * 
     * @param mysqli_result $result
     * @return array
     */
    public static function fetchAll(mysqli_result $result): array
    {
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    /**
     * Fetch single row
     * 
     * @param mysqli_result $result
     * @return array|null
     */
    public static function fetchOne(mysqli_result $result): ?array
    {
        return $result->fetch_assoc();
    }

    /**
     * Get last insert ID
     */
    public function lastInsertId(): int
    {
        return (int)$this->connection->insert_id;
    }

    /**
     * Close connection
     */
    public function close(): void
    {
        if (isset($this->connection)) {
            $this->connection->close();
        }
    }

    /**
     * Prevent cloning
     */
    private function __clone() {}

    /**
     * Prevent unserialization
     */
    private function __wakeup() {}
}
