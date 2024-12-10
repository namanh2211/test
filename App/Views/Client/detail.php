<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../partials/header.php';

// Hiển thị chi tiết sản phẩm
$product_id = $product_id ?? null;
$product_name = $product_name ?? '';
$product_price = $product_price ?? 0;
$product_image = $product_image ?? '';
$product_description = $product_description ?? '';
$product_size = $product_size ?? '';
$product_stock = $product_stock ?? 0;
$product_created_at = $product_created_at ?? '';

?>

<style>
    .form-check-input {
        display: none;
    }

    .form-check-label {
        padding: 10px 20px;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        margin-right: 5px;
        transition: all 0.3s ease;
    }

    .form-check-input:checked+.form-check-label {
        background-color: #007bff;
        color: white;
        border-color: #007bff;
    }
</style>

<!-- Breadcrumb Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Trang chủ</a>
                <a class="breadcrumb-item text-dark" href="shop.php">Cửa hàng</a>
                <span class="breadcrumb-item active"><?php echo htmlspecialchars($product_name); ?></span>
            </nav>
        </div>
    </div>
</div>
<!-- Breadcrumb End -->

<!-- Shop Detail Start -->
<div class="container-fluid pb-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 mb-30">
            <div class="carousel slide" data-ride="carousel">
                <div class="carousel-inner bg-light">
                    <div class="carousel-item active">
                        <img class="w-100 h-100" src="<?php echo htmlspecialchars($product_image); ?>"
                            alt="Hình ảnh sản phẩm">
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-7 h-auto mb-30">
            <div class="h-100 bg-light p-30">
                <h3><?php echo htmlspecialchars($product_name); ?></h3>
                <h3 class="font-weight-semi-bold mb-4"><?php echo number_format($product_price, 0, ',', '.'); ?> VND
                </h3>
                <p class="mb-4"><?php echo htmlspecialchars($product_description); ?></p>

                <!-- Hiển thị size sản phẩm -->
                <div class="mb-4">
                    <h5>Size:</h5>
                    <?php if (!empty($product_size)): ?>
                        <form method="POST" action="/cart/addToCart"> <!-- Form gửi size và ID sản phẩm -->
                            <?php
                            $sizes = explode(',', $product_size); // Tách size bằng dấu phẩy
                            foreach ($sizes as $size): ?>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="selected_size"
                                        id="size-<?php echo htmlspecialchars($size); ?>"
                                        value="<?php echo htmlspecialchars($size); ?>" required>
                                    <label class="form-check-label"
                                        for="size-<?php echo htmlspecialchars($size); ?>"><?php echo htmlspecialchars($size); ?></label>
                                </div>
                            <?php endforeach; ?>

                            <!-- Số lượng và nút thêm vào giỏ hàng -->
                            <div class="d-flex align-items-center mb-4 pt-2">
                                <div class="input-group quantity mr-3" style="width: 130px;">
                                    <input type="number" class="form-control bg-secondary border-0 text-center"
                                        name="quantity" value="1" min="1">
                                </div>
                            </div>

                            <!-- Gửi thông tin sản phẩm -->
                            <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">

                            <!-- Hiển thị nút "Thêm vào giỏ hàng" hoặc yêu cầu đăng nhập -->
                            <?php if (isset($_SESSION['user'])): ?>
                                <button type="submit" class="btn btn-primary px-3 mt-3"><i class="fa fa-shopping-cart mr-1"></i>
                                    Thêm vào giỏ hàng</button>
                            <?php else: ?>
                                <a href="/login" class="btn btn-primary px-3 mt-3">
                                    <i class="fa fa-user mr-1"></i> Đăng nhập để thêm vào giỏ hàng
                                </a>
                            <?php endif; ?>
                        </form>
                    <?php else: ?>
                        <span class="text-muted">Không có size</span>
                    <?php endif; ?>
                </div>

                <!-- Thông tin bổ sung -->
                <p><strong>Tồn kho:</strong> <?php echo htmlspecialchars($product_stock); ?> sản phẩm có sẵn</p>
                <p><strong>Ngày tạo:</strong> <?php echo htmlspecialchars($product_created_at); ?></p>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->
<?php require __DIR__ . '/../partials/footer.php'; ?>
