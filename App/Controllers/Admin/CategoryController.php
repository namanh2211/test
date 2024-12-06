<?php

namespace App\Controllers\Admin;

use App\Models\Admin\CategoryModel;

class CategoryController
{
    // Hiển thị danh sách danh mục
    public function listCategory() {
        // Khởi tạo session
        session_start();
        // Kết nối và lấy danh sách danh mục
        $categoryModel = new CategoryModel();
        $categories = $categoryModel->getAllCategories();
    
        // Truyền danh sách danh mục vào view
        include __DIR__ . '/../../Views/Admin/list_category.php';
    }
    
    // Phương thức hiển thị form thêm danh mục
    public function addCategory() {
        // Khởi tạo session
        session_start();
    
        // Kiểm tra nếu là yêu cầu POST
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $category_name = $_POST['category_name'] ?? '';
            $description = $_POST['description'] ?? '';
    
            // Biến lưu lỗi
            $errors = [];
            $old_data = [
                'category_name' => $category_name,
                'description' => $description,
            ];
    
            // Kiểm tra dữ liệu nhập vào
            if (empty($category_name)) {
                $errors['category_name'] = 'Tên danh mục không được để trống.';
            }
            if (empty($description)) {
                $errors['description'] = 'Mô tả danh mục không được để trống.';
            }
    
            // Nếu có lỗi, quay lại form và hiển thị lỗi
            if (!empty($errors)) {
                // Lưu lỗi và dữ liệu cũ vào session
                $_SESSION['errors'] = $errors;
                $_SESSION['old_data'] = $old_data;
    
                // Chuyển hướng lại trang thêm danh mục
                header('Location: /add-category');
                exit();
            }
    
            // Nếu không có lỗi, thực hiện thêm danh mục vào cơ sở dữ liệu
            $categoryModel = new CategoryModel();
            if ($categoryModel->addCategory($category_name, $description)) {
                // Lưu thông báo thành công vào session
                $_SESSION['success_message'] = 'Thêm danh mục thành công.';
    
                // Chuyển hướng đến trang danh sách danh mục
                header('Location: /list-category');
                exit();
            }
        }
    
        // Hiển thị form nếu là yêu cầu GET
        include __DIR__ . '/../../Views/Admin/add_category.php';
    }

    public function editCategory($id)
    {
        session_start();

        $categoryModel = new CategoryModel();
        $category = $categoryModel->getCategoryById($id);

        if (!$category) {
            $_SESSION['error_message'] = 'Danh mục không tồn tại.';
            header('Location: /list-category');
            exit();
        }

        // Lấy lỗi và dữ liệu cũ từ session (nếu có)
        $errors = $_SESSION['errors'] ?? [];
        $old_data = $_SESSION['old_data'] ?? $category;

        unset($_SESSION['errors'], $_SESSION['old_data']);

        // Hiển thị form edit
        include __DIR__ . '/../../Views/Admin/edit_category.php';
    }

    public function updateCategory()
    {
        session_start();

        $id = $_POST['id'] ?? null;
        $category_name = trim($_POST['category_name'] ?? '');
        $description = trim($_POST['description'] ?? '');

        $errors = [];

        // Validate input
        if (empty($category_name)) {
            $errors['category_name'] = 'Tên danh mục không được để trống.';
        }

        if (empty($description)) {
            $errors['description'] = 'Mô tả không được để trống.';
        }

        if (!empty($errors)) {
            // Lưu lỗi và dữ liệu cũ vào session
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $_POST;

            header("Location: /edit-category?id=$id");
            exit();
        }

        // Nếu không có lỗi, cập nhật danh mục
        $categoryModel = new CategoryModel();
        $categoryModel->updateCategory($id, $category_name, $description);

        // Lưu thông báo thành công vào session và chuyển hướng
        $_SESSION['success_message'] = 'Cập nhật danh mục thành công.';
        header('Location: /list-category');
        exit();
    }
    
    public function deleteCategory() {
        session_start();
    
        // Lấy ID từ URL
        $id = $_GET['id'] ?? null;
    
        if ($id) {
            // Tạo đối tượng CategoryModel và gọi phương thức delete
            $categoryModel = new CategoryModel();
            
            if ($categoryModel->deleteCategoryById($id)) {
                $_SESSION['success_message'] = 'Xóa danh mục thành công!';
            }
        }
    
        header('Location: /list-category');
        exit;
    }
    
    
    
}
