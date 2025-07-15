<?php
include('header.php');
include('header-menu.php');
include('../koneksi.php');

// Konfigurasi pagination
$limit = 9; // Jumlah produk per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$page = max($page, 1);
$start = ($page - 1) * $limit;

// Hitung total produk
$result_count = mysqli_query($koneksi, "SELECT COUNT(*) as total FROM tb_produk");
$total_data = mysqli_fetch_assoc($result_count)['total'];
$total_page = ceil($total_data / $limit);

// Ambil produk sesuai halaman
$produk = mysqli_query($koneksi, "
  SELECT p.*, k.nama_kategori 
  FROM tb_produk p 
  JOIN tb_kategori_produk k ON p.id_kat_produk = k.id_kat_produk
  ORDER BY p.tanggal_ditambahkan DESC
  LIMIT $start, $limit
");
?>

<!-- Konten -->
<div class="main-content app-content mt-0">
  <div class="side-app">
    <div class="main-container container-fluid">

      <!-- Header Halaman -->
      <div class="page-header">
        <h1 class="page-title">Produk</h1>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="#">E-Commerce</a></li>
          <li class="breadcrumb-item active" aria-current="page">Shop</li>
        </ol>
      </div>

      <div class="row row-cards">
        <!-- Sidebar Kategori -->
        <div class="col-xl-3 col-lg-4">
          <div class="card">
            <div class="card-header">
              <div class="card-title">Kategori</div>
            </div>
            <div class="card-body">
              <ul class="list-group">
                <?php
                $kategori = mysqli_query($koneksi, "
                  SELECT k.id_kat_produk, k.nama_kategori, COUNT(p.id_produk) as jumlah_produk
                  FROM tb_kategori_produk k
                  LEFT JOIN tb_produk p ON k.id_kat_produk = p.id_kat_produk
                  GROUP BY k.id_kat_produk
                  ORDER BY k.nama_kategori ASC
                ");
                while ($kat = mysqli_fetch_array($kategori)) {
                ?>
                  <li class="list-group-item border-0 p-0">
                    <a href="produk.php?kategori=<?= $kat['id_kat_produk'] ?>">
                      <i class="fe fe-chevron-right"></i> <?= htmlspecialchars($kat['nama_kategori']) ?>
                    </a>
                    <span class="product-label">(<?= $kat['jumlah_produk'] ?>)</span>
                  </li>
                <?php } ?>
              </ul>
            </div>
          </div>
        </div>

        <!-- Konten Produk -->
        <div class="col-xl-9 col-lg-8">
          <div class="row">
            <div class="col-xl-12">
              <div class="card p-0">
                <div class="card-body p-4">
                  <div class="row">
                    <div class="col-xl-8">
                      <div class="input-group d-flex w-100">
                        <input type="text" class="form-control border-end-0 my-2" placeholder="Search ...">
                        <button class="btn input-group-text border-start-0 my-2">
                          <i class="fe fe-search"></i>
                        </button>
                      </div>
                    </div>
                    <div class="col-xl-4 text-end">
                      <button class="btn btn-primary my-2" data-bs-toggle="modal" data-bs-target="#modal_tambah_produk">
                        <i class="fa fa-plus-square me-2"></i>New Product
                      </button>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Daftar Produk -->
          <div class="row">
            <?php while ($p = mysqli_fetch_array($produk)) { ?>
              <div class="col-md-6 col-xl-4 col-sm-6">
                <div class="card">
                  <div class="product-grid6">
                    <div class="product-image6 p-5">
                      <ul class="icons">
                        <li><a href="produk_deskripsi.php?id=<?= $p['id_produk'] ?>" class="btn btn-primary"><i class="fe fe-eye"></i></a></li>
                        <li><button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_edit_produk<?= $p['id_produk'] ?>"><i class="fe fe-edit"></i></button></li>
                        <li><a href="../admin/produk_hapus.php?id=<?= $p['id_produk'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus produk ini?')"><i class="fe fe-x"></i></a></li>
                      </ul>
                      <a href="produk_deskripsi.php?id=<?= $p['id_produk'] ?>">
                        <img class="img-fluid br-7 w-100" src="../uploads/produk/<?= $p['gambar_produk'] ?>" alt="produk">
                      </a>
                    </div>
                    <div class="card-body pt-0">
                      <div class="product-content text-center">
                        <h1 class="title fw-bold fs-20"><?= htmlspecialchars($p['nama_produk']) ?></h1>
                        <div class="price">Rp<?= number_format($p['harga_produk'], 0, ',', '.') ?></div>
                        <small class="text-muted"><?= htmlspecialchars($p['nama_kategori']) ?></small>
                      </div>
                    </div>
                    <div class="card-footer text-center">
                      <a href="cart.php?add=<?= $p['id_produk'] ?>" class="btn btn-primary mb-1"><i class="fe fe-shopping-cart mx-2"></i>Add to cart</a>
                    </div>
                  </div>
                </div>
              </div>
              <?php include('produk_modal_edit.php'); ?>
            <?php } ?>
          </div>

          <!-- Pagination -->
          <div class="mb-5 mt-4">
            <div class="float-end">
              <ul class="pagination">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                  <a class="page-link" href="?page=<?= $page - 1 ?>">&laquo;</a>
                </li>
                <?php for ($i = 1; $i <= $total_page; $i++) { ?>
                  <li class="page-item <?= $page == $i ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                  </li>
                <?php } ?>
                <li class="page-item <?= $page >= $total_page ? 'disabled' : '' ?>">
                  <a class="page-link" href="?page=<?= $page + 1 ?>">&raquo;</a>
                </li>
              </ul>
            </div>
          </div>

        </div>
      </div>
    </div>
  </div>
</div>

<?php include('produk_modal_tambah.php'); ?>
<?php include('footer.php'); ?>
