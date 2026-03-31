<?php

declare(strict_types=1);

namespace App\Validators;

/**
 * Modern Input Validation
 * 
 * @package App\Validators
 */
class InputValidator
{
    private array $errors = [];

    /**
     * Validate email
     * 
     * @param string $email
     * @return bool
     */
    public static function email(string $email): bool
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }

    /**
     * Validate username (3-20 alphanumeric characters)
     * 
     * @param string $username
     * @return bool
     */
    public static function username(string $username): bool
    {
        return preg_match('/^[a-zA-Z0-9_]{3,20}$/', $username) === 1;
    }

    /**
     * Validate password strength
     * 
     * @param string $password
     * @return bool
     */
    public static function passwordStrength(string $password): bool
    {
        // Minimum 8 characters, at least one uppercase, one lowercase, one number, one special char
        return preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/', $password) === 1;
    }

    /**
     * Sanitize string input
     * 
     * @param string $input
     * @return string
     */
    public static function sanitizeString(string $input): string
    {
        return htmlspecialchars(trim($input), ENT_QUOTES, 'UTF-8');
    }

    /**
     * Sanitize email
     * 
     * @param string $email
     * @return string|false
     */
    public static function sanitizeEmail(string $email): string|false
    {
        return filter_var(trim($email), FILTER_SANITIZE_EMAIL);
    }

    /**
     * Validate integer
     * 
     * @param mixed $value
     * @return bool
     */
    public static function integer(mixed $value): bool
    {
        return filter_var($value, FILTER_VALIDATE_INT) !== false;
    }

    /**
     * Validate URL
     * 
     * @param string $url
     * @return bool
     */
    public static function url(string $url): bool
    {
        return filter_var($url, FILTER_VALIDATE_URL) !== false;
    }

    /**
     * Validate required fields
     * 
     * @param array $data
     * @param array $required
     * @return bool
     */
    public static function required(array $data, array $required): bool
    {
        foreach ($required as $field) {
            if (empty($data[$field] ?? null)) {
                return false;
            }
        }
        return true;
    }
}
