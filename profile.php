<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
}

$profile_update = isset($_SESSION['profile_update']) ? $_SESSION['profile_update'] : "";
unset($_SESSION['profile_update']);

require_once "config/profile_activity.php";
?>

<!doctype html>
<html lang="en">
<!--begin::Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Aplikasi Jaringan</title>
    <!--begin::Primary Meta Tags-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!--end::Primary Meta Tags-->


    <!-- load icons -->
    <link rel="stylesheet" href="dist/assets/icons/bootstrap-icons-1.11.3/font/bootstrap-icons.css" />
    <link href="dist/assets/plugins/sweetalert/dist/sweetalert2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="dist/css/adminlte.css" />
    <link rel="stylesheet" href="dist/css/fileupload.css" />


</head>

<style>
    .img-thumbnail {
        padding: 0.25rem;
        background-color: var(--bs-body-bg);
        border: var(--bs-border-width) solid var(--bs-border-color);
        border-radius: var(--bs-border-radius);
        box-shadow: var(--bs-box-shadow-sm);
        width: 100%;
        height: 300px;
        object-fit: contain;
    }
</style>

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
                    <img src="dist/assets/img/logo_kopin.png" alt="AdminLTE Logo"
                        class="brand-image opacity-75 shadow" />
                    <!--end::Brand Image-->
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

                                <input class="form-control" type="search" placeholder="Search" aria-label="Search" />
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
                            <a href="koreksi.php" class="nav-link">
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
                            <a href="profile.php" class="nav-link active">
                                <i class="nav-icon bi bi-person-fill"></i>
                                <p>Profile</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link" onclick="logoutConfirm($(this).parent())">
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
                            <h3 class="mb-0">Profile</h3>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Upload</li>
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
                <div class="container">
                    <div class="card">
                        <!-- /.row (main row) -->
                        <div class="card-body">
                            <div class="row">

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-3 p-4"><!--left col-->
                                <div class="mb-3">
                                    <div class="text-center">
                                        <h4 class="mb-3"><?= $_SESSION['user']['name']; ?></h4>
                                        <?php if (!$_SESSION['user']['pic']): ?>
                                            <img src="http://ssl.gstatic.com/accounts/ui/avatar_2x.png"
                                                class="avatar img-circle img-thumbnail" alt="avatar">
                                        <?php else: ?>
                                            <img src="uploads/<?= $_SESSION['user']['pic']; ?>"
                                                class="avatar img-circle img-thumbnail" alt="avatar">
                                        <?php endif; ?>
                                    </div>


                                    <div class="text-center mt-2" id="fileNameChange" style="display:none;">

                                    </div>

                                    <div class="text-center mt-2">
                                        <button class="upload-btn" id="upload-avatar">Ubah Foto</button>
                                    </div>
                                </div>





                            </div><!--/col-3-->
                            <div class="col-sm-9">
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">

                                    <button class="nav-link text-dark active" id="nav-profile-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-profile" type="button" role="tab"
                                        aria-controls="nav-profile" aria-selected="false">
                                        Profile
                                    </button>
                                    <button class="nav-link text-dark" id="nav-contact-tab" data-bs-toggle="tab"
                                        data-bs-target="#nav-contact" type="button" role="tab"
                                        aria-controls="nav-contact" aria-selected="false">
                                        Activity
                                    </button>
                                </div>

                                <div class="tab-content" id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-profile" role="tabpanel"
                                        aria-labelledby="nav-profile-tab">

                                        <form class="mt-2" action="config/profile_update" method="POST"
                                            enctype="multipart/form-data">
                                            <input type="hidden" name="user_id" value="<?= $_SESSION['user']['id']; ?>">
                                            <input type="file" name="pic" style="display:none;" id="input-upload-avatar"
                                                accept=".png, .jpg, .jpeg">
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <?php if ($profile_update): ?>
                                                    <?php if ($profile_update['status'] == "success"): ?>
                                                        <div class="alert alert-success mt-2" role="alert">
                                                            <?= $profile_update['message']; ?>
                                                        </div>
                                                    <?php else: ?>
                                                        <div class="alert alert-danger mt-2" role="alert">
                                                            <?= $profile_update['message']; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                <?php endif; ?>
                                                <div class="row g-3">
                                                    <!--begin::Col-->

                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <label for="validationCustom02" class="form-label">
                                                            Nama</label>
                                                        <input type="text" class="form-control" id="validationCustom02"
                                                            value="<?= $_SESSION['user']['name']; ?>"
                                                            required="required" placeholder="Masukkan nama lengkap"
                                                            name="name">
                                                        <div class="valid-feedback">Masukkan nama lengkap</div>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <label for="validationCustomUsername"
                                                            class="form-label">Email</label>
                                                        <div class="input-group has-validation">
                                                            <input type="email" class="form-control"
                                                                id="validationCustomUsername"
                                                                aria-describedby="inputGroupPrepend" required="required"
                                                                placeholder="Masukkan email"
                                                                value="<?= $_SESSION['user']['email']; ?>" name="email">
                                                            <div class="invalid-feedback">Masukkan email
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <label for="validationCustom03"
                                                            class="form-label">Telepon</label>
                                                        <input type="text" class="form-control" id="validationCustom03"
                                                            required="" placeholder="Nomor nomor telepon"
                                                            value="<?= $_SESSION['user']['telephone']; ?>"
                                                            name="telephone">
                                                        <div class="invalid-feedback">Masukkan nomor telepon</div>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6">
                                                        <label for="validationCustom03"
                                                            class="form-label">Handphone</label>
                                                        <input type="text" class="form-control" id="validationCustom03"
                                                            required="required" placeholder="Masukka nomor handphone"
                                                            value="<?= $_SESSION['user']['handphone']; ?>"
                                                            name="handphone">
                                                        <div class="invalid-feedback">Masukkan nomor handphone</div>
                                                    </div>
                                                    <!--end::Col-->

                                                    <!--begin::Col-->
                                                    <div class="col-md-12">
                                                        <label for="validationCustom03"
                                                            class="form-label">Alamat</label>
                                                        <textarea name="address" id="" class="form-control" rows="5"
                                                            placeholder="Tuliskan alamat"><?= $_SESSION['user']['address']; ?></textarea>
                                                    </div>
                                                    <!--end::Col-->

                                                    <!--begin::Col-->
                                                    <div class="col-12 text-end">
                                                        <button class="btn btn-outline-secondary" type="reset"> Reset
                                                        </button>
                                                        <button class="btn btn-success" type="submit">Save</button>
                                                    </div>

                                                    <!--end::Col-->
                                                </div>
                                            </div>




                                        </form>
                                    </div>
                                    <div class="tab-pane fade" id="nav-contact" role="tabpanel"
                                        aria-labelledby="nav-contact-tab">
                                        <div class="col-md-12 mt-4">
                                            <!-- The time line -->


                                            <?php if (count($pdf) > 0): ?>
                                                <div class="timeline">
                                                    <!-- timeline time label -->

                                                    <!-- /.timeline-label -->

                                                    <!-- timeline item -->
                                                    <?php foreach ($pdf as $p): ?>
                                                        <div>
                                                            <i class="timeline-icon bi bi-person text-bg-warning"></i>
                                                            <div class="timeline-item">
                                                                <span class="time"> <i class="bi bi-clock-fill"></i>
                                                                    <?= $p['created_at']; ?>
                                                                </span>
                                                                <h3 class="timeline-header no-border">
                                                                    <a href="#"><?= $_SESSION['user']['name']; ?></a>
                                                                </h3>
                                                                <div class="timeline-body">
                                                                    Mengupload dokumen <?= $p['name']; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- END timeline item -->
                                                    <?php endforeach; ?>
                                                    <div><i class="timeline-icon bi bi-clock-fill text-bg-warning"></i>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div class="text-center">Belum ada aktivitas</div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                            </div><!--/tab-content-->

                        </div><!--/col-9-->
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
<script src="dist/assets/plugins/sweetalert/dist/sweetalert2.min.js"></script>
<script src="dist/js/auth.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
    integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy"
    crossorigin="anonymous"></script>
<script>
    $('#upload-avatar').on('click', function () { $('#input-upload-avatar').trigger('click') });
    $('#input-upload-avatar').on('change', function () {
        $('#fileNameChange').hide();
        let fileName = $('#input-upload-avatar')[0].files[0].name;
        if (fileName != "") {
            $('#fileNameChange').show();
            $('#fileNameChange').html(`<p>${fileName}</p>`);
        }
    });
</script>

</html>