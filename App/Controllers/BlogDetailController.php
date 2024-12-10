<?php
namespace App\Controllers;

use App\Models\BlogModel;

class BlogDetailController
{
    public function show($id)
    {
        // Lấy chi tiết bài viết dựa vào ID
        $blogModel = new BlogModel();
        $post = $blogModel->getPostById($id);

        if (!$post) {
            // Nếu bài viết không tồn tại, hiển thị 404
            http_response_code(404);
            echo "404 - Blog Post Not Found";
            return;
        }
            // Kiểm tra xem người dùng đã đăng nhập chưa
            $isLoggedIn = isset($_SESSION['user']);
            $user = $isLoggedIn ? $_SESSION['user'] : null;

        // Chuyển dữ liệu qua view
        require __DIR__ . '/../Views/Client/blog_detail.php';
    }
}
