<?php

declare(strict_types=1);

namespace App\Config;

use Dotenv\Dotenv;

/**
 * Application Configuration
 * 
 * @package App\Config
 */
class Config
{
    private static $instance = null;
    private array $config = [];

    private function __construct()
    {
        // Load environment variables
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../../');
        $dotenv->load();

        $this->config = [
            'app' => [
                'env' => $_ENV['APP_ENV'] ?? 'production',
                'debug' => filter_var($_ENV['APP_DEBUG'] ?? false, FILTER_VALIDATE_BOOLEAN),
                'name' => 'Hospital Management System',
            ],
            'database' => [
                'host' => $_ENV['DB_HOST'] ?? 'localhost',
                'port' => (int)($_ENV['DB_PORT'] ?? 3306),
                'username' => $_ENV['DB_USERNAME'] ?? 'root',
                'password' => $_ENV['DB_PASSWORD'] ?? '',
                'database' => $_ENV['DB_DATABASE'] ?? 'hms',
                'charset' => $_ENV['DB_CHARSET'] ?? 'utf8mb4',
            ],
            'logging' => [
                'level' => $_ENV['LOG_LEVEL'] ?? 'debug',
                'path' => __DIR__ . '/../../logs',
            ],
        ];
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
     * Get configuration value by dot notation
     * 
     * @param string $key e.g., 'database.host'
     * @param mixed $default
     * @return mixed
     */
    public static function get(string $key, mixed $default = null): mixed
    {
        $keys = explode('.', $key);
        $config = self::getInstance()->config;

        foreach ($keys as $k) {
            if (!isset($config[$k])) {
                return $default;
            }
            $config = $config[$k];
        }

        return $config;
    }
}
