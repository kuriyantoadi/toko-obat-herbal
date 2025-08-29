<?php include('header.php'); ?>
<?php include('header-menu.php'); ?>
<?php include('../koneksi.php'); ?>

<?php $id_pelanggan = $_SESSION['id_pelanggan']; ?>

<div class="main-content app-content mt-0">
  <div class="side-app">
    <div class="main-container container-fluid">

      <!-- TABEL PESANAN PELANGGAN -->
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Daftar Pesanan Pelanggan</h3>
            </div>
            <div class="card-body table-responsive">
              <?php include('../alert.php') ?>
              <table class="table table-bordered table-striped" id="pesanan-datatable">
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
                  $data = mysqli_query($koneksi, "SELECT * 
                                                  FROM tb_pelanggan 
                                                  JOIN tb_order ON tb_pelanggan.id_pelanggan = tb_order.id_pelanggan 
                                                  WHERE tb_order.id_pelanggan = $id_pelanggan 
                                                  ORDER BY tb_order.tanggal_order DESC
                                                ");
                  while ($row = mysqli_fetch_array($data)) {
                  ?>
                    <tr>
                      <td></td> <!-- nomor urut diisi otomatis DataTables -->
                      <td><?= date('d-m-Y H:i', strtotime($row['tanggal_order'])) ?></td>
                      <td><?= htmlspecialchars($row['nama_pelanggan']) ?></td>
                      <td><?= htmlspecialchars($row['no_hp_pelanggan']) ?></td>
                      <td><?= htmlspecialchars($row['alamat_pelanggan']) ?></td>
                      <td>Rp<?= number_format($row['total'], 0, ',', '.') ?></td>
                      <?php include('../case_status_pembayaran.php'); ?>

                      <td>
                        <!-- Tombol Detail -->
                        <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#modal_detail_pesanan<?= $row['id_order'] ?>">
                          <i class="fe fe-eye"></i> 
                        </button>
                        <?php include('pesanan_modal_detail.php'); ?>

                        <!-- Tombol Cetak Invoice -->
                        <a href="invoice_cetak.php?id=<?= $row['id_order'] ?>" target="_blank" class="btn btn-warning btn-sm">
                          <i class="fe fe-printer"></i> 
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
    var t = $('#pesanan-datatable').DataTable({
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

    // Nomor urut otomatis di kolom pertama
    t.on('order.dt search.dt', function () {
      t.column(0, { search: 'applied', order: 'applied' })
        .nodes()
        .each(function (cell, i) {
          cell.innerHTML = i + 1;
        });
    }).draw();
  });
</script>
