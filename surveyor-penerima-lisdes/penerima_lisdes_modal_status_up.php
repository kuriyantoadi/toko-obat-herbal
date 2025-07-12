<?php
session_start();
if ($_SESSION['status'] != "surveyor") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

// Get form data
$id_penerima_lisdes = mysqli_real_escape_string($koneksi, $_POST['id_penerima_lisdes']);

// Handle file uploads
$photo_kwh_path = null;
$photo_saklar_path = null;
$photo_lampu_path = null;

if (!empty($_FILES['photo_kwh']['name'])) {
    // Upload KWH photo
    $photo_kwh_path = upload_file($_FILES['photo_kwh'], 'kwh', "../uploads/");
}

if (!empty($_FILES['photo_saklar']['name'])) {
    // Upload Saklar photo
    $photo_saklar_path = upload_file($_FILES['photo_saklar'], 'saklar', "../uploads/");
}

if (!empty($_FILES['photo_lampu']['name'])) {
    // Upload Lampu photo
    $photo_lampu_path = upload_file($_FILES['photo_lampu'], 'lampu', "../uploads/");
}

// Function to upload files
function upload_file($file, $prefix, $upload_dir) {
    $file_name = basename($file['name']);
    $file_tmp = $file['tmp_name'];
    $file_path = $upload_dir . $prefix . "_" . time() . "_" . $file_name;

    if (move_uploaded_file($file_tmp, $file_path)) {
        return $file_path;
    } else {
        return false;
    }
}

// Prepare SQL query to update status
$query = "UPDATE tb_penerima_lisdes SET status_persetujuan_admin = 'Selesai'";

// Hanya tambahkan kolom yang memiliki nilai baru
if ($photo_kwh_path) {
    $query .= ", photo_kwh = '$photo_kwh_path'";
}
if ($photo_saklar_path) {
    $query .= ", photo_saklar = '$photo_saklar_path'";
}
if ($photo_lampu_path) {
    $query .= ", photo_lampu = '$photo_lampu_path'";
}

$query .= " WHERE id_penerima_lisdes = '$id_penerima_lisdes'";

// Debugging - Cek Query dan Variabel
echo "photo_kwh: $photo_kwh_path <br>";
echo "photo_saklar: $photo_saklar_path <br>";
echo "photo_lampu: $photo_lampu_path <br>";
echo "QUERY: $query <br>";

// Jalankan query
if (mysqli_query($koneksi, $query)) {
    header("Location: ../surveyor/penerima-lisdes.php?pesan=update_status_berhasil");
    exit();
} else {
    echo "SQL Error: " . mysqli_error($koneksi);
}
?>
