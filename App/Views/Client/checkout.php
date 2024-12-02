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
        <form method="POST" action="index.php?action=submit_payment">
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
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <tr>
                            <td><img src="images/<?= $item['image'] ?>" width="100"></td>
                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                            <td><?= number_format($item['quantity'] * $item['price'], 0, ',', '.') ?> VND</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

           
            
            <div class="form-group">
                <label for="payment_method">Chọn phương thức thanh toán:</label>
                <select class="form-control" id="payment_method" name="payment_method">
                    <option value="bank">Chuyển khoản ngân hàng</option>
                    <option value="paypal">PayPal</option>
                    <option value="cash_on_delivery">Thanh toán khi nhận hàng</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Thanh toán</button>
        </form>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
