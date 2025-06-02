<?php 
// hàm view  dùng để render view
function view($path_view, $data=[]){
    extract($data);
// thay the dau . thanh dau /

$path_view = str_replace(".","/",$path_view);
// include
include_once ROOT_DIR ."/views/$path_view.php";
}
// ham dd de debug
function dd($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
    die;
}
// ham session_flash huy session ngay lập tức
function session_flash($key){
    $message = $_SESSION[$key] ?? '';
    unset($_SESSION[$key]);
    return $message;
<<<<<<< HEAD
}
// chuyển đổi trạng thái đơn hàng
function translate_status($status){
    $status_details = [
        1 => 'Chờ xử lý',
        2 => 'Đang xử lý',
        3 => 'Hoàn thành',
        4 => 'Đã hủy',
    ];
    return $status_details[$status];
=======
>>>>>>> 429314e459d02f5fe13ff411b5c5882dacb6eced
}