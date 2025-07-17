<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5 Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin,dashboard,template,bootstrap,responsive,ui kit">

    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico">
    <title>Obat Herbal</title>

    <link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/plugins.css" rel="stylesheet">
    <link href="../assets/css/icons.css" rel="stylesheet">
    <link href="../assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="../assets/switcher/demo.css" rel="stylesheet">
</head>

<body class="app sidebar-mini ltr login-img">
    <div class="">
        <div id="global-loader">
            <img src="../assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>

        <div class="page">
            <div class="container-login100">
                <div class="wrap-login100 p-6">
                    <span class="login100-form-title pb-5">
                        <div class="text-center mb-4">
                            <a href="#"><img src="../assets/images/brand/icon-login.png" class="header-brand-img" alt="Logo"></a>
                        </div>
                        Toko Obat Herbal<br>
                        <small>Login Admin</small>
                        
                        <?php
                        if (isset($_GET['pesan'])) {
                            $alert = '';
                            $message = '';
                            switch ($_GET['pesan']) {
                                case 'gagal':
                                    $alert = 'danger';
                                    $message = 'Username atau Password Tidak Sesuai';
                                    break;
                                case 'logout':
                                    $alert = 'danger';
                                    $message = 'Anda Berhasil Logout';
                                    break;
                                case 'belum_login':
                                    $alert = 'warning';
                                    $message = 'Anda Harus Login';
                                    break;
                                case 'registrasi_berhasil':
                                    $alert = 'primary';
                                    $message = 'Registrasi Berhasil';
                                    break;
                            }
                            if ($alert && $message) {
                                echo "<div class='alert alert-$alert alert-dismissible fade show mt-3' role='alert'>
                                        <strong>$message</strong>
                                        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
                                    </div>";
                            }
                        }
                        ?>
                    </span>

                    <div class="panel panel-primary">
                        <div class="panel-body tabs-menu-body p-0 pt-1">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab5">
                                    <form method="post" action="cek_login.php">
                                        <div class="wrap-input100 validate-input input-group">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-account text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0" type="text" name="username" placeholder="Username" required>
                                        </div>
                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 form-control ms-0" type="password" name="password" placeholder="Password" required>
                                        </div>
                                        <div class="container-login100-form-btn">
                                            <button type="submit" class="login100-form-btn btn-primary m-1">Login</button>
                                            <a href="registrasi.php" class="login100-form-btn btn-info m-1">Registrasi</a>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="../assets/js/show-password.min.js"></script>
    <script src="../assets/js/generate-otp.js"></script>
    <script src="../assets/plugins/p-scroll/perfect-scrollbar.js"></script>
    <script src="../assets/js/themeColors.js"></script>
    <script src="../assets/js/custom.js"></script>
    <script src="../assets/js/custom-swicher.js"></script>
    <script src="../assets/switcher/js/switcher.js"></script>
</body>

</html>
