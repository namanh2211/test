<?php 
namespace App\Models;

use PDO;
use Config\Database;  // Vẫn giữ lại việc sử dụng Database từ config

class CartModel {
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();  // Kết nối đến database
    }

    // Hàm lấy thông tin sản phẩm theo ID
    public function getProductById($productId) {
        // Sử dụng kết nối PDO để lấy thông tin sản phẩm
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        
        // Trả về kết quả hoặc false nếu không tìm thấy
        return $stmt->fetch(PDO::FETCH_ASSOC); // Nếu không có sản phẩm, sẽ trả về false
    }
    
}
