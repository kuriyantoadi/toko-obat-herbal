<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
}

$session_user = $_SESSION['status'];

include '../koneksi.php';

// Ambil data POST dan sanitasi input
$id_kecamatan = mysqli_real_escape_string($koneksi, $_POST['id_kecamatan']);
$id_desa = mysqli_real_escape_string($koneksi, $_POST['id_desa']);
$nama_desa = mysqli_real_escape_string($koneksi, $_POST['nama_desa']);

// Cek apakah nama desa sudah ada
$cek_desa = mysqli_query($koneksi, "SELECT nama_desa FROM tb_desa WHERE nama_desa='$nama_desa' AND id_desa != '$id_desa'");

if (mysqli_num_rows($cek_desa) > 0) {
    // Jika data sudah ada, redirect dengan pesan
    header("Location: ../$session_user/desa.php?pesan=data_sudah_ada");
    exit();
}

// Update data desa
$query = "UPDATE tb_desa SET
          id_kecamatan='$id_kecamatan',
          nama_desa='$nama_desa'
          WHERE id_desa='$id_desa'";

$cek_edit = mysqli_query($koneksi, $query);

// Cek apakah query berhasil
if ($cek_edit) {
    header("Location: ../$session_user/desa.php?pesan=edit_berhasil");
} else {
    header("Location: ../$session_user/desa.php?pesan=edit_gagal");
}
?>
