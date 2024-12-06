<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cập nhật sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/./public/css/style_admin.css">
</head>

<body>

    <div class="d-flex">
        <?php include 'sidebar.php'; ?>

        <div class="flex-grow-1 p-4" id="content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>CẬP NHẬT SẢN PHẨM</h2>
                <div>
                    <a href="#" class="me-3 text-decoration-none">Trang chủ</a>
                    <span> > Cập nhật sản phẩm</span>
                </div>
                <div class="avatar bg-warning rounded-circle" style="width: 40px; height: 40px;"></div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <form action="/update-product?id=<?= $product['id'] ?>" method="POST" class="mt-3" enctype="multipart/form-data">
                        <!-- Tên sản phẩm và Danh mục -->
                        <div class="row mb-3">
                            <!-- Tên sản phẩm -->
                            <div class="col-md-6">
                                <label for="productName" class="form-label">Tên sản phẩm</label>
                                <input type="text" class="form-control <?= isset($_SESSION['errors']['product_name']) ? 'is-invalid' : '' ?>" id="productName" name="product_name" value="<?= $product['product_name'] ?>" />
                                <?php if (isset($_SESSION['errors']['product_name'])): ?>
                                    <div class="invalid-feedback"><?= $_SESSION['errors']['product_name'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Danh mục -->
                            <div class="col-md-6">
                                <label for="category" class="form-label">Danh mục</label>
                                <select class="form-control <?= isset($_SESSION['errors']['category_id']) ? 'is-invalid' : '' ?>" id="category" name="category_id">
                                    <option value="">Chọn danh mục</option>
                                    <?php foreach ($categories as $category): ?>
                                        <option value="<?= $category['id'] ?>" <?= $category['id'] == $product['category_id'] ? 'selected' : '' ?>><?= $category['category_name'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                                <?php if (isset($_SESSION['errors']['category_id'])): ?>
                                    <div class="invalid-feedback"><?= $_SESSION['errors']['category_id'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Mô tả sản phẩm -->
                        <div class="mb-3">
                            <label for="description" class="form-label">Mô tả</label>
                            <textarea class="form-control <?= isset($_SESSION['errors']['description']) ? 'is-invalid' : '' ?>" id="description" name="description" rows="3"><?= $product['description'] ?></textarea>
                            <?php if (isset($_SESSION['errors']['description'])): ?>
                                <div class="invalid-feedback"><?= $_SESSION['errors']['description'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Giá, Số lượng, Kích thước, Thương hiệu -->
                        <div class="row mb-3">
                            <!-- Giá -->
                            <div class="col-md-3">
                                <label for="price" class="form-label">Giá</label>
                                <input type="number" class="form-control <?= isset($_SESSION['errors']['price']) ? 'is-invalid' : '' ?>" id="price" name="price" value="<?= $product['price'] ?>" step="0.01" />
                                <?php if (isset($_SESSION['errors']['price'])): ?>
                                    <div class="invalid-feedback"><?= $_SESSION['errors']['price'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Số lượng -->
                            <div class="col-md-3">
                                <label for="stock" class="form-label">Số lượng</label>
                                <input type="number" class="form-control <?= isset($_SESSION['errors']['stock_quantity']) ? 'is-invalid' : '' ?>" id="stock" name="stock_quantity" value="<?= $product['stock_quantity'] ?>" />
                                <?php if (isset($_SESSION['errors']['stock_quantity'])): ?>
                                    <div class="invalid-feedback"><?= $_SESSION['errors']['stock_quantity'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Kích thước -->
                            <div class="col-md-3">
                                <label for="size" class="form-label">Kích thước</label>
                                <input type="text" class="form-control <?= isset($_SESSION['errors']['size']) ? 'is-invalid' : '' ?>" id="size" name="size" value="<?= $product['size'] ?>" />
                                <?php if (isset($_SESSION['errors']['size'])): ?>
                                    <div class="invalid-feedback"><?= $_SESSION['errors']['size'] ?></div>
                                <?php endif; ?>
                            </div>

                            <!-- Thương hiệu -->
                            <div class="col-md-3">
                                <label for="brand" class="form-label">Thương hiệu</label>
                                <input type="text" class="form-control <?= isset($_SESSION['errors']['brand']) ? 'is-invalid' : '' ?>" id="brand" name="brand" value="<?= $product['brand'] ?>" />
                                <?php if (isset($_SESSION['errors']['brand'])): ?>
                                    <div class="invalid-feedback"><?= $_SESSION['errors']['brand'] ?></div>
                                <?php endif; ?>
                            </div>
                        </div>

                        <!-- Hình ảnh -->
                        <div class="mb-3">
                            <label for="image" class="form-label">Hình ảnh</label>
                            <div class="mb-3">
                                <img src="../../../public/<?= $product['image_path']; ?>" alt="Product Image" class="mt-2" style="width: 100px;">
                            </div>
                            <input type="file" class="form-control <?= isset($_SESSION['errors']['image_path']) ? 'is-invalid' : '' ?>" id="image_path" name="image_path" accept="image/*">
                            <?php if (isset($_SESSION['errors']['image_path'])): ?>
                                <div class="invalid-feedback"><?= $_SESSION['errors']['image_path'] ?></div>
                            <?php endif; ?>
                        </div>

                        <!-- Checkbox sản phẩm nổi bật -->
                        <div class="mb-3">
                            <input type="checkbox" class="form-check-input <?= isset($_SESSION['errors']['is_featured']) ? 'is-invalid' : '' ?>" id="is_featured" name="is_featured"
                                <?= $product['is_featured'] == 1 ? 'checked' : '' ?>>
                            <label for="is_featured" class="form-label">Sản phẩm nổi bật</label>

                        </div>

                        <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>
                        <a href="/list-product" class="btn btn-secondary">Quay lại</a>
                    </form>

                    <?php
                    // Xóa session lỗi và dữ liệu cũ sau khi đã hiển thị
                    unset($_SESSION['errors']);
                    unset($_SESSION['old_data']);
                    ?>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>