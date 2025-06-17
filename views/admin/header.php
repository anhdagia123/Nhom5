<?php $user = $_SESSION['user'] ?>
<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Admin - <?= $title ?? '' ?></title>
  <!--begin::Primary Meta Tags-->
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="AdminLTE v4 | Dashboard" />
  <meta name="author" content="ColorlibHQ" />
  <meta name="description"
    content="AdminLTE is a Free Bootstrap 5 Admin Dashboard, 30 example pages using Vanilla JS." />
  <meta name="keywords"
    content="bootstrap 5, bootstrap, bootstrap 5 admin dashboard, bootstrap 5 dashboard, bootstrap 5 charts, bootstrap 5 calendar, bootstrap 5 datepicker, bootstrap 5 tables, bootstrap 5 datatable, vanilla js datatable, colorlibhq, colorlibhq dashboard, colorlibhq admin dashboard" />
  <!--end::Primary Meta Tags-->
  <!--begin::Fonts-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fontsource/source-sans-3@5.0.12/index.css"
    integrity="sha256-tXJfXfp6Ewt1ilPzLDtQnJV4hclT9XuaZUKyUvmyr+Q=" crossorigin="anonymous" />
  <!--end::Fonts-->
  <!--begin::Third Party Plugin(OverlayScrollbars)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/overlayscrollbars@2.10.1/styles/overlayscrollbars.min.css"
    integrity="sha256-tZHrRjVqNSRyWg2wbppGnT833E/Ys0DHWGwT04GiqQg=" crossorigin="anonymous" />
  <!--end::Third Party Plugin(OverlayScrollbars)-->
  <!--begin::Third Party Plugin(Bootstrap Icons)-->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"
    integrity="sha256-9kPW/n5nn53j4WMRYAxe9c1rCY96Oogo/MKSVdKzPmI=" crossorigin="anonymous" />
  <!--end::Third Party Plugin(Bootstrap Icons)-->
  <!--begin::Required Plugin(AdminLTE)-->
  <link rel="stylesheet" href="<?= ADMIN_URL . 'public/dist/css/adminlte.css' ?> " />
  <!--end::Required Plugin(AdminLTE)-->
  <!-- apexcharts -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.37.1/dist/apexcharts.css"
    integrity="sha256-4MX+61mt9NVvvuPjUWdUdyfZfxSB1/Rf9WtqRHgG5S0=" crossorigin="anonymous" />
  <!-- jsvectormap -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/jsvectormap@1.5.3/dist/css/jsvectormap.min.css"
    integrity="sha256-+uGLJmmTKOqBr+2E6KDYs/NRsHxSkONXFHUL0fy2O/4=" crossorigin="anonymous" />
</head>
<!--end::Head-->
<!--begin::Body-->

<body class="layout-fixed sidebar-expand-lg bg-body-tertiary">
  <!--begin::App Wrapper-->
  <div class="app-wrapper">
    <!--begin::Header-->
    <nav class="app-header navbar navbar-expand bg-body">
      <!--begin::Container-->
      <div class="container-fluid">
        <!--begin::Start Navbar Links-->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link" data-lte-toggle="sidebar" href="#" role="button">
              <i class="bi bi-list"></i>
            </a>
          </li>
          <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Home</a></li>
          <li class="nav-item d-none d-md-block"><a href="#" class="nav-link">Contact</a></li>
        </ul>
        <!--end::Start Navbar Links-->
        <!--begin::End Navbar Links-->
        <ul class="navbar-nav ms-auto">


          <!--begin::User Menu Dropdown-->
          <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
              <?php if (!empty($user['avatar'])): ?>
                <img src="<?= htmlspecialchars($user['avatar']) ?>" class="user-image rounded-circle shadow"
                  alt="User Image" />
              <?php endif; ?>

              <span class="d-none d-md-inline"><?= htmlspecialchars($_SESSION["user"]['fullname']) ?></span>
            </a>

            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
              <!--begin::User Image-->
              <li class="user-header text-bg-primary text-center py-4">
                <div class="mx-auto mb-2" style="width: 100px; height: 100px;">
                  <?php if (!empty($user['avatar'])): ?>
                    <img src="<?= htmlspecialchars($user['avatar']) ?>"
                      class="rounded-circle shadow w-100 h-100 object-fit-cover" alt="User Image" />
                  <?php else: ?>
                    <div class="bg-light rounded-circle w-100 h-100 d-flex align-items-center justify-content-center">
                      <i class="text-secondary">No Avatar</i>
                    </div>
                  <?php endif; ?>
                </div>

                <p class="mt-2 text-light fw-bold mb-0"><?= htmlspecialchars($user['fullname']) ?></p>
                <small class="text-light"><?= htmlspecialchars($user['email']) ?></small>
              </li>

              <!--end::User Image-->
              <!--begin::Menu Footer-->
              <li class="user-footer text-center">
                <a href="?ctl=profile" class="btn btn-default btn-flat">Profile</a>
              </li>
              <!--end::Menu Footer-->
            </ul>
          </li>
          <!--end::User Menu Dropdown-->
        </ul>
        <!--end::End Navbar Links-->
      </div>
      <!--end::Container-->
    </nav>

    <!--end::Header-->
    <!--begin::Sidebar-->
    <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
      <!--begin::Sidebar Brand-->
      <div class="sidebar-brand">
        <a href="<?= ADMIN_URL ?>" class="brand-link">
          <!-- <img src="<?= ADMIN_URL ?>public/dist/assets/img/AdminLTELogo.png" alt="AdminLTE Logo"
            class="brand-image opacity-75 shadow" /> -->
          <span class="brand-text fw-light">Dashboard</span>
        </a>
      </div>
      <!--end::Sidebar Brand-->
      <div class="sidebar-wrapper">
        <nav class="mt-2">
          <ul class="nav sidebar-menu flex-column" role="menu">
            <li class="nav-item">
              <a href="<?= ADMIN_URL ?>" class="nav-link">
                <i class="nav-icon bi bi-speedometer"></i>
                <p>Dashboard</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= ADMIN_URL . '?ctl=listdm' ?>" class="nav-link">
                <i class="nav-icon bi bi-list-ul"></i>
                <p>Danh Mục</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= ADMIN_URL . '?ctl=listsp' ?>" class="nav-link">
                <i class="nav-icon bi bi-box-seam"></i>
                <p>Sản Phẩm</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= ADMIN_URL . '?ctl=listuser' ?>" class="nav-link">
                <i class="nav-icon bi bi-person"></i>
                <p>Tài khoản</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= ADMIN_URL . '?ctl=listcomment' ?>" class="nav-link">
                <i class="nav-icon bi bi-chat-dots"></i>
                <p>Bình luận</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= ADMIN_URL . '?ctl=list-order' ?>" class="nav-link">
                <i class="nav-icon bi bi-receipt"></i>
                <p>Đơn hàng</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="<?= ADMIN_URL . '?ctl=/' ?>" class="nav-link">
                <i class="nav-icon bi bi-box-arrow-right"></i>
                <p>Đăng xuất</p>
              </a>
            </li>
          </ul>
        </nav>
      </div>
    </aside>

    <!--end::Sidebar-->
    <!--begin::App Main-->
    <main class="app-main">
      <!--begin::App Content Header-->
      <div class="p-3">
      </div>
      <!--end::App Content Header-->
      <!--begin::App Content-->
      <div class="app-content"></div>