<?php include('header.php') ?>
<?php include('header-menu.php') ?>
<?php include('../koneksi.php') ?>

<div class="main-content app-content mt-0">
    <div class="side-app">
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Produk per Kategori</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Produk Kategori</li>
                    </ol>
                </div>
            </div>

            <?php
            // Ambil parameter kategori
            $id_kat = isset($_GET['id_kat_produk']) ? intval($_GET['id_kat_produk']) : 0;
            $kategori = mysqli_query($koneksi, "SELECT * FROM tb_kategori_produk WHERE id_kat_produk = $id_kat");
            $kat = mysqli_fetch_assoc($kategori);

            if (!$kat) {
                echo "<div class='alert alert-danger'>Kategori tidak ditemukan.</div>";
                include('footer.php');
                exit;
            }
            ?>

            <h4 class="mb-4">Kategori: <strong><?= htmlspecialchars($kat['nama_kategori']) ?></strong></h4>

            <div class="row">
                <?php
                $produk = mysqli_query($koneksi, "
                    SELECT p.*, k.nama_kategori 
                    FROM tb_produk p 
                    JOIN tb_kategori_produk k ON p.id_kat_produk = k.id_kat_produk
                    WHERE p.id_kat_produk = $id_kat
                    ORDER BY p.tanggal_ditambahkan DESC
                ");

                if (mysqli_num_rows($produk) == 0) {
                    echo "<div class='col-12'><div class='alert alert-warning'>Tidak ada produk dalam kategori ini.</div></div>";
                }

                while ($p = mysqli_fetch_array($produk)) {
                ?>
                <div class="col-md-6 col-xl-4 col-sm-6">
                    <div class="card">
                        <div class="product-grid6">
                            <div class="product-image6 p-5">
                                <ul class="icons">
                                    <li><a href="produk_deskripsi.php?id=<?= $p['id_produk'] ?>" class="btn btn-primary"><i class="fe fe-eye"></i></a></li>
                                    <li><a href="produk_edit.php?id=<?= $p['id_produk'] ?>" class="btn btn-success"><i class="fe fe-edit"></i></a></li>
                                    <li><a href="../admin/produk_hapus.php?id=<?= $p['id_produk'] ?>" onclick="return confirm('Hapus produk ini?')" class="btn btn-danger"><i class="fe fe-x"></i></a></li>
                                </ul>
                                <a href="produk_deskripsi.php?id=<?= $p['id_produk'] ?>">
                                    <img class="img-fluid br-7 w-100" src="../uploads/produk/<?= $p['gambar_produk'] ?>" alt="<?= $p['nama_produk'] ?>">
                                </a>
                            </div>
                            <div class="card-body pt-0">
                                <div class="product-content text-center">
                                    <h1 class="title fw-bold fs-20"><?= htmlspecialchars($p['nama_produk']) ?></h1>
                                    <div class="price">Rp<?= number_format($p['harga_produk'], 0, ',', '.') ?></div>
                                    <small class="text-muted"><?= $p['nama_kategori'] ?></small>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <a href="cart.php?add=<?= $p['id_produk'] ?>" class="btn btn-primary mb-1"><i class="fe fe-shopping-cart mx-2"></i>Add to cart</a>
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>

        </div>
    </div>
</div>

<?php include('footer.php') ?>
