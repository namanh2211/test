<?php

namespace App\Models;

use PDO;

class ProductModel {
    private $db;

    public function __construct() {
        $this->db = (new \Database())->connect();
    }

    // Lấy sản phẩm nổi bật
    public function getFeaturedProducts() {
        $query = "SELECT * FROM products WHERE is_featured = 1 LIMIT 5";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy sản phẩm theo danh mục và phân trang
    public function getProductsByCategory($category_id = null, $page = 1, $items_per_page = 9) {
        $offset = ($page - 1) * $items_per_page;
        $query = "SELECT * FROM products";

        if ($category_id) {
            $query .= " WHERE category_id = :category_id";
        }

        $query .= " LIMIT :offset, :items_per_page";
        $stmt = $this->db->prepare($query);

        if ($category_id) {
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        }
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':items_per_page', $items_per_page, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy tổng số sản phẩm theo danh mục
    public function getTotalProducts($category_id = null) {
        $query = "SELECT COUNT(*) as total FROM products";

        if ($category_id) {
            $query .= " WHERE category_id = :category_id";
        }

        $stmt = $this->db->prepare($query);

        if ($category_id) {
            $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        }

        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['total'];
    }

    // Lấy thông tin chi tiết sản phẩm theo ID
    public function getProductById($product_id) {
        $query = "SELECT * FROM products WHERE id = :product_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':product_id', $product_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Tìm kiếm sản phẩm theo từ khóa
    public function searchProducts($keyword, $page = 1, $items_per_page = 9) {
        $offset = ($page - 1) * $items_per_page;
        $query = "SELECT * FROM products WHERE product_name LIKE :keyword LIMIT :offset, :items_per_page";
        $stmt = $this->db->prepare($query);

        $like_keyword = '%' . $keyword . '%';
        $stmt->bindParam(':keyword', $like_keyword, PDO::PARAM_STR);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
        $stmt->bindParam(':items_per_page', $items_per_page, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy các sản phẩm cùng loại (products from the same category)
    public function getRelatedProducts($category_id, $exclude_product_id, $limit = 4) {
        $query = "SELECT * FROM products WHERE category_id = :category_id AND id != :exclude_product_id LIMIT :limit";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
        $stmt->bindParam(':exclude_product_id', $exclude_product_id, PDO::PARAM_INT);
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
