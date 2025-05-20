<?php 
// Class BaseModel chứa thông tin kết nối
class BaseModel {
    // Biến $conn lưu trữ thông tin kết nối
    public $conn = null;
    // khàm khởi tạo
    public function __construct()
{
    try{
        $this->conn = new PDO("mysql:host=" . HOST . "; dbname= ". DBNAME ."; charset=utf8; port=" .
         PORT , USERNAME, PASSWORD );
    }catch(PDOException $e){
        echo "Lỗi kết nối cơ sở dữ liệu :" . $e->getMessage();
    }
}
}