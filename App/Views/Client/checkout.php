<?php
// Kiểm tra trạng thái đăng nhập
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
if (!isset($_SESSION['user'])) {
    header('Location: login.php');
    exit;
}

// Gọi file cấu hình Database
require_once __DIR__ . '/../../../config/database.php';

use Config\Database;

// Tạo đối tượng Database và khởi tạo kết nối
$db = new Database();
$pdo = $db->connect();

// Sử dụng PDO để lấy dữ liệu từ bảng users
try {
    $stmt = $pdo->prepare('SELECT * FROM users WHERE id = ?');
    // Lấy ID người dùng từ session
    $userId = $_SESSION['user']['id'] ?? null;

    if (!$userId) {
        die('Lỗi: Chưa xác định được user ID.');
    }

    $stmt->execute([$userId]);
    $user = $stmt->fetch();

    if (!$user) {
        die('Không tìm thấy thông tin người dùng.');
    }
} catch (PDOException $e) {
    die('Lỗi truy vấn cơ sở dữ liệu: ' . $e->getMessage());
}

// Lấy thông tin giỏ hàng
$totalAmount = 0;
foreach ($_SESSION['cart'] as $item) {
    $totalAmount += $item['quantity'] * $item['price'];
}

// Lấy thông tin địa chỉ thứ hai (nếu có)
$shippingAddress = $user['address'] . (isset($_POST['address_2']) ? ', ' . $_POST['address_2'] : '');

// Xử lý thanh toán thành công và chuyển hướng
// Xử lý thanh toán thành công và chuyển hướng
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payUrl'])) {
    // Giả sử trạng thái thanh toán đã được trả về từ MoMo API hoặc hệ thống khác
    $paymentId = 'MOMO123456';  // Đây là mã giao dịch trả về từ API MoMo hoặc hệ thống thanh toán của bạn
    $status = 'pending';  // Thay đổi trạng thái thanh toán nếu cần

    // Lưu đơn hàng vào bảng orders
    try {
        $stmt = $pdo->prepare('
            INSERT INTO orders (user_id, order_date, status, payment_id, total_amount, address)
            VALUES (?, NOW(), ?, ?, ?, ?)
        ');

        // Thực hiện chèn dữ liệu vào bảng orders
        $stmt->execute([$userId, $status, $paymentId, $totalAmount, $shippingAddress]);

        // Lấy ID đơn hàng mới
        $orderId = $pdo->lastInsertId();

        // Lưu thông tin sản phẩm vào session để hiển thị trên trang cảm ơn
        $_SESSION['purchased_product'] = [
            'order_id' => $orderId,
            'total_amount' => $totalAmount,
            'address' => $shippingAddress,
            'products' => $_SESSION['cart'], // Đảm bảo giỏ hàng không rỗng
        ];
        var_dump($_SESSION['cart']);  // Kiểm tra giá trị giỏ hàng
        

        // Xóa giỏ hàng sau khi thanh toán thành công
        unset($_SESSION['cart']);  // Xóa giỏ hàng nếu không cần thiết hiển thị lại trên trang khác

        // Chuyển hướng tới trang checkout-success.php
        header('Location: checkout-success.php');
        exit();
    } catch (PDOException $e) {
        die("Lỗi khi lưu đơn hàng: " . $e->getMessage());
    }
}
?>

<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="container">
    <h2>Thanh toán</h2>

    <?php if (empty($_SESSION['cart'])): ?>
        <div class="alert alert-warning">
            Giỏ hàng của bạn hiện tại đang trống.
        </div>
    <?php else: ?>
        <form method="POST" action="/payment">
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
                    foreach ($_SESSION['cart'] as $item):
                        $itemTotal = $item['quantity'] * $item['price'];
                        ?>
                        <tr>
                            <td><img src="images/<?= htmlspecialchars($item['image']) ?>" width="100"></td>
                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                            <td><?= number_format($itemTotal, 0, ',', '.') ?> VND</td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Trường ẩn cho tổng tiền thanh toán -->
            <input type="hidden" name="amount" value="<?= $totalAmount ?>">

            <h3>Thông tin khách hàng</h3>
            <div class="form-group">
                <label for="name">Tên khách hàng:</label>
                <input type="text" class="form-control" id="name" name="name"
                    value="<?= htmlspecialchars($user['full_name']) ?>" readonly>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="text" class="form-control" id="phone" name="phone"
                    value="<?= htmlspecialchars($user['phone']) ?>" readonly>
            </div>
            <div class="form-group">
                <label for="address">Địa chỉ giao hàng:</label>
                <textarea class="form-control" id="address" name="address"
                    readonly><?= htmlspecialchars($user['address']) ?></textarea>
            </div>
            <div class="form-group">
                <label for="address_2">Địa chỉ thứ 2 (nếu có):</label>
                <textarea class="form-control" id="address_2" name="address_2"></textarea>
            </div>

            <!-- Hiển thị tổng số tiền -->
            <div class="form-group">
                <label for="total_amount">Tổng số tiền:</label>
<input type="text" class="form-control" id="total_amount"
                    value="<?= number_format($totalAmount, 0, ',', '.') ?> VND" readonly>
            </div>

            <div class="form-group">
                <label for="payment_method">Chọn phương thức thanh toán:</label> <br />
                <button type="submit" name="payUrl" class="btn btn-primary">Thanh toán MoMo</button>
            </div>
        </form>
    <?php endif; ?>
</div>

<?php include __DIR__ . '/../partials/footer.php'; ?>