
<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="container mt-5">
    <div class="alert alert-success text-center">
        <h2>Cảm ơn bạn đã đặt hàng!</h2>
        <p>Đơn hàng của bạn đã được ghi nhận. Chúng tôi sẽ liên hệ và giao hàng sớm nhất.</p>
    </div>
    <div class="text-center mb-4">
        <a href="<?= ROOT_URL ?>" class="btn btn-primary">Về trang chủ</a>
        <a href="<?= ROOT_URL ?>?ctl=my-orders" class="btn btn-success">Xem đơn hàng của tôi</a>
    </div>

    <?php
    // Lấy đơn hàng mới nhất của user
    if (isset($_SESSION['user'])) {
        $user_id = $_SESSION['user']['id'];
        $order = (new Order)->getByUser($user_id)[0] ?? null;
        if ($order) {
            $orderDetails = (new Order)->getOrderDetails($order['id']);
    ?>
    <div class="card mt-4">
        <div class="card-header bg-success text-white">
            <strong>Thông tin đơn hàng mới nhất (#<?= $order['id'] ?>)</strong>
        </div>
        <div class="card-body">
            <p><strong>Thời gian đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'] ?? $order['date'] ?? '')) ?></p>
            <p><strong>Trạng thái:</strong>
                <?php
                switch ($order['status']) {
                    case 1: echo '<span class="badge bg-warning text-dark">Chờ xử lý</span>'; break;
                    case 2: echo '<span class="badge bg-info text-dark">Đang giao</span>'; break;
                    case 3: echo '<span class="badge bg-success">Hoàn thành</span>'; break;
                    case 0: echo '<span class="badge bg-danger">Đã hủy</span>'; break;
                    default: echo '<span class="badge bg-secondary">Không xác định</span>';
                }
                ?>
            </p>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Ảnh</th>
                            <th>Tên sản phẩm</th>
                            <th>Giá</th>
                            <th>Số lượng</th>
                            <th>Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; foreach ($orderDetails as $item): $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; ?>
                        <tr>
                            <td><img src="<?= ROOT_URL . $item['image'] ?>" style="width:60px"></td>
                            <td><?= htmlspecialchars($item['name']) ?></td>
                            <td><?= number_format($item['price'], 0, ',', '.') ?> VNĐ</td>
                            <td><?= $item['quantity'] ?></td>
                            <td><?= number_format($subtotal, 0, ',', '.') ?> VNĐ</td>
                        </tr>
                        <?php endforeach; ?>
                        <tr>
                            <td colspan="4" class="text-end"><strong>Tổng tiền:</strong></td>
                            <td class="text-danger fw-bold"><?= number_format($total, 0, ',', '.') ?> VNĐ</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
        }
    }
    ?>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>