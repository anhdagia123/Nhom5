<?php include_once ROOT_DIR . "views/admin/header.php" ?>

  <style>
    .profile-avatar {
      width: 100%;
      max-width: 150px;
      height: 150px;
      object-fit: cover;
      border-radius: 50%;
    }
  </style>

<div class="container">
  <div class="card shadow">
    <div class="card-header bg-primary text-white">
      <h4 class="mb-0">Chỉnh sửa thông tin cá nhân</h4>
    </div>
    <div class="card-body">
      <form action="?ctl=update-profile" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $user['id'] ?>">

        <div class="row mb-4 display-flex align-items-center">
          <div class="col-md-4 text-center">
            <img src="<?= $user['avatar'] ? $user['avatar'] : 'default-avatar.png' ?>" class="profile-avatar mb-2" alt="Avatar">
            <div class="mb-2">
              <label class="form-label">Ảnh đại diện</label>
              <input type="file" name="avatar" class="form-control">
            </div>
          </div>

          <div class="col-md-8">
            <div class="row">
              <div class="col-md-8 mb-3">
                <label class="form-label">Họ tên</label>
                <input type="text" class="form-control" value="<?= htmlspecialchars($user['fullname']) ?>" disabled>
              </div>
              <div class="col-md-8 mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" disabled>
              </div>
              <div class="col-md-8 mb-3">
                <label class="form-label">Số điện thoại</label>
                <input type="text" class="form-control" name="phone" value="<?= htmlspecialchars($user['phone']) ?>" required>
              </div>
              <div class="col-md-8 mb-3">
                <label class="form-label">Địa chỉ</label>
                <input type="text" class="form-control" name="address" value="<?= htmlspecialchars($user['address']) ?>" required>
              </div>
            </div>
          </div>
        </div>

        <div class="text-end">
          <button type="submit" class="btn btn-success">Cập nhật</button>
        </div>
      </form>
    </div>
  </div>
</div>


<?php include_once ROOT_DIR . "views/admin/footer.php"; ?>