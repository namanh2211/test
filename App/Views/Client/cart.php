<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

include 'header.php';
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
                    <?php if (!empty($_SESSION['cart'])): ?>
                        <?php foreach ($_SESSION['cart'] as $key => $item): ?>
                            <tr>
                                <td class="align-middle">
                                    <img src="<?php echo htmlspecialchars($item['image']); ?>" alt="" style="width: 50px;">
                                    <?php echo htmlspecialchars($item['name']); ?>
                                </td>
                                <td class="align-middle"><?php echo number_format($item['price'], 0, ',', '.'); ?> VND</td>
                                <td class="align-middle"><?php echo htmlspecialchars($item['size']); ?></td>
                                <td class="align-middle">
                                    <form action="cart-xuly.php" method="GET">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="key" value="<?php echo $key; ?>">
                                        <input type="number" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" class="form-control d-inline" style="width: 60px;">
                                        <button type="submit" class="btn btn-sm btn-success">
                                            <i class="fa fa-sync-alt"></i>
                                        </button>
                                    </form>
                                </td>
                                <td class="align-middle">
                                    <?php echo number_format($item['price'] * $item['quantity'], 0, ',', '.'); ?> VND
                                </td>
                                <td class="align-middle">
                                    <a href="cart-xuly.php?action=remove&key=<?php echo $key; ?>" class="btn btn-sm btn-danger">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6">Your cart is empty.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Cart Summary Section -->
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Cart Summary</span>
            </h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Subtotal</h6>
                        <h6>
                            <?php
                            $subtotal = 0;
                            if (!empty($_SESSION['cart'])) {
                                foreach ($_SESSION['cart'] as $item) {
                                    $subtotal += $item['price'] * $item['quantity'];
                                }
                            }
                            echo number_format($subtotal, 0, ',', '.') . ' VND';
                            ?>
                        </h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">30,000 VND</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Total</h5>
                        <h5>
                            <?php
                            $total = $subtotal + 30000; // Shipping cost
                            echo number_format($total, 0, ',', '.') . ' VND';
                            ?>
                        </h5>
                    </div>
                    <a href="checkout.php">
                        <button class="btn btn-block btn-primary font-weight-bold my-3 py-3">Proceed To Checkout</button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>
