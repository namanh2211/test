<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require __DIR__ . '/../partials/header.php';
// Lấy tên người dùng từ session (nếu có)
$userName = $_SESSION['user']['full_name'] ?? null;
?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php if (!empty($cartItems)): ?>
                        <?php foreach ($cartItems as $key => $item): ?>
                            <tr>
                                <td class="align-middle">
                                    <img src="<?php echo htmlspecialchars($item['image'] ?? 'default-image.jpg'); ?>" 
                                         alt="Product Image" style="width: 50px;">
                                    <?php echo htmlspecialchars($item['product_name'] ?? 'Unknown Product'); ?>
                                </td>
                                <td class="align-middle"><?php echo number_format($item['price'] ?? 0, 0, ',', '.'); ?> VND</td>
                                <td class="align-middle"><?php echo htmlspecialchars($item['size'] ?? 'N/A'); ?></td>
                                <td class="align-middle">
                                    <form action="/cart/update" method="POST">
                                        <input type="hidden" name="key" value="<?php echo htmlspecialchars($key); ?>">
                                        <input type="number" name="quantity" value="<?php echo (int) ($item['quantity'] ?? 1); ?>"
                                            min="1" class="form-control d-inline" style="width: 60px;">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fa fa-sync-alt"></i> Update
                                        </button>
                                    </form>
                                </td>
                                <td class="align-middle">
                                    <?php echo number_format(($item['price'] ?? 0) * (int) ($item['quantity'] ?? 1), 0, ',', '.'); ?> VND
                                </td>
                                <td class="align-middle">
                                    <a href="/cart/remove?key=<?php echo htmlspecialchars($key); ?>" 
                                       class="btn btn-sm btn-danger">
                                        <i class="fa fa-times"></i> Remove
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" class="text-center">Your cart is empty.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Cart Summary</span>
            </h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6><?php echo number_format($subtotal ?? 0, 0, ',', '.'); ?> VND</h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">30,000 VND</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5><?php echo number_format(($subtotal ?? 0) + 30000, 0, ',', '.'); ?> VND</h5>
                    </div>
                    <a href="/checkout">
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To
                            Checkout</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require __DIR__ . '/../partials/footer.php'; ?>
