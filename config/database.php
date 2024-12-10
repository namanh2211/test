<?php

namespace Config;

use PDO;

class Database {
    private $host = 'localhost';
    private $db_name = 'duan1';
    private $username = 'root';
    private $password = 'mysql';
    private $conn;

    public function connect() {
        if ($this->conn === null) {
            try {
                $this->conn = new PDO("mysql:host={$this->host};dbname={$this->db_name}", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database Connection Error: " . $e->getMessage());
            }
        }
        return $this->conn;
    }
}
