<?php
namespace App\Controllers;

use App\Models\BlogModel;

class BlogController
{
    public function index()
    {
        // Lấy danh sách bài viết từ BlogModel
        $blogModel = new BlogModel();
        $posts = $blogModel->getAllPosts();

        // Chuyển dữ liệu qua view
        require __DIR__ . '/../Views/Client/blog.php';
    }
}
