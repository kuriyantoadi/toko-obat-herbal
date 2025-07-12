<div class="main-content app-content mt-0">
    <div class="side-app">

        <!-- CONTAINER -->
        <div class="main-container container-fluid">

            <!-- PAGE-HEADER -->
            <div class="page-header">
                <h1 class="page-title">Desa</h1>
                <div>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="javascript:void(0)">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Desa</li>
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
                            <h3 class="card-title">Data Desa</h3>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                
                                <?php include('../alert.php') ?>

                                <button class="btn btn-icon btn-sm btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#largemodal_tambah">Tambah<i class="fe fe-plus"></i></button>
                                <?php include('desa_modal_tambah.php') ?>

                                <table class="table table-bordered text-nowrap border-bottom" id="basic-datatable">
                                    <thead>
                                        <tr>
                                            <th class="wd-15p border-bottom-0 text-center">No</th>
                                            <th class="wd-15p border-bottom-0 text-center">Nama Kab/Kota</th>                                           
                                            <th class="wd-15p border-bottom-0 text-center">Nama Kecamatan</th>
                                            <th class="wd-15p border-bottom-0 text-center">Nama Desa</th>                                                                                      
                                            <th class="wd-25p border-bottom-0 text-center">Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        include '../koneksi.php';
                                        $no = 1;
                                        $data = mysqli_query($koneksi, "SELECT * from tb_kecamatan, tb_kab_kota, tb_desa WHERE 
                                        tb_kecamatan.id_kab_kota=tb_kab_kota.id_kab_kota AND 
                                        tb_desa.id_kecamatan=tb_kecamatan.id_kecamatan");
                                        while ($d = mysqli_fetch_array($data)) {
                                        ?>

                                        <tr>
                                            <td class="text-center"><?= $no++ ?></td>
                                            <td class=""><?= $d['nama_kab_kota'] ?></td>
                                            <td class=""><?= $d['nama_kecamatan'] ?></td>
                                            <td class=""><?= $d['nama_desa'] ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-icon btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#largemodal_edit<?= $d['id_desa'] ?>"><i class="fe fe-edit"></i></button>
                                                <a href="../data-master/desa_hapus.php?id_desa=<?= $d['id_desa'] ?>" type="button" class="btn btn-icon btn-sm btn-danger" 
                                                onclick="return confirm('Anda yakin Hapus data desa <?php echo $d['nama_desa']; ?> ?')"><i class="fe fe-trash-2"></i></a>
                                                <?php include('desa_modal.php') ?>                                                
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