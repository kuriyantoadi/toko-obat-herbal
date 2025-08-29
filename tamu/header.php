<?php
ob_start();
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if ($_SESSION['status'] != "aktif") {
    header("location:../login/index.php?pesan=belum_login");
}

include '../koneksi.php';
?>

<!doctype html>
<html lang="en" dir="ltr">

<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Sash – Bootstrap 5  Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords"
        content="admin,admin dashboard,admin panel,admin template,bootstrap,clean,dashboard,flat,jquery,modern,responsive,premium admin templates,responsive admin,ui,ui kit.">

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="../assets/images/brand/favicon.ico">

    <!-- TITLE -->
    <title>Sash – Bootstrap 5 Admin & Dashboard Template</title>

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

<body class="app ltr landing-page horizontal">

    <!-- GLOBAL-LOADER -->
    <div id="global-loader">
        <img src="../assets/images/loader.svg" class="loader-img" alt="Loader">
    </div>
    <!-- /GLOBAL-LOADER -->

    <!-- PAGE -->
    <div class="page">
        <div class="page-main">

            <!-- app-Header -->
            <div class="hor-header header">
                <div class="container main-container">
                    <div class="d-flex">
                        <a aria-label="Hide Sidebar" class="app-sidebar__toggle" data-bs-toggle="sidebar"
                            href="javascript:void(0)"></a>
                        <!-- sidebar-toggle-->
                        <a class="logo-horizontal " href="index.html">
                            <img src="../assets/images/brand/logo-white.png" class="header-brand-img desktop-logo" alt="logo">
                            <img src="../assets/images/brand/logo-dark.png" class="header-brand-img light-logo1"
                                alt="logo">
                        </a>
                        <!-- LOGO -->
                        <div class="d-flex order-lg-2 ms-auto header-right-icons">
                            <button class="navbar-toggler navresponsive-toggler d-lg-none ms-auto" type="button"
                                data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent-4"
                                aria-controls="navbarSupportedContent-4" aria-expanded="false"
                                aria-label="Toggle navigation">
                                <span class="navbar-toggler-icon fe fe-more-vertical"></span>
                            </button>
                            <div class="navbar navbar-collapse responsive-navbar p-0">
                                <div class="collapse navbar-collapse bg-white px-0" id="navbarSupportedContent-4">
                                    <!-- SEARCH -->
                                    <div class="header-nav-right p-5">
                                        <a href="register.html" class="btn ripple btn-min w-sm btn-outline-primary me-2 my-auto"
                                            target="_blank">New User
                                        </a>
                                        <a href="login.html" class="btn ripple btn-min w-sm btn-primary me-2 my-auto"
                                            target="_blank">Login
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /app-Header -->

          