<?php
session_start();
if ($_SESSION['status'] != "admin") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

$session_user = $_SESSION['status'];

include '../koneksi.php';

// Ambil data dari form edit
$id_pelanggan = mysqli_real_escape_string($koneksi, $_POST['id_pelanggan']);
$nama_pelanggan = mysqli_real_escape_string($koneksi, $_POST['nama_pelanggan']);
$email_pelanggan = mysqli_real_escape_string($koneksi, $_POST['email_pelanggan']);
$password_pelanggan = mysqli_real_escape_string($koneksi, $_POST['password_pelanggan']);
$no_hp_pelanggan = mysqli_real_escape_string($koneksi, $_POST['no_hp_pelanggan']);
$alamat_pelanggan = mysqli_real_escape_string($koneksi, $_POST['alamat_pelanggan']);

// Cek apakah email sudah digunakan pelanggan lain
$cek_email = mysqli_query($koneksi, "SELECT email_pelanggan FROM tb_pelanggan WHERE email_pelanggan='$email_pelanggan' AND id_pelanggan != '$id_pelanggan'");
if (mysqli_num_rows($cek_email) > 0) {
    header("Location: ../$session_user/pelanggan.php?pesan=email_sudah_ada");
    exit();
}

// Jika password dikosongkan, jangan update password
if (!empty($password_pelanggan)) {
    $password_hash = sha1($password_pelanggan);
    $query = "UPDATE tb_pelanggan SET 
                nama_pelanggan='$nama_pelanggan',
                email_pelanggan='$email_pelanggan',
                password_pelanggan='$password_hash',
                no_hp_pelanggan='$no_hp_pelanggan',
                alamat_pelanggan='$alamat_pelanggan'
              WHERE id_pelanggan='$id_pelanggan'";
} else {
    $query = "UPDATE tb_pelanggan SET 
                nama_pelanggan='$nama_pelanggan',
                email_pelanggan='$email_pelanggan',
                no_hp_pelanggan='$no_hp_pelanggan',
                alamat_pelanggan='$alamat_pelanggan'
              WHERE id_pelanggan='$id_pelanggan'";
}

$cek_edit = mysqli_query($koneksi, $query);

// Cek hasil update
if ($cek_edit) {
    header("Location: ../$session_user/pelanggan.php?pesan=edit_berhasil");
} else {
    header("Location: ../$session_user/pelanggan.php?pesan=edit_gagal");
}
?>
