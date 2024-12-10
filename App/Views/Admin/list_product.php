<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/./public/css/style_admin.css">
</head>

<body>

    <div class="d-flex">
        <?php include 'sidebar.php'; ?>

        <!-- Content -->
        <div class="flex-grow-1 p-4" id="content">

            <!-- Hiển thị thông báo thành công -->
            <?php if (!empty($_SESSION['success_message'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success_message'] ?>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>QUẢN LÝ SẢN PHẨM</h2>
                <div>
                    <a href="/admin" class="me-3 text-decoration-none">Trang chủ</a>
                    <span> > Danh sách sản phẩm</span>
                </div>
                <div class="avatar bg-warning rounded-circle" style="width: 40px; height: 40px;"></div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <a href="/add-product" class="btn btn-success">Thêm Sản Phẩm</a>
            </div>

            <!-- Search and Filter Options -->
            <form method="POST" action="/products-search" class="row mb-3">
                <div class="col-md-4">
                    <input type="text" name="product_name" class="form-control" placeholder="Tìm kiếm sản phẩm...">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-secondary w-100">Tìm kiếm</button>
                </div>
            </form>

            <!-- Product Table -->
            <div class="card mb-4">
                <div class="card-body">
                    <h5>Danh sách sản phẩm</h5>
                    <table class="table table-bordered mt-3">
                        <thead class="table-light">
                            <tr class="text-align-center">
                                <th>ID</th>
                                <th>Tên Sản phẩm</th>
                                <th>Danh mục</th>
                                <th>Mô tả</th>
                                <th>Giá</th>
                                <th>Số lượng</th>
                                <th>Hình ảnh</th>
                                <th>Ngày thêm</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($products as $product): ?>
                                <tr>
                                    <td><?php echo $product['id']; ?></td>
                                    <td><a href="" class="text-decoration-none"><?= $product['product_name']; ?></a></td>
                                    <td><?= $product['category_name']; ?></td>
                                    <td>
                                        <?= (str_word_count($product['description']) > 7) ? implode(' ', array_slice(explode(' ', $product['description']), 0, 7)) . '...' : $product['description']; ?>
                                    </td>
                                    <td>$ <?= number_format($product['price'], 0, ',', '.'); ?></td>
                                    <td><?= $product['stock_quantity']; ?></td>
                                    <td><img width="100" src="../../../public/<?= $product['image_path']; ?>"></td>
                                    <td><?= date('d/m/Y', strtotime($product['created_at'])); ?></td>
                                    <td>
                                        <a href="/update-product?id=<?= $product['id']; ?>" class="btn btn-warning btn-sm">Sửa</a>
                                        <button class="btn btn-danger btn-sm" onclick="deleteProduct(<?= $product['id']; ?>)">Xóa</button>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script>
        function deleteProduct(productId) {
            if (confirm("Bạn có chắc chắn muốn xóa sản phẩm này?")) {
                fetch(`delete_product.php?id=${productId}`, {
                        method: 'GET'
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload(); // Tải lại trang để cập nhật danh sách sản phẩm
                        }
                    })
                    .catch(error => {
                        console.error("Error:", error);
                    });
            }
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>