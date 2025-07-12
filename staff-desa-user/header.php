<?php
ob_start();
session_start();
if ($_SESSION['status'] != "staff-desa-user") {
    header("location:../staff_desa_login/index.php?pesan=belum_login");
}

include '../koneksi.php';

$id_desa = $_SESSION['id_desa'];

$query_desa = "SELECT nama_desa FROM tb_desa WHERE id_desa = '$id_desa'";
$result_desa = mysqli_query($koneksi, $query_desa);

// Cek apakah query berhasil dan data ditemukan
if ($result_desa && mysqli_num_rows($result_desa) > 0) {
    $nama_desa = mysqli_fetch_assoc($result_desa);
    $nama_desa = $nama_desa['nama_desa'];
} else {
    // Jika tidak ada hasil, tampilkan pesan default
    echo 'Nama desa tidak ditemukan';
}          

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
    <title>Sistem LisDes </title>

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