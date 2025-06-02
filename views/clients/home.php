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
<<<<<<< HEAD
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

=======
      <div class="product-box">
        <img src="<?= ROOT_URL . $shirt['image']?>" alt="<?= $shirt['name']?>" class="product-img">
        <a href="#" class="product-name"><?= $shirt['name']?></a>
        <span class="product-price"><?= number_format($shirt['price'])?> ₫</span>
        <div class="product-buttons">
          <button class="btn btn-outline-success">Thêm vào giỏ hàng</button>
        </div>
      </div>
    </div>
    <?php endforeach ?>
  </div>
>>>>>>> 429314e459d02f5fe13ff411b5c5882dacb6eced
        
  
  <h2 class="mb-4 mt-5">QUẦN NAM</h2>
  
  <div class="row g-4">
    <?php foreach($trousers as $trouser) :  ?>
    <div class="col-md-3">
<<<<<<< HEAD
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

=======
      <div class="product-box">
        <img src="<?= ROOT_URL . $trouser['image']?>" alt="<?= $trouser['name']?>" class="product-img">
        <a href="#" class="product-name"><?= $trouser['name']?></a>
        <span class="product-price"><?= number_format($trouser['price'])?> ₫</span>
        <div class="product-buttons">
          <button class="btn btn-outline-success">Thêm vào giỏ hàng</button>
        </div>
      </div>
    </div>
    <?php endforeach ?>
  </div>
>>>>>>> 429314e459d02f5fe13ff411b5c5882dacb6eced

  <!-- Sản phẩm bán chạy -->
  <h2 class="mb-4 mt-5 text-danger">Sản phẩm bán chạy</h2>
  <div class="row g-4">
      <?php foreach($bestSellers as $bestSeller): ?>
        <div class="col-md-3">
          <div class="product-box border border-warning">
            <img src="<?= ROOT_URL . $bestSeller['image']?>" alt="<?= $bestSeller['name']?>" class="product-img">
            <a href="#" class="product-name"><?= $bestSeller['name']?></a>
            <span class="product-price"><?= number_format($bestSeller['price'])?> ₫</span>
            <div class="product-buttons">
              <button class="btn btn-outline-success">Thêm vào giỏ hàng</button>
            </div>
          </div>
        </div>
      <?php endforeach ?>
  </div>


<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>

