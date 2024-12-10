<?php 
session_start(); 
include 'header.php'; // Bao gồm file header

// Kiểm tra nếu có sản phẩm yêu thích trong session
$favorite_products = isset($_SESSION['favorite_products']) ? $_SESSION['favorite_products'] : [];
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
                                    <?php echo $fav_product['name']; ?>
                                </td>
                                <td class="align-middle"><?php echo number_format($fav_product['price'], 2); ?> VND</td>
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
                                <td class="align-middle"><?php echo number_format($fav_product['price'], 2); ?> VND</td>
                                <td class="align-middle">
                                    <a href="favorite_products-xuly.php?action=remove&id=<?php echo $fav_product['id']; ?>" class="btn btn-sm btn-danger">
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

<?php include 'footer.php'; ?>  <!-- Bao gồm footer -->
