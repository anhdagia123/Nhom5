<?php 
session_start();
require_once __DIR__ . "/../env.php";
require_once __DIR__ . "/../commom/function.php";
// models
require_once __DIR__ ."/../models/BaseModel.php";
require_once __DIR__ ."/../models/Category.php";
require_once __DIR__ ."/../models/Product.php";   
<<<<<<< HEAD
require_once __DIR__ ."/../models/User.php";   
require_once __DIR__ ."/../models/Order.php"; 
=======
>>>>>>> 429314e459d02f5fe13ff411b5c5882dacb6eced
// controller
require_once __DIR__."/../controllers/Admin/DashboardController.php";
require_once __DIR__."/../controllers/Admin/AdminCategoryController.php";
require_once __DIR__."/../controllers/Admin/AdminProductController.php";
require_once __DIR__."/../controllers/Admin/AuthController.php";
<<<<<<< HEAD
require_once __DIR__."/../controllers/OrderController.php";
=======
>>>>>>> 429314e459d02f5fe13ff411b5c5882dacb6eced
// lay bien ctl lam dieu khien
$ctl = $_GET['ctl'] ??'';
match ($ctl) {
     // danh mục
     ''=> (new DashboardController)->index(),
     'listdm'=>(new AdminCategoryController)->index(),
     'adddm'=>(new AdminCategoryController)->create(),
     'storedm'=>(new AdminCategoryController)->store(),
     'editdm'=>(new AdminCategoryController)->edit(),
     'updatedm'=>(new AdminCategoryController)->update(),
     'deletedm' =>(new AdminCategoryController)->delete(),
     // sản phẩm
     'listsp'=>(new AdminProductController)->index(),
     'addsp'=>(new AdminProductController)->add(),
     'storesp'=>(new AdminProductController)->store(),
     'editsp'=>(new AdminProductController)->edit(),
     'updatesp'=>(new AdminProductController)->update(),
     'deletesp'=>(new AdminProductController)->delete(),
     
     
      default => die("404 - Không tìm thấy hành động phù hợp"),
<<<<<<< HEAD

       //  User
      'listuser' => (new AuthController)->index(),
      'updateuser' => (new AuthController)->updateActive(),

      // Order
      'list-order' => (new OrderController)->index(),
=======
>>>>>>> 429314e459d02f5fe13ff411b5c5882dacb6eced
};