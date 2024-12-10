<?php 
namespace App\Controllers;

use App\Models\AboutModel;

class AboutController
{
    public function index()
    {
        session_start(); // Bắt đầu session để lấy thông tin đăng nhập

        $aboutModel = new AboutModel();
        $aboutData = $aboutModel->getAboutData();

        // Kiểm tra xem người dùng đã đăng nhập chưa
        $isLoggedIn = isset($_SESSION['user']);
        $user = $isLoggedIn ? $_SESSION['user'] : null;

        require __DIR__ . '/../Views/Client/about.php';
    }
}
