<?php
namespace App\Models;

use PDO;

class UserModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Lấy thông tin người dùng theo username
    public function getUserByUsername($username) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin người dùng theo email
    public function getUserByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tạo người dùng mới
    public function createUser($data) {
        $stmt = $this->db->prepare("INSERT INTO users (full_name, address, phone, username, email, password, created_at) 
            VALUES (:full_name, :address, :phone, :username, :email, :password, NOW())");
        $stmt->bindParam(':full_name', $data['full_name']);
        $stmt->bindParam(':address', $data['address']);
        $stmt->bindParam(':phone', $data['phone']);
        $stmt->bindParam(':username', $data['username']);
        $stmt->bindParam(':email', $data['email']);
        $stmt->bindParam(':password', $data['password']);
        $stmt->execute();
    }
}
