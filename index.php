<?php 
session_start();
require_once __DIR__ . "/env.php";
require_once __DIR__ . "/commom/function.php";

//  models
require_once __DIR__ . "/models/BaseModel.php";
require_once __DIR__ . "/models/Product.php";
require_once __DIR__ . "/models/Category.php";
require_once __DIR__ . "/models/User.php";
require_once __DIR__ . "/models/Order.php";
require_once __DIR__ . "/models/CommentModel.php";


// controllers
require_once __DIR__ . "/controllers/HomeController.php";
require_once __DIR__ . "/controllers/ProductController.php";
require_once __DIR__ . '/controllers/CartController.php';
require_once __DIR__ . "/controllers/Admin/AuthController.php";
require_once __DIR__ . "/controllers/OrderController.php";
$ctl = $_GET['ctl'] ?? '';

match($ctl) {
    '' => (new HomeController)->index(),
    'all-products' => (new HomeController)->allProducts(),
    'category' => (new ProductController)->list(),
    'detail' => (new ProductController)->show(),
    'register' => (new AuthController)->register(),
    'login' => (new AuthController)->login(),
    'logout' => (new AuthController)->logout(),
    'add-cart' => (new CartController)->addToCart(),
    'view-cart' => (new CartController)->viewCart(),
    'update-cart' => (new CartController)->updateCart(),
    'delete-cart' => (new CartController)->deleteCart(),
    'view-checkout' => (new CartController)->viewCheckout(),
    'checkout' => (new CartController)->checkOut(),
    'success' => (new CartController)->success(),
    'my-orders' => (new OrderController)->myOrders(),
    'order-detail' => (new OrderController)->orderDetail(),
    'confirm-order' => (new OrderController)->confirmOrder(),
    default => (new HomeController)->index(),
};
