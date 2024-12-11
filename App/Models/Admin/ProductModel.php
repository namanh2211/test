<?php

namespace App\Models\Admin;

use Config\Database;


class ProductModel
{
    private $db;

    public function __construct()
    {
        // Kết nối cơ sở dữ liệu thông qua Database config
        $this->db = (new Database())->connect();   // Giả sử Database::getConnection() trả về đối tượng PDO
    }

    public function getAllProducts()
    {
        $sql = "SELECT 
                products.id, 
                products.product_name, 
                products.description, 
                products.price, 
                products.stock_quantity, 
                products.image_path, 
                products.created_at, 
                categories.category_name AS category_name 
            FROM products
            INNER JOIN categories ON products.category_id = categories.id";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);  // Trả về kết quả dưới dạng mảng liên kết
    }

    // Tìm kiếm sản phẩm theo tên
    public function searchProductsByName($productName)
    {
        $sql = "SELECT 
                    products.id, 
                    products.product_name, 
                    products.description, 
                    products.price, 
                    products.stock_quantity, 
                    products.image_path, 
                    products.created_at, 
                    categories.category_name AS category_name 
                FROM products
                INNER JOIN categories ON products.category_id = categories.id
                WHERE products.product_name LIKE :product_name";

        $stmt = $this->db->prepare($sql);
        $stmt->bindValue(':product_name', '%' . $productName . '%', \PDO::PARAM_STR);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    public function deleteProduct($id)
    {
        $stmt = $this->db->prepare("DELETE FROM products WHERE id = :id");
        $stmt->bindParam(':id', $id, \PDO::PARAM_INT);
        return $stmt->execute();
    }

    // Phương thức thêm sản phẩm
    public function addProduct($data)
    {
        $sql = "INSERT INTO products (product_name, description, category_id, price, stock_quantity, size, brand, is_featured, image_path)
                VALUES (:product_name, :description, :category_id, :price, :stock_quantity, :size, :brand, :is_featured, :image_path)";

        $stmt = $this->db->prepare($sql);
        $stmt->execute([
            ':product_name' => $data['product_name'],
            ':description' => $data['description'],
            ':category_id' => $data['category_id'],
            ':price' => $data['price'],
            ':stock_quantity' => $data['stock_quantity'],
            ':size' => $data['size'],
            ':brand' => $data['brand'],
            ':is_featured' => $data['is_featured'],
            ':image_path' => $data['image_path']
        ]);
    }

    // Phương thức cập nhật sản phẩm
    public function updateProduct($id, $product_name, $category_id, $description, $price, $stock_quantity, $size, $brand,$is_featured, $image_path)
    {
        // Kiểm tra nếu không có hình ảnh mới, giữ lại hình ảnh cũ
        if (empty($image_path)) {
            // Giữ lại hình ảnh cũ nếu không có hình ảnh mới
            $image_path = $_POST['old_image_path']; // Giả sử hình ảnh cũ được lưu trong POST
        }

        // Câu truy vấn cập nhật sản phẩm
        $query = "UPDATE products 
              SET product_name = :product_name, 
                  category_id = :category_id, 
                  description = :description, 
                  price = :price, 
                  stock_quantity = :stock_quantity, 
                  size = :size, 
                  brand = :brand, 
                  is_featured = :is_featured,
                  image_path = :image_path 
              WHERE id = :id";

        // Chuẩn bị câu truy vấn
        $stmt = $this->db->prepare($query);

        // Liên kết các tham số
        $stmt->bindParam(':product_name', $product_name);
        $stmt->bindParam(':category_id', $category_id);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':stock_quantity', $stock_quantity);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':brand', $brand);
        $stmt->bindParam(':is_featured', $is_featured);
        $stmt->bindParam(':image_path', $image_path);
        $stmt->bindParam(':id', $id);

        // Thực thi câu truy vấn và trả về kết quả
        return $stmt->execute(); // Trả về true nếu cập nhật thành công, ngược lại false.
    }


    // Phương thức để lấy thông tin sản phẩm hiện tại từ database
    public function getProductById($id)
    {
        $query = "SELECT * FROM products WHERE id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();

        return $stmt->fetch(\PDO::FETCH_ASSOC); // Trả về thông tin sản phẩm
    }

    // Phương thức để lấy tất cả các danh mục
    public function getCategories()
    {
        $query = "SELECT * FROM categories";
        $stmt = $this->db->query($query);

        return $stmt->fetchAll(\PDO::FETCH_ASSOC); // Trả về danh sách các danh mục
    }
}
