<?php
namespace App\Models;

use PDO;

class CategoryModel {
    private $db;

    public function __construct() {
        $this->db = (new \Database())->connect();
    }

    public function getAllCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->db->query($query);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
