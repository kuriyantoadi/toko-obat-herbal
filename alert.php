<?php
    if (isset($_GET['pesan'])) {
        if ($_GET['pesan'] == "gagal") {
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Username atau Password Salah
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        } elseif ($_GET['pesan'] == "logout") {
            echo "
            <div class='alert alert-primary alert-dismissible fade show' role='alert'>
                Anda Berhasil Logout
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        } elseif ($_GET['pesan'] == "edit_berhasil") {
            echo "
            <div class='alert alert-primary alert-dismissible fade show' role='alert pt-5' style='margin-top: 20px'>
                <span class='alert-inner--text'><strong>Edit Data Berhasil</strong></span>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            ";
        } elseif ($_GET['pesan'] == "hapus_berhasil") {
            echo "
            <div class='alert alert-primary alert-dismissible fade show' role='alert pt-5' style='margin-top: 20px'>
                <span class='alert-inner--text'><strong>Hapus Data Berhasil</strong></span>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            ";
        } elseif ($_GET['pesan'] == "belum_login") {
            echo "
            <div class='alert alert-primary alert-dismissible fade show' role='alert'>
                Anda Harus Login
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
        } elseif ($_GET['pesan'] == "tambah_berhasil") {
            echo "
            <div class='alert alert-primary alert-dismissible fade show' role='alert pt-5' style='margin-top: 20px'>
                <span class='alert-inner--text'><strong>Tambah Data Berhasil</strong></span>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            ";
         } elseif ($_GET['pesan'] == "edit_password_berhasil") {
            echo "
           <div class='alert alert-primary alert-dismissible fade show' role='alert pt-5' style='margin-top: 20px'>
                <span class='alert-inner--text'><strong>Edit Password Berhasil</strong></span>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            ";
        } elseif ($_GET['pesan'] == "data_sudah_ada") {
            echo "
           <div class='alert alert-warning alert-dismissible fade show' role='alert pt-5' style='margin-top: 20px'>
                <span class='alert-inner--text'><strong>Tambah Data Gagal, Data Sudah Ada</strong></span>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            ";

        } elseif ($_GET['pesan'] == "nik_sudah_ada") {
            echo "
           <div class='alert alert-warning alert-dismissible fade show' role='alert pt-5' style='margin-top: 20px'>
                <span class='alert-inner--text'><strong>Tambah Data Gagal, Data Sudah NIK Sudah Ada</strong></span>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            ";
        } elseif ($_GET['pesan'] == "update_status_berhasil") {
            echo "
           <div class='alert alert-info alert-dismissible fade show' role='alert pt-5' style='margin-top: 20px'>
                <span class='alert-inner--text'><strong>Update Status Listrik Desa Berhasil</strong></span>
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>×</span>
                </button>
            </div>
            ";
        } 
        
    }
?>