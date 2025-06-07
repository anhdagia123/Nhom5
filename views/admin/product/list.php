<?php include_once ROOT_DIR . "views/admin/header.php" ?>
<div class="container">
    <?php if ($message != ''): ?>
        <div class="alert alert-success shadow-sm rounded-3 mb-3">
            <?= $message ?>
        </div>
    <?php endif ?>

    <div class="d-flex justify-content-end mb-3">
        <a href="<?= ADMIN_URL . '?ctl=addsp' ?>" class="btn btn-primary fw-semibold shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Thêm mới
        </a>
    </div>

    <div class="card shadow border-0" style="background: linear-gradient(135deg, #f8fafc 60%, #e3f0ff 100%);">
        <div class="card-header" style="background: linear-gradient(90deg, #007bff 60%, #00c6ff 100%);">
            <h5 class="mb-0 text-white fw-bold">Danh sách sản phẩm</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" style="width:60px;">#ID</th>
                        <th scope="col">Tên sản phẩm</th>
                        <th scope="col">Hình ảnh</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Số lượng</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Danh mục</th>
                        <th scope="col" style="width:180px;">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($product as $pro): ?>
                    <tr>
                        <th scope="row"><?= $pro['id'] ?></th>
                        <td><?= htmlspecialchars($pro['name']) ?></td>
                        <td>
                            <img src="<?= ROOT_URL . $pro['image'] ?>" width="60" class="rounded shadow-sm border" alt="">
                        </td>
                        <td class="text-danger fw-bold"><?= number_format($pro['price']) ?> VNĐ</td>
                        <td><?= $pro['quantity'] ?></td>
                        <td>
                            <?php if ($pro['status']): ?>
                                <span class="badge bg-success">Đang kinh doanh</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Ngừng kinh doanh</span>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($pro['cate_name']) ?></td>
                        <td>
                            <a href="<?= ADMIN_URL . '?ctl=editsp&id=' . $pro['id'] ?>" class="btn btn-primary btn-sm me-1">
                                <i class="bi bi-pencil-square"></i> Sửa
                            </a>
                            <a href="<?= ADMIN_URL . '?ctl=deletesp&id=' . $pro['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có muốn xóa không?')">
                                <i class="bi bi-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>