<?php
namespace App\Controllers;

use App\Models\PaymentModel;

class PaymentController {
    private $paymentModel;

    public function __construct() {
        $this->paymentModel = new PaymentModel();
    }

    // Phương thức xử lý thanh toán
    public function processPayment() {
        // Kiểm tra thông tin thanh toán (ví dụ, thông tin thẻ, ngân hàng, ...)
        if (empty($_SESSION['cart'])) {
            echo "Giỏ hàng của bạn trống. Không thể thanh toán.";
            return;
        }

        // Giả sử bạn gọi một phương thức thanh toán (ví dụ: thông qua API thanh toán)
        $paymentStatus = $this->paymentModel->processPayment($_SESSION['cart']);

        if ($paymentStatus) {
            echo "Thanh toán thành công!";
        } else {
            echo "Thanh toán không thành công. Vui lòng thử lại.";
        }
    }
}
