<?php include('header.php'); ?>
<?php include('header-menu.php'); ?>
<?php include('../koneksi.php'); ?>

<div class="main-content app-content mt-0">
  <div class="side-app">
    <div class="main-container container-fluid">

      <!-- PAGE HEADER -->
      <div class="page-header">
        <h1 class="page-title">Daftar Pesanan</h1>
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Pesanan</li>
          </ol>
        </div>
      </div>

      <!-- PESANAN TABLE -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Data Checkout / Pesanan Masuk</h3>
            </div>
            <div class="card-body table-responsive">
                <?php include('../alert.php') ?>
              <table class="table table-bordered table-striped">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pembeli</th>
                    <th>No. HP</th>
                    <th>Alamat Pembeli</th>
                    <th>Total</th>
                    <th>Status Pembayaran</th>
                    <th>Detail</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT * FROM tb_order ORDER BY tanggal_order DESC");
                  while ($row = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= date('d-m-Y H:i', strtotime($row['tanggal_order'])) ?></td>
                      <td><?= htmlspecialchars($row['nama_pembeli']) ?></td>
                      <td><?= htmlspecialchars($row['no_hp']) ?></td>
                      <td><?= htmlspecialchars($row['alamat_pembeli']) ?></td>
                      <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
                        
                      <td><center>
                        <span class="badge bg-<?= $row['status_pembayaran'] == 'lunas' ? 'success' : 'danger' ?>">
                          <?= ucfirst($row['status_pembayaran']) ?>
                        </span>
                      </td>
                      <td>
                            <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_detail_pesanan<?= $row['id_order'] ?>">
                                <i class="fe fe-eye"></i> Detail
                            </button>

                            <?php include('pesanan_modal_detail.php'); ?>
                            <a href="invoice_cetak.php?id=<?= $row['id_order'] ?>" target="_blank" class="btn btn-outline-secondary btn-sm mt-1">
                                <i class="fe fe-printer"></i> Invoice
                            </a>
                       

                          <!-- Tombol Konfirmasi Pembayaran -->
                            <?php if (strtolower($row['status_pembayaran']) != 'lunas') { ?>
                            <button class="btn btn-success btn-sm mt-1" data-bs-toggle="modal" data-bs-target="#modal_konfirmasi<?= $row['id_order'] ?>">
                                <i class="fe fe-check-circle"></i> Konfirmasi
                            </button>
                            <?php include('pesanan_modal_konfirmasi.php'); ?>
                            <?php } else { ?>
                            <span class="badge bg-success mt-1">Sudah Lunas</span>
                            <?php } ?>

                        </td>

                    </tr>
                  <?php } ?>
                  <?php if (mysqli_num_rows($data) == 0): ?>
                    <tr>
                      <td colspan="9" class="text-center">Belum ada pesanan.</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>

<?php include('footer.php'); ?>
