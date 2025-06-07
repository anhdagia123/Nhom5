
<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div class="container ">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-9">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center border-bottom">
                    <h4 class="mb-0 fw-bold text-primary">Thêm sản phẩm mới</h4>
                </div>
                <div class="card-body">
                    <form action="<?= ADMIN_URL . '?ctl=storesp'?>" method="post" enctype="multipart/form-data">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Tên sản phẩm</label>
                                <input type="text" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label for="category_id" class="form-label">Danh mục</label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <?php foreach($categories as $cate): ?>
                                        <option value="<?=$cate['id']?>"><?= $cate['cate_name']?></option>
                                    <?php endforeach ?>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="image" class="form-label">Hình ảnh</label>
                                <input type="file" name="image" id="image" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="price" class="form-label">Giá</label>
                                <input type="number" name="price" id="price" step="0.1" class="form-control" required>
                            </div>
                            <div class="col-md-3">
                                <label for="quantity" class="form-label">Số lượng</label>
                                <input type="number" name="quantity" id="quantity" step="1" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Trạng thái</label>
                                <div class="d-flex gap-3 mt-1">
                                    <label class="form-check-label">
                                        <input type="radio" name="status" value="1" class="form-check-input" checked> Đang kinh doanh
                                    </label>
                                    <label class="form-check-label">
                                        <input type="radio" name="status" value="0" class="form-check-input"> Ngừng kinh doanh
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="description" class="form-label">Mô tả ngắn</label>
                                <textarea name="description" id="description" rows="2" class="form-control"></textarea>
                            </div>
                            <div class="col-12">
                                <label for="content" class="form-label">Nội dung</label>
                                <textarea name="content" id="content" rows="4" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary fw-bold">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>