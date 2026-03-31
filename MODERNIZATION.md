# HMS - PHP Modernization Guide

## Overview
This guide explains the modernization improvements made to the Hospital Management System application.

## Modern PHP Features Implemented

### 1. **Strict Type Declarations**
All new files include `declare(strict_types=1)` for type safety:
```php
declare(strict_types=1);
```

### 2. **Type Hints and Return Types**
Modern type declarations for parameters and return values:
```php
public function findByUsername(string $username): ?stdClass
public function hash(string $password): string
public function query(string $query, array $params = []): mysqli_result|bool
```

### 3. **Namespaces**
Organized code into logical namespaces following PSR-4:
```
App\Config
App\Database
App\Models
App\Services
App\Middleware
App\Validators
App\Logger
```

### 4. **Environment Configuration**
Use `.env` file for configuration instead of hardcoded values:
```
DB_HOST=localhost
DB_PASSWORD=
APP_ENV=development
```

### 5. **Composer & Dependency Management**
Professional dependency management via `composer.json`:
```bash
composer install
composer require package/name
```

### 6. **Prepared Statements**
All database queries use prepared statements to prevent SQL injection:
```php
$this->db->query("SELECT * FROM users WHERE username = ?", [$username]);
```

### 7. **Modern Password Hashing**
Replaced deprecated MD5 with bcrypt:
```php
// Old way (INSECURE)
md5($password)

// New way (SECURE)
PasswordManager::hash($password)
PasswordManager::verify($plainPassword, $hash)
```

### 8. **Singleton Pattern**
Database and configuration use singleton pattern for efficiency:
```php
$db = Database::getInstance();
$config = Config::get('database.host');
```

### 9. **Session Security**
Secure session configuration:
```php
session_start([
    'secure' => true,
    'httponly' => true,
    'samesite' => 'Strict',
]);
```

### 10. **Input Validation & Sanitization**
Centralized validation utilities:
```php
InputValidator::email($email)
InputValidator::username($username)
InputValidator::sanitizeString($input)
InputValidator::passwordStrength($password)
```

### 11. **Logging**
Simple but effective logging system:
```php
$logger = new Logger();
$logger->info("User logged in", ['user_id' => 123]);
$logger->error("Login failed", ['username' => 'john']);
```

### 12. **Middleware Pattern**
Authentication middleware for route protection:
```php
$auth = new AuthMiddleware();
$auth->verify();
$auth->requireModule('patient_management');
```

## Installation & Setup

### 1. Install Composer Dependencies
```bash
cd /path/to/hms
composer install
```

### 2. Create .env File
```bash
cp .env.example .env
# Edit .env with your database configuration
```

### 3. Database
```bash
# Create database (already done)
mysql -u root < hms.sql
```

### 4. Run Application
```bash
# Using PHP built-in server
php -S localhost:8000

# Or use your local Apache/Nginx
```

## Migration Path

### Phase 1: Backward Compatibility (Current)
- New code in `/src` directory
- Legacy CodeIgniter code still active
- Gradual migration of controllers and models

### Phase 2: Modern Controllers
Migrate controllers to modern PHP:
```php
namespace App\Controllers;

class LoginController {
    private AuthService $auth;
    
    public function __construct() {
        $this->auth = new AuthService();
    }
    
    public function login(): void {
        if ($this->auth->login($_POST['username'], $_POST['password'])) {
            redirect('/dashboard');
        }
    }
}
```

### Phase 3: Modern Models
Replace CodeIgniter models with modern implementations:
```php
namespace App\Models;

class User {
    private Database $db;
    
    public function __construct() {
        $this->db = Database::getInstance();
    }
    
    public function findByUsername(string $username): ?stdClass { ... }
}
```

### Phase 4: Full Migration
Remove legacy code and complete modernization.

## Code Quality Standards

### PSR Compliance
- **PSR-1**: Basic Coding Standard
- **PSR-4**: Autoloading Standard
- **PSR-12**: Extended Coding Style Guide

### PHP Stan Analysis
```bash
composer run php-stan
```

### Code Sniffer
```bash
composer require --dev squizlabs/php_codesniffer
./vendor/bin/phpcs src/
```

## Security Best Practices

✅ **Implemented:**
- Prepared statements (prevent SQL injection)
- Bcrypt password hashing
- HTTPS-ready session configuration
- Input validation and sanitization
- Type declarations (prevent type juggling attacks)
- Error suppression in production

⚠️ **Still To Implement:**
- CSRF token protection
- Rate limiting
- API authentication (JWT)
- Data encryption at rest
- Audit logging

## Performance Improvements

1. **Singleton Pattern**: Avoid multiple database connections
2. **Type Hints**: PHP can optimize type-checked code
3. **Prepared Statements**: Optimized query execution
4. **Session Management**: Efficient user tracking

## Debugging & Development

### Enable Debug Mode
Edit `.env`:
```
APP_ENV=development
APP_DEBUG=true
```

### View Logs
```bash
tail -f logs/$(date +%Y-%m-%d).log
```

### Use Doctor Command
```bash
php -S localhost:8000 -t public
```

## Next Steps

1. ✅ Install Composer: `composer install`
2. ✅ Create `.env` file from `.env.example`
3. ✅ Test database connection
4. 🔄 Migrate one controller at a time
5. 🔄 Update views to use new models
6. 🔄 Implement middleware for protected routes
7. ✅ Enable logging for debugging
8. ✅ Run code quality checks

## Resources

- [PHP 8 Documentation](https://www.php.net/manual/en/index.php)
- [PSR Standards](https://www.php-fig.org/)
- [Composer Documentation](https://getcomposer.org/)
- [OWASP Security](https://owasp.org/)

## Support

For questions or issues with modernization:
1. Check the `src/` directory for examples
2. Review this documentation
3. Check logs in the `/logs` directory

---

**Last Updated**: March 2026
**PHP Version**: 8.0+
**Framework Version**: CodeIgniter 3 (Legacy) + Modern PHP
