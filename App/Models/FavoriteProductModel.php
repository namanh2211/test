<?php

namespace App\Models;

use PDO;
use Config\Database;

class FavoriteProductModel
{
    private $db;

    public function __construct()
    {
        $this->db = (new Database())->connect();
    }

    // Lấy danh sách sản phẩm yêu thích theo user_id
    public function getFavoriteProductsByUserId($userId)
    {
        $sql = "SELECT * FROM favorite_products WHERE user_id = :user_id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC); // Trả về danh sách sản phẩm yêu thích
    }

    // Thêm sản phẩm vào danh sách yêu thích
    // Thêm sản phẩm vào danh sách yêu thích
// Thêm sản phẩm vào danh sách yêu thích
public function addToFavorites($userId, $productId)
{
    // Lấy thông tin sản phẩm từ bảng products
    $sql = "SELECT product_name, price, image_path FROM products WHERE id = :product_id";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([':product_id' => $productId]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Thêm sản phẩm vào danh sách yêu thích
        $sql = "INSERT INTO favorite_products (user_id, product_id, name, price, image_path) VALUES (:user_id, :product_id, :name, :price, :image_path)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':user_id' => $userId,
            ':product_id' => $productId,
            ':name' => $product['product_name'],
            ':price' => $product['price'],
            ':image_path' => $product['image_path']
        ]);
    }
}

    // Xóa sản phẩm khỏi danh sách yêu thích
    public function removeFromFavorites($userId, $productId)
    {
        $sql = "DELETE FROM favorite_products WHERE user_id = :user_id AND product_id = :product_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->bindParam(':product_id', $productId, PDO::PARAM_INT);
        $stmt->execute();
    }
}