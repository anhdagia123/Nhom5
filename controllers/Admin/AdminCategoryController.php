<?php
class AdminCategoryController {

     public function __construct(){
        $user = $_SESSION['user'] ?? [];
        if ( !$user || $user['role'] != 'admin' ){
            return header("location:" .  ROOT_URL);
        }
    }
    public function index()
    {
        $categoryModel = new Category();
        $limit = 5; // Số danh mục mỗi trang
        $page = isset($_GET['page']) ? (int) $_GET['page'] : 1;
        if ($page < 1)
            $page = 1;
        $offset = ($page - 1) * $limit;

        $categories = $categoryModel->paginate($limit, $offset);
        $totalCategories = $categoryModel->countAll();
        $totalPages = ceil($totalCategories / $limit);

        $message = session_flash('message');
        return view('admin.categories.list', compact('categories', 'message', 'page', 'totalPages'));
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
