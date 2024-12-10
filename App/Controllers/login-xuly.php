<?php
session_start();

// Kết nối tới cơ sở dữ liệu
try {
    $conn = new PDO("mysql:host=localhost;dbname=duan1;charset=utf8", "root", "mysql");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Lỗi kết nối: " . $e->getMessage());
}

// Kiểm tra xem form đã được submit chưa
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    // Truy vấn để kiểm tra thông tin người dùng
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->bindParam(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Kiểm tra thông tin đăng nhập
    if ($user && password_verify($password, $user['password'])) {
        // Đăng nhập thành công
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'full_name' => isset($user['full_name']) ? $user['full_name'] : ''
        ];

        // Kiểm tra xem có URL cần chuyển hướng lại không
        if (isset($_SESSION['redirect_url'])) {
            $redirect_url = $_SESSION['redirect_url'];
            unset($_SESSION['redirect_url']); // Xóa session để tránh chuyển hướng không mong muốn sau này
            header("Location: $redirect_url");
        } else {
            header("Location: index.php"); // Mặc định chuyển về trang chủ nếu không có URL
        }
        exit();
    } else {
        // Thông tin đăng nhập không chính xác
        $_SESSION['error_message'] = "Tên người dùng hoặc mật khẩu không đúng.";
        header("Location: login.php");
        exit();
    }
}
?>
