<?php
namespace App\Controllers;

use App\Models\ProductModel;
use App\Helpers\SessionHelper;

class HomeController {
    private $productModel;

    public function __construct() {
        // Kiểm tra xem class ProductModel có tồn tại không
        if (!class_exists('App\Models\ProductModel')) {
            die('ProductModel not found!'); // Hiển thị lỗi nếu không tìm thấy ProductModel
        }

        // Khởi tạo ProductModel
        $this->productModel = new ProductModel();
    }

    public function index() {
        // Bắt đầu session để quản lý trạng thái đăng nhập
        SessionHelper::start();

        // Kiểm tra xem người dùng đã đăng nhập hay chưa
        $isLoggedIn = isset($_SESSION['user']);
        $user = $isLoggedIn ? $_SESSION['user'] : null;

        // Lấy dữ liệu sản phẩm nổi bật từ model
        $featuredProducts = $this->productModel->getFeaturedProducts();

        // Gọi hàm render từ helpers.php để hiển thị View
        render('Client/home', [
            'title' => 'Home - HMT Shop',
            'featuredProducts' => $featuredProducts,
            'isLoggedIn' => $isLoggedIn,
            'user' => $user
        ]);
    }
}
