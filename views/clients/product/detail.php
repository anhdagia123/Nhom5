
<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<!-- Alert nổi trên đầu trang, không ảnh hưởng bố cục -->
<div id="global-alert" style="display:none;position:fixed;top:70px;left:50%;transform:translateX(-50%);z-index:2000;min-width:100%;max-width:90vh;"></div>

<?php if (isset($_SESSION['success'])): ?>
    <div class="alert alert-success"><?= $_SESSION['success'] ?></div>
    <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<div class="product-container">
    <div class="product-image">
      <img src="<?= $product['image']?>" alt="<?= $product['name'] ?>">
    </div>
    <div class="product-info">
      <h1><?= $product['name'] ?></h1>
      <p class="status">Trạng thái:
        <?php if($product['quantity']>0) : ?>
      <span class="in-stock">Còn hàng</span></p>
      <?php else: ?>
         <span class="btn btn-danger">Hết hàng</span></p>
        <?php endif?>
      <p class="price">Giá: <?= number_format($product['price']) ?></p>
      <p><strong>Số lượng còn:</strong> <span id="remain-qty"><?= $product['quantity'] ?></span></p>
      <p><strong>Mô tả sản phẩm:</strong><br>
       <?= $product['description']?>
      </p>
      <div class="mt-4">
       <?php if($product['quantity'] > 0): ?>
      <button id="add-to-cart-btn" class="btn btn-success">Thêm vào giỏ hàng</button>
      <?php else: ?>
      <button class="btn btn-secondary" disabled>Hết hàng</button>
      <?php endif; ?>
      <!-- Đã bỏ alert cũ ở đây -->
      </div>
    </div>
  </div>

  <div class="product-description">
  <h2>Mô tả chi tiết</h2>
  <?= $product['content'] ?>
</div>

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