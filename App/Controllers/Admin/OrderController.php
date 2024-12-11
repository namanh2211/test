<?php

namespace App\Controllers\Admin;

use App\Models\Admin\OrderModel;

class OrderController {


    // Hiển thị danh sách đơn hàng
    public function listOder(){

        // Khởi tạo session
        session_start();

        // Gọi Model để lấy danh sách đơn hàng
        $orderModel = new OrderModel();
        $orders = $orderModel->getAllOrder(); // Giả sử hàm getAllOrders() trả về danh sách đơn hàng

        // Truyền dữ liệu qua View
        require_once __DIR__ . '/../../Views/Admin/list_order.php';

    }

    
}