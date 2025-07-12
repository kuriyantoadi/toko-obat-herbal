<?php
// mengaktifkan session php
session_start();

// menghubungkan dengan koneksi
include '../koneksi.php';

// menangkap data yang dikirim dari form
$username = addslashes(trim($_POST['username']));
$password = sha1($_POST['password']);

// menyeleksi data operator dengan username dan password yang sesuai
$data = mysqli_query($koneksi, "SELECT * FROM tb_staff_desa WHERE username='$username' AND password='$password'");

// menghitung jumlah data yang ditemukan
$cek = mysqli_num_rows($data);

if ($cek > 0) {
    $login = mysqli_fetch_assoc($data);

    // Menyimpan id_user ke dalam session
    $_SESSION['id_user'] = $login['id_user'];
    $_SESSION['id_desa'] = $login['id_desa'];
    $_SESSION['id_kecamatan'] = $login['id_kecamatan'];
    $_SESSION['id_kab_kota'] = $login['id_kab_kota'];

    $_SESSION['username'] = $username;

    if ($login['status'] == "staff-desa-user") {
        $_SESSION['status'] = "staff-desa-user";
        $_SESSION['username'] = $username;
        $_SESSION['id_desa'] = $login['id_desa'];
        $_SESSION['id_kecamatan'] = $login['id_kecamatan'];
        $_SESSION['id_kab_kota'] = $login['id_kab_kota'];
        header("location:../staff-desa-user/index.php");
    // } elseif ($login['status'] == "petugas") {
    //     $_SESSION['status'] = "petugas";
    //     header("location:../petugas/index.php");
    // } elseif ($login['status'] == "manager") {
    //     $_SESSION['status'] = "manager";
    //     header("location:../manager/index.php");
    } else {
        header("location:index.php?pesan=gagal1");
    }
} else {
    header("location:index.php?pesan=gagal");
}
