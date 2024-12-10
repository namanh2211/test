<?php
// Hiển thị dữ liệu GET để kiểm tra
var_dump($_GET);

// Dừng script để kiểm tra nếu cần
if (empty($_GET)) {
    echo "No GET data received.";
    exit;
}

// Khởi động session nếu chưa tồn tại
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Kết nối cơ sở dữ liệu
include 'database.php'; 

// Kiểm tra nếu người dùng chưa đăng nhập
if (!isset($_SESSION['user'])) {
    $_SESSION['error_message'] = "Please log in to add products to your cart.";
    header('Location: login.php');
    exit;
}

// Xử lý hành động theo action trong URL
if (isset($_GET['action'])) {
    $action = $_GET['action'];

    if ($action === 'remove' && isset($_GET['key'])) {
        // Xóa sản phẩm khỏi giỏ hàng
        $key = intval($_GET['key']);
        if (isset($_SESSION['cart'][$key])) {
            unset($_SESSION['cart'][$key]); // Xóa sản phẩm khỏi session giỏ hàng
            $_SESSION['cart'] = array_values($_SESSION['cart']); // Sắp xếp lại chỉ số mảng
        }
        header('Location: cart.php'); // Quay lại trang giỏ hàng
        exit;
    }
}

// Kiểm tra đủ dữ liệu từ URL để thêm sản phẩm vào giỏ hàng
if (isset($_GET['product_id'], $_GET['selected_size'], $_GET['quantity'])) {
    $product_id = intval($_GET['product_id']);
    $selected_size = htmlspecialchars(trim($_GET['selected_size']));
    $quantity = intval($_GET['quantity']);

    // Kiểm tra giá trị quantity
    if ($quantity <= 0) {
        echo "Invalid quantity.";
        exit;
    }

    // Lấy thông tin sản phẩm từ cơ sở dữ liệu
    $query = "SELECT * FROM products WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $product_id, PDO::PARAM_INT);
    $stmt->execute();
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    // Nếu sản phẩm tồn tại
    if ($product) {
        // Khởi tạo giỏ hàng nếu chưa tồn tại
        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        // Tạo item cho giỏ hàng
        $cart_item = [
            'id' => $product['id'],
            'name' => $product['product_name'],
            'price' => $product['price'],
            'size' => $selected_size,
            'quantity' => $quantity,
            'image' => $product['image_path']
        ];

        // Kiểm tra xem sản phẩm đã tồn tại trong giỏ hàng chưa
        $exists = false;
        foreach ($_SESSION['cart'] as &$item) {
            if ($item['id'] == $product_id && $item['size'] == $selected_size) {
                // Nếu tồn tại, cộng số lượng
                $item['quantity'] += $quantity;
                $exists = true;
                break;
            }
        }

        // Nếu chưa tồn tại, thêm sản phẩm mới vào giỏ hàng
        if (!$exists) {
            $_SESSION['cart'][] = $cart_item;
        }

        // Điều hướng đến trang giỏ hàng
        header('Location: cart.php');
        exit;
    } else {
        // Nếu sản phẩm không tồn tại
        echo "Product does not exist.";
        exit;
    }
} else {
    // Thông báo lỗi nếu thiếu dữ liệu
    echo "Invalid data. Missing product_id, selected_size, or quantity.";
    exit;
}
?>
