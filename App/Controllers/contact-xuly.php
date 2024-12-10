<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : '';
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $subject = isset($_POST['subject']) ? htmlspecialchars(trim($_POST['subject'])) : '';
    $message = isset($_POST['message']) ? htmlspecialchars(trim($_POST['message'])) : '';

    if (empty($name) || empty($email) || empty($subject) || empty($message)) {
        echo "Vui lòng điền đầy đủ thông tin.";
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Địa chỉ email không hợp lệ.";
        exit;
    }

    $mail = new PHPMailer(true);
    try {
        // Bật chế độ debug
        $mail->SMTPDebug = 2;
        $mail->Debugoutput = 'html';

        // Cấu hình SMTP cho Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'thanhxinhtraizz@gmail.com'; // Địa chỉ Gmail của bạn
        $mail->Password = 'your_application_password'; // Mật khẩu ứng dụng hoặc mật khẩu Gmail của bạn
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Người nhận và nội dung email
        $mail->setFrom($email, $name);
        $mail->addAddress('thanhxinhtraizz@gmail.com'); // Địa chỉ Gmail nhận email
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = nl2br($message);

        $mail->send();
        echo "Cảm ơn bạn đã liên hệ! Chúng tôi sẽ phản hồi trong thời gian sớm nhất.";
    } catch (Exception $e) {
        echo "Đã xảy ra lỗi trong quá trình gửi tin nhắn. Lỗi: {$mail->ErrorInfo}";
    }
} else {
    echo "Yêu cầu không hợp lệ.";
}
