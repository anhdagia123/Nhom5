<?php include_once ROOT_DIR . "views/clients/header.php"; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">

            <h2>Đăng ký</h2>
            <form action="<?= ROOT_URL . '?ctl=register' ?>" method="POST" novalidate>
                <div class="mb-3">
                    <label for="fullname" class="form-label">Họ Tên</label>
                    <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Nhập họ tên" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Nhập email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Mật Khẩu</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Nhập mật khẩu" required>
                </div>
                <div class="mb-3">
                    <label for="phone" class="form-label">Số điện thoại</label>
                    <input type="tel" class="form-control" id="phone" name="phone" placeholder="Nhập số điện thoại" pattern="[0-9]{9,15}" title="Chỉ nhập số, từ 9 đến 15 ký tự" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Địa chỉ</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Nhập địa chỉ" required>
                </div>
                <button type="submit" class="btn btn-primary w-100">Đăng ký</button>
            </form>

        </div>
    </div>
</div>

<?php include_once ROOT_DIR . "views/clients/footer.php"; ?>
