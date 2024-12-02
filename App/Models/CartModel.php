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
    public function processOrder($userId, $cart, $paymentMethod) {
        // Giả sử bạn sẽ lưu thông tin đơn hàng vào cơ sở dữ liệu
        // Giả lập lưu đơn hàng vào DB và trả về mã đơn hàng mới tạo
        $orderId = rand(1000, 9999);  // Tạo mã đơn hàng giả để minh họa

        // Lưu thông tin đơn hàng vào cơ sở dữ liệu (bạn có thể sử dụng PDO hoặc ORM)
        // Ví dụ:
        // $db->query("INSERT INTO orders (user_id, payment_method, total_price) VALUES (?, ?, ?)", [$userId, $paymentMethod, $totalPrice]);

        // Trả về ID đơn hàng vừa tạo
        return $orderId;
    }
    
}
