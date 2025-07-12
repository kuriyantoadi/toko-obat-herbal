<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Penerima Listrik Desa</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Listik Desa</li>
                    </ol>
                </div>
            </div>
            <!-- PAGE-HEADER END -->

            <!-- ROW-3 -->

            <!-- awal tabel -->

            <div class="row row-sm">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Penerima Listrik Desa</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php include('../alert.php') ?>

                                <button class="btn btn-icon btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#largemodal_tambah">Tambah<i class="fe fe-plus"></i></button>
                                <?php include('penerima_lisdes_modal_tambah.php') ?>

                                <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0 text-center">No</th>
                                            <th class="wd-15p border-bottom-0 text-center">Nama Penerima</th>                                           
                                            <th class="wd-15p border-bottom-0 text-center">Nama Kecamatan</th>
                                            <th class="wd-15p border-bottom-0 text-center">Nama Desa</th>
                                            <th class="wd-15p border-bottom-0 text-center">Pemasangan</th>                                                                                                                                                                            
                                            <th class="wd-25p border-bottom-0 text-center">Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../koneksi.php';
                                        $no = 1;
                                        $data = mysqli_query($koneksi, "SELECT tb_penerima_lisdes.*, tb_kab_kota.nama_kab_kota, tb_kecamatan.nama_kecamatan, tb_desa.nama_desa
                                                                        FROM tb_penerima_lisdes
                                                                        JOIN tb_kab_kota ON tb_penerima_lisdes.id_kab_kota = tb_kab_kota.id_kab_kota
                                                                        JOIN tb_kecamatan ON tb_penerima_lisdes.id_kecamatan = tb_kecamatan.id_kecamatan
                                                                        JOIN tb_desa ON tb_penerima_lisdes.id_desa = tb_desa.id_desa
                                                                        WHERE tb_penerima_lisdes.id_desa=$id_desa;");
                                        while ($d = mysqli_fetch_array($data)) {
                                        ?>

                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class=""><?= $d['nama_calon_konsumen'] ?></td>
                                            <td class=""><?= $d['nama_kecamatan'] ?></td>
                                            <td class=""><?= $d['nama_desa'] ?></td>
                                            <td class="text-center">
                                                <?php
                                                if ($d['status_pemasangan'] == 'Belum Terpasang') {
                                                    echo '<span class="badge bg-warning">Belum Terpasang</span>';
                                                } elseif ($d['status_pemasangan'] == 'Tolak') {
                                                    echo '<span class="badge bg-danger">Tolak</span>';
                                                } elseif ($d['status_pemasangan'] == 'Sudah Terpasang') {
                                                    echo '<span class="badge bg-success">Sudah Terpasang</span>';
                                                } else {
                                                    echo '<span class="badge bg-secondary">Tidak Diketahui</span>';
                                                }
                                                ?>
                                            </td>

                                            <td class="text-center">
                                                <button class="btn btn-icon btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#largemodal_detail<?= $d['id_penerima_lisdes'] ?>"><i class="fe fe-eye"></i></button>
                                                <?php include('penerima_lisdes_modal_detail.php') ?>                                                
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
            <!-- End Row -->            
            
        </div>
        <!-- CONTAINER END -->
    </div>
</div>
<!--app-content close-->
</div>