<?php

namespace App\Controllers\Admin;

use App\Models\Admin\UserModel;

class UserController
{


    // Hiển thị danh sách người dùng
    public function listUsers()
    {
        session_start();

        // Gọi Model để lấy danh sách người dùng
        $userModel = new UserModel();
        $users = $userModel->getAllUsers(); // Giả sử hàm getAllUsers() trả về danh sách người dùng

        // Truyền dữ liệu qua View
        include __DIR__ . '/../../Views/Admin/list_user.php';
    }


    public function deleteUser()
    {
        session_start();

        if (isset($_GET['id'])) {
            $userId = (int)$_GET['id'];

            $userModel = new UserModel();
            $result = $userModel->deleteUser($userId);

            if ($result) {
                $_SESSION['success_message'] = 'Xóa người dùng thành công';
            } else {
                $_SESSION['error_message'] = 'Không thể xóa người dùng. Vui lòng thử lại.';
            }
        } else {
            $_SESSION['error_message'] = 'ID người dùng không hợp lệ.';
        }

        header("Location: /list-user");
        exit();
    }

    // Thêm mới người dùng
    public function addUser()
    {
        // Khởi tạo session để lưu lỗi và dữ liệu cũ
        session_start();

        // Lấy dữ liệu cũ và lỗi từ session (nếu có)
        $errors = $_SESSION['errors'] ?? [];
        $old_data = $_SESSION['old_data'] ?? [];

        // Hủy session lỗi và dữ liệu cũ sau khi đã sử dụng
        unset($_SESSION['errors'], $_SESSION['old_data']);

        // Kiểm tra nếu form được gửi
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $errors = [];
            $old_data = $_POST;

            // Kiểm tra username
            if (empty($old_data['username'])) {
                $errors['username'] = 'Tên đăng nhập không được bỏ trống';
            } else {
                // Gọi model để kiểm tra xem username đã tồn tại chưa
                $userModel = new UserModel();
                if ($userModel->usernameExists($old_data['username'])) {
                    $errors['username'] = 'Tên đăng nhập đã tồn tại, vui lòng chọn tên khác.';
                }
            }

            if (empty($old_data['email']) || !filter_var($old_data['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Email không hợp lệ';
            } else {
                // Gọi model để kiểm tra xem email đã tồn tại chưa
                $userModel = new UserModel();
                if ($userModel->emailExists($old_data['email'])) {
                    $errors['email'] = 'Email này đã được sử dụng, vui lòng chọn email khác.';
                }
            }


            if (empty($old_data['fullname'])) {
                $errors['fullname'] = 'Tên đầy đủ không được bỏ trống';
            }

            if (empty($old_data['password'])) {
                $errors['password'] = 'Mật khẩu không được bỏ trống';
            } elseif (strlen($old_data['password']) < 6) {
                $errors['password'] = 'Mật khẩu phải có ít nhất 6 ký tự.';
            }



            // Nếu không có lỗi, tiến hành thêm người dùng vào cơ sở dữ liệu
            if (empty($errors)) {
                try {
                    // Gọi Model để thêm người dùng
                    $userModel = new UserModel();
                    $userModel->addUser($old_data['username'], $old_data['password'], $old_data['email'], $old_data['fullname'], $old_data['role']);

                    // Chuyển hướng đến trang danh sách người dùng sau khi thêm thành công
                    $_SESSION['success_message'] = 'Thêm người dùng thành công';
                    header("Location: /list-user");
                    exit();
                } catch (\Exception $e) {
                    // Nếu có lỗi trong quá trình thêm người dùng vào cơ sở dữ liệu
                    $errors['db'] = 'Lỗi khi thêm người dùng: ' . $e->getMessage();
                }
            }

            // Lưu lỗi và dữ liệu cũ vào session để hiển thị lại trong form
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $old_data;

            // Quay lại trang form với lỗi
            header("Location: /add-user");
            exit();
        }

        // Gọi view và truyền dữ liệu (lỗi và dữ liệu cũ)
        include __DIR__ . '/../../Views/Admin/add_user.php';
    }

    public function resetPassword()
    {
        session_start(); // Khởi tạo session

        // Khởi tạo mảng lỗi và dữ liệu cũ
        $errors = $_SESSION['errors'] ?? [];
        $old_data = $_SESSION['old_data'] ?? [];

        // Hủy session lỗi và dữ liệu cũ sau khi đã sử dụng
        unset($_SESSION['errors'], $_SESSION['old_data']);

        // Khởi tạo đối tượng UserModel
        $userModel = new UserModel();

        // Lấy ID từ URL
        $id = $_GET['id'] ?? null;

        if (!$id) {
            $_SESSION['error_message'] = 'Người dùng không tồn tại';
            header('Location: /list-user');
            exit();
        }

        // Lấy thông tin người dùng từ ID
        $user = $userModel->getUserById($id);

        if (!$user) {
            $_SESSION['error_message'] = 'Người dùng không tồn tại';
            header('Location: /list-user');
            exit();
        }

        // Xử lý form khi có dữ liệu POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form và lưu vào mảng old_data
            $new_password = trim($_POST['new_password']);
            $confirm_password = trim($_POST['confirm_password']);

            $old_data = [
                'new_password' => $new_password,
                'confirm_password' => $confirm_password
            ];

            // Kiểm tra dữ liệu
            if (empty($new_password)) {
                $errors['new_password'] = 'Mật khẩu mới không được để trống';
            } elseif (strlen($new_password) < 6) {
                $errors['new_password'] = 'Mật khẩu mới phải có ít nhất 6 ký tự';
            }

            if ($new_password !== $confirm_password) {
                $errors['confirm_password'] = 'Xác nhận mật khẩu không khớp';
            }

            // Nếu không có lỗi, tiến hành cập nhật mật khẩu
            if (empty($errors)) {
                try {
                    $hashedPassword = password_hash($new_password, PASSWORD_BCRYPT);
                    $userModel->updatePassword($id, $hashedPassword);

                    $_SESSION['success_message'] = 'Đặt lại mật khẩu thành công';
                    header('Location: /list-user');
                    exit();
                } catch (\Exception $e) {
                    $errors['db'] = 'Lỗi khi đặt lại mật khẩu: ' . $e->getMessage();
                }
            }

            // Lưu lỗi và dữ liệu cũ vào session để hiển thị lại trong form
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $old_data;

            // Reload lại trang hiện tại để hiển thị lỗi
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit();
        }

        // Truyền dữ liệu qua View
        include __DIR__ . '/../../Views/Admin/reset_password.php';
    }


    public function updateUser()
    {
        session_start(); // Khởi tạo session

        $id = $_GET['id'] ?? null;
        if (!$id) {
            header('Location: /list-user');
            exit;
        }

        // Lấy thông tin người dùng hiện tại
        $userModel = new UserModel();
        $user = $userModel->getUserById($id);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $role = $_POST['role'] ?? 'User'; // Mặc định giá trị role là 'User'

            // Kiểm tra lỗi
            $errors = [];

            if (empty($name)) {
                $errors['name'] = 'Tên đầy đủ không được để trống.';
            }

            // Kiểm tra nếu role là hợp lệ (phải là 'Admin' hoặc 'User')
            if (!in_array($role, ['Admin', 'User'])) {
                $errors['role'] = 'Quyền người dùng không hợp lệ.';
            }

            if (empty($errors)) {
                // Cập nhật thông tin người dùng
                $userModel->updateUserById($id, $name, $role);

                $_SESSION['success_message'] = 'Cập nhật người dùng thành công!';
                header('Location: /list-user');
                exit;
            }

            $old_data = ['name' => $name, 'role' => $role];
        }

        require_once __DIR__ . '/../../Views/Admin/edit_user.php';
    }
}
