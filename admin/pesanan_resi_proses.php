<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_order = intval($_POST['id_order']);
    $no_resi  = mysqli_real_escape_string($koneksi, $_POST['no_resi']);

    // update no_resi sekaligus ubah status jadi 'Dikirim'
    $update = mysqli_query($koneksi, "
        UPDATE tb_order 
        SET no_resi = '$no_resi', status_pembayaran = 'Dikirim' 
        WHERE id_order = $id_order
    ");

    if ($update) {
        header("Location: pesanan.php?pesan=resi_sukses");
    } else {
        header("Location: pesanan.php?pesan=resi_gagal");
    }
    exit;
}
?>
