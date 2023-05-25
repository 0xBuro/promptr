<?php 
require_once __DIR__ . '/../init.php';
require_once SERVICES_PATH . '/DatabaseService.php';

// db hsh config
$remote = [
    'host' => getenv('DB_HOST'),
    'dbname' => getenv('DB_NAME'),
    'username' => getenv('DB_USER'),
    'password' => getenv('DB_PASSWORD')
];


// db local config
$local = [
    'host' => 'localhost',
    'dbname' => 'promptr',
    'username' => 'root',
    'password' => ''
];

// set conn with local or remote
$conn = new DatabaseConnection($local);
$pdo = $conn->getPdo();

return $pdo;
?>