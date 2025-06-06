
<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-9">
            <?php if ($message != ''): ?>
                <div class="alert alert-success mt-3">
                    <?= $message ?>
                </div>
            <?php endif ?>
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center border-bottom">
                    <h4 class="mb-0 fw-bold text-primary">Cập nhật sản phẩm</h4>
                </div>
                <div class="card-body">
                    <form action="<?= ADMIN_URL . '?ctl=updatesp'?>" method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Tên sản phẩm</label>
                                <input type="text" name="name" id="name" value="<?= htmlspecialchars($product['name']) ?>" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Danh mục</label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <?php foreach($categories as $cate): ?>
                                        <option value="<?=$cate['id']?>"
                                            <?= $cate['id']==$product['category_id']? 'selected':'' ?>>
                                            <?= $cate['cate_name']?>
                                        </option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Hình ảnh hiện tại</label><br>
                                <img src="<?= ROOT_URL . $product['image']?>" width="90" alt="">
                                <input type="hidden" name="image" value="<?= $product['image']?>">
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label">Chọn hình ảnh mới (nếu muốn thay)</label>
                                <input type="file" name="image" id="image" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label for="price" class="form-label">Giá</label>
                                <input type="number" name="price" id="price" step="0.1" value="<?= $product['price']?>" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="quantity" class="form-label">Số lượng</label>
                                <input type="number" name="quantity" id="quantity" value="<?= $product['quantity']?>" class="form-control" required>
                            </div>
                            <div class="col-md-12">
                                <label class="form-label">Trạng thái</label><br>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" id="status1" value="1" class="form-check-input" <?= $product['status'] ? 'checked': '' ?>>
                                    <label class="form-check-label" for="status1">Đang kinh doanh</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="status" id="status0" value="0" class="form-check-input" <?= $product['status'] == 0 ? 'checked': '' ?>>
                                    <label class="form-check-label" for="status0">Ngừng kinh doanh</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="form-label">Mô tả ngắn</label>
                                <textarea name="description" id="description" rows="3" class="form-control"><?= htmlspecialchars($product['description']) ?></textarea>
                            </div>
                            <div class="col-md-6">
                                <label for="content" class="form-label">Nội dung</label>
                                <textarea name="content" id="content" rows="3" class="form-control"><?= htmlspecialchars($product['content']) ?></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="id" value="<?= $product['id']?>">
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary fw-bold">Cập nhật</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>