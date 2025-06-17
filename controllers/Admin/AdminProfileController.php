<?php

class AdminProfileController
{
    public function __construct()
    {
        $user = $_SESSION['user'] ?? [];
        if (!$user || $user['role'] != 'admin') {
            header("Location: " . ADMIN_URL);
            exit;
        }
    }

    public function index()
    {
        $user = $_SESSION['user'];
        return view('admin.profile.update', compact('user'));
    }

    public function update()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $phone = trim($_POST['phone'] ?? '');
            $address = trim($_POST['address'] ?? '');
            $avatar = $_FILES['avatar'] ?? null;

            // Kiểm tra bắt buộc
            if (empty($phone) || empty($address)) {
                $_SESSION['message'] = 'Vui lòng điền đầy đủ số điện thoại và địa chỉ.';
                header('Location: ' . ADMIN_URL . '?ctl=profile');
                exit;
            }

            $userModel = new User();
            $avatarPath = null;

            // Xử lý ảnh đại diện
            if ($avatar && $avatar['error'] === UPLOAD_ERR_OK) {
                $uploadDir = 'uploads/avatars/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $ext = pathinfo($avatar['name'], PATHINFO_EXTENSION);
                $fileName = 'avatar_' . $_SESSION['user']['id'] . '_' . time() . '.' . $ext;
                $fullPath = $uploadDir . $fileName;

                if (move_uploaded_file($avatar['tmp_name'], $fullPath)) {
                    $avatarPath = $fullPath;
                } else {
                    $_SESSION['message'] = 'Tải ảnh đại diện thất bại.';
                    header('Location: ' . ADMIN_URL . '?ctl=profile');
                    exit;
                }
            }

            // Cập nhật thông tin
            $result = $userModel->updateInfo($_SESSION['user']['id'], $phone, $address, $avatarPath);

            if ($result) {
                $_SESSION['message'] = 'Cập nhật thành công.';
                $_SESSION['user']['phone'] = $phone;
                $_SESSION['user']['address'] = $address;
                if ($avatarPath) {
                    $_SESSION['user']['avatar'] = $avatarPath;
                }
            } else {
                $_SESSION['message'] = 'Cập nhật thất bại. Vui lòng thử lại.';
            }

            header('Location: ' . ADMIN_URL . '?ctl=profile');
            exit;
        }
    }
}
