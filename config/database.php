<?php

class Database {
    private $host = "localhost";
    private $dbname = "duan1";
    private $username = "root";
    private $password = "mysql";

    public function connect() {
        try {
            $conn = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8", $this->username, $this->password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // echo "Kết nối cơ sở dữ liệu thành công!";
            return $conn;
        } catch (PDOException $e) {
            echo "Database Connection Error: " . $e->getCode() . " - " . $e->getMessage();
            exit;
        }
    }
}    
