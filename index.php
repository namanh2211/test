<?php
// Hiển thị lỗi (chỉ dùng khi phát triển)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Nạp autoload của Composer
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/app/Helpers/view_helper.php';

// Tạo kết nối database (PDO)
require_once __DIR__ . '/config/database.php';

try {
    $db = new PDO('mysql:host=localhost;dbname=duan1;charset=utf8', 'root', 'mysql');
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
        $homeController = new App\Controllers\HomeController();
        $homeController->index();
        break;
        // trang đăng nhập
    case '/login':
        $authController = new App\Controllers\AuthController($db);
        $authController->showLoginForm();
        break;

    case '/login-xuly':
        $authController = new App\Controllers\AuthController($db);
        $authController->login();
        break;
        // trang đăng ký
    case '/register':
        $authController = new App\Controllers\AuthController($db);
        $authController->showRegisterForm();
        break;

    case '/register-xuly':
        $authController = new App\Controllers\AuthController($db);
        $authController->register();
        break;
        // đăng xuất
    case '/logout':
        $authController = new App\Controllers\AuthController($db);
        $authController->logout();
        break;
        // trang sản phẩm 
    case '/shop':
        $shopController = new App\Controllers\ShopController();
        $shopController->index();
        break;
        // chi tiết sản phẩm 
    case '/detail':
        $productController = new App\Controllers\ProductController($db);
        $productController->showProductDetail();
        break;
        // giỏ hàng 
    case '/cart':
        $cartController = new App\Controllers\CartController();
        $cartController->index();
        break;
        // thêm sản phẩm 
    case '/cart/addToCart':
        $cartController = new App\Controllers\CartController();
        $cartController->addToCart();
        break;
        // cập nhật sản phẩm 
    case '/cart/update':
        $cartController = new App\Controllers\CartController();
        $cartController->update();
        break;
        // xóa sản phẩm 
    case '/cart/remove':
        $cartController = new App\Controllers\CartController();
        $cartController->remove();
        break;
        // liện hệ
    case '/contact':
        $contactController = new App\Controllers\ContactController();
        $contactController->index();
        break;

    case '/contact/submit':
        $contactController = new App\Controllers\ContactController();
        $contactController->submit();
        break;
        // trang về chúng tôi 
    case '/about':
        $aboutController = new App\Controllers\AboutController();
        $aboutController->index();
        break;
        // bài viết 
    case '/blog':
        $blogController = new App\Controllers\BlogController();
        $blogController->index();
        break;
        // bài viết chi tiết
    case '/blog/detail':
        $id = $_GET['id'] ?? null;
        if ($id) {
            $blogDetailController = new App\Controllers\BlogDetailController();
            $blogDetailController->show($id);
        } else {
            http_response_code(404);
            echo "404 - Blog Post Not Found";
        }
        break;

        case '/search':
            $searchController = new App\Controllers\SearchController();
            $searchController->index();
            break;

    default:
        http_response_code(404);
        echo "404 - Page Not Found<br>";
        echo "Không tìm thấy route: " . htmlspecialchars($requestUri);
        break;
}
