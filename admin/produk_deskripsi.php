<?php include('header.php') ?>
<?php include('header-menu.php') ?>
<?php include('../koneksi.php') ?>

<?php
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$produk = mysqli_query($koneksi, "
    SELECT p.*, k.nama_kategori 
    FROM tb_produk p 
    JOIN tb_kategori_produk k ON p.id_kat_produk = k.id_kat_produk 
    WHERE p.id_produk = $id
");
$data = mysqli_fetch_assoc($produk);

if (!$data) {
    echo "<div class='alert alert-danger m-4'>Produk tidak ditemukan.</div>";
    include('footer.php');
    exit;
}
?>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">

            <!-- Header -->
            <div class="page-header">
                <h1 class="page-title"><?= htmlspecialchars($data['nama_produk']) ?></h1>
            </div>

            <div class="row">
                <!-- Gambar -->
                <div class="col-lg-5">
                    <img src="../uploads/produk/<?= $data['gambar_produk'] ?>" class="img-fluid shadow" alt="<?= $data['nama_produk'] ?>">
                </div>

                <!-- Detail Produk -->
                <div class="col-lg-7">
                    <h3 class="fw-bold">Rp<?= number_format($data['harga_produk'], 0, ',', '.') ?></h3>
                    <p class="text-muted">Kategori: <?= htmlspecialchars($data['nama_kategori']) ?></p>
                    <p><?= nl2br(htmlspecialchars($data['deskripsi_produk'])) ?></p>
                    <p>Stok: <?= $data['stok_produk'] ?> | Berat: <?= $data['berat_produk'] ?> gram</p>
                    <a href="cart.php?add=<?= $data['id_produk'] ?>" class="btn btn-primary"><i class="fe fe-shopping-cart me-1"></i> Tambah ke Keranjang</a>
                </div>
            </div>

            <hr class="my-5">

            <!-- Ulasan Pelanggan -->
            <h4 class="mb-3">Ulasan Pelanggan</h4>

            <?php
            $id_produk = $data['id_produk'];

            $query_ulasan = mysqli_query($koneksi, "
                SELECT u.*, p.nama_pelanggan
                FROM tb_ulasan u
                JOIN tb_order o ON u.id_order = o.id_order
                JOIN tb_order_detail od ON od.id_order = o.id_order
                JOIN tb_pelanggan p ON o.id_pelanggan = p.id_pelanggan
                WHERE od.id_produk = '$id_produk'
                GROUP BY u.id_ulasan
            ");

            if ($query_ulasan && mysqli_num_rows($query_ulasan) > 0):
                while ($ulasan = mysqli_fetch_assoc($query_ulasan)) :
                    $rating = intval($ulasan['rating']);
            ?>

                <div class="mb-4 p-4" style="background-color: #ffffff; box-shadow: 0 0 10px rgba(0,0,0,0.05);">
                    <p class="mb-1"><strong><?= htmlspecialchars($ulasan['nama_pelanggan']) ?></strong></p>
                    <p class="text-warning fs-5 mb-1">
                        <?php
                        for ($i = 1; $i <= 5; $i++) {
                            echo $i <= $rating ? '★' : '☆';
                        }
                        ?>
                    </p>
                    <p><?= nl2br(htmlspecialchars($ulasan['ulasan'])) ?></p>
                    <small class="text-muted"><?= date('d M Y H:i', strtotime($ulasan['tanggal_ulasan'])) ?></small>
                </div>


            <?php endwhile; ?>
            <?php else: ?>
                <div class="alert alert-info">Belum ada ulasan untuk produk ini.</div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php include('footer.php') ?>
