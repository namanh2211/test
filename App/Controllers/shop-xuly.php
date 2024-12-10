<?php
try {
    $conn = new PDO("mysql:host=localhost;
    dbname=duan1;
    charset=utf8",
     "root",
      "mysql");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Số sản phẩm hiển thị trên mỗi trang
    $products_per_page = 9;

    // Kiểm tra trang hiện tại, mặc định là trang 1
    $current_page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
    $offset = ($current_page - 1) * $products_per_page;

    // Lấy danh mục sản phẩm (nếu có)
    $category_id = isset($_GET['category_id']) ? (int)$_GET['category_id'] : null;
    $category_filter = $category_id ? "WHERE category_id = :category_id" : "";

    // Lấy tổng số sản phẩm cho phân trang
    $total_products_stmt = $conn->prepare("SELECT COUNT(*) FROM products $category_filter");
    if ($category_id) $total_products_stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $total_products_stmt->execute();
    $total_products = $total_products_stmt->fetchColumn();
    $total_pages = ceil($total_products / $products_per_page);

    // Truy vấn lấy sản phẩm cho trang hiện tại theo danh mục
    $stmt = $conn->prepare("SELECT * FROM products $category_filter LIMIT :limit OFFSET :offset");
    if ($category_id) $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->bindParam(':limit', $products_per_page, PDO::PARAM_INT);
    $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
    $stmt->execute();
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Lấy danh sách danh mục
    $categories_stmt = $conn->prepare("SELECT * FROM categories");
    $categories_stmt->execute();
    $categories = $categories_stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    echo "Lỗi kết nối: " . $e->getMessage();
    die();
}
