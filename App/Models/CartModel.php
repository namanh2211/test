<?php
namespace App\Models;

use PDO;
use Config\Database;  // Vẫn giữ lại việc sử dụng Database từ config

class CartModel
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();  // Kết nối đến database
    }

    // Hàm lấy thông tin sản phẩm theo ID
    public function getProductById($productId)
    {
        // Sử dụng kết nối PDO để lấy thông tin sản phẩm
        $sql = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $productId, PDO::PARAM_INT);
        $stmt->execute();

        // Trả về kết quả hoặc false nếu không tìm thấy
        return $stmt->fetch(PDO::FETCH_ASSOC); // Nếu không có sản phẩm, sẽ trả về false
    }

    public function processOrder($userId, $cart, $paymentMethod)
    {
        // Giả sử bạn sẽ lưu thông tin đơn hàng vào cơ sở dữ liệu
        // Giả lập lưu đơn hàng vào DB và trả về mã đơn hàng mới tạo
        $orderId = rand(1000, 9999);  // Tạo mã đơn hàng giả để minh họa

        // Lưu thông tin đơn hàng vào cơ sở dữ liệu (bạn có thể sử dụng PDO hoặc ORM)
        // Ví dụ:
        // $db->query("INSERT INTO orders (user_id, payment_method, total_price) VALUES (?, ?, ?)", [$userId, $paymentMethod, $totalPrice]);

        // Trả về ID đơn hàng vừa tạo
        return $orderId;
    }
    // Phương thức thêm sản phẩm vào cơ sở dữ liệu
    public function addToCartDatabase($userId, $productId, $quantity)
    {
        // Kiểm tra xem sản phẩm đã có trong giỏ hàng của người dùng chưa
        $sql = "SELECT * FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
        $existingProduct = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($existingProduct) {
            // Nếu có rồi thì cập nhật số lượng
            $sql = "UPDATE cart SET quantity = quantity + :quantity WHERE user_id = :user_id AND product_id = :product_id";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->execute();
        } else {
            // Nếu chưa có thì thêm mới
            $sql = "INSERT INTO cart (user_id, product_id, quantity) VALUES (:user_id, :product_id, :quantity)";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
            $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
            $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
            $stmt->execute();
        }
    }
    // Cập nhật số lượng sản phẩm trong cơ sở dữ liệu
    public function updateCartDatabase($userId, $productId, $quantity)
    {
        $sql = "UPDATE cart SET quantity = :quantity WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':quantity', $quantity, PDO::PARAM_INT);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
    }
    // Xóa sản phẩm khỏi cơ sở dữ liệu
    public function removeFromCartDatabase($userId, $productId)
    {
        $sql = "DELETE FROM cart WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
    }



}
