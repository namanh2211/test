<?php


namespace App\Controllers;

use App\Models\FavoriteProductModel;
session_start(); // Khởi tạo session
class FavoriteProductController
{
    private $favoriteProductModel;

    public function __construct()
    {
        $this->favoriteProductModel = new FavoriteProductModel();
    }

    // Hiển thị sản phẩm yêu thích
    public function index()
    {
        $userId = $_SESSION['user']['id'] ?? null;
        if (!$userId) {
            echo "Bạn cần đăng nhập để xem sản phẩm yêu thích.";
            exit();
        }

        // Lấy danh sách sản phẩm yêu thích từ cơ sở dữ liệu
        $favoriteProducts = $this->favoriteProductModel->getFavoriteProductsByUserId($userId);

        // Render view sản phẩm yêu thích
        renderView('Client/favorite_products', compact('favoriteProducts'));
    }

    // Thêm sản phẩm vào danh sách yêu thích
// Thêm sản phẩm vào danh sách yêu thích
    public function addToFavorites()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productId = $_POST['product_id'] ?? null;
            $productName = $_POST['product_name'] ?? null;
            $productPrice = $_POST['product_price'] ?? null;
            $imagePath = $_POST['image_path'] ?? null;
            $userId = $_SESSION['user']['id'] ?? null;

            if (!$productId || !$userId) {
                echo "Thông tin không hợp lệ.";
                exit();
            }

            // Tạo mảng sản phẩm yêu thích
            $favoriteProduct = [
                'product_id' => $productId,
                'name' => $productName,
                'price' => $productPrice,
                'image_path' => $imagePath,
            ];

            // Khởi tạo mảng yêu thích nếu chưa có
            if (!isset($_SESSION['favorite_products'])) {
                $_SESSION['favorite_products'] = [];
            }

            // Kiểm tra xem sản phẩm đã có trong danh sách yêu thích chưa
            $exists = false;
            foreach ($_SESSION['favorite_products'] as $product) {
                if ($product['product_id'] == $productId) {
                    $exists = true;
                    break;
                }
            }

            // Nếu sản phẩm chưa có, thêm vào danh sách
            if (!$exists) {
                $_SESSION['favorite_products'][] = $favoriteProduct;
            }

            // Chuyển hướng về trang sản phẩm yêu thích
            header('Location: /favorite-products');
            exit();
        }
    }

    // Xóa sản phẩm khỏi danh sách yêu thích
    public function removeFromFavorites()
    {
        session_start(); // Khởi tạo session
    
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            $productId = $_GET['product_id'] ?? null;
    
            if ($productId && isset($_SESSION['favorite_products'])) {
                // Tìm và xóa sản phẩm khỏi danh sách yêu thích
                foreach ($_SESSION['favorite_products'] as $key => $product) {
                    if ($product['product_id'] == $productId) {
                        unset($_SESSION['favorite_products'][$key]);
                        break; // Thoát khỏi vòng lặp sau khi xóa
                    }
                }
            }
    
            // Chuyển hướng về trang sản phẩm yêu thích
            header('Location: /favorite-products');
            exit();
        }
    }
}