<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý người dùng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/public/css/style_admin.css">
</head>

<body>

    <div class="d-flex">
        <?php include 'sidebar.php'; ?> <!-- Giao diện sidebar -->

        <!-- Content -->
        <div class="flex-grow-1 p-4" id="content">

            <!-- Hiển thị thông báo thành công -->
            <?php if (!empty($_SESSION['success_message'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success_message'] ?>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <!-- Header -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>QUẢN LÝ NGƯỜI DÙNG</h2>
                <div>
                    <a href="/admin" class="me-3 text-decoration-none">Trang chủ</a>
                    <span> > Danh sách người dùng</span>
                </div>
                <div class="avatar bg-warning rounded-circle" style="width: 40px; height: 40px;"></div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="/add-user" class="btn btn-success">Thêm Người Dùng</a>
            </div>

            <!-- User Table -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Danh sách người dùng</h5>
                    <table class="table table-bordered mt-3">
                        <thead class="table-light">
                            <tr>
                                <th>ID</th>
                                <th>Tên đăng nhập</th>
                                <th>Email</th>
                                <th>Tên đầy đủ</th>
                                <th>Vai trò</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($users) && is_array($users)): ?>
                                <?php foreach ($users as $user): ?>
                                    <tr>
                                        <td><?= htmlspecialchars($user['id']); ?></td>
                                        <td><?= htmlspecialchars($user['username']); ?></td>
                                        <td><?= htmlspecialchars($user['email']); ?></td>
                                        <td><?= htmlspecialchars($user['full_name']); ?></td>
                                        <td><?= $user['role'] === 'Admin' ? 'Admin' : 'Người dùng'; ?></td>
                                        <td>
                                            <a href="/update-user?id=<?= $user['id']; ?>" class="btn btn-primary btn-sm">Sửa</a>
                                            <a href="/delete-user?id=<?= $user['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">Xóa</a>
                                            <a href="/reset-password?id=<?= $user['id']; ?>" class="btn btn-warning btn-sm">Đặt lại mật khẩu</a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="6" class="text-center">Không có người dùng nào</td>
                                </tr>
                            <?php endif; ?>

                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>