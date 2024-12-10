<?php
namespace App\Models;

use PDO;
use Config\Database;  // Vẫn giữ lại việc sử dụng Database từ config

class AboutModel
{
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();  // Kết nối đến database
    }

    public function getAboutData()
    {
        $stmt = $this->db->query("SELECT * FROM about");
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
