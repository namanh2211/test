<?php

namespace App\Controllers;

use App\Models\OrderModel; // Đảm bảo bạn đã import OrderModel
use PDO; // Import PDO nếu cần
session_start();
class PaymentController
{
    public $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
    public $partnerCode = 'MOMOBKUN20180529';
    public $accessKey = 'klm05TvNBzhg7h7j';
    public $secretKey = 'at67qH6mk8w5Y1nAyMoYKMWACiEi2bsa';
    public $redirectUrl = "http://127.0.0.1:8000/checkout-success";
    public $ipnUrl = "http://127.0.0.1:8000/checkout-success";

    public function processPayment()
    {
        // Kiểm tra dữ liệu POST từ form
        if (empty($_POST['amount'])) {
            echo "Số tiền không được để trống!";
            return;
        }

        // Lấy thông tin thanh toán từ $_POST, sử dụng giá trị mặc định nếu không có
        $partnerCode = $_POST['partnerCode'] ?? $this->partnerCode;
        $accessKey = $_POST['accessKey'] ?? $this->accessKey;
        $secretKey = $_POST['secretKey'] ?? $this->secretKey;
        $orderId = $_POST['orderId'] ?? time() . "";  // Nếu không có, dùng mã đơn hàng mới
        $orderInfo = $_POST['orderInfo'] ?? "Thanh toán qua MoMo";
        $amount = $_POST['amount'] ?? '10000';
        $ipnUrl = $_POST['ipnUrl'] ?? $this->ipnUrl;
        $redirectUrl = $_POST['redirectUrl'] ?? $this->redirectUrl;
        $extraData = $_POST['extraData'] ?? "";

        // Tạo mã signature để gửi tới MoMo
        $requestId = time() . "";
        $requestType = "payWithATM";

        // Tạo chuỗi hash trước khi mã hóa bằng HMAC SHA256
        $rawHash = "accessKey=" . $accessKey . "&amount=" . $amount . "&extraData=" . $extraData . "&ipnUrl=" . $ipnUrl . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&partnerCode=" . $partnerCode . "&redirectUrl=" . $redirectUrl . "&requestId=" . $requestId . "&requestType=" . $requestType;

        // Kiểm tra nếu secretKey hợp lệ
        if (!$secretKey) {
            echo "Secret key không hợp lệ!";
            return;
        }

        // Tính toán chữ ký HMAC SHA256
        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        // Chuẩn bị dữ liệu để gửi đến MoMo
        $data = array(
            'partnerCode' => $partnerCode,
            'partnerName' => "Test",
            "storeId" => "MomoTestStore",
            'requestId' => $requestId,
            'amount' => $amount,
            'orderId' => $orderId,
            'orderInfo' => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl' => $ipnUrl,
            'lang' => 'vi',
            'extraData' => $extraData,
            'requestType' => $requestType,
            'signature' => $signature
        );

        // Kiểm tra xem cú pháp JSON có hợp lệ hay không
        $dataJson = json_encode($data);
        if (json_last_error() !== JSON_ERROR_NONE) {
            echo "Lỗi JSON: " . json_last_error_msg();
            return;
        }

        // Gửi yêu cầu đến MoMo
        $result = $this->execPostRequest($this->endpoint, $dataJson);
        $jsonResult = json_decode($result, true);

        // Chuyển hướng người dùng đến URL thanh toán nếu có
        if (isset($jsonResult['payUrl'])) {
            // Lưu thông tin đơn hàng vào cơ sở dữ liệu
            $this->saveOrder($orderId, $amount, $orderInfo, $redirectUrl);
            header('Location:  ' . $jsonResult['payUrl']);
            exit();
        } else {
            echo "Lỗi: " . htmlspecialchars($jsonResult['message'] ?? 'Không rõ');
        }
    }

    public function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data)
            )
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }

    private function saveOrder($orderId, $amount, $orderInfo, $redirectUrl)
    {
        // Kết nối đến cơ sở dữ liệu
        try {
            $db = new PDO('mysql:host=localhost;dbname=duan1', 'root', 'mysql');
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Giả sử bạn đã có thông tin người dùng (user_id, address, status, v.v.)
            $userId = 1; // Thay thế bằng ID người dùng thực tế
            $address = "Địa chỉ giao hàng"; // Thay thế bằng địa chỉ thực tế
            $status = "Pending"; // Thay đổi trạng thái thành 'Pending'

            // Kiểm tra xem user_id có tồn tại trong bảng users không
            $stmt = $db->prepare("SELECT COUNT(*) FROM users WHERE id = :user_id");
            $stmt->execute(['user_id' => $userId]);
            $userExists = $stmt->fetchColumn();

            if ($userExists) {
                // Chuẩn bị câu lệnh SQL để chèn đơn hàng
                $stmt = $db->prepare("INSERT INTO orders (payment_id, user_id, order_date, status, total_amount, address) VALUES (:payment_id, :user_id, NOW(), :status, :total_amount, :address)");
                $stmt->execute([
                    'payment_id' => $orderId,
                    'user_id' => $userId,
                    'status' => $status, // Sử dụng giá trị 'Pending'
                    'total_amount' => $amount,
                    'address' => $address
                ]);
            } else {
                echo "Lỗi: Người dùng không tồn tại.";
            }
        } catch (PDOException $e) {
            echo "Lỗi lưu đơn hàng: " . $e->getMessage();
        }
    }
}

