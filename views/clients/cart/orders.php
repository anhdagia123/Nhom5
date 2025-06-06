
<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<main class="container my-5">
    <h1 class="mb-4 text-center text-primary">Đơn hàng của tôi</h1>
    <div class="table-responsive">
        <table class="table table-bordered align-middle">
            <thead class="table-light">
                <tr>
                    <th>Mã đơn</th>
                    <th>Tên đơn</th>
                    <th>Thời gian</th>
                    <th>Trạng thái</th>
                    <th>Tổng tiền</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($orders)): ?>
                    <tr>
                        <td colspan="6" class="text-center text-muted">Bạn chưa có đơn hàng nào.</td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($orders as $order): ?>
                        <?php
                        // Lấy tên sản phẩm đầu tiên trong đơn
                        $orderDetails = (new Order)->getOrderDetails($order['id']);
                        $firstProduct = $orderDetails[0]['name'] ?? 'Đơn hàng';
                        $more = count($orderDetails) > 1 ? ' và ' . (count($orderDetails) - 1) . ' sản phẩm khác' : '';
                        ?>
                        <tr>
                            <td>#<?= $order['id'] ?></td>
                            <td><?= htmlspecialchars($firstProduct . $more) ?></td>
                            <td><?= date('d/m/Y H:i', strtotime($order['created_at'] ?? $order['date'] ?? '')) ?></td>
                            <td>
                                <?php
                                switch ($order['status']) {
                                    case 1: echo '<span class="badge bg-warning text-dark">Chờ xử lý</span>'; break;
                                    case 2: echo '<span class="badge bg-info text-dark">Đang giao</span>'; break;
                                    case 3: echo '<span class="badge bg-success">Hoàn thành</span>'; break;
                                    case 0: echo '<span class="badge bg-danger">Đã hủy</span>'; break;
                                    default: echo '<span class="badge bg-secondary">Không xác định</span>';
                                }
                                ?>
                            </td>
                            <td class="text-danger fw-bold"><?= number_format($order['total_price'], 0, ',', '.') ?> VNĐ</td>
                            <td>
                                <a href="<?= ROOT_URL ?>?ctl=order-detail&id=<?= $order['id'] ?>" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>