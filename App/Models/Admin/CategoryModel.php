<?php

namespace App\Models\Admin;

use PDO;
use Config\Database;

class CategoryModel
{
    protected $db;

    public function __construct()
    {
        // Kết nối cơ sở dữ liệu thông qua Database config
        $this->db = (new Database())->connect();   // Giả sử Database::getConnection() trả về đối tượng PDO
    }

    // Phương thức lấy tất cả danh mục
    public function getAllCategories()
    {
        $sql = "SELECT * FROM categories";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);  // Trả về tất cả các danh mục dưới dạng mảng
    }

    // Phương thức thêm danh mục mới vào cơ sở dữ liệu
    public function addCategory($category_name, $description)
    {
        // Câu truy vấn thêm danh mục vào cơ sở dữ liệu
        $sql = "INSERT INTO categories (category_name, description) VALUES (:category_name, :description)";
        $stmt = $this->db->prepare($sql);

        // Liên kết giá trị
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':description', $description);

        // Thực thi câu lệnh và trả về true nếu thành công
        return $stmt->execute();
    }

    public function getCategoryById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function updateCategory($id, $category_name, $description)
    {
        $stmt = $this->db->prepare("UPDATE categories SET category_name = :category_name, description = :description WHERE id = :id");
        $stmt->bindParam(':category_name', $category_name);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function deleteCategoryById($id) {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
        return $stmt->execute();
    }
    
    

}
