<?php
namespace App\Models;

use PDO;

class BlogModel
{
    private $db;

    public function __construct()
    {
        $this->db = new PDO('mysql:host=localhost;dbname=duan1;charset=utf8', 'root', 'mysql');
    }

    public function getAllPosts()
    {
        $stmt = $this->db->query("SELECT id, title, summary, created_at FROM blog_posts ORDER BY created_at DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getPostById($id)
    {
        $stmt = $this->db->prepare("SELECT * FROM blog_posts WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
