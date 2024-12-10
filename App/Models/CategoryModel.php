<?php

namespace App\Models;

use Config\Database;  // Vẫn giữ lại việc sử dụng Database từ config

class CategoryModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();  // Kết nối đến database
    }

    public function getAllCategories() {
        // Sử dụng PDO một cách trực tiếp mà không cần namespace App\Models\PDO
        $query = "SELECT * FROM categories";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);  // Sử dụng \PDO toàn cục
    }
}
