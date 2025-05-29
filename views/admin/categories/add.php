<?php include_once ROOT_DIR . "views/admin/header.php" ?>
<div class="container">
    <form action="<?= ADMIN_URL . '?ctl=storedm' ?>" method="post">
        <div class="bt-3">
            <label for="" class="form-lable">Tên danh mục</label>
            <input type="text" name="cate_name" class="form-control">
        </div>
        <div class="mb-3">
            <button type="submit" class="btn btn-primary">Thêm mới </button>
        </div>
    </form>

</div>
<?php include_once ROOT_DIR . "views/admin/footer.php" ?>