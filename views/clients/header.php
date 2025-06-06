
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ban Hang - <?= $title ?? '' ?></title>
    <link rel="stylesheet" href="./css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body>
<div class="container-fluid px-0">
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm py-3">
        <div class="container">
            <!-- Logo -->
            <a class="navbar-brand fw-bold fs-3 text-primary" href="<?= ROOT_URL ?>">LOGO</a>
            <!-- Toggle button for mobile -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- Navbar content -->
            <div class="collapse navbar-collapse" id="mainNavbar">
                <!-- Left: Navigation -->
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link<?= ($_GET['ctl'] ?? '') == '' ? ' active' : '' ?>" href="<?= ROOT_URL ?>">Trang chủ</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Giới thiệu</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="productDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sản phẩm
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="productDropdown">
                            <li>
                                <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=all-products' ?>">Tất cả sản phẩm</a>
                            </li>
                            <?php foreach($categories as $cate): ?>
                                <li>
                                    <a class="dropdown-item" href="<?= ROOT_URL . '?ctl=category&id=' . $cate['id'] ?>">
                                        <?= htmlspecialchars($cate['cate_name']) ?>
                                    </a>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </li>
                </ul>
                <!-- Right: Search, Cart, Account -->
                <form action="<?= ROOT_URL ?>" method="get" class="d-flex me-3" role="search">
                    <input class="form-control me-2" type="search" name="search" placeholder="Tìm sản phẩm..." aria-label="Search" value="<?= isset($_GET['search']) ? htmlspecialchars($_GET['search']) : '' ?>">
                    <button class="btn btn-outline-primary" type="submit"><i class="fa fa-search"></i></button>
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0 align-items-lg-center">
                    <li class="nav-item me-2">
                        <a class="nav-link position-relative" href="<?= ROOT_URL . '?ctl=view-cart'?>">
                            <i class="fa fa-shopping-cart fa-lg"></i>
                            <span class="d-none d-lg-inline">Giỏ hàng</span>
                        </a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="accountDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fa-solid fa-user me-1"></i>
                            <span><?= $_SESSION['user']['fullname'] ?? 'Tài khoản' ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="accountDropdown">
                            <?php if (isset($_SESSION['user'])): ?>
                                <li><a class="dropdown-item" href="<?= ROOT_URL ?>">Hồ sơ</a></li>
                                <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=my-orders' ?>">Đơn hàng của tôi</a></li>
                                <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=logout' ?>">Đăng xuất</a></li>
                            <?php else: ?>
                                <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=login' ?>">Đăng nhập</a></li>
                                <li><a class="dropdown-item" href="<?= ROOT_URL . '?ctl=register' ?>">Đăng ký</a></li>
                            <?php endif ?>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
