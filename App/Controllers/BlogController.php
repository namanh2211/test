<?php
namespace App\Controllers;

use App\Models\BlogModel;

class BlogController
{
    public function index()
    {
        session_start(); // Bắt đầu session để kiểm tra thông tin người dùng đăng nhập

        // Lấy danh sách bài viết từ BlogModel
        $blogModel = new BlogModel();
        $posts = $blogModel->getAllPosts();

        // Kiểm tra xem người dùng đã đăng nhập chưa
        $isLoggedIn = isset($_SESSION['user']);
        $user = $isLoggedIn ? $_SESSION['user'] : null;

        // Chuyển dữ liệu qua view
        require __DIR__ . '/../Views/Client/blog.php';
    }
}
