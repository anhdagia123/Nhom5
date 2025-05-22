<?php 

require_once __DIR__ . "/env.php";
require_once __DIR__ . "/commom/function.php";

//  models
require_once __DIR__ . "/models/BaseModel.php";
require_once __DIR__ . "/models/Product.php";
require_once __DIR__ . "/models/Category.php";

// controllers
require_once __DIR__ . "/controllers/HomeController.php";

$ctl = $_GET['ctl'] ?? '';

match($ctl) {
    '' =>(new HomeController)->index(),
};
