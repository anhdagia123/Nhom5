<?php
 class AdminCategoryController {
    public function index() {
        $categories = (new Category)->all();
        // lay thong bao tu session
        $message = $_SESSION['message'] ?? '';

        // xoa SESSION
        unset($_SESSION['message']);
        return view('admin.categories.list', compact('categories', 'message'));
    }
    public function create(){
        return view('admin.categories.add');
    }
    // lưu trữ dữ liệu thêm vào csdl 
    public function store(){
        $data = $_POST;
        (new Category)->create($data);
        // luu thong bao vao session
        $_SESSION['message'] ="them du lieu thanh cong";
        // chuyen huong ve danh sach
        header("location: " . ADMIN_URL . "?ctl=listdm");
    }
 }