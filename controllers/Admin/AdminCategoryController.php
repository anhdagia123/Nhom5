<?php
class AdminCategoryController {
<<<<<<< HEAD
     public function __construct(){
        $user = $_SESSION['user'] ?? [];
        if ( !$user || $user['role'] != 'admin' ){
            return header("location:" .  ROOT_URL);
        }
    }
=======
>>>>>>> 429314e459d02f5fe13ff411b5c5882dacb6eced
    public function index() {
        $categories = (new Category)->all();
        // lấy thông báo từ session
        $message = session_flash('message');
        return view('admin.categories.list', compact('categories', 'message'));
    }

    public function create() {
        // lấy thông báo nếu có
        $message = session_flash('message');
        return view('admin.categories.add', compact('message'));
    }

    // lưu trữ dữ liệu thêm vào csdl 
    public function store() {
        $data = $_POST;
        (new Category)->create($data);
        // lưu thông báo vào session
        $_SESSION['message'] = "Thêm dữ liệu thành công";
        // chuyển hướng về danh sách
        header("Location: " . ADMIN_URL . "?ctl=listdm");
        exit;
    }

    // hiển thị form edit
    public function edit() {
        $id = $_GET['id'];
        $category = (new Category)->find($id);
        // lấy session thông báo
        $message = session_flash('message');
        return view('admin.categories.edit', compact('category', 'message'));
    }

    // update 
    public function update() {
        $data = $_POST;
        (new Category)->update($data['id'], $data);
        $_SESSION['message'] = "Cập nhật dữ liệu thành công";
        header("Location: " . ADMIN_URL . "?ctl=editdm&id=" . $data['id']);
        exit;
    }

    // xóa 
    public function delete() {
        $id = $_GET['id'];
        // kiểm tra xem có dữ liệu của product thuộc category không
        $products = (new Product)->listProductInCategory($id);
        if ($products) {
            $_SESSION['message'] = "Không thể xóa, vì có sản phẩm của danh mục";
            header("Location: " . ADMIN_URL . "?ctl=listdm");
            exit;
        }

        // xóa
        (new Category)->delete($id);
        $_SESSION['message'] = "Xóa dữ liệu thành công";
        header("Location: " . ADMIN_URL . "?ctl=listdm");
        exit;
    }
}
