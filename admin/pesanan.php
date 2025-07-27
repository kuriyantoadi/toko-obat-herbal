<?php include('header.php'); ?>
<?php include('header-menu.php'); ?>
<?php include('../koneksi.php'); ?>

<div class="main-content app-content mt-0">
  <div class="side-app">
    <div class="main-container container-fluid">

      <!-- PAGE HEADER -->
      <div class="page-header">
        <h1 class="page-title">Pesanan Lunas</h1>
        <div>
          <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.php">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Lunas</li>
          </ol>
        </div>
      </div>

      <!-- TABEL PESANAN LUNAS -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Pesanan yang Sudah Lunas</h3>
            </div>
            <div class="card-body table-responsive">
            <?php include('../alert.php') ?>
            <?php include('pesanan-btn.php') ?>
              <table class="table table-bordered table-striped" id="lunas-datatable">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Tanggal</th>
                    <th>Nama Pembeli</th>
                    <th>No. HP</th>
                    <th>Alamat</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Aksi</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $no = 1;
                  $data = mysqli_query($koneksi, "SELECT * FROM tb_pelanggan, tb_order WHERE tb_pelanggan.id_pelanggan=tb_order.id_order ORDER BY tanggal_order DESC");
                  while ($row = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= date('d-m-Y H:i', strtotime($row['tanggal_order'])) ?></td>
                      <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
                      <td><?= htmlspecialchars($row['no_hp_pelanggan']) ?></td>
                      <td><?= htmlspecialchars($row['alamat_pelanggan']) ?></td>
                      <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
                      <td><span class="badge bg-success"><?= ucfirst($row['status_pembayaran']) ?></span></td>
                      <td>
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_detail_pesanan<?= $row['id_order'] ?>">
                          <i class="fe fe-eye"></i> Detail
                        </button>
                        <?php include('pesanan_modal_detail.php'); ?>

                        <a href="invoice_cetak.php?id=<?= $row['id_order'] ?>" target="_blank" class="btn btn-warning btn-sm">
                          <i class="fe fe-printer"></i> Invoice
                        </a>
                      </td>
                    </tr>
                  <?php } ?>
                  
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

<!-- DataTable Script -->
<script>
  $(document).ready(function () {
    $('#lunas-datatable').DataTable({
      language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ entri",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        paginate: {
          first: "Pertama",
          last: "Terakhir",
          next: "Berikutnya",
          previous: "Sebelumnya"
        },
        zeroRecords: "Tidak ada data ditemukan",
        infoEmpty: "Menampilkan 0 sampai 0 dari 0 entri"
      }
    });
  });
</script>
