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
    public function index()
    {

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
            } else {
                echo "Giỏ hàng có sản phẩm thiếu ID.";
            }
        }

        // Kiểm tra xem người dùng đã đăng nhập chưa
        if (isset($_SESSION['user'])) {
            $user = $_SESSION['user']; // Lấy thông tin người dùng từ session
            $isLoggedIn = true;  // Đánh dấu người dùng đã đăng nhập
        } else {
            $user = null;
            $isLoggedIn = false; // Nếu không có session, coi như chưa đăng nhập
        }



        // Render view giỏ hàng với danh sách sản phẩm, tổng tiền, và tên người dùng
        renderView('Client/cart', compact('cartItems', 'subtotal', 'user', 'isLoggedIn'));
    }


    // Xóa sản phẩm khỏi giỏ hàng
    public function remove()
    {
        $key = $_GET['key'] ?? null;
        if ($key !== null) {
            // Lấy thông tin sản phẩm
            $productId = $_SESSION['cart'][$key]['id'];
            $userId = $_SESSION['user']['id'];
    
            // Xóa sản phẩm khỏi giỏ hàng trong session
            unset($_SESSION['cart'][$key]);
    
            // Xóa sản phẩm khỏi cơ sở dữ liệu
            $this->cartModel->removeFromCartDatabase($userId, $productId);
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
    
            // Cập nhật cơ sở dữ liệu
            $userId = $_SESSION['user']['id'];
            $productId = $_SESSION['cart'][$key]['id'];
            
            // Gọi phương thức cập nhật trong CartModel
            $this->cartModel->updateCartDatabase($userId, $productId, $quantity);
        }
        // Chuyển hướng lại về giỏ hàng sau khi cập nhật
        header('Location: /cart');
        exit();
    }
    

    // Thêm sản phẩm vào giỏ hàng
    // Thêm sản phẩm vào giỏ hàng
    public function addToCart()
    {
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

            // Kiểm tra xem người dùng đã đăng nhập chưa
            if (!isset($_SESSION['user'])) {
                echo "Bạn cần đăng nhập để thêm sản phẩm vào giỏ hàng.";
                exit();
            }

            // Lấy thông tin người dùng
            $userId = $_SESSION['user']['id'];

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
                    'quantity' => $quantity,
                    'product_name' => $product['product_name'],
                    'price' => $product['price'],
                    'image' => $product['image_path'],
                ];
            }

            // Lưu thông tin vào cơ sở dữ liệu
            $stmt = $this->cartModel->addToCartDatabase($userId, $productId, $quantity);

            // Chuyển hướng về giỏ hàng
            header('Location: /cart');
            exit();
        }
    }
    public function submitCheckout()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Kiểm tra xem người dùng có đăng nhập không
        if (!isset($_SESSION['user'])) {
            echo "Bạn cần đăng nhập để thanh toán.";
            exit();
        }

        // Lấy thông tin từ form
        $userId = $_SESSION['user']['id'];
        $address = $_POST['address'] ?? '';
        $paymentMethod = $_POST['payment_method'] ?? '';

        // Kiểm tra tính hợp lệ của thông tin
        if (!$address || !$paymentMethod) {
            echo "Thông tin thanh toán không hợp lệ.";
            exit();
        }

        // Lấy giỏ hàng từ session
        $cartItems = $_SESSION['cart'] ?? [];
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }
        $totalPrice += 30000; // Thêm phí vận chuyển

        // Lưu thông tin đơn hàng vào cơ sở dữ liệu
        $orderId = $this->cartModel->processOrder($userId, $cartItems, $paymentMethod);

        // Sau khi lưu đơn hàng thành công, xóa giỏ hàng trong session
        unset($_SESSION['cart']);

        // Chuyển hướng đến trang thành công
        header('Location: /checkout-success?order_id=' . $orderId);
        exit();
    }
}


}
