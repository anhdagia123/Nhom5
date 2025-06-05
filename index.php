<?php 
session_start();
require_once __DIR__ . "/env.php";
require_once __DIR__ . "/commom/function.php";

// Models
require_once __DIR__ . "/models/BaseModel.php";
require_once __DIR__ . "/models/Product.php";
require_once __DIR__ . "/models/Category.php";
require_once __DIR__ . "/models/User.php";
require_once __DIR__ . "/models/Order.php";

// Controllers
require_once __DIR__ . "/controllers/HomeController.php";
require_once __DIR__ . "/controllers/ProductController.php";
require_once __DIR__ . "/controllers/Admin/AuthController.php";
require_once __DIR__ . "/controllers/CartController.php";

$ctl = $_GET['ctl'] ?? '';

match($ctl) {
    '' => (new HomeController)->index(),
    'category' => (new ProductController)->list(),
    'detail' => (new ProductController)->show(),
    'register' => (new AuthController)->register(),
    'login' => (new AuthController)->login(),
    'logout' => (new AuthController)->logout(),
    'add-cart' => (new CartController)->addToCart(),
    'view-cart' => (new CartController)->viewCart(),
    'delete-cart' => (new CartController)->deleteCart(),
    'update-cart' => (new CartController)->updateCart(),
    'view-checkout' => (new CartController)->viewCheckout(),
    'checkout' => (new CartController)->checkOut(),
    'success' => (new CartController)->success(),
    default => (new HomeController)->index(), // Trường hợp không khớp
};
