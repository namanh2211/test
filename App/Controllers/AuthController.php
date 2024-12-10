<?php
namespace App\Controllers;

use App\Models\UserModel;
use App\Helpers\SessionHelper;

class AuthController {
    private $userModel;

    public function __construct($db) {
        $this->userModel = new UserModel($db); // Kết nối cơ sở dữ liệu
    }

    // Hiển thị form login
    public function showLoginForm(): void {
        $path = realpath(__DIR__ . '/../Views/Client/login.php');
        if ($path && file_exists($path)) {
            require_once $path;
        } else {
            die("Không tìm thấy file login.php tại: " . $path);
        }
    }

    // Hiển thị form đăng ký
    public function showRegisterForm(): void {
        $path = realpath(__DIR__ . '/../Views/Client/register.php');
        if ($path && file_exists($path)) {
            require_once $path;
        } else {
            die("Không tìm thấy file register.php tại: " . $path);
        }
    }

    // Xử lý logic đăng nhập
    public function login() {
        SessionHelper::start();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $password = $_POST['password'] ?? '';
    
            // Kiểm tra các trường trống
            if (empty($username)) {
                $_SESSION['error_username'] = "Username không được để trống";
            }
            if (empty($password)) {
                $_SESSION['error_password'] = "Password không được để trống";
            }
    
            // Nếu không có lỗi, kiểm tra thông tin đăng nhập
            if (empty($_SESSION['error_username']) && empty($_SESSION['error_password'])) {
                $user = $this->userModel->getUserByUsername($username);
    
                if ($user && password_verify($password, $user['password'])) {
                    // Lưu thông tin user vào session
                    $_SESSION['user'] = $user;
    
                    // Kiểm tra vai trò để điều hướng
                    if ($user['role'] === 'admin') {
                        header('Location: /admin'); // Admin vào trang admin
                    } else {
                        header('Location: /home'); // Khách hàng vào trang client
                    }
                    exit;
                } else {
                    $_SESSION['error_password'] = "Sai username hoặc password";
                }
            }
    
            // Quay lại trang login nếu có lỗi
            header('Location: /login');
            exit;
        }
    }

    // Xử lý logic đăng ký (giữ nguyên như cũ)
    public function register() {
        SessionHelper::start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $old = $_POST;

            // Validate dữ liệu
            if (empty($_POST['full_name'])) {
                $errors['full_name'] = 'Full Name không được để trống.';
            }

            if (empty($_POST['address'])) {
                $errors['address'] = 'Address không được để trống.';
            }

            if (empty($_POST['phone'])) {
                $errors['phone'] = 'Phone không được để trống.';
            } elseif (!preg_match('/^[0-9]{10}$/', $_POST['phone'])) {
                $errors['phone'] = 'Phone phải là 10 chữ số.';
            }

            if (empty($_POST['username'])) {
                $errors['username'] = 'Username không được để trống.';
            } elseif ($this->userModel->getUserByUsername($_POST['username'])) {
                $errors['username'] = 'Username đã tồn tại.';
            }

            if (empty($_POST['email'])) {
                $errors['email'] = 'Email không được để trống.';
            } elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ.';
            } elseif ($this->userModel->getUserByEmail($_POST['email'])) {
                $errors['email'] = 'Email đã tồn tại.';
            }

            if (empty($_POST['password'])) {
                $errors['password'] = 'Password không được để trống.';
            }

            if (empty($_POST['confirm_password']) || $_POST['password'] !== $_POST['confirm_password']) {
                $errors['confirm_password'] = 'Password xác nhận không khớp.';
            }

            // Nếu có lỗi, lưu vào session và chuyển hướng về form đăng ký
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old'] = $old;
                header('Location: /register');
                exit;
            }

            // Thêm người dùng mới vào cơ sở dữ liệu
            $hashedPassword = password_hash($_POST['password'], PASSWORD_BCRYPT);
            $this->userModel->createUser([
                'full_name' => $_POST['full_name'],
                'address' => $_POST['address'],
                'phone' => $_POST['phone'],
                'username' => $_POST['username'],
                'email' => $_POST['email'],
                'password' => $hashedPassword,
            ]);

            // Thông báo thành công và chuyển hướng đến login
            $_SESSION['success'] = 'Đăng ký thành công. Vui lòng đăng nhập.';
            header('Location: /login');
            exit;
        }
    }

    // Xử lý logout
    public function logout() {
        SessionHelper::start();

        // Xóa thông tin user trong session
        unset($_SESSION['user']);

        // Chuyển hướng về trang login
        header('Location: /login');
        exit;
    }
}
