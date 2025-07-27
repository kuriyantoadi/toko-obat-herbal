<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_order = intval($_POST['id_order']);
    $folder = '../uploads/bukti_transfer/';

    // Validasi dan simpan file
    if ($_FILES['bukti']['error'] === 0) {
        $ext = pathinfo($_FILES['bukti']['name'], PATHINFO_EXTENSION);
        $nama_file = 'bukti_' . $id_order . '_' . time() . '.' . $ext;
        $path_simpan = $folder . $nama_file;

        if (move_uploaded_file($_FILES['bukti']['tmp_name'], $path_simpan)) {
            // Update database
            mysqli_query($koneksi, "
              UPDATE tb_order 
              SET status_pembayaran = 'lunas', bukti_transfer = '$nama_file'
              WHERE id_order = $id_order
            ");
            header('Location: pesanan.php?pesan=konfirmasi_berhasil');
            exit;
        } else {
            echo "Gagal menyimpan bukti pembayaran.";
        }
    } else {
        echo "Upload gagal. Silakan coba lagi.";
    }
} else {
    echo "Akses tidak diizinkan.";
}
