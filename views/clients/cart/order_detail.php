<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<main class="container my-5">
    <h1 class="mb-4 text-center text-primary">Chi tiết đơn hàng #<?= $order['id'] ?></h1>
    <div class="mb-3">
        <strong>Thời gian đặt:</strong> <?= date('d/m/Y H:i', strtotime($order['created_at'] ?? $order['date'] ?? '')) ?><br>
        <strong>Trạng thái:</strong>
        <?php
        switch ($order['status']) {
            case 1: echo '<span class="badge bg-warning text-dark">Chờ xử lý</span>'; break;
            case 2: echo '<span class="badge bg-info text-dark">Đang giao</span>'; break;
            case 3: echo '<span class="badge bg-success">Hoàn thành</span>'; break;
            case 0: echo '<span class="badge bg-danger">Đã hủy</span>'; break;
            default: echo '<span class="badge bg-secondary">Không xác định</span>';
        }
        ?>
        <br>
        <strong>Phương thức thanh toán:</strong> <?= htmlspecialchars($order['payment_method']) ?>
    </div>
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
                    <td><img src="<?= ROOT_URL . $item['image'] ?>" alt="" style="width:60px;height:60px;object-fit:cover"></td>
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
    <a href="<?= ROOT_URL ?>?ctl=my-orders" class="btn btn-secondary">Quay lại danh sách</a>
</main>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>