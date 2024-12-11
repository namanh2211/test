<?php 
namespace App\Controllers;

use App\Models\CartModel;
use App\Helpers\SessionHelper;

class CheckoutController {
    private $cartModel;

    public function __construct() {
        $this->cartModel = new CartModel();
    }

    public function index() {
        // Bắt đầu session và kiểm tra trạng thái đăng nhập
        SessionHelper::start();
        if (!isset($_SESSION['user'])) {
            header('Location: login.php');
            exit;
        }

        // Kiểm tra nếu giỏ hàng trống
        if (empty($_SESSION['cart'])) {
            echo "<div class='container text-center mt-5'><h4>Giỏ hàng của bạn đang trống.</h4></div>";
            exit;
        }

        // Lấy dữ liệu giỏ hàng từ session
        $cart = $_SESSION['cart'];

        // Kiểm tra xem người dùng đã đăng nhập chưa
        $isLoggedIn = isset($_SESSION['user']);
        $user = $isLoggedIn ? $_SESSION['user'] : null;

        // Bao gồm view checkout.php
        require __DIR__ . '/../Views/Client/checkout.php';
    }

    // Phương thức xử lý thanh toán khi người dùng chọn phương thức thanh toán
    public function payment() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $customer_name = $_POST['customer_name'] ?? '';
            $customer_phone = $_POST['customer_phone'] ?? '';
            $shipping_address = $_POST['shipping_address'] ?? '';
            $payment_method = $_POST['payment_method'] ?? '';
            $total_amount = $_POST['total_amount'] ?? 0;

            // Kiểm tra dữ liệu đầu vào
            if (empty($customer_name) || empty($customer_phone) || empty($shipping_address)) {
                echo "<div class='alert alert-danger'>Vui lòng điền đầy đủ thông tin khách hàng!</div>";
                return;
            }

            // Lưu thông tin khách hàng vào session để sử dụng trong PaymentController
            $_SESSION['customer'] = [
                'name' => $customer_name,
                'phone' => $customer_phone,
                'address' => $shipping_address,
                'total_amount' => $total_amount,
            ];

            // Chuyển hướng đến PaymentController để xử lý thanh toán
            if ($payment_method === 'momo') {
                header('Location: /payment/processPayment');
                exit;
            } else {
                echo "<div class='alert alert-danger'>Phương thức thanh toán không được hỗ trợ!</div>";
            }
        }
    }
}
