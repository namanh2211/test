<?php
include 'header.php';
require_once 'FavoriteProductsController.php'; // Kết nối với Controller

// Kiểm tra nếu người dùng đã đăng nhập
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Lấy ID người dùng
$user_id = $_SESSION['user_id'];

// Lấy danh sách sản phẩm yêu thích từ Controller
$favorite_products = FavoriteProductsController::getFavoriteProducts($user_id);

?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="index.php">Trang chủ</a>
                <a class="breadcrumb-item text-dark" href="shop.php">Cửa hàng</a>
                <span class="breadcrumb-item active">Sản phẩm yêu thích</span>
            </nav>
        </div>
    </div>
</div>

<!-- Wishlist Table Start -->
<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0 w-100">
                <thead class="thead-dark">
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Tổng cộng</th>
                        <th>Xóa</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php if (count($favorite_products) > 0): ?>
                        <?php foreach ($favorite_products as $fav_product): ?>
                            <tr>
                                <td class="align-middle">
                                    <img src="<?php echo $fav_product['image_path']; ?>" alt="Hình ảnh sản phẩm" style="width: 50px;">
                                    <?php echo $fav_product['product_name']; ?>
                                </td>
                                <td class="align-middle"><?php echo number_format($fav_product['product_price'], 2); ?> VND</td>
                                <td class="align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center" value="1">
                                        <div class="input-group-btn">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="align-middle"><?php echo number_format($fav_product['product_price'], 2); ?> VND</td>
                                <td class="align-middle">
                                    <a href="Favorite_productsController.php?action=remove&id=<?php echo $fav_product['id']; ?>" class="btn btn-sm btn-danger">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr><td colspan="5">Chưa có sản phẩm yêu thích nào.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Wishlist Table End -->

<?php include 'footer.php'; ?>
