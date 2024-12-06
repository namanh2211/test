<!-- views/payment.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - MultiShop</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>Thông tin thanh toán</h2>
    
    <?php if (isset($paymentData)): ?>
        <p><strong>Tên đầy đủ:</strong> <?= htmlspecialchars($paymentData['full_name']); ?></p>
        <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($paymentData['address']); ?></p>
        <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($paymentData['phone']); ?></p>
        <p><strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($paymentData['payment_method']); ?></p>

        <!-- Hiển thị các lựa chọn thanh toán -->
        <?php if ($paymentData['payment_method'] == 'momo'): ?>
            <p>Chuyển hướng đến MoMo để hoàn tất thanh toán...</p>
        <?php elseif ($paymentData['payment_method'] == 'vnpay'): ?>
            <p>Chuyển hướng đến VNPAY để hoàn tất thanh toán...</p>
        <?php else: ?>
            <p>Thanh toán khi nhận hàng. Cảm ơn bạn!</p>
        <?php endif; ?>
    <?php else: ?>
        <p>Không có thông tin thanh toán.</p>
    <?php endif; ?>
</div>

</body>
</html>
