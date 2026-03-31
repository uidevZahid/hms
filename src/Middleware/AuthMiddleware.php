<?php

declare(strict_types=1);

namespace App\Middleware;

use App\Services\AuthService;

/**
 * Authentication Middleware
 * 
 * Checks if user is authenticated before allowing access to protected routes
 * 
 * @package App\Middleware
 */
class AuthMiddleware
{
    private AuthService $auth;

    public function __construct()
    {
        $this->auth = new AuthService();
    }

    /**
     * Verify authentication
     * 
     * @return bool
     */
    public function verify(): bool
    {
        if (!$this->auth->isAuthenticated()) {
            http_response_code(401);
            header('Location: /login');
            exit;
        }

        return true;
    }

    /**
     * Verify user has required module/permission
     * 
     * @param string $module
     * @return bool
     */
    public function requireModule(string $module): bool
    {
        if (!$this->auth->hasModule($module)) {
            http_response_code(403);
            header('Location: /access-denied');
            exit;
        }

        return true;
    }
}
