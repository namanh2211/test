<?php 
// File: app/Controllers/ProductController.php
namespace App\Controllers;

use App\Models\ProductModel;
use App\Helpers\SessionHelper; // Nếu cần

class ProductController {
    private $productModel;

    public function __construct($db) {
        $this->productModel = new ProductModel($db); // Khởi tạo ProductModel
    }

    // Hiển thị chi tiết sản phẩm
    public function showProductDetail() {
        // Lấy thông tin sản phẩm từ URL (ví dụ id)
        $product_id = isset($_GET['id']) ? (int)$_GET['id'] : null;
    
        if (!$product_id) {
            http_response_code(404);
            echo "Sản phẩm không tồn tại.";
            return;
        }
    
        // Lấy chi tiết sản phẩm
        $product = $this->productModel->getProductById($product_id);
    
        if (!$product) {
            http_response_code(404);
            echo "Sản phẩm không tồn tại.";
            return;
        }
          // Bắt đầu session và kiểm tra trạng thái đăng nhập
          SessionHelper::start();
          $isLoggedIn = isset($_SESSION['user']); // Kiểm tra người dùng đã đăng nhập chưa
              // Truyền dữ liệu vào view
              $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;
    
        // Gửi dữ liệu đến view
        render('Client/detail', [
            'product_id' => $product['id'],
            'product_name' => $product['product_name'],
            'product_price' => $product['price'],
            'product_description' => $product['description'],
            'product_image' => $product['image_path'],
            'product_size' => $product['size'],
            'product_stock' => $product['stock'],
            'product_created_at' => $product['created_at'],
            'user' => $user,
            'isLoggedIn' => $isLoggedIn,
        ]);
    }
}
?>