<?php
// Hiển thị lỗi (chỉ dùng khi phát triển)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Nạp các file cần thiết
require_once __DIR__ . '/App/helpers/helpers.php';
require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/App/Controllers/HomeController.php';
require_once __DIR__ . '/App/Controllers/AuthController.php';
require_once __DIR__ . '/App/Controllers/ShopController.php'; // Thêm ShopController
require_once __DIR__ . '/App/Controllers/ProductController.php'; // Thêm ProductController
require_once __DIR__ . '/App/Models/UserModel.php';
require_once __DIR__ . '/App/Helpers/SessionHelper.php';
require_once __DIR__ . '/App/Models/ProductModel.php';
require_once __DIR__ . '/App/Models/CategoryModel.php';

use App\Controllers\HomeController;
use App\Controllers\AuthController;
use App\Controllers\ShopController;
use App\Controllers\ProductController; // Thêm ProductController

// Tạo kết nối database (PDO)
try {
    $db = new PDO('mysql:host=localhost;dbname=duan1;charset=utf8', 'root', 'mysql'); // Thay đổi mật khẩu nếu cần
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database Connection Error: " . $e->getCode() . " - " . $e->getMessage());
}

// Lấy URI
$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestUri = rtrim($requestUri, '/'); // Loại bỏ dấu `/` cuối nếu có

// Xử lý route dựa trên URI
switch ($requestUri) {
    case '':
    case '/':
    case '/home':
        // Hiển thị trang chủ
        $homeController = new HomeController();
        $homeController->index();
        break;

    case '/login':
        // Hiển thị form đăng nhập
        $authController = new AuthController($db);
        $authController->showLoginForm();
        break;

    case '/login-xuly':
        // Xử lý đăng nhập
        $authController = new AuthController($db);
        $authController->login();
        break;

    case '/register':
        // Hiển thị form đăng ký
        $authController = new AuthController($db);
        $authController->showRegisterForm();
        break;

    case '/register-xuly':
        // Xử lý đăng ký
        $authController = new AuthController($db);
        $authController->register();
        break;

    case '/logout':
        // Xử lý logout
        $authController = new AuthController($db);
        $authController->logout();
        break;

    case '/shop':
        // Hiển thị trang danh sách sản phẩm
        $shopController = new ShopController($db);
        $shopController->index();
        break;

    case '/detail':
        // Hiển thị trang chi tiết sản phẩm
        $productController = new ProductController($db);
        $productController->showProductDetail();
        break;

    default:
        // Nếu route không tồn tại
        http_response_code(404);
        echo "404 - Page Not Found<br>";
        echo "Không tìm thấy route: " . htmlspecialchars($requestUri);
        break;
}
