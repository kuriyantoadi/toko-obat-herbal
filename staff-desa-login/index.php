<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico">

    <!-- TITLE -->
    <title>Login LisDes</title>

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="../assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- STYLE CSS -->
     <link href="../assets/css/style.css" rel="stylesheet">

	<!-- Plugins CSS -->
    <link href="../assets/css/plugins.css" rel="stylesheet">

    <!--- FONT-ICONS CSS -->
    <link href="../assets/css/icons.css" rel="stylesheet">

    <!-- INTERNAL Switcher css -->
    <link href="../assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="../assets/switcher/demo.css" rel="stylesheet">

</head>

<body class="app sidebar-mini ltr login-img">

    <!-- BACKGROUND-IMAGE -->
    <div class="">

        <!-- GLOABAL LOADER -->
        <div id="global-loader">
            <img src="../assets/images/loader.svg" class="loader-img" alt="Loader">
        </div>
        <!-- /GLOABAL LOADER -->

        <!-- PAGE -->
        <div class="page">
            <div class="">
                <!-- Theme-Layout -->

                <!-- CONTAINER OPEN -->
                <!-- <div class="col col-login mx-auto mt-7">
                    <div class="text-center">
                        <a href="index.html"><img src="../assets/images/logo/logo-banten.png" class="header-brand-img" alt=""></a>
                    </div>
                </div> -->

                <div class="container-login100">
                    <div class="wrap-login100 p-6">
                            <span class="login100-form-title pb-5">
                                
                                <div class="text-center mb-4">
                                    <a href="index.html"><img src="../assets/images/logo/logo-banten.png" class="header-brand-img" alt=""></a>
                                </div>
                                Dinas Energi Dan Sumber Daya Mineral<br>
                                Sistem Bantuan Listrik Desa<br>
                                <b>Login Staff Desa</b>

                                <?php
                                if (isset($_GET['pesan'])) {
                                    if ($_GET['pesan'] == "gagal") {
                                        echo "
                                        <div class='alert alert-danger alert-dismissible fade show' role='alert pt-5' style='margin-top: 20px'>
                                            <span class='alert-inner--text'><strong>Username atau Password Tidak Sesuai</span>
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                                                <span aria-hidden='true'>×</span>
                                            </button>
                                        </div>
                                        ";
                                    } elseif ($_GET['pesan'] == "logout") {
                                        echo "
                                        <div class='alert alert-danger alert-dismissible fade show' role='alert pt-5' style='margin-top: 20px'>
                                            <span class='alert-inner--text'><strong>Anda Berhasil Logout</span>
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                                                <span aria-hidden='true'>×</span>
                                            </button>
                                        </div>
                                        ";
                                    } elseif ($_GET['pesan'] == "belum_login") {
                                        echo "
                                        <div class='alert alert-warning alert-dismissible fade show' role='alert pt-5' style='margin-top: 20px'>
                                            <span class='alert-inner--text'><strong>Anda Harus Login</span>
                                            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                                                <span aria-hidden='true'>×</span>
                                            </button>
                                        </div>
                                        ";
                                    }
                                }
                                ?>


                            </span>
                            <div class="panel panel-primary">
                               
                                <div class="panel-body tabs-menu-body p-0 pt-1">
                                    <div class="tab-content">
                                        <div class="tab-pane active" id="tab5">
                                            <form method="post" action="cek_login.php">
                                                                                                    
                                                <div class="wrap-input100 validate-input input-group" data-bs-validate="Valid email is required: ex@abc.xyz">
                                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                        <i class="zmdi zmdi-account text-muted" aria-hidden="true"></i>
                                                    </a>
                                                    <input class="input100 border-start-0 form-control ms-0" type="text" name="username" placeholder="Username">
                                                </div>
                                                <div class="wrap-input100 validate-input input-group" id="Password-toggle">
                                                    <a href="javascript:void(0)" class="input-group-text bg-white text-muted">
                                                        <i class="zmdi zmdi-eye text-muted" aria-hidden="true"></i>
                                                    </a>
                                                    <input class="input100 border-start-0 form-control ms-0" type="password"  name="password" placeholder="Password">
                                                </div>
                                            
                                                <div class="container-login100-form-btn">
                                                    <input type="submit" value="Login" class="login100-form-btn btn-primary">                                                    
                                                </div>
                                            </form>   
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                </div>
                <!-- CONTAINER CLOSED -->
            </div>
        </div>
        <!-- End PAGE -->

    </div>
    <!-- BACKGROUND-IMAGE CLOSED -->

    <!-- JQUERY JS -->
    <script src="../assets/js/jquery.min.js"></script>

    <!-- BOOTSTRAP JS -->
    <script src="../assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="../assets/plugins/bootstrap/js/bootstrap.min.js"></script>

    <!-- SHOW PASSWORD JS -->
    <script src="../assets/js/show-password.min.js"></script>

    <!-- GENERATE OTP JS -->
    <script src="../assets/js/generate-otp.js"></script>

    <!-- Perfect SCROLLBAR JS-->
    <script src="../assets/plugins/p-scroll/perfect-scrollbar.js"></script>

    <!-- Color Theme js -->
    <script src="../assets/js/themeColors.js"></script>

    <!-- CUSTOM JS -->
    <script src="../assets/js/custom.js"></script>

    <!-- Custom-switcher -->
    <script src="../assets/js/custom-swicher.js"></script>

    <!-- Switcher js -->
    <script src="../assets/switcher/js/switcher.js"></script>

</body>

</html>