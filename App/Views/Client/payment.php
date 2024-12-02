<!-- payment.php -->
<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <h2>Thanh toán</h2>
    
    <form method="POST" action="index.php?action=submit_payment">
        <h3>Chọn phương thức thanh toán</h3>
        
        <div>
            <label for="payment_method">Phương thức thanh toán:</label>
            <select name="payment_method" id="payment_method" required>
                <option value="credit_card">Thẻ tín dụng</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Chuyển khoản ngân hàng</option>
            </select>
        </div>

        <div>
            <button type="submit">Thanh toán</button>
        </div>
    </form>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>
