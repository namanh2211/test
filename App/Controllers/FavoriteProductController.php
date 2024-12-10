<?php
session_start();
require_once 'database.php'; // Kết nối cơ sở dữ liệu

class FavoriteProductsController {

    // Thêm sản phẩm vào danh sách yêu thích
    public static function addProduct($product_id, $user_id) {
        global $pdo;
        
        // Kiểm tra xem sản phẩm đã tồn tại trong danh sách yêu thích của người dùng chưa
        $sql_check = "SELECT * FROM favorite_products WHERE user_id = ? AND product_id = ?";
        $stmt_check = $pdo->prepare($sql_check);
        $stmt_check->execute([$user_id, $product_id]);
        $existing_product = $stmt_check->fetch();
        
        if (!$existing_product) {
            // Nếu chưa tồn tại, thêm sản phẩm vào danh sách yêu thích
            $sql_add = "INSERT INTO favorite_products (user_id, product_id) VALUES (?, ?)";
            $stmt_add = $pdo->prepare($sql_add);
            $stmt_add->execute([$user_id, $product_id]);
        }
    }

    // Xóa sản phẩm khỏi danh sách yêu thích
    public static function removeProduct($favorite_id) {
        global $pdo;

        // Xóa sản phẩm khỏi danh sách yêu thích
        $sql_remove = "DELETE FROM favorite_products WHERE id = ?";
        $stmt_remove = $pdo->prepare($sql_remove);
        $stmt_remove->execute([$favorite_id]);
    }

    // Lấy danh sách sản phẩm yêu thích của người dùng
    public static function getFavoriteProducts($user_id) {
        global $pdo;

        // Lấy thông tin sản phẩm yêu thích của người dùng từ cơ sở dữ liệu
        $sql = "SELECT fp.id, fp.product_name, fp.product_price, fp.image_path, fp.product_id
                FROM favorite_products fp
                WHERE fp.user_id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$user_id]);
        return $stmt->fetchAll();
    }
}

?>
