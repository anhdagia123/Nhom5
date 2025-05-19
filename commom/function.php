<?php 
// hàm view  dùng để render view
function view($path_view, $data=[]){
    extract($data);
// thay the dau . thanh dau /

$path_view = str_replace(".","/",$path_view);
// include
include_once ROOT_DIR ."views/$path_view.php";
}
// ham dd de debug
function dd($data){
    echo "<pre>";
    var_dump($data);
    echo "</pre>";
}
