<?php 
namespace App\Controllers;

use App\Models\ProductModel;

class SearchController
{
    public function index()
    {
        $searchTerm = $_GET['q'] ?? '';
        $searchResults = [];

        if (!empty($searchTerm)) {
            $productModel = new ProductModel();
            $searchResults = $productModel->searchProducts($searchTerm);
        }

        // Debug để kiểm tra dữ liệu
        var_dump($searchResults);

        // Gửi dữ liệu đến view
        require __DIR__ . '/../Views/Client/search.php';
    }
}
