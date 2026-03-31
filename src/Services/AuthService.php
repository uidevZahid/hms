<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Utils\PasswordManager;
use stdClass;

/**
 * Authentication Service with modern security practices
 * 
 * @package App\Services
 */
class AuthService
{
    private User $userModel;
    private const SESSION_PREFIX = 'auth_';

    public function __construct()
    {
        $this->userModel = new User();
        $this->startSession();
    }

    /**
     * Start PHP session securely
     */
    private function startSession(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start([
                'secure' => true,
                'httponly' => true,
                'samesite' => 'Strict',
            ]);
        }
    }

    /**
     * Authenticate user with username and password
     * 
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function login(string $username, string $password): bool
    {
        // Sanitize input
        $username = trim($username);
        $password = trim($password);

        if (empty($username) || empty($password)) {
            return false;
        }

        // Find user
        $user = $this->userModel->findByUsername($username);
        if (!$user) {
            return false;
        }

        // Verify password
        if (!PasswordManager::verify($password, $user->password)) {
            return false;
        }

        // Set session
        $this->setUserSession($user);

        return true;
    }

    /**
     * Set user session data
     * 
     * @param stdClass $user
     */
    private function setUserSession(stdClass $user): void
    {
        $_SESSION[self::SESSION_PREFIX . 'user_id'] = $user->user_id;
        $_SESSION[self::SESSION_PREFIX . 'username'] = $user->username;
        $_SESSION[self::SESSION_PREFIX . 'user_role'] = $user->user_role;
        $_SESSION[self::SESSION_PREFIX . 'email'] = $user->email ?? '';
        $_SESSION[self::SESSION_PREFIX . 'is_logged_in'] = true;
        $_SESSION[self::SESSION_PREFIX . 'login_time'] = time();

        // Get user modules
        $modules = $this->userModel->getUserModules($user->user_id);
        $_SESSION[self::SESSION_PREFIX . 'modules'] = $modules;
    }

    /**
     * Check if user is authenticated
     */
    public function isAuthenticated(): bool
    {
        return $_SESSION[self::SESSION_PREFIX . 'is_logged_in'] ?? false;
    }

    /**
     * Get current user ID
     */
    public function getUserId(): ?int
    {
        return $_SESSION[self::SESSION_PREFIX . 'user_id'] ?? null;
    }

    /**
     * Get current user username
     */
    public function getUsername(): ?string
    {
        return $_SESSION[self::SESSION_PREFIX . 'username'] ?? null;
    }

    /**
     * Get current user role
     */
    public function getUserRole(): ?int
    {
        return $_SESSION[self::SESSION_PREFIX . 'user_role'] ?? null;
    }

    /**
     * Get user modules
     */
    public function getUserModules(): array
    {
        return $_SESSION[self::SESSION_PREFIX . 'modules'] ?? [];
    }

    /**
     * Check if user has permission for module
     */
    public function hasModule(string $module): bool
    {
        $modules = $this->getUserModules();
        return in_array($module, $modules, true);
    }

    /**
     * Logout user
     */
    public function logout(): void
    {
        session_destroy();
    }
}
