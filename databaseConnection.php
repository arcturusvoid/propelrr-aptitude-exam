<?php

class DatabaseConnection {
    private $host = 'localhost';
    private $dbname = 'propelrr_exam';
    private $username = 'root';
    private $password = '';
    private $pdo;

    public function __construct() {
        $this->connect();
    }

    public function connect() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Database Connection Error: " . $e->getMessage();
        }
    }

    public function getConnection() {
        return $this->pdo;
    }
}
