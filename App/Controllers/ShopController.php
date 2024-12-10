<?php
namespace App\Controllers;

use App\Models\ProductModel;
use App\Models\CategoryModel;
use App\Helpers\SessionHelper;

class ShopController {
    private $productModel;
    private $categoryModel;

    public function __construct() {
        $this->productModel = new ProductModel();
        $this->categoryModel = new CategoryModel();
    }

    public function index() {
        // Bắt đầu session và kiểm tra trạng thái đăng nhập
        SessionHelper::start();
        $isLoggedIn = isset($_SESSION['user']); // Kiểm tra người dùng đã đăng nhập chưa

        // Lấy danh mục sản phẩm
        $categories = $this->categoryModel->getAllCategories();

        // Xử lý danh mục và phân trang
        $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;
        $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $items_per_page = 9;

        // Lấy danh sách sản phẩm theo danh mục và phân trang
        $products = $this->productModel->getProductsByCategory($category_id, $current_page, $items_per_page);
        $total_products = $this->productModel->getTotalProducts($category_id);
        $total_pages = ceil($total_products / $items_per_page);

        // Truyền dữ liệu vào view
        $user = isset($_SESSION['user']) ? $_SESSION['user'] : null;

        // Gọi view và truyền dữ liệu
        view('Client.shop', [
            'categories' => $categories,
            'products' => $products,
            'category_id' => $category_id,
            'current_page' => $current_page,
            'total_pages' => $total_pages,
            'user' => $user,
            'isLoggedIn' => $isLoggedIn
        ]);
    }
}
