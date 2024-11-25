<?php

namespace App\Controllers;

use App\Models\CartModel;
session_start(); // Khởi tạo session trước khi sử dụng

class CartController
{
    private $cartModel;

    public function __construct()
    {
        // Khởi tạo đối tượng CartModel để thao tác với dữ liệu giỏ hàng
        $this->cartModel = new CartModel();
    }

    // Hiển thị giỏ hàng
    public function index() {
        // Kiểm tra giỏ hàng có trong session không
        $cartItems = isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    
        // Tính tổng tiền từ các sản phẩm trong giỏ hàng
        $subtotal = 0;
    
        foreach ($cartItems as $key => $item) {

            if (isset($item['id'])) {
            // Lấy thông tin sản phẩm từ cơ sở dữ liệu
            $product = $this->cartModel->getProductById($item['id']);
            if ($product) {
                $item['product_name'] = $product['product_name'];
                $item['price'] = $product['price'];
                $item['image'] = $product['image_path']; // Đảm bảo sử dụng image_path từ cơ sở dữ liệu
                $subtotal += $product['price'] * $item['quantity']; // Tính tổng tiền giỏ hàng
            } else {
                echo "Sản phẩm không tồn tại trong cơ sở dữ liệu.";
            }
        }else{
            echo "Giỏ hàng có sản phẩm thiếu ID.";
        }
    }

    // Render view giỏ hàng với danh sách sản phẩm và tổng tiền
    renderView('Client/cart', compact('cartItems', 'subtotal'));
}

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove()
    {
        $key = $_GET['key'] ?? null;
        if ($key !== null) {
            // Xóa sản phẩm khỏi giỏ hàng trong session
            unset($_SESSION['cart'][$key]);
        }
        // Chuyển hướng về trang giỏ hàng sau khi xóa
        header('Location: /cart');
        exit();
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function update()
    {
        $key = $_POST['key'] ?? null;
        $quantity = $_POST['quantity'] ?? 1;
        if ($key !== null && isset($_SESSION['cart'][$key])) {
            // Cập nhật số lượng sản phẩm trong giỏ hàng
            $_SESSION['cart'][$key]['quantity'] = $quantity;
        }
        // Chuyển hướng lại về giỏ hàng sau khi cập nhật
        header('Location: /cart');
        exit();
    }

    // Thêm sản phẩm vào giỏ hàng
    public function addToCart() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            $quantity = $_POST['quantity'] ?? 1;
            $size = $_POST['selected_size'] ?? null;
    
            // Kiểm tra dữ liệu đầu vào
            if (!$productId || !$size || $quantity <= 0) {
                echo "Thông tin sản phẩm không hợp lệ.";
                exit();
            }
    
            // Chuyển quantity thành số nguyên để tránh lỗi
            $quantity = intval($quantity);
    
            // Khởi tạo giỏ hàng nếu chưa tồn tại
            if (!isset($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
    
            // Tạo key duy nhất cho từng sản phẩm
            $cartKey = $productId . '_' . $size;
    
            // Kiểm tra xem sản phẩm đã có trong giỏ hay chưa
            if (isset($_SESSION['cart'][$cartKey])) {
                // Nếu có thì tăng số lượng sản phẩm lên
                $_SESSION['cart'][$cartKey]['quantity'] += $quantity;
            } else {
                // Nếu chưa có thì thêm sản phẩm mới vào giỏ
                // Lấy thêm thông tin sản phẩm từ cơ sở dữ liệu
                $product = $this->cartModel->getProductById($productId);
                $_SESSION['cart'][$cartKey] = [
                    'id' => $productId,
                    'size' => $size,
                    'quantity' => $quantity, // Đảm bảo có trường quantity
                    'product_name' => $product['product_name'], // Dùng product_name thay cho name
                    'price' => $product['price'],
                    'image' => $product['image_path'], // Dùng image_path thay cho image
                ];
            }
    
            // Chuyển hướng về giỏ hàng
            header('Location: /cart');
            exit();
        }
    }    
}
