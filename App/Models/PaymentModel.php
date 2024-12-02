<?php
namespace App\Models;

use PDO;

class PaymentModel {
    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;dbname=duan1;charset=utf8', 'root', 'mysql');
    }

    // Phương thức xử lý thanh toán
    public function processPayment($cart, $user) {
        try {
            // Giả sử bạn lưu thông tin đơn hàng vào database
            $stmt = $this->db->prepare("INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, ?)");
            $totalAmount = $this->calculateTotal($cart);
            $status = 'pending'; // Trạng thái ban đầu của đơn hàng
            $stmt->execute([$user['id'], $totalAmount, $status]);

            // Sau khi đơn hàng được lưu thành công, cập nhật trạng thái thanh toán
            return true;
        } catch (PDOException $e) {
            return false;
        }
    }

    // Tính tổng giá trị giỏ hàng
    private function calculateTotal($cart) {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}
