<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
include __DIR__ . '/../partials/header.php';

// Lấy thông tin sản phẩm từ session
$purchasedProduct = $_SESSION['purchased_product'] ?? null;

// Kiểm tra xem dữ liệu có tồn tại không
if (!$purchasedProduct || empty($purchasedProduct['products'])) {
    echo '<h1>Cảm ơn bạn đã thanh toán!</h1>';
    // Không gọi exit() ở đây, để mã tiếp tục thực thi và footer vẫn được bao gồm
} else {
    // Nếu có dữ liệu, hiển thị thông tin đơn hàng
    echo '<h1>Cảm ơn bạn đã thanh toán!</h1>';
}

include __DIR__ . '/../partials/footer.php';
?>