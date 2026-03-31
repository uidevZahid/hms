<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Services\AuthService;
use App\Validators\InputValidator;
use App\Logger\Logger;

/**
 * Modern Login Controller Example
 * 
 * Shows how to migrate from CodeIgniter 3 to modern PHP
 * 
 * @package App\Controllers
 */
class LoginController
{
    private AuthService $auth;
    private Logger $logger;

    public function __construct()
    {
        $this->auth = new AuthService();
        $this->logger = new Logger();
    }

    /**
     * Show login form
     * 
     * @return void
     */
    public function showForm(): void
    {
        if ($this->auth->isAuthenticated()) {
            header('Location: /app/dashboard');
            exit;
        }

        // Load view
        include __DIR__ . '/../../application/views/login.php';
    }

    /**
     * Handle login request
     * 
     * @return void
     */
    public function authenticate(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            die('Method not allowed');
        }

        // Get and validate input
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        // Validate required fields
        if (empty($username) || empty($password)) {
            $this->logger->warning('Login attempt with empty credentials', ['ip' => $_SERVER['REMOTE_ADDR']]);
            $_SESSION['error'] = 'Username and password are required';
            header('Location: /login');
            exit;
        }

        // Sanitize input
        $username = InputValidator::sanitizeString($username);

        // Attempt login
        if ($this->auth->login($username, $password)) {
            $this->logger->info('User logged in successfully', ['username' => $username]);
            
            $_SESSION['success'] = 'Welcome, ' . $this->auth->getUsername() . '!';
            header('Location: /app/dashboard');
            exit;
        }

        // Login failed
        $this->logger->warning('Failed login attempt', [
            'username' => $username,
            'ip' => $_SERVER['REMOTE_ADDR'],
        ]);

        $_SESSION['error'] = 'Invalid username or password';
        header('Location: /login');
        exit;
    }

    /**
     * Handle logout
     * 
     * @return void
     */
    public function logout(): void
    {
        $username = $this->auth->getUsername();
        
        $this->auth->logout();
        
        $this->logger->info('User logged out', ['username' => $username]);
        
        header('Location: /login');
        exit;
    }
}
