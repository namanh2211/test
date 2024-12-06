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
            $searchController->search();
            break;
            //thanh toán 
            case '/checkout':
                // Nếu route là /checkout, gọi controller CheckoutController và phương thức index
                require_once __DIR__ . '/app/Controllers/CheckoutController.php';
                $CheckoutController = new App\Controllers\CheckoutController();
                $CheckoutController->index();
                break;

                    case 'checkout':
                        // Điều hướng đến trang checkout
                        $CheckoutController = new \App\Controllers\CheckoutController();
                        $CheckoutController->index();
                        break;
                
// admin
// ADMIN

case '/admin':
    $adminController = new App\Controllers\Admin\AdminController();
    $adminController->dashboard();
    break;

case '/login-admin':
    $adminController = new App\Controllers\Admin\AdminController();
    $adminController->login();
    break;

case '/list-category':
    $adminController = new App\Controllers\Admin\CategoryController();
    $adminController->listCategory();
    break;

case '/add-category':
    $adminController = new App\Controllers\Admin\CategoryController();
    $adminController->addCategory();  // Gọi phương thức addCategory
    break;

case '/update-category':
    $adminController = new \App\Controllers\Admin\CategoryController();
    $adminController->updateCategory();
    break;
    
case '/edit-category':
    $id = $_GET['id'] ?? null;
    $adminController = new \App\Controllers\Admin\CategoryController();
    $adminController->editCategory($id);
    break;

case '/delete-category':
    $adminController = new App\Controllers\Admin\CategoryController();
    $adminController->deleteCategory();
    break;

case '/list-user':
    $adminController = new \App\Controllers\Admin\UserController();
    $adminController->listUsers();
    break;

case '/list-product':
    $adminController = new App\Controllers\Admin\ProductController();
    $adminController->listProducts();
    break;

case '/products-search':
    $adminController = new App\Controllers\Admin\ProductController();
    $adminController->searchProducts();
    break;

case '/add-product':
    $adminController = new App\Controllers\Admin\ProductController();
    $adminController->addProduct();
    break;   

case '/update-product':
    $adminController = new \App\Controllers\Admin\ProductController();
    $adminController->updateProduct();
    break;
        
case '/add-user':
    $adminController = new \App\Controllers\Admin\UserController();
    $adminController->addUser();
    break;

case '/delete-user':
    $adminController = new \App\Controllers\Admin\UserController();
    $adminController->deleteUser();
    break;

case '/reset-password':
    $adminController = new \App\Controllers\Admin\UserController();
    $adminController->resetPassword();
    break;

case '/update-user':
    $adminController = new \App\Controllers\Admin\UserController();
    $adminController->updateUser();
    break;
                 
        
            

    default:
        http_response_code(404);
        echo "404 - Page Not Found<br>";
        echo "Không tìm thấy route: " . htmlspecialchars($requestUri);
        break;
}
