<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div class="container col-lg-11 p-2 ">
  <div class="row g-4 mb-5">
    <!-- Top 5 sản phẩm bán chạy -->
    <div class="col-md-4">
      <div class="card card-success card-outline shadow-sm mb-4">
        <div class="card-header">
          <h3 class="card-title"><i class="bi bi-bag-check-fill me-2"></i>Top 5 sản phẩm bán chạy</h3>
        </div>
        <div class="card-body">
          <ol class="list-group list-group-numbered">
            <?php if (empty($topProducts)): ?>
              <li class="list-group-item text-muted">Không có dữ liệu</li>
            <?php else: ?>
              <?php foreach ($topProducts as $p): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <?= htmlspecialchars($p['name']) ?>
                  <span class="badge bg-success rounded-pill"><?= $p['total_sold'] ?> đã bán</span>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ol>
        </div>
      </div>
    </div>


    <!-- Top 5 sản phẩm tồn kho -->
    <div class="col-md-4">
      <div class="card card-warning card-outline shadow-sm mb-4">
        <div class="card-header">
          <h3 class="card-title"><i class="bi bi-box-seam me-2"></i>Top 5 sản phẩm tồn kho</h3>
        </div>
        <div class="card-body">
          <ol class="list-group list-group-numbered">
            <?php if (empty($topStock)): ?>
              <li class="list-group-item text-muted">Không có dữ liệu</li>
            <?php else: ?>
              <?php foreach ($topStock as $p): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <?= htmlspecialchars($p['name']) ?>
                  <span class="badge bg-warning text-dark rounded-pill"><?= $p['stock'] ?> tồn kho</span>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ol>
        </div>
      </div>
    </div>


    <!-- Top 5 khách hàng mua nhiều -->
    <div class="col-md-4">
      <div class="card card-info card-outline shadow-sm mb-4">
        <div class="card-header">
          <h3 class="card-title"><i class="bi bi-person-lines-fill me-2"></i>Top 5 khách hàng mua nhiều</h3>
        </div>
        <div class="card-body">
          <ol class="list-group list-group-numbered">
            <?php if (empty($topCustomers)): ?>
              <li class="list-group-item text-muted">Không có dữ liệu</li>
            <?php else: ?>
              <?php foreach ($topCustomers as $c): ?>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                  <?= htmlspecialchars($c['name']) ?>
                  <span class="badge bg-info text-dark rounded-pill"><?= $c['total_orders'] ?> đơn hàng</span>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ol>
        </div>
      </div>
    </div>

  </div>

  <!-- Danh sách đơn hàng -->
  <div class="card card-secondary card-outline shadow-sm mb-4">
    <div class="card-header">
      <h3 class="card-title"><i class="bi bi-clock-history me-2"></i>Đơn hàng mới chờ xác nhận</h3>
    </div>
    <div class="card-body table-responsive p-0">
      <table class="table table-hover table-bordered mb-0 align-middle text-nowrap">
        <thead class="table-light">
          <tr>
            <th scope="col">Mã đơn</th>
            <th scope="col">Khách hàng</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Chi tiết</th>
          </tr>
        </thead>
        <tbody>
          <?php if (empty($newOrders)): ?>
            <tr>
              <td colspan="4" class="text-center text-muted">Không có đơn hàng mới</td>
            </tr>
          <?php else: ?>
            <?php foreach ($newOrders as $order): ?>
              <tr>
                <td class="fw-semibold">#<?= $order['id'] ?></td>
                <td><?= htmlspecialchars($order['customer_name']) ?></td>
                <td><?= date('d/m/Y H:i', strtotime($order['created_at'])) ?></td>
                <td>
                  <a href="<?=  ADMIN_URL?>?ctl=order-detail-dashboard&id=<?= $order['id'] ?>"
                    class="btn btn-sm btn-outline-primary rounded-pill" title="Xem đơn hàng" data-bs-toggle="tooltip">
                    <i class="bi bi-eye"></i> Xem
                  </a>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>


  <div class="row mt-5">
    <!-- Biểu đồ doanh thu theo ngày (có form lọc) -->
    <div class="card card-primary mb-4">
      <div class="card-header">
        <h3 class="card-title"><i class="bi bi-graph-up me-2"></i>Doanh thu theo ngày</h3>
        <div class="card-tools">
          <button class="btn btn-tool" data-card-widget="collapse">
            <i class="bi bi-dash-lg"></i>
          </button>
        </div>
      </div>
      <div class="card-body">
        <form id="filterForm" class="row gy-2 gx-3 align-items-end mb-3">
          <div class="col-auto">
            <label for="fromDate" class="form-label">Từ ngày</label>
            <input type="date" name="from" id="fromDate" class="form-control form-control-sm"
              value="<?= htmlspecialchars($from) ?>">
          </div>
          <div class="col-auto">
            <label for="toDate" class="form-label">Đến ngày</label>
            <input type="date" name="to" id="toDate" class="form-control form-control-sm"
              value="<?= htmlspecialchars($to) ?>">
          </div>
          <div class="col-auto">
            <button type="submit" class="btn btn-sm btn-primary"><i class="bi bi-funnel me-1"></i> Lọc</button>
          </div>
        </form>
        <canvas id="chart" height="150" class="bg-white rounded shadow-sm w-100"></canvas>
      </div>
    </div>


  </div>

</div>

<!-- CDN & Script -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
  let chartRevenue, chartWeekday;

  // Biểu đồ doanh thu theo ngày (line)
  function renderRevenueChart(labels, data) {
    if (chartRevenue) chartRevenue.destroy();
    const ctx = document.getElementById('chart').getContext('2d');
    chartRevenue = new Chart(ctx, {
      type: 'line',
      data: {
        labels: labels,
        datasets: [{
          label: 'Doanh thu',
          data: data,
          borderColor: '#0d6efd',
          backgroundColor: 'rgba(13,110,253,0.1)',
          tension: 0.4,
          fill: true,
          pointRadius: 5,
          pointBackgroundColor: '#0d6efd'
        }]
      },
      options: {
        responsive: true,
        plugins: { legend: { display: true } },
        scales: {
          y: {
            beginAtZero: true,
            ticks: { callback: value => value.toLocaleString('vi-VN') + ' ₫' }
          }
        }
      }
    });
  }

  // Khởi tạo biểu đồ ban đầu
  $(function () {
 renderRevenueChart(
  <?= json_encode(array_column($revenueData, 'date')) ?>,
  <?= json_encode(array_map('floatval', array_column($revenueData, 'revenue'))) ?>
);
    renderWeekdayChart(
      getWeekdayDataFromPHP(<?= json_encode($revenueByWeekday) ?>)
    );
  });

  // Xử lý lọc bằng AJAX
  $('#filterForm').on('submit', function (e) {
    e.preventDefault();
    let from = $('input[name="from"]').val();
    let to = $('input[name="to"]').val();
    $.ajax({
      url: window.location.pathname,
      type: 'GET',
      data: { from, to, ajax: 1 },
      dataType: 'json',
      success: function (res) {
        renderRevenueChart(res.revenueLabels, res.revenueData.map(parseFloat));
        renderWeekdayChart(res.weekdayData);
      },
      error: function () {
        alert('Không thể tải dữ liệu biểu đồ. Vui lòng thử lại.');
      }
    });
  });
</script>