<?php
session_start();
require_once __DIR__ . "/../env.php";
require_once __DIR__ . "/../commom/function.php";
// models
require_once __DIR__ . "/../models/BaseModel.php";
require_once __DIR__ . "/../models/Category.php";
require_once __DIR__ . "/../models/Product.php";
require_once __DIR__ . "/../models/User.php";
require_once __DIR__ . "/../models/admin/orderModel.php";
// controller
require_once __DIR__ . "/../controllers/Admin/DashboardController.php";
require_once __DIR__ . "/../controllers/Admin/AdminCategoryController.php";
require_once __DIR__ . "/../controllers/Admin/AdminProductController.php";
require_once __DIR__ . "/../controllers/Admin/AuthController.php";
require_once __DIR__ . "/../controllers/Admin/AdminOrderController.php";

// lay bien ctl lam dieu khien
$ctl = $_GET['ctl'] ?? '';
match ($ctl) {
      // danh mục
      '' => (new DashboardController)->index(),
      'listdm' => (new AdminCategoryController)->index(),
      'adddm' => (new AdminCategoryController)->create(),
      'storedm' => (new AdminCategoryController)->store(),
      'editdm' => (new AdminCategoryController)->edit(),
      'updatedm' => (new AdminCategoryController)->update(),
      'deletedm' => (new AdminCategoryController)->delete(),
      // sản phẩm
      'listsp' => (new AdminProductController)->index(),
      'addsp' => (new AdminProductController)->add(),
      'storesp' => (new AdminProductController)->store(),
      'editsp' => (new AdminProductController)->edit(),
      'updatesp' => (new AdminProductController)->update(),
      'deletesp' => (new AdminProductController)->delete(),

      //Đơn hàng
      'list-order' => (new AdminOrderController)->index(),
      'order-detail' => (new AdminOrderController)->detail(),
      'update-order-status' => (new AdminOrderController)->updateOrderStatus(),
      'delete-order' => (new AdminOrderController)->delete(),
      default => die("404 - Không tìm thấy hành động phù hợp"),

      //  User
      'listuser' => (new AuthController)->index(),
      'updateuser' => (new AuthController)->updateActive(),
      '/' => (new AuthController)->logout(),
};