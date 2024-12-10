<?php
use App\Helpers\SessionHelper;

// Xác định đường dẫn chính xác
$databasePath = __DIR__ . '/../../../config/database.php';

// Kiểm tra file tồn tại trước khi require
if (file_exists($databasePath)) {
    require_once $databasePath;
} else {
    die("Tệp database.php không tồn tại tại: " . $databasePath);
}

// Kiểm tra nếu có từ khóa tìm kiếm
$searchTerm = '';
$searchResults = [];

if (isset($_GET['q']) && !empty($_GET['q']) && isset($conn)) {
    $searchTerm = $_GET['q'];

    try {
        // Truy vấn cơ sở dữ liệu
        $sql = "SELECT id, product_name, price, image_path FROM products WHERE product_name LIKE :searchTerm LIMIT 5";
        $stmt = $conn->prepare($sql);
        $stmt->execute(['searchTerm' => '%' . $searchTerm . '%']);
        $searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
        error_log("Lỗi truy vấn cơ sở dữ liệu: " . $e->getMessage());
    }
}

if (!isset($isLoggedIn)) {
    $isLoggedIn = false;
}
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <title>HMT Shop - Mua sắm trực tuyến</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="Mua sắm trực tuyến" name="keywords">
    <meta content="Trang web mua sắm trực tuyến tốt nhất" name="description">

    <!-- Favicon -->
    <link href="/public/img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="/public/lib/animate/animate.min.css" rel="stylesheet">
    <link href="/public/lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="/public/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Thanh trên cùng Bắt đầu -->
    <div class="container-fluid">
        <div class="row bg-secondary py-1 px-xl-5">
            <div class="col-lg-6 text-center text-lg-right">
                <div class="d-inline-flex align-items-center d-block d-lg-none">
                    <a href="cart.php" class="btn px-0 ml-2">
                        <i class="fas fa-shopping-cart text-dark"></i>
                        <span class="badge text-dark border border-dark rounded-circle"
                            style="padding-bottom: 2px;">0</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="/home" class="text-decoration-none">
                    <span class="h1 text-uppercase text-primary bg-dark px-2">HMT</span>
                    <span class="h1 text-uppercase text-dark bg-primary px-2 ml-n1">Shop</span>
                </a>
            </div>
            <div class="col-lg-4 col-6 text-left">
                <!-- Form tìm kiếm -->
                <form action="/search" method="GET" style="position: relative;" autocomplete="off">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" placeholder="Tìm kiếm sản phẩm..."
                            value="<?php echo htmlspecialchars($searchTerm ?? ''); ?>" required>
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-lg-4 col-6 text-right">
                <p class="m-0">Hỗ trợ khách hàng</p>
                <h5 class="m-0">0774901624</h5>
            </div>
        </div>
    </div>
    <!-- Thanh trên cùng Kết thúc -->

    <!-- Thanh điều hướng Bắt đầu -->
    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="/" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">HMT</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">Shop</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav mr-auto py-0">
                            <a href="/" class="nav-item nav-link active">Trang chủ</a>
                            <a href="/shop" class="nav-item nav-link">Cửa hàng</a>
                            <a href="/contact" class="nav-item nav-link">Liên hệ</a>
                            <a href="/about" class="nav-item nav-link">Về chúng tôi</a>
                            <a href="/blog" class="nav-item nav-link">Bài viết</a>
                        </div>
                        <div class="navbar-nav ml-auto py-0 d-none d-lg-block">
                            <a href="/favorite_products.php" class="btn px-0">
                                <i class="fas fa-heart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">0</span>
                            </a>
                            <a href="/cart" class="btn px-0 ml-3">
                                <i class="fas fa-shopping-cart text-primary"></i>
                                <span class="badge text-secondary border border-secondary rounded-circle"
                                    style="padding-bottom: 2px;">0</span>
                            </a>
                            <?php if ($isLoggedIn): ?>
                                <span class="user-login text-white px-0 ml-3">
                                    Xin chào, <?php echo htmlspecialchars($user['full_name']); ?>
                                </span>
                                <a href="/logout" class="btn btn-outline-light btn-sm ml-2">Đăng xuất</a>
                            <?php else: ?>
                                <a href="/login" class="user-login text-white px-0 ml-3">
                                    <i class="fas fa-user text-primary"></i> Đăng nhập
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>
    <!-- Thanh điều hướng Kết thúc -->

</body>

</html>
