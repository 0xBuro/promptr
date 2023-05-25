<?php

class DatabaseConnection {
    private $pdo;

    public function __construct($config) {
        try {
            $dsn = "mysql:host={$config['host']};dbname={$config['dbname']}";
            $this->pdo = new PDO($dsn, $config['username'], $config['password']);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->exec("SET NAMES utf8mb4");
        } catch (PDOException $e) {
            die("Database connection error: " . $e->getMessage());
        }
    }
    
    public function getPDO() {
        return $this->pdo;
    }
}

?>