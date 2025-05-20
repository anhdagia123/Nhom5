<?php 
class AdminProductController {
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

        
    }
// cập nhật 
      public function update(){

        
    }
    // xóa 
      public function delete(){

        
    }


}