<html lang="en">
<?php
session_start();
$error = isset($_SESSION['error']) ? $_SESSION['error'] : "";
unset($_SESSION['error']);

if (isset($_SESSION['user'])) {
    header("Location: upload.php");
}


?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <!-- load icons -->
    <link rel="stylesheet" href="dist/assets/icons/bootstrap-icons-1.11.3/font/bootstrap-icons.css" />
</head>

<link rel="stylesheet" href="dist/css/adminlte.css" />
<link rel="stylesheet" href="dist/css/login.css" />


<body>
    <header class="container-header">
        <nav class="wrapper-header d-flex">
            <div class="content-container content-wrapper">
                <ul class="header-list">
                    <li>
                        <a id="logo" href="#" class="tab-link tab-logo">
                            <img alt="Codecademy logo" class="image-header" src="dist/assets/img/logo_kopin.png">
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <main class="main-content">
        <h1 class="page-heading-h1 mt-5 text-center mb-3 montserrat-font">WEBSITE PEMERIKSAAN DOKUMEN PROJECT<BR>
            PEMBANGUNAN FIBER
            OPTIK</h1>
        <img src="dist/assets/img/login-thumbnail.jpg" alt="" style="width: 360px;" class="mt-3 mb-3">
        <div class="mb-">
            <div class="form-container">
                <div class="container-content-form">
                    <div class="flex-style col-style login-form-style">
                        <form action="config/auth" class="form-base" method="POST">
                            <?php if ($error): ?>
                                <div class="alert alert-danger" role="alert"
                                    style="color:red;width:100%;text-align:center;font-size: 14px;">
                                    <?= $error; ?>
                                </div>
                            <?php endif; ?>
                            <div class="form-group1">
                                <div class="form-group2 form-group3">
                                    <label for="user-login" class="label-form">Username</label>
                                    <input type="text" name="username" id="user-login"
                                        class="input-form-group is-invalid" value="" placeholder="Username">
                                </div>
                                <div class="form-group2 form-group3">
                                    <label for="login-user-password" class="label-form">Password</label>
                                    <div class="icon-form-input">
                                        <i class="bi bi-eye hidepass" id="toggle-pass"></i>
                                    </div>
                                    <input type="password" name="password" placeholder="Password"
                                        id="login-user-password" class="input-form-group" value="">
                                </div>
                            </div>
                            <button class="basic-button btn-lg btn-black btn-xlarge btn-submit" id="user_submit"
                                type="submit">Sign
                                In</button>
                        </form>
                    </div>
                </div>
            </div>
            <!-- <a href="#" class="outLink__register">Belum memiliki akun? <b>Daftar</b></a> -->
        </div>
    </main>
    <footer class="footer-page">

    </footer>

</body>

</html>

<script src="dist/js/jquery.3.7.1.min.js"></script>
<script>
    $(`#toggle-pass`).on('click', function () {
        if ($(this).hasClass(`hidepass`)) {
            $(this).removeClass(`bi-eye hidepass`).addClass(`bi-eye-slash showpass`);
            $('#login-user-password').attr('type', 'text');
            return false;
        }
        $(this).removeClass(`bi-eye-slash showpass`).addClass(`bi-eye hidepass`);
        $('#login-user-password').attr('type', 'password');
    })
</script>