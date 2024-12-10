<?php 
namespace App\Controllers;

use App\Models\ProductModel;

class SearchController
{
    public function search() {
        // Khởi tạo đối tượng ProductModel
        $productModel = new ProductModel();
        
        // Lấy từ khóa tìm kiếm từ GET request
        $searchTerm = isset($_GET['q']) ? $_GET['q'] : '';
    
        // Kiểm tra giá trị searchTerm
        var_dump($searchTerm);
        
        // Nếu có từ khóa tìm kiếm, tìm kiếm trong cơ sở dữ liệu
        if ($searchTerm) {
            // Gọi hàm tìm kiếm từ model
            $searchResults = $productModel->searchProducts($searchTerm);
        } else {
            // Nếu không có từ khóa tìm kiếm, không có kết quả
            $searchResults = [];
        }
    
        // Truyền kết quả tìm kiếm vào view
        require __DIR__ . '/../Views/Client/search.php';
    }
    
}
