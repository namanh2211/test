<?php
$errors = isset($_SESSION['errors']) ? $_SESSION['errors'] : [];
$old = isset($_SESSION['old']) ? $_SESSION['old'] : [];

// Xóa dữ liệu lỗi và dữ liệu cũ khỏi session sau khi tải trang
unset($_SESSION['errors']);
unset($_SESSION['old']);
?>
<!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <!-- Required meta tags -->
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="public/css/style.css">
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h2>Login</h2>
                    </div>
                    <div class="card-body">
                        <form action="/login-xuly" method="POST">
                            <div class="mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" id="username" name="username" class="form-control"
                                    value="<?php echo isset($old['username']) ? htmlspecialchars($old['username']) : ''; ?>">
                                <?php if (isset($errors['username'])): ?>
                                    <small class="text-danger"><?php echo $errors['username']; ?></small>
                                <?php endif; ?>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" id="password" name="password" class="form-control">
                                <?php if (isset($errors['password'])): ?>
                                    <small class="text-danger"><?php echo $errors['password']; ?></small>
                                <?php endif; ?>
                            </div>
                            <button type="submit" class="w-100 btn btn-primary">Login</button>
                        </form>
                        <div class="text-center mt-3">
                            <p>Don't have an account? <a href="/register">Register here</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>