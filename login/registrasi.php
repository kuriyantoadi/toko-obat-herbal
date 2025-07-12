<!doctype html>
<html lang="en" dir="ltr">

<head>
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5 Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin, dashboard, template, bootstrap, responsive, ui kit">

    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico">
    <title>Login LisDes</title>

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
                            <a href="#"><img src="../assets/images/logo/logo-banten.png" class="header-brand-img" alt="Logo"></a>
                        </div>
                        Toko Obat Herbal
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
                                case 'email_sudah_ada':
                                    $alert = 'warning';
                                    $message = 'Mohon maaf email sudah terdaftar';
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
                                    <form method="post" action="registrasi_tambah.php">
                                        <span class="login100-form-title">Registration</span>

                                        <div class="wrap-input100 validate-input input-group">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="mdi mdi-account" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 ms-0 form-control" type="text" name="nama_pelanggan" placeholder="Nama Pelanggan" required>
                                        </div>

                                        <div class="wrap-input100 validate-input input-group">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-email" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 ms-0 form-control" type="email" name="email_pelanggan" placeholder="Email Pelanggan" required>
                                        </div>

                                        <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-eye" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 ms-0 form-control" type="password" name="password_pelanggan" placeholder="Password Pelanggan" required>
                                        </div>

                                        <div class="wrap-input100 validate-input input-group">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-smartphone" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 ms-0 form-control" type="text" name="no_hp_pelanggan" placeholder="Nomor HP Pelanggan" required>
                                        </div>

                                        <div class="wrap-input100 validate-input input-group">
                                            <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                <i class="zmdi zmdi-pin" aria-hidden="true"></i>
                                            </a>
                                            <input class="input100 border-start-0 ms-0 form-control" type="text" name="alamat_pelanggan" placeholder="Alamat Pelanggan" required>
                                        </div>

                                        <label class="custom-control custom-checkbox mt-4">
                                            <input type="checkbox" class="custom-control-input" required>
                                            <span class="custom-control-label">Agree the <a href="terms.html">terms and policy</a></span>
                                        </label>

                                        <div class="container-login100-form-btn">
                                            <button type="submit" class="login100-form-btn btn-primary">Register</button>
                                        </div>

                                        <div class="text-center pt-3">
                                            <p class="text-dark mb-0 d-inline-flex">Already have account ?<a href="index.php" class="text-primary ms-1">Sign In</a></p>
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
