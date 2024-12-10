<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập Admin</title>
    <link rel="stylesheet" href="/./public/css/style_login.css">
</head>
<body>

    <div class="login-container">
        <div class="login-box">
            <h2>Đăng nhập Admin</h2>

            <?php if (isset($errorMessage)): ?>
                <div class="alert alert-danger"><?= htmlspecialchars($errorMessage) ?></div>
            <?php endif; ?>

            <form action="/login-admin" method="POST">
                <div class="mb-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="Tên đăng nhập">
                </div>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Mật khẩu">
                </div>

                <!-- Thêm checkbox lưu tài khoản -->
                <div class="checkbox-container">
                    <input type="checkbox" id="remember_me" name="remember_me">
                    <label for="remember_me">Lưu tài khoản trong 20 ngày</label>
                </div>

                <button type="submit" class="btn-login">Đăng nhập</button>
            </form>
        </div>
    </div>

</body>
</html>