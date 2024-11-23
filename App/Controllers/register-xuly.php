<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$errors = [];
$old = [];

// Kiểm tra nếu dữ liệu được gửi qua POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $old['full_name'] = trim($_POST['full_name']);
    $old['address'] = trim($_POST['address']);
    $old['phone'] = trim($_POST['phone']);
    $old['username'] = trim($_POST['username']);
    $old['email'] = trim($_POST['email']);
    $password = trim($_POST['password']);
    $confirm_password = trim($_POST['confirm_password']);

    // Kiểm tra fullname
    if (empty($old['full_name'])) {
        $errors['full_name'] = "Fullname is required.";
    }

    // Kiểm tra address
    if (empty($old['address'])) {
        $errors['address'] = "Address is required.";
    }

    // Kiểm tra phone
    if (empty($old['phone'])) {
        $errors['phone'] = "Phone number is required.";
    } elseif (!preg_match("/^[0-9]{10,15}$/", $old['phone'])) {
        $errors['phone'] = "Phone number must be between 10 to 15 digits.";
    }

    // Kiểm tra username
    if (empty($old['username'])) {
        $errors['username'] = "Username is required.";
    }

    // Kiểm tra email
    if (empty($old['email'])) {
        $errors['email'] = "Email is required.";
    } elseif (!filter_var($old['email'], FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "Invalid email format.";
    }

    // Kiểm tra password
    if (empty($password)) {
        $errors['password'] = "Password is required.";
    } elseif (strlen($password) < 6) {
        $errors['password'] = "Password must be at least 6 characters.";
    }

    // Kiểm tra confirm password
    if (empty($confirm_password)) {
        $errors['confirm_password'] = "Confirm password is required.";
    } elseif ($password !== $confirm_password) {
        $errors['confirm_password'] = "Passwords do not match.";
    }

    // Nếu có lỗi, lưu lỗi và dữ liệu vào session rồi chuyển hướng lại
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        $_SESSION['old'] = $old;
        header("Location: register.php");
        exit;
    }

    // Kết nối cơ sở dữ liệu và lưu thông tin nếu không có lỗi
    try {
        $conn = new PDO("mysql:host=localhost;dbname=duan1;charset=utf8", "root", "mysql");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Mã hóa mật khẩu
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Thêm dữ liệu vào bảng users
        $stmt = $conn->prepare("INSERT INTO users (full_name, address, phone, username, email, password) VALUES (:full_name, :address, :phone, :username, :email, :password)");
        $stmt->bindParam(':full_name', $old['full_name']);
        $stmt->bindParam(':address', $old['address']);
        $stmt->bindParam(':phone', $old['phone']);
        $stmt->bindParam(':username', $old['username']);
        $stmt->bindParam(':email', $old['email']);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->execute();

        // Chuyển hướng đến trang đăng nhập sau khi đăng ký thành công
        header("Location: login.php");
        exit;
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
}
?>
