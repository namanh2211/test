<?php 
// app/Helpers/view_helper.php
function view($view, $data = []) {
    extract($data);

    $file = __DIR__ . '/../views/' . str_replace('.', '/', $view) . '.php';

    // Debug: Kiểm tra xem đường dẫn tới view có chính xác không
    // var_dump($file);  // In ra đường dẫn tới file view

    if (file_exists($file)) {
        include $file;
    } else {
        die("View not found: " . $file);
    }
}
function render($render, $data = []) {
    extract($data);

    $file = __DIR__ . '/../views/' . str_replace('.', '/', $render) . '.php';

    // Debug: Kiểm tra xem đường dẫn tới view có chính xác không
    // var_dump($file);  // In ra đường dẫn tới file view

    if (file_exists($file)) {
        include $file;
    } else {
        die("View not found: " . $file);
    }
}
function renderView($viewName, $data = []) {
    // Extract data để biến mảng thành các biến trong view
    extract($data);

    // Tạo đường dẫn tuyệt đối đến view
    $viewPath = __DIR__ . '/../Views/' . $viewName . '.php';

    // Kiểm tra xem file view có tồn tại không
    if (file_exists($viewPath)) {
        require $viewPath;
    } else {
        http_response_code(404);
        echo "View not found: " . htmlspecialchars($viewName);
    }
}

