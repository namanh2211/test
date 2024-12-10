<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/./public/css/style_admin.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>

<body>

    <div class="d-flex">

        <?php
        include 'sidebar.php';
        ?>

        <!-- Content -->
        <div class="flex-grow-1 p-4" id="content">

            <!-- Hiển thị thông báo thành công -->
            <?php if (!empty($_SESSION['success_message'])): ?>
                <div class="alert alert-success">
                    <?= $_SESSION['success_message'] ?>
                </div>
                <?php unset($_SESSION['success_message']); ?>
            <?php endif; ?>

            <!-- Navbar -->
            <div class="d-flex justify-content-between align-items-center">
                <h2>THỐNG KÊ</h2>
                <div>
                    <a href="/admin" class="me-3 text-decoration-none">Trang chủ</a>
                    <a href="#" class="text-decoration-none">Library</a>
                    <!-- Nút trở về Client -->
                    <a href="/home" class="btn btn-outline-secondary ms-3">Về Trang Client</a>
                </div>
                <div class="avatar bg-warning rounded-circle"></div>
            </div>


            <!-- Stats Cards -->
            <div class="row mt-4">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body text-center">
                            <h5><i class="bi bi-people-fill"></i> <?= $stats['users'] ?></h5>
                            <p>Người dùng</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body text-center">
                            <h5><i class="bi bi-list-ul"></i> <?= $stats['categories'] ?></h5>
                            <p>Loại sản phẩm</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body text-center">
                            <h5><i class="bi bi-cup"></i> <?= $stats['products'] ?></h5>
                            <p>Sản phẩm</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-danger text-white">
                        <div class="card-body text-center">
                            <h5><i class="bi bi-chat-dots"></i> <?= $stats['orders'] ?></h5>
                            <p>Đơn hàng</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-5">
                <div class="row">
                    <!-- Biểu đồ tròn -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5>Thống kê sản phẩm theo loại</h5>
                                <canvas id="pieChart" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>

                    <!-- Biểu đồ cột -->
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5>5 sản phẩm được mua nhiều nhất</h5>
                                <canvas id="barChart" width="400" height="400"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                // Biểu đồ tròn
                var ctx = document.getElementById('pieChart').getContext('2d');
                var pieChart = new Chart(ctx, {
                    type: 'pie',
                    data: {
                        labels: ['Áo khoác', 'Quần jeans', 'Giày dép', 'Phụ kiện'],
                        datasets: [{
                            label: 'Sản phẩm theo loại',
                            data: [20, 30, 40, 10],
                            backgroundColor: ['#FF5733', '#33FF57', '#3357FF', '#F1C40F'],
                            borderColor: ['#ffffff', '#ffffff', '#ffffff', '#ffffff'],
                            borderWidth: 2
                        }]
                    }
                });

                // Biểu đồ cột
                var ctxBar = document.getElementById('barChart').getContext('2d');
                var barChart = new Chart(ctxBar, {
                    type: 'bar',
                    data: {
                        labels: ['Áo khoác', 'Quần jeans', 'Giày thể thao', 'Áo thun', 'Váy'],
                        datasets: [{
                            label: 'Sản phẩm được mua nhiều nhất',
                            data: [15, 25, 30, 20, 18],
                            backgroundColor: '#3498db',
                            borderColor: '#2980b9',
                            borderWidth: 1
                        }]
                    },
                    options: {
                        scales: {
                            y: {
                                beginAtZero: true
                            }
                        }
                    }
                });
            </script>
</body>

</html>