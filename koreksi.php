<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Aplikasi Jaringan</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--end::Primary Meta Tags-->

    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <link rel="stylesheet" href="dist/css/fileupload.css" />
    <!-- load icons -->
    <link rel="stylesheet" href="dist/assets/icons/bootstrap-icons-1.11.3/font/bootstrap-icons.css" />
    <link href="dist/assets/plugins/sweetalert/dist/sweetalert2.min.css" rel="stylesheet">
</head>

<?php

session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

require_once('config/get_inquiry.php');


?>

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
                </ul>
                <!--end::Start Navbar Links-->
                <!--begin::End Navbar Links-->
                <ul class="navbar-nav ms-auto">
                    <!--begin::Fullscreen Toggle-->
                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen">
                            <i data-lte-icon="maximize" class="bi bi-arrows-fullscreen"></i>
                            <i data-lte-icon="minimize" class="bi bi-fullscreen-exit" style="display: none"></i>
                        </a>
                    </li>
                    <!--end::Fullscreen Toggle-->
                    <!--begin::User Menu Dropdown-->
                    <li class="nav-item dropdown user-menu">
                        <a href="profile.php" class="nav-link">
                            <?php if ($_SESSION['user']['pic']): ?>
                                <img src="uploads/<?= $_SESSION['user']['pic']; ?>" class="user-image rounded-circle shadow"
                                    alt="User Image" />
                            <?php else: ?>
                                <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                                    class="user-image rounded-circle shadow" alt="User Image" />
                            <?php endif; ?>
                            <span class="d-none d-md-inline"><?= $_SESSION['user']['username']; ?></span>
                        </a>
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
                <!--begin::Brand Link-->
                <a href="#" class="brand-link">
                    <!--begin::Brand Image-->
                    <img src="dist/assets/img/logo_kopin.png" alt="Logo" class="brand-image opacity-75 shadow" />
                    <!--end::Brand Image-->
                    <!--begin::Brand Text-->
                    <!--end::Brand Text-->
                </a>
                <!--end::Brand Link-->
            </div>

            <!--begin::Sidebar Wrapper-->
            <div class="sidebar-wrapper">

                <nav class="mt-1">
                    <!--begin::Sidebar Menu-->
                    <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item mb-1 p-2">

                            <div class="input-group flex-nowrap">

                                <input type="text" class="form-control" placeholder="Search" aria-label="Username"
                                    aria-describedby="addon-wrapping">
                                <button class="input-group-text search-btn" id="addon-wrapping"
                                    style="border-left: none;">
                                    <i class="bi bi-search"></i></button>
                            </div>

                        </li>
                        <?php if ($_SESSION['user']['role'] == 1): ?>
                            <li class="nav-item">
                                <a href="upload.php" class="nav-link">
                                    <i class="nav-icon bi bi-cloud-upload"></i>
                                    <p>Upload</p>
                                </a>
                            </li>
                        <?php endif; ?>
                        <li class="nav-item">
                            <a href="koreksi.php" class="nav-link active">
                                <i class="nav-icon bi bi-pencil-square"></i>
                                <p>Koreksi</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="tracking.php" class="nav-link">
                                <i class="nav-icon bi bi-graph-up-arrow"></i>
                                <p>Tracking</p>
                            </a>
                        </li>
                        <li class="nav-header">PENGATURAN</li>
                        <li class="nav-item">
                            <a href="profile.php" class="nav-link">
                                <i class="nav-icon bi bi-person-fill"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="logoutConfirm(this)">
                                <i class="nav-icon bi bi-arrow-left-square"></i>
                                <p>Sign Out</p>
                            </a>
                        </li>
                    </ul>
                    <!--end::Sidebar Menu-->
                </nav>
            </div>
            <!--end::Sidebar Wrapper-->
        </aside>
        <!--end::Sidebar-->
        <!--begin::App Main-->
        <main class="app-main">
            <!--begin::App Content Header-->
            <div class="app-content-header">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!--begin::Row-->
                    <div class="row">
                        <div class="col-sm-6">
                            <h3 class="mb-0">Koreksi</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Koreksi</li>
                            </ol>
                        </div>
                    </div>
                    <!--end::Row-->
                </div>
                <!--end::Container-->
            </div>
            <!--end::App Content Header-->
            <!--begin::App Content-->
            <div class="app-content">
                <!--begin::Container-->
                <div class="container-fluid">
                    <!-- /.row (main row) -->
                    <div class="d-flex justify-content-center">
                        <div class=" col-sm-6 mb-4 ">
                            <div class=" card card-secondary card-outline ">
                                <!--begin::Header-->
                                <div class=" card-header">
                                    <div class="card-title">
                                        <h5>Invalid</h5>
                                    </div>
                                </div>
                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body">
                                    <div>
                                        <h6 class="text-secondary mb-3">File : <?= $pdf['name']; ?></h6>
                                        <?php if ($inquiry['status'] == "in_process"): ?>
                                            <h6 class="text-secondary mb-3">Status : <span
                                                    class="badge rounded-pill text-bg-primary">In Process</span></h6>
                                        <?php else: ?>
                                            <h6 class="text-secondary mb-3">Status : <span
                                                    class="badge rounded-pill text-bg-success">Completed</span></h6>
                                        <?php endif; ?>
                                        <div class="progress mb-2" role="progressbar"
                                            aria-label="Warning striped example" aria-valuenow="75" aria-valuemin="0"
                                            aria-valuemax="100" style="border-radius:5px;">
                                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-warning"
                                                style="width: <?= $inquiry['progress']; ?>%; border-radius: 0.375rem">
                                                <?= $inquiry['progress']; ?>%
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <?php if (isset($inquiry['result'])): ?>
                                            <?php foreach ($inquiry['result'] as $r): ?>
                                                <?php if ($r['page_valid'] == false): ?>
                                                    <div class="col-md-12 mt-3 col-lg-12">
                                                        <img src="<?= $r['url']; ?>" class="img-fluid" alt="image">
                                                    </div>
                                                    <div class="col-md-12 mt-3 col-lg-12">
                                                        <img src="<?= $r['url']; ?>" class="img-fluid" alt="image">
                                                    </div>
                                                    <div class="col-md-12 mt-3 col-lg-12">
                                                        <img src="<?= $r['url']; ?>" class="img-fluid" alt="image">
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <div class="col-md-12 text-center">
                                                Data belum tersedia
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!--end::App Content-->
        </main>
        <!--end::App Main-->
        <!--begin::Footer-->
        <footer class="app-footer">
            <!--begin::To the end-->
            <div class="float-end d-none d-sm-inline"></div>
            <!--end::To the end-->
            <!--begin::Copyright-->
            <strong>
                Copyright &copy; 2025&nbsp;
            </strong>
            All rights reserved.
            <!--end::Copyright-->
        </footer>
        <!--end::Footer-->
    </div>
    <!--end::App Wrapper-->
    <!--begin::Script-->
</body>
<script src="dist/js/jquery.3.7.1.min.js"></script>
<script src="dist/assets/plugins/@popperjs/core/dist/umd/popper.min.js"></script>
<!--end::Required Plugin(popperjs for Bootstrap 5)--><!--be>
::Required Plugin(Bootstrap 5)-->
<script src="dist/js/bootstrap5.min.js"></script>
<!--end::Required Plugin(Bootstrap 5)--><!--begin::Required Plugin(AdminLTE)-->
<script src="dist/js/adminlte.js"></script>
<script src="dist/js/fileuploader.js"></script>
<script src="dist/assets/plugins/sweetalert/dist/sweetalert2.min.js"></script>
<script src="dist/js/auth.js"></script>



</html>