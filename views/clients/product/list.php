<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="container mt-4">
  <div class="banner position-relative rounded overflow-hidden" style="height: 300px;">
    <img src="<?= ROOT_URL ?>images/banner 1.webp" alt="Banner" class="w-100 h-100 object-fit-cover" style="object-fit: cover;">
  </div>
</div>

<div class="container mt-5">
  <h2 class="mb-4"><?= $category_name ?></h2>
  <div class="row g-4">
    <?php if($product)  :  ?>
    <?php foreach($product as $products) : ?>
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
    <?php else : ?>
        <div>Danh mục<strong> <?=$category_name  ?></strong> không có sản phẩm</h3>
    <?php endif ?>
  </div>
        


<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>

