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

                                <!-- <button class="btn btn-icon btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#largemodal_tambah">Tambah<i class="fe fe-plus"></i></button> -->
                                <?php include('penerima_lisdes_modal_tambah.php') ?>

                                <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0 text-center">No</th>
                                            <th class="wd-15p border-bottom-0 text-center">Nama Penerima</th>
                                            <!-- <th class="wd-15p border-bottom-0 text-center">Nama Kab/Kota</th>                                            -->
                                            <th class="wd-15p border-bottom-0 text-center">Nama Kecamatan</th>
                                            <th class="wd-15p border-bottom-0 text-center">Nama Desa</th>
                                            <!-- <th class="wd-15p border-bottom-0 text-center">Persetujuan Admin</th>                                                                                                                                                                             -->
                                            <th class="wd-15p border-bottom-0 text-center">Persetujuan Admin</th>                                                                                                                                                                            
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
                                                                        JOIN tb_desa ON tb_penerima_lisdes.id_desa = tb_desa.id_desa;
                                                                        ");
                                        while ($d = mysqli_fetch_array($data)) {
                                        ?>

                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class=""><?= $d['nama_calon_konsumen'] ?></td>
                                            <!-- <td class=""><?php echo $d['id_kab_kota'] ?></td> -->
                                            <td class=""><?= $d['nama_kecamatan'] ?></td>
                                            <td class=""><?= $d['nama_desa'] ?></td>
                                            <!-- <td class="text-center">
                                                <?php
                                                include('../case_status_pemasangan.php')
                                                ?>
                                            </td> -->
                                            <td class="text-center">
                                                <?php include('../case_status_pemasangan.php') ?>
                                            </td>

                                            <td class="text-center">
                                                <a href="../admin-penerima-lisdes/penerima_lisdes_hapus.php?id_penerima_lisdes=<?= $d['id_penerima_lisdes'] ?>" type="button" class="btn btn-icon btn-sm btn-danger" 
                                                onclick="return confirm('Anda yakin Hapus data Penerima Listrik Desa <?php echo $d['nama_calon_konsumen']; ?> ?')"><i class="fe fe-trash-2"></i></a>
                                                <button class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#largemodal_edit<?= $d['id_penerima_lisdes'] ?>"><i class="fe fe-edit"></i></button>
                                                <!-- <button class="btn btn-icon btn-sm btn-success" data-bs-toggle="modal" data-bs-target="#largemodal_status<?= $d['id_penerima_lisdes'] ?>"><i class="fe fe-check"></i></button> -->
                                                <button class="btn btn-icon btn-sm btn-info" data-bs-toggle="modal" data-bs-target="#largemodal_detail<?= $d['id_penerima_lisdes'] ?>"><i class="fe fe-eye"></i></button>
                                                
                                                <?php include('penerima_lisdes_modal_edit.php') ?>
                                                <?php include('penerima_lisdes_modal_status.php') ?>
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