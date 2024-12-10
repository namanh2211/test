<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../partials/header.php';

// Lấy tên người dùng từ session (nếu có)
$userName = $_SESSION['user']['full_name'] ?? null;

// Giả sử bạn đã có một mảng chứa các sản phẩm yêu thích
$favoriteProducts = $_SESSION['favorite_products'] ?? []; // Lấy danh sách sản phẩm yêu thích từ session

?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-12 table-responsive mb-5">
            <h2 class="text-center">Sản Phẩm Yêu Thích</h2>
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php if (!empty($favoriteProducts)): ?>
                        <?php foreach ($favoriteProducts as $product): ?>
                            <tr>
                                <td class="align-middle">
                                    <img src="<?php echo htmlspecialchars($product['image_path'] ?? 'default-image.jpg'); ?>"
                                        alt="Product Image" style="width: 50px;">
                                    <?php echo htmlspecialchars($product['name'] ?? 'Unknown Product'); ?>
                                </td>
                                <td class="align-middle"><?php echo number_format($product['price'] ?? 0, 0, ',', '.'); ?> VND
                                </td>
                                <td class="align-middle">
                                    <a href="/favorite-products/remove?product_id=<?php echo htmlspecialchars($product['product_id']); ?>"
                                        class="btn btn-sm btn-danger">
                                        <i class="fa fa-times"></i> Remove
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="3" class="text-center">Bạn chưa có sản phẩm yêu thích nào.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
