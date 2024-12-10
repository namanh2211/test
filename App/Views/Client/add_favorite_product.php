<?php
include 'header.php'; // Header của trang

session_start();

// Kiểm tra nếu người dùng đã đăng nhập
if (!isset($_SESSION['user_id'])) {
    echo "<p>Bạn phải đăng nhập để thêm sản phẩm yêu thích.</p>";
    exit();
}

?>

<div class="container">
    <h2>Thêm sản phẩm yêu thích</h2>
    <form method="get" action="add_favorite_product_controller.php">
        <label for="product_id">Chọn sản phẩm:</label>
        <select name="product_id" id="product_id" required>
            <!-- Các sản phẩm sẽ được lấy từ cơ sở dữ liệu hoặc có thể thêm thủ công -->
            <option value="1">Sản phẩm 1</option>
            <option value="2">Sản phẩm 2</option>
            <option value="3">Sản phẩm 3</option>
        </select>
        <button type="submit">Thêm vào yêu thích</button>
    </form>
</div>

<?php include 'footer.php'; // Footer của trang ?>
