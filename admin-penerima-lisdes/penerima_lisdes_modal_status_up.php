<?php
session_start();
if ($_SESSION['status'] != "admin-dinas") {
    header("location:../login.php?pesan=belum_login");
    exit();
}

include '../koneksi.php';

// Get form data
$id_penerima_lisdes = mysqli_real_escape_string($koneksi, $_POST['id_penerima_lisdes']);
$status_pemasangan = mysqli_real_escape_string($koneksi, $_POST['status_pemasangan']);

// Handle file uploads
$photo_kwh_path = null;
$photo_saklar_path = null;
$photo_lampu_path = null;

if ($_FILES['photo_kwh']['name']) {
    // Upload KWH photo
    $photo_kwh_path = upload_file($_FILES['photo_kwh'], 'kwh', "../uploads/");
}

if ($_FILES['photo_saklar']['name']) {
    // Upload Saklar photo
    $photo_saklar_path = upload_file($_FILES['photo_saklar'], 'saklar', "../uploads/");
}

if ($_FILES['photo_lampu']['name']) {
    // Upload Lampu photo
    $photo_lampu_path = upload_file($_FILES['photo_lampu'], 'lampu', "../uploads/");
}

// Function to upload files
function upload_file($file, $prefix, $upload_dir) {
    $file_name = $file['name'];
    $file_tmp = $file['tmp_name'];
    $file_path = $upload_dir . $prefix . "_" . time() . "_" . basename($file_name);
    
    if (move_uploaded_file($file_tmp, $file_path)) {
        return $file_path;
    } else {
        return false;
    }
}

// Prepare SQL query to update status
$query = "UPDATE tb_penerima_lisdes SET 
            status_pemasangan = '$status_pemasangan',
            photo_kwh = IFNULL('$photo_kwh_path', photo_kwh),
            photo_saklar = IFNULL('$photo_saklar_path', photo_saklar),
            photo_lampu = IFNULL('$photo_lampu_path', photo_lampu)
          WHERE id_penerima_lisdes = '$id_penerima_lisdes'";

// Execute the query
if (mysqli_query($koneksi, $query)) {
    header("Location: ../admin-dinas/penerima-lisdes.php?pesan=update_status_berhasil");
    exit();
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>
