<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<!-- Alert nổi trên đầu trang, không ảnh hưởng bố cục -->
<div id="global-alert" style="display:none;position:fixed;top:70px;left:50%;transform:translateX(-50%);z-index:2000;min-width:320px;max-width:90vw;"></div>

<div class="container my-5">
  <div class="row g-4">
    <!-- Hình ảnh sản phẩm -->
    <div class="col-md-5">
      <div class="border rounded shadow-sm bg-white p-3">
        <img src="<?= $product['image']?>" alt="<?= $product['name'] ?>" class="img-fluid w-100 rounded" style="object-fit:cover;max-height:400px;">
      </div>
    </div>
    <!-- Thông tin sản phẩm -->
    <div class="col-md-7">
      <div class="border rounded shadow-sm bg-white p-4 h-100 d-flex flex-column">
        <h1 class="fw-bold mb-3"><?= htmlspecialchars($product['name']) ?></h1>
        <div class="mb-2">
          <span class="badge <?= $product['quantity'] > 0 ? 'bg-success' : 'bg-danger' ?>">
            <?= $product['quantity'] > 0 ? 'Còn hàng' : 'Hết hàng' ?>
          </span>
        </div>
        <div class="mb-3">
          <span class="fs-3 text-danger fw-bold"><?= number_format($product['price']) ?> ₫</span>
        </div>
        <div class="mb-3">
          <strong>Số lượng còn:</strong>
          <span id="remain-qty" class="fw-bold"><?= $product['quantity'] ?></span>
        </div>
        <div class="mb-3">
          <strong>Mô tả sản phẩm:</strong>
          <div class="text-secondary"><?= nl2br(htmlspecialchars($product['description'])) ?></div>
        </div>
        <div class="mt-auto">
          <?php if($product['quantity'] > 0): ?>
            <button id="add-to-cart-btn" class="btn btn-success btn-lg w-100 mb-2">
              <i class="fa fa-cart-plus me-2"></i>Thêm vào giỏ hàng
            </button>
          <?php else: ?>
            <button class="btn btn-secondary btn-lg w-100 mb-2" disabled>Hết hàng</button>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </div>

  <!-- Mô tả chi tiết -->
  <div class="row mt-5">
    <div class="col-12">
      <div class="border rounded bg-white p-4 shadow-sm">
        <h2 class="mb-3 fs-4 fw-bold text-primary">Mô tả chi tiết</h2>
        <div><?= $product['content'] ?></div>
      </div>
    </div>
  </div>

  <!-- Bình luận sản phẩm -->
  <div class="row mt-5">
    <div class="col-12">
      <div class="border rounded bg-white p-4 shadow-sm">
        <h3 class="mb-3 fs-5 fw-bold text-primary">Bình luận sản phẩm</h3>
        <?php if (!empty($commentError)): ?>
          <div class="alert alert-danger"><?= htmlspecialchars($commentError) ?></div>
        <?php endif; ?>

        <?php if (!isset($_SESSION['user'])): ?>
          <div class="alert alert-warning">Bạn cần <a href="<?= ROOT_URL . '?ctl=login' ?>">đăng nhập</a> để bình luận.</div>
        <?php elseif (!$canComment): ?>
          <div class="alert alert-info">Chỉ khách đã mua sản phẩm này mới được bình luận.</div>
        <?php else: ?>
          <form method="post" action="" class="mb-4">
            <div class="mb-3">
              <textarea name="comment" class="form-control" rows="3" required placeholder="Nhập bình luận..."></textarea>
            </div>
            <button type="submit" name="submit_comment" class="btn btn-primary">Gửi bình luận</button>
          </form>
        <?php endif; ?>

          <hr>
        <div class="comment-list">
          <?php foreach ($comments as $row): ?>
            <?php if ($row['status'] == 0): // Chỉ hiện bình luận có status = 0 ?>
            <div class="mb-3 pb-2 border-bottom">
              <strong class="text-dark"><?= htmlspecialchars($row['username']) ?></strong>:
              <span><?= nl2br(htmlspecialchars($row['content'])) ?></span>
              <div class="text-muted small"><?= $row['created_at'] ?></div>
            </div>
            <?php endif; ?>
          <?php endforeach; ?>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Alert JS -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const btn = document.getElementById('add-to-cart-btn');
    const globalAlert = document.getElementById('global-alert');
    if (btn) {
        btn.addEventListener('click', function() {
            fetch('<?= ROOT_URL ?>?ctl=add-cart&id=<?= $product['id'] ?>&ajax=1')
                .then(res => res.json())
                .then(data => {
                    let alertHtml = '';
                    if(data.success) {
                        alertHtml = `<div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fa fa-check-circle me-2"></i>${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                        document.getElementById('remain-qty').textContent = data.remain;
                        if (data.remain <= 0) {
                            btn.disabled = true;
                            btn.classList.remove('btn-success');
                            btn.classList.add('btn-secondary');
                            btn.textContent = 'Hết hàng';
                        }
                    } else {
                        alertHtml = `<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fa fa-exclamation-circle me-2"></i>${data.message}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>`;
                    }
                    globalAlert.innerHTML = alertHtml;
                    globalAlert.style.display = 'block';
                    setTimeout(() => {
                        let alert = globalAlert.querySelector('.alert');
                        if(alert) alert.classList.remove('show');
                        setTimeout(() => { globalAlert.style.display = 'none'; }, 2000);
                    }, 2500);
                });
        });
    }
});
</script>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>