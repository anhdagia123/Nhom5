<?php include_once ROOT_DIR . "views/clients/header.php"   ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

        <div class="container">
            <h2>Đăng ký</h2>
            <form action="<?= ROOT_URL . '?ctl=register' ?>" method="POST">
                <div class="mb-3">
                    <label for="fullname" class="form-label">Họ Tên</label>
                    <input type="text" class="form-control " name="fullname" placeholder="Nhập họ tên">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Nhập email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật Khẩu</label>
                    <input type="password" class="form-control" name="password" placeholder="Nhập password">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" name="address" placeholder="Nhập Địa chỉ">
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
            </form>
        </div>
        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"   ?>