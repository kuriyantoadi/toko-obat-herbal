<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
}

$session_user = $_SESSION['status'];

// koneksi database
include '../koneksi.php';

$id_kab_kota = $_GET['id_kab_kota'];

// menghapus data dari database
$cek_hapus = mysqli_query($koneksi, "delete from tb_kab_kota where id_kab_kota='$id_kab_kota' ");


// mengalihkan halaman kembali ke index.php
if ($cek_hapus) {
    header("location:../$session_user/kab_kota.php?pesan=hapus_berhasil");
}else{
    echo "error";
}