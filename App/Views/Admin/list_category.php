<?php
// Lấy danh sách danh mục từ controller
$categories = $categories ?? [];

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý loại sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/./public/css/style_admin.css">
</head>

<body>

    <div class="d-flex">

        <?php include 'sidebar.php'; ?>

        <!-- Content -->
        <div class="flex-grow-1 p-4" id="content">
            <h2>QUẢN LÝ DANH MỤC</h2>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="add-category" class="btn btn-success">Thêm Danh Mục</a>
            </div>

            <!-- Hiển thị thông báo thành công -->
            <?php
            // Hiển thị thông báo thành công nếu có
            $success_message = $_SESSION['success_message'] ?? '';
            if ($success_message) {
                echo "<div class='alert alert-success'>$success_message</div>";
                unset($_SESSION['success_message']); // Xóa thông báo sau khi đã hiển thị
            }
            ?>
            <!-- Product Category Table -->
            <div class="card">
                <div class="card-body">
                    <h5>Danh sách danh mục</h5>
                    <table class="table table-bordered mt-3">
                        <thead class="table-light">
                            <tr class="text-align-center">
                                <th>STT</th>
                                <th>Tên</th>
                                <th>Mô tả</th>
                                <th>Ngày tạo</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 1;
                            foreach ($categories as $category): ?>
                                <tr>
                                    <td><?php echo $stt++; ?></td>
                                    <td><?php echo htmlspecialchars($category['category_name']); ?></td>
                                    <td><?php echo htmlspecialchars($category['description']); ?></td>
                                    <td><?php echo $category['created_at']; ?></td>
                                    <td>
                                        <a href="/edit-category?id=<?php echo $category['id']; ?>" class="btn btn-primary btn-sm">Sửa</a>
                                        <a href="delete-category?id=<?php echo $category['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa danh mục này?');">Xóa</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>