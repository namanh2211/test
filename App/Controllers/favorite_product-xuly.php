<?php
session_start(); // Bắt đầu phiên làm việc

// Kiểm tra xem có tham số `action` và `id` trong URL không
if (isset($_GET['action'])) {
    // Nếu action là "add" thì thêm sản phẩm vào danh sách yêu thích
    if ($_GET['action'] == 'add' && isset($_GET['id'])) {
        $product_id = intval($_GET['id']); // Lấy ID sản phẩm từ URL

        // Kiểm tra nếu danh sách yêu thích chưa có
        if (!isset($_SESSION['favorite_products'])) {
            $_SESSION['favorite_products'] = []; // Khởi tạo danh sách nếu chưa có
        }

        // Kiểm tra nếu sản phẩm đã có trong danh sách yêu thích chưa
        $product_exists = false;
        foreach ($_SESSION['favorite_products'] as $fav_product) {
            if ($fav_product['id'] == $product_id) {
                $product_exists = true;
                break;
            }
        }

        // Nếu sản phẩm chưa có trong danh sách yêu thích, thêm vào
        if (!$product_exists) {
            // Tạo mảng thông tin sản phẩm (có thể lấy từ cơ sở dữ liệu)
            // Ví dụ: Lấy thông tin từ cơ sở dữ liệu (ở đây chỉ có một số dữ liệu mẫu)
            $product = [
                'id' => $product_id,
                'name' => 'Product ' . $product_id, // Tên sản phẩm (thay bằng dữ liệu thực)
                'price' => 150, // Giá (thay bằng dữ liệu thực)
                'image_path' => 'img/product-' . $product_id . '.jpg', // Đường dẫn ảnh (thay bằng dữ liệu thực)
            ];

            // Thêm sản phẩm vào danh sách yêu thích
            $_SESSION['favorite_products'][] = $product;
        }
    }

    // Nếu action là "remove" thì xóa sản phẩm khỏi danh sách yêu thích
    if ($_GET['action'] == 'remove' && isset($_GET['id'])) {
        $product_id = intval($_GET['id']); // Lấy ID sản phẩm từ URL

        // Kiểm tra nếu danh sách yêu thích có
        if (isset($_SESSION['favorite_products'])) {
            // Xóa sản phẩm khỏi danh sách yêu thích
            foreach ($_SESSION['favorite_products'] as $key => $fav_product) {
                if ($fav_product['id'] == $product_id) {
                    unset($_SESSION['favorite_products'][$key]);
                    $_SESSION['favorite_products'] = array_values($_SESSION['favorite_products']); // Reindex lại mảng
                    break;
                }
            }
        }
    }
}

// Chuyển hướng lại về trang danh sách yêu thích
header("Location: favorite_product.php");
exit;
?>
