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
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $paymentMethod = $_POST['payment_method'];
            $totalAmount = $_POST['total_amount'];

            // Kiểm tra và xử lý thanh toán
            $paymentStatus = $this->paymentModel->processPayment($paymentMethod, $totalAmount);

            if ($paymentStatus) {
                // Thanh toán thành công, chuyển hướng đến trang thành công
                header('Location: success.php');
            } else {
                // Thanh toán thất bại
                echo "<div class='alert alert-danger'>Thanh toán thất bại. Vui lòng thử lại.</div>";
            }
        }
    }
}
