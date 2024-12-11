<?php

namespace App\Models\Admin;

use Config\Database;

class OrderModel
{

    private $db;

    public function __construct()
    {
        // Kết nối cơ sở dữ liệu thông qua Database config
        $this->db = (new Database())->connect();   // Giả sử Database::getConnection() trả về đối tượng PDO
    }

    public function getAllOrder()
    {
        try {
            $query = "SELECT * FROM orders";
            $stmt = $this->db->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(\PDO::FETCH_ASSOC);
        } catch (\PDOException $e) {
            die("Query failed: " . $e->getMessage());
        }
    }
}
