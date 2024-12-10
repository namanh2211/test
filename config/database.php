<?php

namespace Config;

use PDO;
use PDOException;

class Database {
    private $host = 'localhost';
    private $db_name = 'duan1';
    private $username = 'root';
    private $password = 'mysql';
    private $conn;

    public function connect() {
        if ($this->conn === null) {
            try {
                $dsn = "mysql:host={$this->host};dbname={$this->db_name};charset=utf8";
                $this->conn = new PDO($dsn, $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Database Connection Error: " . $e->getMessage());
            }
        }
        return $this->conn;
    }

    // Phương thức ngắt kết nối
    public function disconnect() {
        $this->conn = null;
    }

    // Phương thức thực thi truy vấn
    public function query($sql) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt;
    }

    // Phương thức thực thi các truy vấn với tham số
    public function execute($sql, $params = []) {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($params);
        return $stmt;
    }
}
