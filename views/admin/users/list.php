
<?php include_once ROOT_DIR . "views/admin/header.php" ?>

<div class="container py-4">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0 fw-bold text-primary">Danh sách người dùng</h5>
        </div>
        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th scope="col">#ID</th>
                        <th scope="col">Họ và tên</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Vai trò</th>
                        <th scope="col">Hoạt động</th>
                        <th scope="col">Địa chỉ</th>
                        <th scope="col" style="width:120px;"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $user): ?>
                        <tr>
                            <th scope="row"><?= $user['id'] ?></th>
                            <td><?= htmlspecialchars($user['fullname']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['phone']) ?></td>
                            <td><?= htmlspecialchars($user['role']) ?></td>
                            <td>
                                <?php if ($user['active'] == 1): ?>
                                    <span class="badge bg-success">Hoạt động</span>
                                <?php else: ?>
                                    <span class="badge bg-danger">Khoá</span>
                                <?php endif ?>
                            </td>
                            <td><?= htmlspecialchars($user['address']) ?></td>
                            <td>
                                <form action="<?= ADMIN_URL . '?ctl=updateuser' ?>" method="post" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $user['id'] ?>">
                                    <input type="hidden" name="active" value="<?= $user['active'] ?>">
                                    <?php if ($user['role'] != 'admin'): ?>
                                        <?php if ($user['active'] == 1): ?>
                                            <button type="submit" class="btn btn-danger btn-sm">Khoá</button>
                                        <?php else: ?>
                                            <button type="submit" class="btn btn-primary btn-sm">Kích hoạt</button>
                                        <?php endif ?>
                                    <?php endif ?>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/admin/footer.php" ?>