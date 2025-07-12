<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
}

$session_user = $_SESSION['status'];

include '../koneksi.php';

$id_kab_kota = mysqli_real_escape_string($koneksi, $_POST['id_kab_kota']);
$id_kecamatan = mysqli_real_escape_string($koneksi, $_POST['id_kecamatan']);
$nama_kecamatan = mysqli_real_escape_string($koneksi, $_POST['nama_kecamatan']);

$cek_kec = mysqli_query($koneksi, "SELECT nama_kecamatan from tb_kecamatan WHERE nama_kecamatan='$nama_kecamatan'");

if (mysqli_num_rows($cek_kec) > 0) {
    // Jika null, anggap berhasil
    header("Location: ../$session_user/kec.php?pesan=data_sudah_ada");
    exit();
}

$cek_edit = mysqli_query($koneksi, "UPDATE tb_kecamatan SET
        id_kab_kota='$id_kab_kota',
        nama_kecamatan='$nama_kecamatan'
        where id_kecamatan='$id_kecamatan'
        ");

if ($cek_edit) {
    header("location:../$session_user/kec.php?pesan=edit-berhasil");
} else {
    header("location:../$session_user/kec.php?pesan=edit-gagal");
}