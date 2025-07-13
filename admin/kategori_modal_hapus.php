<?php
session_start();
if ($_SESSION['status'] != "admin") {
    header("Location: ../login.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

$id_kategori = mysqli_real_escape_string($koneksi, $_GET['id_kategori']);

if (!empty($id_kategori)) {
    $hapus = mysqli_query($koneksi, "DELETE FROM tb_kategori WHERE id_kategori = '$id_kategori'");

    if ($hapus) {
        header("Location: kategori.php?pesan=hapus-berhasil");
    } else {
        header("Location: kategori.php?pesan=hapus-gagal");
    }
} else {
    header("Location: kategori.php?pesan=id-tidak-valid");
}
?>