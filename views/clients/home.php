<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="container mt-4">
  <div class="banner position-relative rounded overflow-hidden" style="height: 300px;">
    <img src="<?= ROOT_URL ?>images/banner 1.webp" alt="Banner" class="w-100 h-100 object-fit-cover" style="object-fit: cover;">
  </div>
</div>

<div class="container mt-5">
  <?php if (isset($searchResults)): ?>
    <h2 class="mb-4">Kết quả tìm kiếm cho "<?= htmlspecialchars($searchTerm) ?>"</h2>
    <?php if (count($searchResults) > 0): ?>
      <div class="row g-4">
        <?php foreach ($searchResults as $product): ?>
          <div class="col-md-3">
            <div class="product-box">
              <img src="<?= ROOT_URL . $product['image'] ?>" alt="<?= $product['name'] ?>" class="product-img">
              <a href="<?= ROOT_URL . '?ctl=detail&id=' . $product['id'] ?>" class="product-name"><?= $product['name'] ?></a>
              <span class="product-price"><?= number_format($product['price'], 0, ',', '.') ?> ₫</span>
              <div class="product-buttons">
                 <a href="<?= ROOT_URL . '?ctl=add-cart&id=' . $product['id'] ?>" class="btn btn-outline-success">Thêm vào giỏ hàng</a>
              </div>
            </div>
          </div>
        <?php endforeach; ?>
      </div>
    <?php else: ?>
      <p>Không tìm thấy sản phẩm nào.</p>
    <?php endif; ?>

  <?php else: ?>
    <!-- Hiển thị danh mục mặc định -->
    <h2 class="mb-4">ÁO NAM</h2>
    <div class="row g-4">
      <?php foreach($shirts as $shirt) : ?>
        <div class="col-md-3">
            <div class="product-box">
                <img src="<?= ROOT_URL . $shirt['image'] ?>" alt="<?= $shirt['name'] ?>" class="product-img">
                <a href="<?= ROOT_URL . '?ctl=detail&id=' . $shirt['id'] ?>" class="product-name">
                    <?= $shirt['name'] ?>
                </a>
                <span class="product-price"><?= number_format($shirt['price'], 0, ',', '.') ?> ₫</span>
                <div class="product-buttons">
                    <a href="<?= ROOT_URL . '?ctl=add-cart&id=' . $shirt['id'] ?>" class="btn btn-outline-success">Thêm vào giỏ hàng</a>
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
                <img src="<?= ROOT_URL . $trouser['image'] ?>" alt="<?= $trouser['name'] ?>" class="product-img">
                <a href="<?= ROOT_URL . '?ctl=detail&id=' . $trouser['id'] ?>" class="product-name"><?= $trouser['name'] ?></a>
                <span class="product-price"><?= number_format($trouser['price'], 0, ',', '.') ?> ₫</span>
                <div class="product-buttons">
                    <a href="<?= ROOT_URL . '?ctl=add-cart&id=' . $trouser['id'] ?>" class="btn btn-outline-success">Thêm vào giỏ hàng</a>
                </div>
            </div>
        </div>
      <?php endforeach; ?>
    </div>

    <h2 class="mb-4 mt-5 text-danger">Sản phẩm bán chạy</h2>
    <div class="row g-4">
        <?php foreach($bestSellers as $bestSeller): ?>
          <div class="col-md-3">
            <div class="product-box border border-warning">
              <img src="<?= ROOT_URL . $bestSeller['image']?>" alt="<?= $bestSeller['name']?>" class="product-img">
              <a href="<?= ROOT_URL . '?ctl=detail&id=' . $trouser['id'] ?>" class="product-name"><?= $bestSeller['name']?></a>
              <span class="product-price"><?= number_format($bestSeller['price'])?> ₫</span>
              <div class="product-buttons">
                 <div class="product-buttons">
                    <a href="<?= ROOT_URL . '?ctl=add-cart&id=' . $trouser['id'] ?>" class="btn btn-outline-success">Thêm vào giỏ hàng</a>
                </div>
              </div>
            </div>
          </div>
        <?php endforeach ?>
    </div>
  <?php endif; ?>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>
