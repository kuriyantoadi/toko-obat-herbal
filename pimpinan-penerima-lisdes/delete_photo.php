<?php
include '../koneksi.php';

// Check if 'photo' and 'id' are set in the URL
if (isset($_GET['photo']) && isset($_GET['id'])) {
    $photo = $_GET['photo'];
    $id = $_GET['id'];

    // Get current file path from the database based on the selected photo type
    $query = "SELECT $photo FROM tb_penerima_lisdes WHERE id_penerima_lisdes = '$id'";
    $result = mysqli_query($koneksi, $query);
    $data = mysqli_fetch_assoc($result);

    // Path to the file
    $file_path = "../uploads/" . basename($data[$photo]);

    // Delete the file from the server
    if (file_exists($file_path)) {
        unlink($file_path);
    }

    // Remove the file reference from the database
    $update_query = "UPDATE tb_penerima_lisdes SET $photo = NULL WHERE id_penerima_lisdes = '$id'";
    if (mysqli_query($koneksi, $update_query)) {
        header("Location: ../admin-lisdes/penerima-lisdes.php?pesan=photo_deleted");
    } else {
        echo "Error deleting photo.";
    }
}
?>
