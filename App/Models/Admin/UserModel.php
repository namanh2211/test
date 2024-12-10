<?php

namespace App\Models\Admin;

use PDO;
use Config\Database;

class UserModel
{

    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();    // Kết nối cơ sở dữ liệu
    }

    // Lấy tất cả người dùng
    public function getAllUsers()
    {
        $sql = "SELECT * FROM users";
        $stmt = $this->db->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function deleteUser($userId)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $userId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->rowCount() > 0; // Trả về true nếu xóa thành công
    }

    public function usernameExists($username)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE username = :username";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }

    // Phương thức kiểm tra xem email đã tồn tại chưa
    public function emailExists($email)
    {
        $sql = "SELECT COUNT(*) FROM users WHERE email = :email";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0; // Nếu email tồn tại thì trả về true
    }

    // Phương thức thêm người dùng
    public function addUser($username, $password, $email, $fullname, $role)
    {
        // Lệnh SQL để thêm người dùng vào cơ sở dữ liệu
        $sql = "INSERT INTO users (username, password, email, full_name, role, created_at) 
                VALUES (:username, :password, :email, :full_name, :role, NOW())";

        $stmt = $this->db->prepare($sql);
        // Mã hóa mật khẩu trước khi lưu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Gắn các tham số vào câu lệnh SQL
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':full_name', $fullname);
        $stmt->bindParam(':role', $role);

        // Thực thi câu lệnh
        $stmt->execute();
        return true; // Trả về true nếu thành công
    }

    public function getUserById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->execute(['id' => $id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePassword($id, $hashedPassword)
    {
        $stmt = $this->db->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->execute([
            'password' => $hashedPassword,
            'id' => $id,
        ]);
    }

    public function updateUserById($id, $name, $role)
    {
        $stmt = $this->db->prepare("UPDATE users SET full_name = :name, role = :role WHERE id = :id");
        $stmt->execute([
            'id' => $id,
            'name' => $name,
            'role' => $role // 'Admin' hoặc 'User'
        ]);
    }

    public function checkLogin($username, $password)
    {
        // Giả sử bạn kiểm tra trong cơ sở dữ liệu
        $stmt = $this->db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Kiểm tra mật khẩu
        if ($user && password_verify($password, $user['password'])) {
            return $user; // Trả về thông tin người dùng nếu đăng nhập thành công
        }

        return false; // Trả về false nếu thông tin không đúng
    }
}
