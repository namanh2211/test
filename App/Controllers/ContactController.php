<?php
namespace App\Controllers;

use App\Models\ContactModel;

class ContactController
{
    public function index()
    {
        // Bắt đầu phiên làm việc
        session_start();

        // Kiểm tra trạng thái đăng nhập
        $isLoggedIn = isset($_SESSION['user']);
        $user = $isLoggedIn ? $_SESSION['user'] : null;

        // Lấy thông tin lỗi và dữ liệu từ session nếu có, sau đó xóa khỏi session
        $errors = $_SESSION['errors'] ?? [];
        $formData = $_SESSION['formData'] ?? [
            'name' => '',
            'email' => '',
            'subject' => '',
            'message' => ''
        ];
        unset($_SESSION['errors'], $_SESSION['formData']);

        // Hiển thị trang liên hệ
        require __DIR__ . '/../Views/Client/contact.php';
    }

    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Bắt đầu phiên làm việc
            session_start();

            $errors = [];
            $formData = [
                'name' => trim($_POST['name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'subject' => trim($_POST['subject'] ?? ''),
                'message' => trim($_POST['message'] ?? '')
            ];
            
            // Kiểm tra từng trường
            if (empty($formData['name'])) {
                $errors['name'] = 'Vui lòng nhập tên của bạn.';
            }

            if (empty($formData['email'])) {
                $errors['email'] = 'Vui lòng nhập địa chỉ email.';
            } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Định dạng email không hợp lệ.';
            }

            if (empty($formData['subject'])) {
                $errors['subject'] = 'Vui lòng nhập tiêu đề.';
            }

            if (empty($formData['message'])) {
                $errors['message'] = 'Vui lòng nhập nội dung tin nhắn.';
            }

            // Nếu có lỗi, lưu lỗi và dữ liệu vào session rồi chuyển hướng lại trang liên hệ
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['formData'] = $formData;
                header('Location: /contact');
                exit();
            }

            // Lưu vào cơ sở dữ liệu nếu không có lỗi
            $contactModel = new ContactModel();
            $success = $contactModel->saveContact(
                $formData['name'],
                $formData['email'],
                $formData['subject'],
                $formData['message']
            );

            if ($success) {
                header('Location: /contact?status=success');
                exit();
            } else {
                $errors['database'] = 'Có lỗi xảy ra khi lưu tin nhắn của bạn. Vui lòng thử lại.';
                $_SESSION['errors'] = $errors;
                $_SESSION['formData'] = $formData;
                header('Location: /contact');
                exit();
            }
        }
    }

    public function logout()
    {
        // Hủy phiên làm việc và chuyển hướng về trang chủ
        session_start();
        session_destroy();
        header('Location: /');
        exit();
    }
}
