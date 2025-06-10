
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
                    <th>Hành động</th>
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
                                    case 0:
                                        echo '<span class="badge bg-secondary">Chờ xác nhận</span>';
                                        break;
                                    case 1:
                                        echo '<span class="badge bg-warning text-dark">Đang xử lý</span>';
                                        break;
                                    case 2:
                                        echo '<span class="badge bg-info text-dark">Đang giao</span>';
                                        break;
                                    case 3:
                                        echo '<span class="badge bg-success">Hoàn thành</span>';
                                        break;
                                    default:
                                        echo '<span class="badge bg-secondary">Không xác định</span>';
                                }
                                ?>
                            </td>
                            <td class="text-danger fw-bold"><?= number_format($order['total_price'], 0, ',', '.') ?> VNĐ</td>
                            <td class="text-center">
    <a href="<?= ROOT_URL ?>?ctl=order-detail&id=<?= $order['id'] ?>" class="btn btn-outline-primary btn-sm mb-1 rounded-pill px-3">
        <i class="bi bi-eye"></i> Xem chi tiết
    </a>
    <?php if ($order['status'] == 2): ?>
        <form method="post" action="<?= ROOT_URL ?>?ctl=confirm-order" class="d-inline">
            <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
            <button type="submit" class="btn btn-success btn-sm mb-1 rounded-pill px-3"
                onclick="return confirm('Bạn chắc chắn đã nhận được hàng?')">
                <i class="bi bi-check-circle"></i> Xác nhận nhận hàng
            </button>
        </form>
    <?php endif; ?>
</td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>