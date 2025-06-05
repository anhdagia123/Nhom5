<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="container mt-4">
  <div class="banner position-relative rounded overflow-hidden" style="height: 300px;">
    <img src="<?= ROOT_URL ?>images/banner 1.webp" alt="Banner" class="w-100 h-100 object-fit-cover" style="object-fit: cover;">
  </div>
</div>

<div class="container mt-5">
  <h2 class="mb-4 text-primary fw-bold">Tất cả sản phẩm</h2>
  <?php if (!empty($products)): ?>
    <div class="row g-4">
      <?php foreach ($products as $product): ?>
        <div class="col-md-3">
          <div class="product-box">
            <img src="<?= ROOT_URL . $product['image'] ?>" alt="<?= $product['name'] ?>" class="product-img">
            <a href="<?= ROOT_URL . '?ctl=detail&id=' . $product['id'] ?>" class="product-name"><?= $product['name'] ?></a>
            <span class="product-price"><?= number_format($product['price'], 0, ',', '.') ?> ₫</span>
            <div class="product-buttons">
              <?php if ($product['quantity'] > 0): ?>
                <a href="<?= ROOT_URL . '?ctl=add-cart&id=' . $product['id'] ?>" class="btn btn-outline-success">Thêm vào giỏ hàng</a>
              <?php else: ?>
                <button class="btn btn-secondary" disabled>Hết hàng</button>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  <?php else: ?>
    <div class="alert alert-warning text-center mt-4">Không có sản phẩm nào.</div>
  <?php endif; ?>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>