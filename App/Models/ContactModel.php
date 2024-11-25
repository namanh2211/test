<?php 
namespace App\Models;

use PDO;
use Config\Database;

class ContactModel
{
    private $db;

    public function __construct() {
        $this->db = (new Database())->connect();  // Sử dụng lớp Database đã được import
    }


    public function saveContact($name, $email, $subject, $message)
    {
        $sql = "INSERT INTO contacts (name, email, subject, message, created_at) VALUES (:name, :email, :subject, :message, NOW())";
        $stmt = $this->db->prepare($sql);

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':subject', $subject);
        $stmt->bindParam(':message', $message);

        return $stmt->execute();
    }
}
