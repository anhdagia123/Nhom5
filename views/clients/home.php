<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="container mt-4">
  <div class="banner position-relative rounded overflow-hidden" style="height: 300px;">
    <img src="<?= ROOT_URL ?>images/banner 1.webp" alt="Banner" class="w-100 h-100 object-fit-cover" style="object-fit: cover;">
  </div>
</div>

<div class="container mt-5">
  <h2 class="mb-4">ÁO NAM</h2>
  <div class="row g-4">
    <?php foreach($shirts as $shirt) : ?>
    <div class="col-md-3">
        <div class="product-box">
            <img src="<?= htmlspecialchars(ROOT_URL . $shirt['image']) ?>" alt="<?= htmlspecialchars($shirt['name']) ?>" class="product-img">
            <a href="<?= htmlspecialchars(ROOT_URL . '?ctl=detail&id=' . $shirt['id']) ?>" class="product-name">
                <?= htmlspecialchars($shirt['name']) ?>
            </a>
            <span class="product-price"><?= number_format($shirt['price'], 0, ',', '.') ?> ₫</span>
            <div class="product-buttons">
                <a href="<?= htmlspecialchars(ROOT_URL . '?ctl=add-cart&id=' . $shirt['id']) ?>" class="btn btn-outline-success">Thêm vào giỏ hàng</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
  </div>

  <h2 class="mb-4 mt-5">QUẦN NAM</h2>
  <div class="row g-4">
    <?php foreach($trousers as $trouser) :  ?>
    <div class="col-md-3">
        <div class="product-box">
            <img src="<?= htmlspecialchars(ROOT_URL . $trouser['image']) ?>" alt="<?= htmlspecialchars($trouser['name']) ?>" class="product-img">
            <a href="<?= htmlspecialchars(ROOT_URL . '?ctl=detail&id=' . $trouser['id']) ?>" class="product-name"><?= htmlspecialchars($trouser['name']) ?></a>
            <span class="product-price"><?= number_format($trouser['price'], 0, ',', '.') ?> ₫</span>
            <div class="product-buttons">
                <a href="<?= htmlspecialchars(ROOT_URL . '?ctl=add-cart&id=' . $trouser['id']) ?>" class="btn btn-outline-success">Thêm vào giỏ hàng</a>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
  </div>

  <!-- Sản phẩm bán chạy -->
  <h2 class="mb-4 mt-5 text-danger">Sản phẩm bán chạy</h2>
  <div class="row g-4">
      <?php foreach($bestSellers as $bestSeller): ?>
        <div class="col-md-3">
          <div class="product-box border border-warning">
            <img src="<?= htmlspecialchars(ROOT_URL . $bestSeller['image']) ?>" alt="<?= htmlspecialchars($bestSeller['name']) ?>" class="product-img">
            <a href="#" class="product-name"><?= htmlspecialchars($bestSeller['name']) ?></a>
            <span class="product-price"><?= number_format($bestSeller['price'], 0, ',', '.') ?> ₫</span>
            <div class="product-buttons">
              <button class="btn btn-outline-success">Thêm vào giỏ hàng</button>
            </div>
          </div>
        </div>
      <?php endforeach ?>
  </div>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>
