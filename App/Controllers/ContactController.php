<?php
namespace App\Controllers;

use App\Models\ContactModel;

class ContactController
{
    public function index()
    {
        // Khởi tạo biến lỗi và giá trị mặc định
        $errors = [];
        $formData = [
            'name' => '',
            'email' => '',
            'subject' => '',
            'message' => ''
        ];

        // Hiển thị trang liên hệ
        require __DIR__ . '/../Views/Client/contact.php';
    }

    public function submit()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Khởi tạo mảng lỗi và lấy dữ liệu từ form
            $errors = [];
            $formData = [
                'name' => trim($_POST['name'] ?? ''),
                'email' => trim($_POST['email'] ?? ''),
                'subject' => trim($_POST['subject'] ?? ''),
                'message' => trim($_POST['message'] ?? '')
            ];

            // Kiểm tra từng trường
            if (empty($formData['name'])) {
                $errors['name'] = 'Please enter your name.';
            }

            if (empty($formData['email'])) {
                $errors['email'] = 'Please enter your email.';
            } elseif (!filter_var($formData['email'], FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = 'Invalid email format.';
            }

            if (empty($formData['subject'])) {
                $errors['subject'] = 'Please enter a subject.';
            }

            if (empty($formData['message'])) {
                $errors['message'] = 'Please enter your message.';
            }

            // Nếu có lỗi, quay lại form với lỗi
            if (!empty($errors)) {
                require __DIR__ . '/../Views/Client/contact.php';
                return;
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
                // Chuyển hướng với thông báo thành công
                header('Location: /contact?status=success');
                exit();
            } else {
                // Thêm lỗi lưu trữ dữ liệu
                $errors['database'] = 'There was an error saving your message. Please try again.';
                require __DIR__ . '/../Views/Client/contact.php';
            }
        }
    }
}
