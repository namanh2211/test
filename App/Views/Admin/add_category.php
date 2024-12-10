<?php
// Lấy lỗi và dữ liệu cũ từ session
$errors = $_SESSION['errors'] ?? [];
$old_data = $_SESSION['old_data'] ?? ['category_name' => '', 'description' => ''];

// Xóa lỗi và dữ liệu cũ khỏi session sau khi hiển thị
unset($_SESSION['errors']);
unset($_SESSION['old_data']);
unset($_SESSION['success_message']);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm danh mục</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/./public/css/style_admin.css">
</head>

<body>
    <div class="d-flex">
        <?php include __DIR__ . '/sidebar.php'; ?>
        <div class="flex-grow-1 p-4" id="content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>Thêm danh mục</h2>
                <div>
                    <a href="/admin" class="me-3 text-decoration-none">Trang chủ</a>
                    <span> > Thêm danh mục</span>
                </div>
                <div class="avatar bg-warning rounded-circle" style="width: 40px; height: 40px;"></div>
            </div>

            <!-- Hiển thị thông báo lỗi nếu có -->
            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?= htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <div class="card">
                <div class="card-body">
                    <h5>Thêm danh mục mới</h5>
                    <form action="/add-category" method="POST" class="mt-3">
                        <div class="mb-3">
                            <label for="category_name" class="form-label">Tên danh mục</label>
                            <input type="text" class="form-control <?= !empty($errors['category_name']) ? 'is-invalid' : ''; ?>"
                                id="category_name" name="category_name"
                                value="<?= htmlspecialchars($old_data['category_name'] ?? ''); ?>">
                            <div class="invalid-feedback">
                                <?= $errors['category_name'] ?? ''; ?>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả danh mục</label>
                            <textarea class="form-control <?= !empty($errors['description']) ? 'is-invalid' : ''; ?>"
                                id="description" name="description" rows="4"><?= htmlspecialchars($old_data['description'] ?? ''); ?></textarea>
                            <div class="invalid-feedback">
                                <?= $errors['description'] ?? ''; ?>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-success">Thêm danh mục</button>
                        <a href="/category-list" class="btn btn-secondary">Quay lại</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>