<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div class="container">
    <?php if ($message != ''): ?>
        <div class="alert alert-success">
            <?= $message ?>
        </div>
    <?php endif ?>

    

    <table class="table">
        <thead>
            <tr>
                <th>#ID</th>
                <th>Tên sản phẩm</th>
                <th>Hình ảnh</th>
                <th>Giá</th>
                <th>Trạng thái</th>
                <th>Danh mục</th>
                <th>Hành động</th>
                <a href="<?= ADMIN_URL . '?ctl=addsp' ?>" class="btn btn-primary mb-3">Thêm Mới</a>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($product as $pro): ?>
                <tr>
                    <td><?= $pro['id'] ?></td>
                    <td><?= $pro['name'] ?></td>
                    <td><img src="<?= ROOT_URL . $pro['image'] ?>" width="60" alt=""></td>
                    <td><?= number_format($pro['price']) ?>VNĐ</td>
                    <td><?= $pro['status'] ? 'Đang kinh doanh' : 'Ngừng kinh doanh' ?></td>
                    <td><?= $pro['cate_name'] ?></td>
                    <td>
                        <a href="<?= ADMIN_URL . '?ctl=editsp&id=' . $pro['id'] ?>" class="btn btn-primary">Sửa</a>
                        <a href="<?= ADMIN_URL . '?ctl=deletesp&id=' . $pro['id'] ?>" class="btn btn-danger" onclick="return confirm('Bạn có muốn xóa không?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>
