<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

$session_user = $_SESSION['status'];

include '../koneksi.php';

// Ambil data yang dikirim dari form edit
$id_user = mysqli_real_escape_string($koneksi, $_POST['id_user']);
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$nama_staff_desa = mysqli_real_escape_string($koneksi, $_POST['nama_staff_desa']);
$id_kab_kota = mysqli_real_escape_string($koneksi, $_POST['id_kab_kota']);
$id_kecamatan = mysqli_real_escape_string($koneksi, $_POST['id_kecamatan']);
$id_desa = mysqli_real_escape_string($koneksi, $_POST['id_desa']);
$status_staff = mysqli_real_escape_string($koneksi, $_POST['status_staff']);

// Cek apakah username sudah ada (jika ada kebutuhan untuk cek duplikat username)
$cek_username = mysqli_query($koneksi, "SELECT username FROM tb_user WHERE username='$username' AND id_user != '$id_user'");

if (mysqli_num_rows($cek_username) > 0) {
    // Jika username sudah ada dan digunakan oleh staff lain, redirect dengan pesan error
    header("Location: ../$session_user/staff_desa.php?pesan=username_sudah_ada");
    exit();
}

// Lakukan update data staff desa
$cek_edit = mysqli_query($koneksi, "UPDATE tb_user SET
        username='$username',
        nama_staff_desa='$nama_staff_desa',
        id_kab_kota='$id_kab_kota',
        id_kecamatan='$id_kecamatan',
        id_desa='$id_desa',
        status_staff='$status_staff'
        WHERE id_user='$id_user'");

if ($cek_edit) {
    // Jika update berhasil
    header("Location: ../$session_user/staff-desa.php?pesan=edit-berhasil");
} else {
    // Jika update gagal
    header("Location: ../$session_user/staff-desa.php?pesan=edit-gagal");
}
?>
