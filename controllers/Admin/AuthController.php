<?php

class AuthController
{
    // Đăng ký
    public function register()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            // Mã hóa passwordpassword
            $password = $_POST['password'];
            $password = password_hash($password, PASSWORD_DEFAULT);
            // đưa vào data
            $data['password'] = $password;

            (new User)->create($data);
            // thông báo
            $_SESSION['message'] = 'Đăng ký thành công';
            header("Location:" . ROOT_URL . "?ctl=login");
            die;
        }
        return view('clients.users.register');
    }
    //Đăng nhập
    public function login()
    {
        if (isset($_SESSION['user'])) {
            header("location: " . ROOT_URL);
            die;
        }
        $error = null;
        if ($_SERVER['REQUEST_METHOD'] === "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = (new User)->findUserOfEmail($email);
            // Kiểm tra mật khẩu
            if ($user) {
                if (password_verify($password, $user['password'])) {
                    $_SESSION['user'] = $user;
                    if ($user['role'] == 'admin') {
                        header("Location: " . ADMIN_URL);
                        die;
                    }
                    header("Location: " . ROOT_URL);
                    die;
                } else {
                    $error = "Email hoặc Mật khẩu không đúng";
                }

            } else {
                $error = "Email hoặc Mật khẩu không đúng";
            }
        }
        $message = session_flash('message');
        return view('clients.users.login', compact('message', 'error'));
    }
    //Đăng xuất
    public function logout()
    {
        unset($_SESSION['user']);
        $_SESSION['message'] = 'Đăng xuất thành công';
        header('Location: ' . ROOT_URL . '?ctl=login');
        exit;
    }

    public function index()
    {
        $userModel = new User();
        $limit = 5; // Số user mỗi trang
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;
        $offset = ($page - 1) * $limit;

        $users = $userModel->paginate($limit, $offset);
        $totalUsers = $userModel->countAll();
        $totalPages = ceil($totalUsers / $limit);

        return view('admin.users.list', compact('users', 'page', 'totalPages'));
    }

    public function updateActive()
    {
        $data = $_POST;

        $data['active'] = $data['active'] ? 0 : 1;

        (new User)->updateActive($data['id'], $data['active']);
        return header('Location: ' . ADMIN_URL . '?ctl=listuser');

    }


}