<?php include_once ROOT_DIR . "views/admin/header.php" ?>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white text-center border-bottom">
                    <h4 class="mb-0 fw-bold text-primary">Thêm danh mục mới</h4>
                </div>
                <div class="card-body">
                    <form action="<?= ADMIN_URL . '?ctl=storedm' ?>" method="post">
                        <div class="mb-3">
                            <label for="cate_name" class="form-label fw-semibold">Tên danh mục</label>
                            <input type="text" name="cate_name" id="cate_name" class="form-control" placeholder="Nhập tên danh mục..." required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary fw-bold">Thêm mới</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include_once ROOT_DIR . "views/admin/footer.php" ?>