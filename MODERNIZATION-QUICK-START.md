# Modern PHP - Quick Reference

## Creating Modern Controllers

### Before (CodeIgniter 3 - OLD):
```php
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends General{
    function __construct(){
        parent::__construct();	
        $this->load->model('login_model');
    }
    
    function loginNow($username,$password){
        $this->data['usernamelogin'] = $username;
        $this->load->view("login",$this->data);		
    }
}
```

### After (Modern PHP - NEW):
```php
<?php declare(strict_types=1);

namespace App\Controllers;

class LoginController {
    private AuthService $auth;

    public function __construct() {
        $this->auth = new AuthService();
    }
    
    public function authenticate(): void {
        if ($this->auth->login($username, $password)) {
            header('Location: /dashboard');
            exit;
        }
    }
}
```

## Creating Modern Models

### Before (CodeIgniter 3 - OLD):
```php
<?php
class Login_model extends CI_Model{
    public function validate_login(){
        $this->db->select("username,password");
        $this->db->where(array(
            'username' => $this->input->post('username'),
            'password' => md5($this->input->post('password'))
        ));
        $query = $this->db->get('users');
        return $query->num_rows() == 1;
    }
}
```

### After (Modern PHP - NEW):
```php
<?php declare(strict_types=1);

namespace App\Models;

class User {
    private Database $db;

    public function findByUsername(string $username): ?stdClass {
        $query = "SELECT * FROM users WHERE username = ? AND inactive = 0";
        $result = $this->db->query($query, [$username]);
        return Database::fetchOne($result);
    }
}
```

## Key Improvements Checklist

- ✅ `declare(strict_types=1)` - Type safety
- ✅ Type hints on parameters: `string $username`
- ✅ Type hints on returns: `: ?stdClass`
- ✅ Prepared statements: `WHERE username = ?`
- ✅ Bcrypt hashing: `password_hash()` not `md5()`
- ✅ Namespaces: `namespace App\Models;`
- ✅ PSR-4 Autoloading: Files automatically loaded
- ✅ Dependency Injection: Pass dependencies via constructor
- ✅ Modern PHP 8 syntax: `string|false`, `?stdClass`

## Usage Examples

### Use Modern Auth Service
```php
$auth = new \App\Services\AuthService();
if ($auth->login('user', 'pass')) {
    echo "Welcome " . $auth->getUsername();
}
```

### Use Modern Database
```php
$db = \App\Database\Database::getInstance();
$result = $db->query("SELECT * FROM users WHERE id = ?", [1]);
$user = \App\Database\Database::fetchOne($result);
```

### Use Modern Validation
```php
if (!\App\Validators\InputValidator::email($email)) {
    echo "Invalid email";
}

$safe = \App\Validators\InputValidator::sanitizeString($input);
```

### Use Logger
```php
$logger = new \App\Logger\Logger();
$logger->info("User logged in", ['user_id' => 123]);
$logger->error("Database error", ['query' => $sql]);
```

## File Structure

```
/hms
├── /src                          # Modern PHP code
│   ├── /Config                   # Configuration
│   ├── /Database                 # Database layer
│   ├── /Models                   # Data models
│   ├── /Services                 # Business logic
│   ├── /Controllers              # HTTP controllers
│   ├── /Middleware               # Route middleware
│   ├── /Validators               # Input validation
│   └── /Logger                   # Logging
├── /application                  # Legacy CodeIgniter 3
├── /public                       # Web root
├── /logs                         # Application logs
├── .env                          # Environment config
├── .env.example                  # Config template
├── composer.json                 # Dependency management
└── MODERNIZATION.md              # This guide
```

## Next Steps for Migration

### 1. Update One Controller at a Time
```bash
# Old: /application/controllers/Login.php
# New: /src/Controllers/LoginController.php
```

### 2. Create Modern Route Handler
```php
// routes.php or router
$route = $_GET['route'] ?? 'login';
if ($route === 'login') {
    $controller = new \App\Controllers\LoginController();
    $controller->showForm();
}
```

### 3. Test & Verify
- Load the login page
- Test login with valid credentials
- Test login with invalid credentials
- Check logs: `/logs/2026-03-31.log`

### 4. Repeat for Other Controllers
- `General.php` → `GeneralController.php`
- `Myprofile.php` → `ProfileController.php`
- `Angular.php` → `ApiController.php`

## Debugging Modern Code

### Check if Environment Loaded
```php
echo \App\Config\Config::get('app.env');
```

### Test Database Connection
```php
try {
    $db = \App\Database\Database::getInstance();
    echo "Connected!";
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
```

### View Recent Logs
```php
// Check logs/2026-03-31.log
```

## Common Issues & Solutions

### Issue: "Class not found"
**Solution**: Ensure `composer install` was run and file follows PSR-4 naming

### Issue: "Database connection failed"  
**Solution**: Check `.env` file database credentials

### Issue: "Method not allowed"
**Solution**: Ensure `declare(strict_types=1)` and type hints are correct

### Issue: "Undefined variable"
**Solution**: Check namespace imports and use statements

## Performance Tips

1. Use singleton pattern for shared resources
2. Cache configuration values
3. Use prepared statements
4. Enable query caching in production
5. Log to files, not database

## Security Checklist

- ✅ Use bcrypt for passwords
- ✅ Always use prepared statements
- ✅ Validate and sanitize input
- ✅ Use secure session settings
- ✅ Enable HTTPS in production
- ✅ Never hard-code secrets (use .env)
- ✅ Log security events

---

For more information, see [MODERNIZATION.md](MODERNIZATION.md)
