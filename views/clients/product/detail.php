<?php include_once ROOT_DIR . "views/clients/header.php"; ?>
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
      <p><strong>Số lượng còn:</strong> <?= $product['quantity']?></p>
      <p><strong>Mô tả sản phẩm:</strong><br>
       <?= $product['description']?>
      </p>
      <button class="add-to-cart">Thêm vào giỏ hàng</button>
    </div>
  </div>

  <div class="product-description">
  <h2>Mô tả chi tiết</h2>
  <?= $product['content'] ?>
</div>

<div class="container mt-5">
  <h2 class="mb-4">Sản phẩm liên quan</h2>
  <div class="row g-4">
    
    <?php foreach($productReleads as $products) : ?>
    <div class="col-md-3">
      <div class="product-box">
        <img src="<?= ROOT_URL . $products['image']?>" alt="<?= $products['name']?>" class="product-img">
        <a href="<?= ROOT_URL .'?ctl=detail&id=' .$products['id'] ?>" class="product-name"><?= $products['name']?></a>
        <span class="product-price"><?= number_format($products['price'])?> ₫</span>
        <div class="product-buttons">
          <button class="btn btn-outline-success">Thêm vào giỏ hàng</button>
        </div>
      </div>
    </div>
    <?php endforeach ?>
  </div>



<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>

