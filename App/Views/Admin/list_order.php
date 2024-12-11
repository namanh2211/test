<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Thanh Toán</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/./public/css/style_admin.css">
</head>

<body>
    <div class="d-flex">
        <?php include 'sidebar.php'; ?>

        <div class="flex-grow-1 p-4" id="content">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2>QUẢN LÝ ĐƠN HÀNG</h2>
                <div>
                    <a href="#" class="me-3 text-decoration-none">Trang chủ</a>
                    <span> > Danh sách đơn hàng</span>
                </div>
                <div class="avatar bg-warning rounded-circle" style="width: 40px; height: 40px;"></div>
            </div>

            <div class="card mb-4">
                <div class="card-body">
                    <h5>Danh sách đơn hàng</h5>
                    <table class="table table-bordered mt-3">
                        <thead class="table-light">
                            <tr>
                                <th>STT</th>
                                <th>ID Đơn Hàng</th>
                                <th>ID Người Dùng</th>
                                <th>Ngày Đặt Hàng</th>
                                <th>Tổng Số Tiền</th>
                                <th>Địa Chỉ Giao Hàng</th>
                                <th>Trạng Thái Đơn Hàng</th>
                                <th>Hành Động</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $stt = 1; // Khởi tạo biến đếm STT
                            foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= $stt++ ?></td> <!-- Hiển thị STT và tăng biến đếm -->
                                    <td><?= $order['id'] ?></td>
                                    <td><?= $order['user_id'] ?></td>
                                    <td><?= $order['order_date'] ?></td>
                                    <td><?= number_format($order['total_amount'], 0, ',', '.') ?> VND</td>
                                    <td><?= $order['address'] ?></td>
                                    <td>
                                        <?php
                                        // Hiển thị trạng thái tiếng Việt
                                        switch ($order['status']) {
                                            case 'Pending':
                                                echo 'Đang chờ xử lý';
                                                break;
                                            case 'Completed':
                                                echo 'Đã hoàn thành';
                                                break;
                                            case 'Cancelled':
                                                echo 'Đã hủy';
                                                break;
                                            default:
                                                echo 'Không xác định';
                                                break;
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="./view_order.php?id=<?= $order['id'] ?>" class="btn btn-info btn-sm">Xem chi tiết</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>