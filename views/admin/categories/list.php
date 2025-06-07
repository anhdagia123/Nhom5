<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div class="container">
    <?php if ($message != ''): ?>
        <div class="alert alert-success shadow-sm rounded-3">
            <?= $message ?>
        </div>
    <?php endif ?>

    <div class="d-flex justify-content-end mb-3">
        <a href="<?= ADMIN_URL . '?ctl=adddm' ?>" class="btn btn-primary fw-semibold shadow-sm">
            <i class="bi bi-plus-circle me-1"></i> Thêm mới
        </a>
    </div>

    <div class="card shadow border-0" style="background: linear-gradient(135deg, #f8fafc 60%, #e3f0ff 100%);">
        <div class="card-header" style="background: linear-gradient(90deg, #007bff 60%, #00c6ff 100%);">
            <h5 class="mb-0 text-white fw-bold">Danh sách danh mục</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col" style="width:60px;">#ID</th>
                        <th scope="col">Tên danh mục</th>
                        <th scope="col" style="width:180px;">Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $cate): ?>
                        <tr>
                            <th scope="row"><?= $cate['id'] ?></th>
                            <td><?= $cate['cate_name'] ?></td>
                            <td>
                                <a href="<?= ADMIN_URL . '?ctl=editdm&id=' . $cate['id'] ?>"
                                    class="btn btn-primary btn-sm me-1">
                                    <i class="bi bi-pencil-square"></i> Sửa
                                </a>
                                <a href="<?= ADMIN_URL . '?ctl=deletedm&id=' . $cate['id'] ?>" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Bạn có muốn xóa không?')">
                                    <i class="bi bi-trash"></i> Xóa
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
    <nav>
        <ul class="pagination justify-content-center mt-3">
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?ctl=listdm&page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor ?>
        </ul>
    </nav>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>