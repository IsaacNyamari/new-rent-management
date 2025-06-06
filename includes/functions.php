<?php

/**
 * Loads an asset using document root as base
 * @param string $assetPath Relative path to the asset from document root
 * @return string Absolute path to the asset
 */
function loadAsset($assetPath)
{
    // Remove any leading/trailing slashes
    $cleanPath = trim($assetPath, '/\\');

    // Get base URL (you might need to configure this)
    $baseUrl = isset($_SERVER['HTTPS']) ? 'https://' : 'http://';
    $baseUrl .= $_SERVER['HTTP_HOST'];

    // If your assets are in a subdirectory, add it here
    $assetsBase = ''; // e.g., 'myapp/public'

    return $baseUrl . '/' . $assetsBase . '/' . $cleanPath;
}
// Usage example:
class Dbh
{
    private $host = 'localhost';
    private $db   = 'p_m_s';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    public $pdo;

    public function __construct()
    {
        $dsn = "mysql:host={$this->host};dbname={$this->db};charset={$this->charset}";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];
        try {
            $this->pdo = new PDO($dsn, $this->user, $this->pass, $options);
        } catch (\PDOException $e) {
            die('Database connection failed: ' . $e->getMessage());
        }
    }
}
class LoginHandler
{
    private $pdo;
    public $errors = [];
    
    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function handleRequest(string $email, string $password)
    {
        // Basic validation
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Valid email is required.';
        }
        if (empty($password)) {
            $this->errors[] = 'Password is required.';
        }

        // Attempt login
        if (empty($this->errors)) {
            $stmt = $this->pdo->prepare('SELECT id, name,role, password FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($user && password_verify($password, $user['password'])) {
                session_start();
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
               $role = $_SESSION['role'] = $user['role'];
                echo json_encode([
                    "status" => "success",
                    "redirectUrl" => "dashboard/$role/"
                ]);
                exit;
            } else {
                $this->errors[] = 'Invalid email or password.';
                echo json_encode(
                    ["error" => $this->errors]
                );
            }
        }
    }
}

class RegistrationHandler
{
    private $pdo;
    public $errors = [];
    public $email = '';
    public $name = '';
    public $phone = '';

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function handleRequest(string $name, string $email, string $password, string $phone, string $confirmPassword)
    {



        // Basic validation
        if (empty($name)) {
            $this->errors[] = 'Name is required.';
        }
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = 'Valid email is required.';
        }
        if (empty($password)) {
            $this->errors[] = 'Password is required.';
        }
        if ($password !== $confirmPassword) {
            $this->errors[] = 'Passwords do not match.';
        }

        // Check if email already exists
        if (empty($this->errors)) {
            $stmt = $this->pdo->prepare('SELECT id FROM users WHERE email = ?');
            $stmt->execute([$email]);
            if ($stmt->fetch()) {
                $this->errors[] = 'Email is already registered.';
            }
        }

        // Register user
        if (empty($this->errors)) {
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $stmt = $this->pdo->prepare('INSERT INTO users (name, email, password,phone) VALUES (?, ?, ?,?)');
            if ($stmt->execute([$name, $email, $hashedPassword, $phone])) {
                session_start();
                $_SESSION['user_id'] = $this->pdo->lastInsertId();
                $_SESSION['user_name'] = $this->name;
                echo json_encode([
                    "status" => "success",
                    "redirectUrl" => "dashboard/"
                ]);
                exit;
            } else {
                echo json_encode(
                    ["errors" => $this->errors]
                );
            }
        }
    }
}

if(isset($_POST['action'])){
$action = $_POST['action'];
switch($action){
        case 'login':
            $db = new Dbh();
        $login = new LoginHandler($db->pdo);
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        echo $login->handleRequest($email, $password);
        case 'register':
            $db = new Dbh();
            $name = trim($_POST['name'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $phone = trim($_POST['phone'] ?? '');
            $password = $_POST['password'] ?? '';
            $confirmPassword = $_POST['confirm_password'] ?? '';
            $register = new RegistrationHandler($db->pdo);
           echo $register->handleRequest($name, $email, $password, $phone, $confirmPassword);

    }
}