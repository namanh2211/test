<?php
include 'database.php'; // Kết nối cơ sở dữ liệu

if (isset($_GET['q'])) {
    $searchTerm = $_GET['q'];

    // Truy vấn cơ sở dữ liệu
    $sql = "SELECT id, product_name, price, image_path FROM products WHERE product_name LIKE :searchTerm LIMIT 5";
    $stmt = $conn->prepare($sql);
    $stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Trả về dữ liệu JSON nếu yêu cầu là AJAX
    if (isset($_GET['ajax'])) {
        echo json_encode($products);
        exit;
    }
}
?>