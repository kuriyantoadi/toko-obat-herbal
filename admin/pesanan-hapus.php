<?php
include('../koneksi.php');

// Cek apakah ada ID pesanan
if (isset($_GET['id'])) {
    $id_order = intval($_GET['id']);

    // Hapus detail order dulu (foreign key constraint)
    mysqli_query($koneksi, "DELETE FROM tb_order_detail WHERE id_order='$id_order'");

    // Hapus order utama
    $delete = mysqli_query($koneksi, "DELETE FROM tb_order WHERE id_order='$id_order'");

    if ($delete) {
        header("Location: pesanan.php?pesan=hapus_sukses");
    } else {
        header("Location: pesanan.php?pesan=hapus_gagal");
    }
} else {
    header("Location: pesanan.php?pesan=invalid_id");
}
?>
