<?php
// Aktifkan session
session_start();

// Koneksi ke database
include '../koneksi.php';

// Ambil data dari form dan bersihkan
$email = trim($_POST['username']); // 'username' di form sebenarnya email
$password = $_POST['password'];

// Cek apakah data pelanggan tersedia
$query = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan WHERE email_pelanggan = '$email'");
$cek = mysqli_num_rows($query);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($query);

    // Verifikasi password
    if (password_verify($password, $data['password_pelanggan'])) {
        // Simpan data ke session
        $_SESSION['id_pelanggan'] = $data['id_pelanggan'];
        $_SESSION['nama_pelanggan'] = $data['nama_pelanggan'];
        $_SESSION['status'] = 'pelanggan';

        // Redirect ke halaman pelanggan
        header("location:../pelanggan/index.php");
        exit();
    } else {
        // Password salah
        header("location:index.php?pesan=gagal");
        exit();
    }
} else {
    // Email tidak ditemukan
    header("location:index.php?pesan=gagal");
    exit();
}
?>
