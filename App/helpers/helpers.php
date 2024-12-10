<?php

function render($view, $data = []) {
    // Chuyển dữ liệu từ mảng `$data` thành biến
    extract($data);

    // Đường dẫn tới file View
    $viewPath = __DIR__ . '/../Views/' . $view . '.php';
    if (!file_exists($viewPath)) {
        throw new Exception("View file not found: $viewPath");
    }

    // Bắt đầu output buffering
    ob_start();

    // Gắn nội dung của file View
    require $viewPath;

    // Lấy nội dung đã render
    $content = ob_get_clean();

    // Kết hợp với header và footer
    require __DIR__ . '/../Views/partials/header.php';
    echo $content;
    require __DIR__ . '/../Views/partials/footer.php';
}
