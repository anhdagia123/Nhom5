
<?php include_once ROOT_DIR . "views/admin/header.php" ?>
<div class="container">
    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-bold text-primary">Chi tiết đơn hàng #<?= $order['id'] ?></h5>
        </div>
        <div class="card-body">
            <p><b>Khách hàng:</b> <?= htmlspecialchars($order['customer_name']) ?></p>
            <p><b>Email:</b> <?= htmlspecialchars($order['email']) ?></p>
            <p><b>Địa chỉ:</b> <?= htmlspecialchars($order['address']) ?></p>
            <p><b>Số điện thoại:</b> <?= htmlspecialchars($order['phone']) ?></p>
            <p><b>Trạng thái:</b> <span class="badge 
                <?php
                    switch($order['status']) {
                        case 0: echo 'bg-secondary'; break;
                        case 1: echo 'bg-info'; break;
                        case 2: echo 'bg-warning text-dark'; break;
                        case 3: echo 'bg-success'; break;
                    }
                ?>">
                <?= $statusText[$order['status']] ?>
            </span></p>
            <hr>
            <h6>Sản phẩm:</h6>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Giá</th>
                        <th>Số lượng</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orderDetails as $item): ?>
                    <tr>
                        <td><img src="<?= ROOT_URL . $item['image'] ?>" width="60"> <?= htmlspecialchars($item['product_name']) ?></td>
                        <td><?= number_format($item['price']) ?> VNĐ</td>
                        <td><?= $item['quantity'] ?></td>
                        <td><?= number_format($item['price'] * $item['quantity']) ?> VNĐ</td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <p class="fw-bold text-end">Tổng tiền: <?= number_format($order['total'] ?? 0) ?> VNĐ</p>
            <!-- Có thể bổ sung lịch sử trạng thái, ghi chú, ... -->
            <div class="text-end mt-4">
                <a href="javascript:history.back()" class="btn btn-secondary btn-sm">
                    <i class="bi bi-arrow-left"></i> Quay lại
                </a>
            </div>
        </div>
    </div>
</div>
<?php include_once ROOT_DIR . "views/admin/footer.php" ?>