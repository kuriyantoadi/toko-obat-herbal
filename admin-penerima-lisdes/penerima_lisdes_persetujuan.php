<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

// Ambil data dari form
$id_penerima_lisdes = mysqli_real_escape_string($koneksi, $_POST['id_penerima_lisdes']);
$status_persetujuan_admin = mysqli_real_escape_string($koneksi, $_POST['status_persetujuan_admin']);

if($status_persetujuan_admin == "Di Tolak"){
    $status_pemasangan = "Di Tolak";
}elseif($status_persetujuan_admin == "Di Setujui"){
    $status_pemasangan = "Di Setujui";
}elseif($status_persetujuan_admin == "Pengajuan"){
    $status_pemasangan = "Pengajuan";
}

// Query untuk memperbarui status persetujuan
$query = "UPDATE tb_penerima_lisdes SET status_persetujuan_admin = '$status_persetujuan_admin', status_pemasangan='$status_pemasangan' WHERE id_penerima_lisdes = '$id_penerima_lisdes'";

// Eksekusi query
if (mysqli_query($koneksi, $query)) {
    header("Location: ../admin-dinas/penerima-lisdes.php?pesan=persetujuan_berhasil");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
