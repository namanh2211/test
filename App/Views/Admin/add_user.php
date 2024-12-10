<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Người Dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/./public/css/style_admin.css">
</head>

<body>

    <div class="d-flex">
        <?php include 'sidebar.php'; ?>

        <!-- Content -->
        <div class="flex-grow-1 p-4" id="content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>THÊM NGƯỜI DÙNG</h2>
                <div>
                    <a href="/admin" class="me-3 text-decoration-none">Trang chủ</a>
                    <span> > Thêm người dùng</span>
                </div>
                <div class="avatar bg-warning rounded-circle" style="width: 40px; height: 40px;"></div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="/add-user" method="POST">
                        <div class="mb-3">
                            <label for="username" class="form-label">Tên đăng nhập</label>
                            <input type="text" class="form-control" id="username" name="username" value="<?= $old_data['username'] ?? '' ?>">
                            <?php if (isset($errors['username'])): ?>
                                <div class="text-danger"><?= $errors['username'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?= $old_data['email'] ?? '' ?>">
                            <?php if (isset($errors['email'])): ?>
                                <div class="text-danger"><?= $errors['email'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Tên đầy đủ</label>
                            <input type="text" class="form-control" id="fullname" name="fullname" value="<?= $old_data['fullname'] ?? '' ?>">
                            <?php if (isset($errors['fullname'])): ?>
                                <div class="text-danger"><?= $errors['fullname'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Mật khẩu</label>
                            <input type="password" class="form-control" id="password" name="password">
                            <?php if (isset($errors['password'])): ?>
                                <div class="text-danger"><?= $errors['password'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="confirm_password" class="form-label">Xác nhận mật khẩu</label>
                            <input type="password" class="form-control" id="confirm_password" name="confirm_password">
                            <?php if (isset($errors['confirm_password'])): ?>
                                <div class="text-danger"><?= $errors['confirm_password'] ?></div>
                            <?php endif; ?>
                        </div>
                        <div class="mb-3">
                            <label for="role" class="form-label">Quyền người dùng</label>
                            <select class="form-control" id="role" name="role">
                                <option value="0" <?= (isset($old_data['role']) && $old_data['role'] == 0) ? 'selected' : '' ?>>Người dùng</option>
                                <option value="1" <?= (isset($old_data['role']) && $old_data['role'] == 1) ? 'selected' : '' ?>>Admin</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Thêm người dùng</button>
                        <a href="/admin/user/list" class="btn btn-secondary">Quay lại</a>
                    </form>

                </div>
            </div>
        </div>
</body>

</html>