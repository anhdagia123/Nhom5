<?php
 class AdminCategoryController {
    public function index() {
        $categories = (new Category)->all();
        // lay thong bao tu session
        $message = $_SESSION['message'] ?? '';
        $message = session_flash('message');
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
    // hiển thị form edit
    public function edit(){
        $id = $_GET['id'];
        $category = (new Category)->find($id);
        //  lấy session thông báo
        $message = session_flash('message');
        return view('admin.categories.edit', compact('category','message'));
    }
    // update 
    public function update(){
        $data =$_POST;
        (new Category)->update($data['id'],$data);
        $_SESSION['message']="Cập nhật dữ liệu thành công";
        header("location: " .ADMIN_URL . '?ctl=editdm&id=' .$data['id']);
    }
    // xóa 
    public function delete(){
        $id = $_GET['id'];
        // kiểm tra xem có dữ liệu của product thuộc category không
        $products = (new Product)->listProductInCategory($id);
        if($products){
            $_SESSION['message'] = " Không thể xóa, vì có sản phẩm của danh mục ";
            header("location: " . ADMIN_URL . "?ctl=listdm");
            return;
        }

        // xóa
        (new Category)->delete($id);
         $_SESSION['message'] = " Xóa dữ liệu thành công ";
            header("location: " . ADMIN_URL . "?ctl=listdm");
            return;

    }
 }