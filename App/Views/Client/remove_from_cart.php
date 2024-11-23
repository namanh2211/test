<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['key'])) {
    $key = intval($_GET['key']); // Chỉ mục sản phẩm trong giỏ hàng
    if (isset($_SESSION['cart'][$key])) {
        unset($_SESSION['cart'][$key]); // Xóa sản phẩm
        $_SESSION['cart'] = array_values($_SESSION['cart']); // Đặt lại chỉ mục
    }
}

header('Location: cart.php');
exit;
?>
