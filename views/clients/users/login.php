<?php include_once ROOT_DIR . "views/clients/header.php" ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <!-- Hiển thị thông báo thành công -->
            <?php if (!empty($message)) : ?>
                <div class="alert alert-success">
                    <?= htmlspecialchars($message) ?>
                </div>
            <?php endif; ?>

            <!-- Hiển thị lỗi đăng nhập -->
            <?php if (!empty($error)) : ?>
                <div class="alert alert-danger">
                    <?= htmlspecialchars($error) ?>
                </div>
            <?php endif; ?>

            <!-- Form đăng nhập -->
            <h3 class="mb-4 text-center">Đăng nhập</h3>
            <form action="<?= ROOT_URL . '?ctl=login' ?>" method="POST">
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Email</label>
                    <input type="email" class="form-control" id="loginEmail" name="email" placeholder="Nhập email" required>
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Mật khẩu</label>
                    <input type="password" class="form-control" id="loginPassword" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng nhập</button>
            </form>

        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php" ?>
