<?php
// app/Controllers/PaymentController.php
namespace App\Controllers;
class PaymentController
{
    public function index()
    {
        // Lấy thông tin thanh toán từ session
        if (isset($_SESSION['paymentData'])) {
            $paymentData = $_SESSION['paymentData'];
        } else {
            echo "Không có thông tin thanh toán!";
            return;
        }

        // Hiển thị trang payment
        require_once __DIR__ . '/../views/payment.php';
    }
}
