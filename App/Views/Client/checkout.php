<?php
// Kiểm tra trạng thái đăng nhập
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}
?>

<?php include __DIR__ . '/../partials/header.php'; ?>

<!-- checkout.php -->
<div class="container">
    <h2>Thanh toán</h2>

    <?php if (empty($_SESSION['cart'])): ?>
        <div class="alert alert-warning">
            Giỏ hàng của bạn hiện tại đang trống.
        </div>
    <?php else: ?>
        <form method="POST" action="/payment/momo">
            <h3>Thông tin giỏ hàng</h3>
            <table class="table">
                <thead>
                    <tr>
                        <th>Ảnh</th>
                        <th>Tên sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Giá</th>
                        <th>Tổng</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    $totalAmount = 0; // Biến lưu tổng tiền thanh toán
                    foreach ($_SESSION['cart'] as $item): 
                        $itemTotal = $item['quantity'] * $item['price'];
                        $totalAmount += $itemTotal;
                    ?>
                        <tr>
                            <td><img src="images/<?= $item['image'] ?>" width="100"></td>
                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                            <td><?= number_format($itemTotal, 0, ',', '.') ?> VND</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Trường ẩn cho tổng tiền thanh toán -->
            <input type="hidden" name="amount" value="<?= $totalAmount ?>">

            <div class="form-group">
                <label for="payment_method">Chọn phương thức thanh toán:</label>
                <select class="form-control" id="payment_method" name="payment_method">
                    <option value="cash_on_delivery">Thanh toán khi nhận hàng</option>
                    <option value="momo">Thanh toán MoMo</option> <!-- Thêm phương thức thanh toán MoMo -->
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Thanh toán</button>
        </form>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
