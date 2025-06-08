
<?php include_once ROOT_DIR . "views/admin/header.php" ?>
<div class="container">
  <div class="card shadow-sm border-0">
    <div class="card-header bg-white border-bottom">
      <h5 class="mb-0 fw-bold text-primary">Quản lý đơn hàng</h5>
    </div>
    <div class="card-body p-0">
      <table class="table table-hover align-middle mb-0">
        <thead class="table-light">
          <tr>
            <th>#ID</th>
            <th>Đơn hàng</th>
            <th>Khách hàng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Cập nhật trạng thái</th>
            <th>Chi tiết</th>
          </tr>
        </thead>
        <tbody>
          <?php
            $statusText = [
              0 => 'Chờ xác nhận',
              1 => 'Đang xử lý',
              2 => 'Đang giao hàng',
              3 => 'Đã giao thành công'
            ];
          ?>
          <?php foreach ($orders as $order): ?>
            <tr>
              <td><?= $order['id'] ?></td>
              <td><?= htmlspecialchars($order['product_names']) ?></td>
              <td><?= htmlspecialchars($order['customer_name']) ?></td>
              <td><?= number_format($order['total'] ?? 0) ?> VNĐ</td>
              <td>
                <span class="badge 
                  <?php
                    switch ($order['status']) {
                      case 0: echo 'bg-secondary'; break;
                      case 1: echo 'bg-info'; break;
                      case 2: echo 'bg-warning text-dark'; break;
                      case 3: echo 'bg-success'; break;
                    }
                  ?>">
                  <?= $statusText[$order['status']] ?>
                </span>
              </td>
              <td>
               <select class="form-select form-select-sm order-status" data-id="<?= $order['id'] ?>">
                <?php foreach ($statusText as $key => $text): ?>
                  <option value="<?= $key ?>"
                    <?= $order['status'] == $key ? 'selected' : ($key < $order['status'] ? 'disabled' : '') ?>
                    <?= $key == 3 ? 'disabled' : '' ?>
                    <?= $order['status'] == $key ? 'data-current="1"' : '' ?>>
                    <?= $text ?>
                  </option>
                <?php endforeach ?>
              </select>
              </td>
              <td>
                <a href="<?= ADMIN_URL . '?ctl=order-detail&id=' . $order['id'] ?>" class="btn btn-primary btn-sm">Xem</a>
              </td>
            </tr>
          <?php endforeach ?>
        </tbody>
      </table>
    </div>
    <nav>
      <ul class="pagination justify-content-center mt-3">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
            <a class="page-link" href="?ctl=list-order&page=<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor ?>
      </ul>
    </nav>
  </div>
</div>

<!-- Thông báo -->
<div id="order-alert" style="position:fixed;top:80px;right:30px;z-index:9999;display:none;min-width:250px"></div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
  $('.order-status').change(function () {
    var select = $(this);
    var orderId = select.data('id');
    var prevStatus = parseInt(select.find('option[data-current="1"]').val());
    var newStatus = parseInt(select.val());

    // Không cho chọn lại trạng thái đã qua
    if (newStatus < prevStatus) {
      showOrderAlert('Không thể quay lại trạng thái trước đó!', 'danger');
      select.val(prevStatus);
      return;
    }

    // Gửi AJAX cập nhật trạng thái
    $.post('<?= ADMIN_URL ?>?ctl=update-order-status', {
      id: orderId,
      status: newStatus
    }, function (res) {
      if (res.success) {
        showOrderAlert('Cập nhật trạng thái thành công!', 'success');
        setTimeout(function () { location.reload(); }, 1000);
      } else {
        showOrderAlert(res.message || 'Có lỗi xảy ra!', 'danger');
        select.val(prevStatus);
      }
    }, 'json');
  });

  function showOrderAlert(msg, type) {
    $('#order-alert').html('<div class="alert alert-' + type + ' alert-dismissible fade show" role="alert">' + msg + '<button type="button" class="btn-close" data-bs-dismiss="alert"></button></div>').fadeIn();
    setTimeout(function () { $('#order-alert').fadeOut(); }, 2500);
  }
</script>
<?php include_once ROOT_DIR . "views/admin/footer.php" ?>