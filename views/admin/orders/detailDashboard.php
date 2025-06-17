<?php include_once ROOT_DIR . "views/admin/header.php"; ?>

<div class="container mt-4">
  <div class="card">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Chi tiết đơn hàng #<?= $order['id'] ?></h4>
    </div>
    <div class="card-body">
      <p><strong>Khách hàng:</strong> <?= htmlspecialchars($order['customer_name']) ?></p>
      <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($order['phone']) ?></p>
      <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['address']) ?></p>
      <p><strong>Trạng thái:</strong> <?= $statusText[$order['status']] ?></p>

      <hr>
     <hr>
<h5>Danh sách sản phẩm</h5>
<table class="table table-bordered mt-3">
  <thead>
    <tr>
      <th>Hình ảnh</th>
      <th>Sản phẩm</th>
      <th>Giá</th>
      <th>Số lượng</th>
      <th>Tổng</th>
    </tr>
  </thead>
  <tbody>
    <?php
      $totalOrder = 0;
      foreach ($orderDetails as $item):
        $lineTotal = $item['price'] * $item['quantity'];
        $totalOrder += $lineTotal;
    ?>
      <tr>
        <td><img src="<?= ROOT_URL ?>/<?= htmlspecialchars($item['image']) ?>" width="60" height="60" class="img-thumbnail" alt=""></td>
        <td><?= htmlspecialchars($item['product_name']) ?></td>
        <td><?= number_format($item['price']) ?> ₫</td>
        <td><?= $item['quantity'] ?></td>
        <td><?= number_format($lineTotal) ?> ₫</td>
      </tr>
    <?php endforeach; ?>
  </tbody>
  <tfoot>
    <tr>
      <td colspan="4" class="text-end"><strong>Tổng đơn hàng:</strong></td>
      <td><strong class="text-danger"><?= number_format($totalOrder) ?> ₫</strong></td>
    </tr>
  </tfoot>
</table>


    <?php if ($order['status'] == 0): ?>
  <button class="btn btn-success mt-3 me-2" id="confirmBtn" data-id="<?= $order['id'] ?>">
    <i class="bi bi-check-circle"></i> Xác nhận đơn hàng
  </button>
<?php endif; ?>

<a href="<?= ADMIN_URL ?>" class="btn btn-secondary mt-3">
  <i class="bi bi-arrow-left"></i> Quay lại danh sách đơn hàng
</a>

    </div>
  </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
  $('#confirmBtn').on('click', function () {
     let id = $(this).data('id');
    if (confirm("Bạn có chắc muốn xác nhận đơn hàng này?")) {
      $.post('<?= ADMIN_URL ?>?ctl=update-order-status', { id: id, status: 1 }, function (res) {
        if (res.success) {
          alert("Đã xác nhận đơn hàng!");
          location.reload();
        } else {
          alert(res.message);
        }
      }, 'json');
    }
  });
});

</script>

<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>
