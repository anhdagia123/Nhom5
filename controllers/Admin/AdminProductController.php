<?php 
class AdminProductController {
     public function __construct(){
        $user = $_SESSION['user'] ?? [];
        if ( !$user || $user['role'] != 'admin' ){
            return header("location:" .  ROOT_URL);
        }
    }
public function index(){
    $product = (new Product)->all();
    $message = session_flash('message');
    return view('admin.product.list',compact('product','message'));
}
//  thêm
public function add(){
    $categories =(new Category)->all();
    return view('admin.product.add',compact('categories'));
}
 

    // lưu dữ liệu vào csdl
    public function store(){
        $data = $_POST;
        // nếu người dùng không nhập ảnh
        $image ='';
        // nếu người dùng nhập ảnh
        $file = $_FILES['image'];
        if($file['size'] >0){
            $image ='images/'. $file['name'];
            move_uploaded_file($file['tmp_name'], ROOT_DIR . $image );

        }
        // Đưa ảnh vào mảng data
        $data['image'] =$image;
        // lưu vào CSDL
        (new Product)->create($data);
        $_SESSION['message'] = "thêm dữ liệu thành công";
        header("location:" . ADMIN_URL . "?ctl=listsp" );
        die;
        
        
    }
    // form sửa
      public function edit(){
        $id = $_GET['id'];
        $product = (new Product)->find($id);
        $categories = (new Category)->all();

        // lấy session 
        $message = session_flash('message');


        return view('admin.product.edit',compact('product','categories','message'));
        
    }
// cập nhật 
      public function update(){
        $data = $_POST;

        // neu thay anh
        $file = $_FILES['image'];
        if ($file['size'] > 0) {
            $image = "images/" . $file['name'];
            move_uploaded_file($file['tmp_name'], ROOT_DIR . $image);

        //  cap nhat image vao mang data 
        $data['image'] = $image;
        }
        //  luu data vao csdl
        (new Product)->update($data['id'], $data);

        $_SESSION['message'] = 'Cap nhat du lieu thanh cong';

        header("Location: ". ADMIN_URL . "?ctl=editsp&id=" . $data['id']);
        die;
        
    }
    // xóa 
      public function delete(){
        $id = $_GET['id'];
        (new Product)->delete($id);
        $_SESSION['message'] = 'Xóa dữ liệu thành công';
        header('Location: ' . ADMIN_URL . '?ctl=listsp');
        die;
    }


}