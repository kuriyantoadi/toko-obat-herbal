<?php
if (isset($_GET['pesan'])) {
    $pesan = $_GET['pesan'];

    switch ($pesan) {
        case "gagal":
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                Username atau Password Salah
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "logout":
            echo "
            <div class='alert alert-primary alert-dismissible fade show' role='alert'>
                Anda Berhasil Logout
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "belum_login":
            echo "
            <div class='alert alert-primary alert-dismissible fade show' role='alert'>
                Anda Harus Login
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "edit_berhasil":
            echo "
            <div class='alert alert-primary alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                <strong>Edit Data Berhasil</strong>
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "hapus_berhasil":
            echo "
            <div class='alert alert-primary alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                <strong>Hapus Data Berhasil</strong>
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "tambah_berhasil":
        case "tambah-berhasil":
            echo "
            <div class='alert alert-primary alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                <strong>Tambah Data Berhasil</strong>
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "edit_password_berhasil":
            echo "
            <div class='alert alert-primary alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                <strong>Edit Password Berhasil</strong>
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "data_sudah_ada":
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                <strong>Tambah Data Gagal, Data Sudah Ada</strong>
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "nik_sudah_ada":
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                <strong>Tambah Data Gagal, NIK Sudah Ada</strong>
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "update_status_berhasil":
            echo "
            <div class='alert alert-info alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                <strong>Update Status Listrik Desa Berhasil</strong>
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "konfirmasi_berhasil":
            echo "
            <div class='alert alert-info alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                <strong>Konfirmasi Pembayaran Sukses</strong>
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "kategori_dipakai":
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                <strong>Kategori tidak dapat dihapus</strong><br>
                Karena masih digunakan oleh produk yang terdaftar.
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "id_tidak_valid":
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                ID kategori tidak valid.
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "hapus_gagal":
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                <strong>Gagal Menghapus Data</strong><br>
                Silakan coba lagi atau hubungi administrator.
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "id_tidak_valid":
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                ID Produk tidak valid.
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "id_tidak_ditemukan":
            echo "
            <div class='alert alert-warning alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                Produk tidak ditemukan atau sudah dihapus sebelumnya.
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

        case "hapus_gagal":
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert' style='margin-top: 20px'>
                <strong>Gagal Menghapus Produk</strong><br>
                Silakan coba lagi atau hubungi administrator.
                <button class='btn-close' type='button' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>
            ";
            break;

    }
}
?>
