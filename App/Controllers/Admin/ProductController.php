<?php

namespace App\Controllers\Admin;

use App\Models\Admin\CategoryModel;
use App\Models\Admin\ProductModel;


class ProductController
{

    public function listProducts()
    {
        // Khởi tạo session
        session_start();

        // Khởi tạo model và lấy danh sách người dùng
        $productModel = new ProductModel();
        $products = $productModel->getAllProducts();


        require_once __DIR__ . '/../../Views/Admin/list_product.php'; // Đường dẫn file view
    }

    public function searchProducts()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $productName = $_POST['product_name'] ?? '';
            $productModel = new ProductModel();
            $products = $productModel->searchProductsByName($productName);

            include __DIR__ . '/../../Views/Admin/list_product.php';
        }
    }

    public function deleteProduct()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $productModel = new ProductModel();
            $success = $productModel->deleteProduct($id);


            echo json_encode(['success' => $success]);
        } else {
            echo json_encode(['success' => false, 'message' => 'ID không hợp lệ']);
        }
    }


    public function addProduct()
    {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Lấy dữ liệu từ form
            $product_data = [
                'product_name' => $_POST['product_name'] ?? '',
                'description' => $_POST['description'] ?? '',
                'category_id' => $_POST['category_id'] ?? '',
                'price' => $_POST['price'] ?? '',
                'stock_quantity' => $_POST['stock_quantity'] ?? '',
                'size' => $_POST['size'] ?? '',
                'brand' => $_POST['brand'] ?? '',
                'is_featured' => isset($_POST['is_featured']) ? 1 : 0,
            ];

            $errors = [];

            // Kiểm tra hình ảnh
            if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
                $image = $_FILES['image_path'];
                $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

                if (!in_array($image['type'], $allowed_types)) {
                    $errors['image_path'] = "Chỉ cho phép các định dạng JPEG, PNG, GIF.";
                } else {
                    $target_dir = __DIR__ . '/../../../public/img/';
                    $target_file = $target_dir . basename($image['name']);

                    if (!move_uploaded_file($image['tmp_name'], $target_file)) {
                        $errors['image_path'] = "Không thể upload hình ảnh.";
                    } else {
                        $product_data['image_path'] = 'img/' . basename($image['name']); // Thêm image_path vào product_data
                    }
                }
            } else {
                $errors['image_path'] = "Hình ảnh không được để trống.";
            }

            // Kiểm tra các trường khác
            if (empty($product_data['product_name'])) {
                $errors['product_name'] = "Tên sản phẩm không được để trống.";
            }
            if (empty($product_data['description'])) {
                $errors['description'] = "Mô tả không được để trống.";
            }
            if (empty($product_data['category_id'])) {
                $errors['category_id'] = "Danh mục không được để trống.";
            }
            if (empty($product_data['price'])) {
                $errors['price'] = "Giá không được để trống.";
            } elseif ($product_data['price'] < 0) {
                $errors['price'] = "Giá phải lớn hơn hoặc bằng 0.";
            }
            if (empty($product_data['stock_quantity'])) {
                $errors['stock_quantity'] = "Số lượng không được để trống.";
            } elseif ($product_data['stock_quantity'] < 0) {
                $errors['stock_quantity'] = "Số lượng phải lớn hơn hoặc bằng 0.";
            }
            if (empty($product_data['size'])) {
                $errors['size'] = "Kích thước không được để trống.";
            }
            if (empty($product_data['brand'])) {
                $errors['brand'] = "Thương hiệu không được để trống.";
            }

            // Nếu có lỗi, lưu vào session và quay lại trang add_product
            if (!empty($errors)) {
                $_SESSION['errors'] = $errors;
                $_SESSION['old_data'] = $product_data;

                header("Location: /add-product");
                exit();
            }

            // Thêm sản phẩm nếu không có lỗi
            $model = new ProductModel();
            $model->addProduct($product_data);

            // Xóa session lỗi và chuyển hướng
            unset($_SESSION['errors'], $_SESSION['old_data']);


            $_SESSION['success_message'] = 'Thêm sản phẩm thành công.';
            header("Location: /list-product");
            exit();
        }

        // Lấy danh mục từ Model
        $model = new ProductModel();
        $categories = $model->getCategories();

        require_once __DIR__ . '/../../Views/Admin/add_product.php';
    }


    public function updateProduct()
{
    session_start();

    // Lấy ID sản phẩm từ URL (GET)
    $id = $_GET['id'] ?? null;

    // Kiểm tra nếu ID sản phẩm không tồn tại thì chuyển hướng về danh sách sản phẩm
    if (!$id) {
        header("Location: /list-product");
        exit();
    }

    // Tạo đối tượng ProductModel để lấy thông tin sản phẩm và danh mục
    $productModel = new ProductModel();
    $product = $productModel->getProductById($id);
    $categories = $productModel->getCategories();

    // Nếu sản phẩm không tồn tại, chuyển hướng về trang danh sách sản phẩm
    if (!$product) {
        header("Location: /list-product");
        exit();
    }

    // Nếu người dùng gửi form (POST), xử lý cập nhật
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Lấy dữ liệu từ POST
        $product_name = $_POST['product_name'] ?? '';
        $category_id = $_POST['category_id'] ?? '';
        $description = $_POST['description'] ?? '';
        $price = $_POST['price'] ?? '';
        $stock_quantity = $_POST['stock_quantity'] ?? '';
        $size = $_POST['size'] ?? '';
        $brand = $_POST['brand'] ?? '';
        $is_featured = isset($_POST['is_featured']) ? 1 : 0;
        $image_path = $_FILES['image_path']['name'] ?? ''; // Lấy tên file ảnh từ form

        // Validate dữ liệu
        $errors = [];
        if (empty($product_name)) {
            $errors['product_name'] = 'Tên sản phẩm không được để trống';
        }
        if (empty($category_id)) {
            $errors['category_id'] = 'Danh mục không được để trống';
        }
        if (empty($description)) {
            $errors['description'] = 'Mô tả sản phẩm không được để trống';
        }
        if (empty($price)) {
            $errors['price'] = 'Giá sản phẩm không được để trống';
        }
        if (empty($stock_quantity)) {
            $errors['stock_quantity'] = 'Số lượng sản phẩm không được để trống';
        }
        if (empty($brand)) {
            $errors['brand'] = 'Nhãn hàng không được để trống';
        }

        // Kiểm tra hình ảnh nếu có
        if (isset($_FILES['image_path']) && $_FILES['image_path']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image_path'];
            $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];

            // Kiểm tra loại hình ảnh
            if (!in_array($image['type'], $allowed_types)) {
                $errors['image_path'] = "Chỉ cho phép các định dạng JPEG, PNG, GIF.";
            } else {
                $target_dir = __DIR__ . '/../../../public/img/';
                $target_file = $target_dir . basename($image['name']);

                // Kiểm tra việc upload
                if (!move_uploaded_file($image['tmp_name'], $target_file)) {
                    $errors['image_path'] = "Không thể upload hình ảnh.";
                } else {
                    $image_path = 'img/' . basename($image['name']); // Cập nhật image_path
                }
            }
        } elseif (empty($image_path)) {
            // Nếu không có hình ảnh mới, giữ lại hình ảnh cũ
            $image_path = $product['image_path']; // Sử dụng hình ảnh cũ nếu không có ảnh mới
        } else {
            $errors['image_path'] = "Hình ảnh không được để trống.";
        }

        // Nếu có lỗi, quay lại form và hiển thị lỗi
        if (!empty($errors)) {
            $_SESSION['errors'] = $errors;
            $_SESSION['old_data'] = $_POST;
            header("Location: /update-product?id=$id");
            exit();
        }

        // Cập nhật sản phẩm trong cơ sở dữ liệu
        $updateSuccess = $productModel->updateProduct($id, $product_name, $category_id, $description, $price, $stock_quantity, $size, $brand, $is_featured, $image_path);

        // Chuyển hướng sau khi cập nhật thành công
        if ($updateSuccess) {
            $_SESSION['success_message'] = 'Cập nhật sản phẩm thành công';
            header('Location: /list-product');
        } else {
            $_SESSION['error_message'] = 'Cập nhật sản phẩm thất bại';
            header("Location: /update-product?id=$id");
        }
        exit();
    }

    // Hiển thị form cập nhật sản phẩm nếu là GET request
    require_once __DIR__ . '/../../Views/Admin/edit_product.php';
}

}
