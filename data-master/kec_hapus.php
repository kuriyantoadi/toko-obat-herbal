<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
}

$session_user = $_SESSION['status'];

// koneksi database
include '../koneksi.php';

$id_kecamatan = $_GET['id_kecamatan'];

// menghapus data dari database
$cek_hapus = mysqli_query($koneksi, "DELETE from tb_kecamatan WHERE id_kecamatan='$id_kecamatan' ");


// mengalihkan halaman kembali ke index.php
if ($cek_hapus) {
    header("location:../$session_user/kec.php?pesan=hapus_berhasil");
}else{
    echo "error";
}