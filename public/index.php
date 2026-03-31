<?php

declare(strict_types=1);

/**
 * Modern PHP Entry Point - Hospital Management System
 * 
 * PHP Version: 8.0+
 * 
 * This is the main entry point for the HMS application with modern PHP practices.
 */

// Set error reporting
error_reporting(E_ALL);
ini_set('display_errors', '0');
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/../logs/php-errors.log');

// Define root path
define('ROOT_PATH', dirname(__DIR__));
define('APP_PATH', ROOT_PATH . '/application');
define('PUBLIC_PATH', __DIR__);

/**
 * Load Composer autoloader
 */
if (!file_exists(ROOT_PATH . '/vendor/autoload.php')) {
    die("ERROR: Composer dependencies not installed. Run: composer install");
}

require_once ROOT_PATH . '/vendor/autoload.php';

/**
 * Load CodeIgniter for backward compatibility
 */
$system_path = ROOT_PATH . '/system';
$application_folder = 'application';

if (!file_exists($system_path . '/core/CodeIgniter.php')) {
    die("ERROR: CodeIgniter framework not found.");
}

define('BASEPATH', $system_path . DIRECTORY_SEPARATOR);
define('APPPATH', ROOT_PATH . DIRECTORY_SEPARATOR . $application_folder . DIRECTORY_SEPARATOR);
define('VIEWPATH', APPPATH . 'views' . DIRECTORY_SEPARATOR);

// Set environment
$_ENV['CI_ENV'] = $_ENV['APP_ENV'] ?? 'production';

require_once BASEPATH . 'core/CodeIgniter.php';
