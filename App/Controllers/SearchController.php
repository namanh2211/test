<?php

namespace App\Controllers;

use App\Models\ProductModel;

class SearchController
{
    public function search()
    {
        // Khởi tạo đối tượng ProductModel
        $productModel = new ProductModel();

        // Lấy từ khóa tìm kiếm từ GET request
        $searchTerm = $_GET['q'] ?? '';

        // Kiểm tra nếu có từ khóa tìm kiếm
        if ($searchTerm) {
            // Gọi hàm tìm kiếm từ model
            $searchResults = $productModel->searchProducts($searchTerm);
        } else {
            // Nếu không có từ khóa tìm kiếm, không có kết quả
            $searchResults = [];
        }

        // Truyền kết quả tìm kiếm vào view
        include __DIR__ . '/../Views/Client/search.php';
    }
}
