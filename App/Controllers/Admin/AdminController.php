<?php

namespace App\Controllers\Admin;

use App\Models\Admin\UserModel;
use Config\Database;

class AdminController
{
    private $db;

    public function __construct()
    {
        // Kết nối cơ sở dữ liệu thông qua Database config
        $this->db = (new Database())->connect();   // Giả sử Database::getConnection() trả về đối tượng PDO
    }

    public function dashboard()
    {
        // Kiểm tra nếu người dùng chưa đăng nhập hoặc không phải là Admin
        // if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'Admin') {
        //     // Nếu không phải là Admin, chuyển hướng về trang login
        //     header('Location: /login-admin');
        //     exit;
        // }

        // Lấy tổng số người dùng
        $stmt = $this->db->query("SELECT COUNT(*) FROM users");
        $users = $stmt->fetchColumn();

        // Lấy tổng số danh mục
        $stmt = $this->db->query("SELECT COUNT(*) FROM categories");
        $categories = $stmt->fetchColumn();

        // Lấy tổng số sản phẩm
        $stmt = $this->db->query("SELECT COUNT(*) FROM products");
        $products = $stmt->fetchColumn();

        // Lấy tổng số đơn hàng
        $stmt = $this->db->query("SELECT COUNT(*) FROM orders");
        $orders = $stmt->fetchColumn();

        // Lưu dữ liệu vào biến $stats
        $stats = [
            'users' => $users,
            'categories' => $categories,
            'products' => $products,
            'orders' => $orders
        ];


        // Gọi view admin từ đúng cấu trúc thư mục
        require_once __DIR__ . '/../../Views/Admin/admin.php';
    }


    // Phương thức xử lý đăng nhập
    public function login()
    {
        session_start(); // Bắt đầu session nếu chưa bắt đầu

        // Kiểm tra nếu người dùng đã gửi form
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];
            $rememberMe = isset($_POST['remember_me']) ? $_POST['remember_me'] : false;

            // Khởi tạo đối tượng UserModel trực tiếp trong phương thức
            $userModel = new UserModel();

            // Kiểm tra đăng nhập thông qua Model
            $user = $userModel->checkLogin($username, $password);

            if ($user) {
                // Lưu vai trò vào session sau khi đăng nhập thành công
                $_SESSION['role'] = $user['role']; // Lưu vai trò vào session
                $_SESSION['username'] = $user['username']; // Lưu tên người dùng vào session (tuỳ chọn)

                // Nếu chọn lưu cookie, lưu tài khoản vào cookie
                if ($rememberMe) {
                    setcookie('username', $username, time() + (20 * 24 * 60 * 60), '/'); // Lưu cookie trong 20 ngày
                } else {
                    setcookie('username', '', time() - 3600, '/'); // Xóa cookie nếu không chọn
                }

                $_SESSION['success_message'] = 'Đăng nhập thành công.';
                // Chuyển hướng đến trang quản trị admin
                header('Location: /admin');
                exit;
            } else {
                $errorMessage = "Tên đăng nhập hoặc mật khẩu không đúng!";
            }
        }

        // Gọi view login
        require_once __DIR__ . '/../../Views/Admin/login_admin.php';
    }
}
