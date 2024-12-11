<?php
namespace App\Controllers;
error_reporting(0);
use App\Models\OrderModel;
use App\Models\ProductModel;

class CheckoutSuccessController {
    public function index() {
        // Debug: Kiểm tra session ngay từ đầu
        session_start();
        
        // Log thông tin session để kiểm tra
        error_log("Session trong CheckoutSuccessController: " . print_r($_SESSION, true));
        
        // Kiểm tra xác thực người dùng
        
        // Các xử lý tiếp theo
        $this->processCheckoutSuccess();
    }
    
  
    
    
    private function processCheckoutSuccess() {
        // // Kiểm tra session sản phẩm
        // if (!isset($_SESSION['products']) || empty($_SESSION['products'])) {
        //     error_log("Không có sản phẩm trong session");
        //     header("Location: /cart");
        //     exit();
        // }
        
        // Lấy thông tin sản phẩm
        $products = $_SESSION['products'];
        
        // Tính tổng tiền
        $total = $this->calculateTotal($products);
        
        // Render view
        $this->renderView($products, $total);
    }
    
    private function calculateTotal($products) {
        $total = 0;
        foreach ($products as $product) {
            $total += $product['price'] * $product['quantity'];
        }
        return $total;
    }
    
    private function renderView($products, $total) {
        // Truyền dữ liệu vào view
        $viewData = [
            'products' => $products,
            'total' => $total
        ];
        
        // Render view checkout success
        require __DIR__ . '/../Views/Client/checkout-success.php';
    }
}