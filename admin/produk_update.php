<?php
include '../koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_produk       = intval($_POST['id_produk']);
    $nama_produk     = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $harga_produk    = intval($_POST['harga_produk']);
    $id_kat_produk   = intval($_POST['id_kat_produk']);
    $deskripsi       = mysqli_real_escape_string($koneksi, $_POST['deskripsi_produk']);
    $stok            = intval($_POST['stok_produk']);
    $berat           = intval($_POST['berat_produk']);

    // Ambil data produk lama
    $data_lama = mysqli_query($koneksi, "SELECT gambar_produk FROM tb_produk WHERE id_produk = $id_produk");
    $produk_lama = mysqli_fetch_assoc($data_lama);
    $gambar_lama = $produk_lama['gambar_produk'];

    // Cek apakah ada file gambar yang diupload
    if ($_FILES['gambar_produk']['name'] !== '') {
        $gambar_baru = $_FILES['gambar_produk']['name'];
        $tmp         = $_FILES['gambar_produk']['tmp_name'];
        $ekstensi    = pathinfo($gambar_baru, PATHINFO_EXTENSION);
        $nama_baru   = uniqid('produk_') . '.' . $ekstensi;

        $upload_path = "../uploads/produk/$nama_baru";
        if (move_uploaded_file($tmp, $upload_path)) {
            // Hapus gambar lama jika ada
            if ($gambar_lama && file_exists("../uploads/produk/$gambar_lama")) {
                unlink("../uploads/produk/$gambar_lama");
            }
            $gambar_final = $nama_baru;
        } else {
            echo "<script>alert('Gagal upload gambar.');window.location='produk.php';</script>";
            exit;
        }
    } else {
        $gambar_final = $gambar_lama;
    }

    // Update produk
    $update = mysqli_query($koneksi, "
        UPDATE tb_produk SET
            nama_produk     = '$nama_produk',
            harga_produk    = $harga_produk,
            id_kat_produk   = $id_kat_produk,
            deskripsi_produk= '$deskripsi',
            stok_produk     = $stok,
            berat_produk    = $berat,
            gambar_produk   = '$gambar_final',
            tanggal_ditambahkan = NOW()
        WHERE id_produk = $id_produk
    ");

    if ($update) {
        echo "<script>alert('Produk berhasil diperbarui.');window.location='../admin/produk.php';</script>";
    } else {
        echo "<script>alert('Gagal memperbarui produk.');window.history.back();</script>";
    }
} else {
    echo "<script>alert('Akses tidak valid.');window.location='../admin/produk.php';</script>";
}
?>
