<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
}

$session_user = $_SESSION['status'];

include '../koneksi.php';

$id_kab_kota = $_POST['id_kab_kota'];
$nama_kab_kota = $_POST['nama_kab_kota'];

$cek_edit = mysqli_query($koneksi, "UPDATE tb_kab_kota SET
        nama_kab_kota='$nama_kab_kota'
        where id_kab_kota='$id_kab_kota'
        ");

if ($cek_edit) {
    header("location:../$session_user/kab_kota.php?pesan=edit-berhasil");
} else {
    header("location:../$session_user/kab_kota.php?pesan=edit-gagal");
}