
<?php include_once ROOT_DIR . "views/admin/header.php" ?>
<style>
    #alert-message {
        position: fixed;
        top: 24px;
        right: 24px;
        z-index: 1050;
        min-width: 320px;
        max-width: 90vw;
        box-shadow: 0 2px 12px rgba(0,0,0,0.15);
        opacity: 0.98;
        transition: opacity 0.3s;
    }
</style>
<div class="container">
    <?php if ($message != ''): ?>
        <div class="alert alert-success alert-dismissible fade show shadow-sm rounded-3" id="alert-message" role="alert">
            <?= $message ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Đóng"></button>
        </div>
    <?php endif ?>
    <div class="card shadow border-0 mt-3">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0 fw-bold">Danh sách bình luận</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#ID</th>
                        <th>Sản phẩm</th>
                        <th>Người bình luận</th>
                        <th>Nội dung</th>
                        <th>Ngày</th>
                        <th>Trạng thái</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($comments as $cmt): ?>
                    <tr>
                        <td><?= $cmt['id'] ?></td>
                        <td><?= htmlspecialchars($cmt['product_name']) ?></td>
                        <td><?= htmlspecialchars($cmt['username']) ?></td>
                        <td><?= htmlspecialchars($cmt['content']) ?></td>
                        <td><?= $cmt['created_at'] ?></td>
                        <td>
                            <?php if ($cmt['status'] == 0): ?>
                                <span class="badge bg-success">Hiện</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Ẩn</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if ($cmt['status'] == 0): ?>
                                <a href="?ctl=hidecomment&id=<?= $cmt['id'] ?>" class="btn btn-warning btn-sm">Ẩn</a>
                            <?php else: ?>
                                <a href="?ctl=showcomment&id=<?= $cmt['id'] ?>" class="btn btn-success btn-sm">Hiện</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <nav>
      <ul class="pagination justify-content-center mt-3">
        <?php for ($i = 1; $i <= $totalPages; $i++): ?>
          <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
            <a class="page-link" href="?ctl=listcomment&page<?= $i ?>"><?= $i ?></a>
          </li>
        <?php endfor ?>
      </ul>
    </nav>
</div>
<?php include_once ROOT_DIR . "views/admin/footer.php" ?>

<script>
    // Ẩn alert sau 3 giây (nếu chưa đóng thủ công)
    setTimeout(function() {
        var alert = document.getElementById('alert-message');
        if(alert) {
            var bsAlert = bootstrap.Alert.getOrCreateInstance(alert);
            bsAlert.close();
        }
    }, 3000);
</script>