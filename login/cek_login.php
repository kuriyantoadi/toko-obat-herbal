<?php
session_start();
include '../koneksi.php';

// Ambil input dan hindari SQL Injection
$email = mysqli_real_escape_string($koneksi, trim($_POST['username']));
$password = $_POST['password']; // jangan escape password

// Cek email di database
$query = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE email_pelanggan = '$email'");
$data = mysqli_fetch_assoc($query);

if ($data) {
    // Verifikasi password (pastikan menggunakan password_hash saat registrasi)
    if (password_verify($password, $data['password_pelanggan'])) {
        // Set session
        $_SESSION['id_pelanggan'] = $data['id_pelanggan'];
        $_SESSION['nama_pelanggan'] = $data['nama_pelanggan'];
        $_SESSION['status'] = 'aktif';
        header("Location: ../pelanggan/index.php");
    } else {
        header("Location: index.php?pesan=gagal");
    }
} else {
    header("Location: index.php?pesan=gagal");
}
?>
