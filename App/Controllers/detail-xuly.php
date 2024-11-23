<?php
include 'database.php'; // Kết nối cơ sở dữ liệu

// Kiểm tra nếu ID sản phẩm hợp lệ
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $product_id = intval($_GET['id']); // Lấy ID sản phẩm

    try {
        // Truy vấn để lấy thông tin sản phẩm
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        $product = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($product) {
            // Lưu thông tin sản phẩm vào biến
            $product_name = $product['product_name'];
            $product_price = $product['price'];
            $product_description = $product['description'];
            $product_image = $product['image_path'];
            $product_stock = $product['stock'];
            $product_size = $product['size']; // Lấy thông tin size
            $product_created_at = $product['created_at'];
        } else {
            echo "Sản phẩm không tồn tại.";
            exit;
        }
    } catch (PDOException $e) {
        echo "Lỗi khi lấy thông tin sản phẩm: " . $e->getMessage();
        exit;
    }
} else {
    echo "ID sản phẩm không hợp lệ.";
    exit;
}
?>
