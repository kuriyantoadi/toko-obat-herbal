-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 13, 2025 at 08:55 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `toko-obat-herbal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori_produk`
--

CREATE TABLE `tb_kategori_produk` (
  `id_kat_produk` int(11) NOT NULL,
  `nama_kategori` varchar(100) NOT NULL,
  `deskripsi_kategori` text,
  `status_kategori` enum('aktif','nonaktif') DEFAULT 'aktif',
  `tanggal_dibuat` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_kategori_produk`
--

INSERT INTO `tb_kategori_produk` (`id_kat_produk`, `nama_kategori`, `deskripsi_kategori`, `status_kategori`, `tanggal_dibuat`) VALUES
(1, 'Madu', 'madu', 'aktif', '2025-07-13 21:09:57'),
(2, 'Jeruk', 'Jeruk', '', '2025-07-15 19:15:42');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order`
--

CREATE TABLE `tb_order` (
  `id_order` int(11) NOT NULL,
  `id_pelanggan` int(11) NOT NULL,
  `tanggal_order` datetime DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `status_pembayaran` varchar(20) DEFAULT 'belum',
  `bukti_transfer` varchar(255) DEFAULT NULL,
  `metode_pembayaran` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order`
--

INSERT INTO `tb_order` (`id_order`, `id_pelanggan`, `tanggal_order`, `total`, `status_pembayaran`, `bukti_transfer`, `metode_pembayaran`) VALUES
(3, 4, '2025-07-27 08:07:15', 30000, 'Belum Lunas', NULL, 'Transfer'),
(4, 4, '2025-07-27 08:28:16', 20000, 'lunas', 'bukti_4_1753598366.jpeg', 'Transfer'),
(5, 4, '2025-07-27 08:46:06', 420000, 'Belum Lunas', NULL, 'Transfer');

-- --------------------------------------------------------

--
-- Table structure for table `tb_order_detail`
--

CREATE TABLE `tb_order_detail` (
  `id_detail` int(11) NOT NULL,
  `id_order` int(11) DEFAULT NULL,
  `id_produk` int(11) DEFAULT NULL,
  `jumlah` int(11) DEFAULT NULL,
  `harga` int(11) DEFAULT NULL,
  `subtotal` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_order_detail`
--

INSERT INTO `tb_order_detail` (`id_detail`, `id_order`, `id_produk`, `jumlah`, `harga`, `subtotal`) VALUES
(10, 3, 7, 1, 20000, 20000),
(11, 3, 8, 1, 10000, 10000),
(12, 4, 7, 1, 20000, 20000),
(13, 5, 6, 2, 200000, 400000),
(14, 5, 7, 1, 20000, 20000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_pelanggan`
--

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL,
  `nama_pelanggan` varchar(100) NOT NULL,
  `email_pelanggan` varchar(100) NOT NULL,
  `password_pelanggan` text NOT NULL,
  `no_hp_pelanggan` varchar(20) DEFAULT NULL,
  `alamat_pelanggan` text,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_pelanggan`
--

INSERT INTO `tb_pelanggan` (`id_pelanggan`, `nama_pelanggan`, `email_pelanggan`, `password_pelanggan`, `no_hp_pelanggan`, `alamat_pelanggan`, `created_at`, `status`) VALUES
(3, 'siti', 'siti@gmail.com', '$2y$10$yWpQV0oFt/z1av8dKuydJOk/xwuW33xv2hXFwcuESFBLgd2xB0rqO', '123', 'serang', '2025-07-27 02:54:22', 'aktif'),
(4, 'agus', 'agus@gmail.com', '$2y$10$X2PDg1OIAakzkij/jrNF7upjidYqtr11aNYj/AL62HfgPDJQXe.QK', '123', 'serang', '2025-07-27 03:51:15', 'aktif');

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(11) NOT NULL,
  `id_kat_produk` int(11) NOT NULL,
  `nama_produk` varchar(255) NOT NULL,
  `stok_produk` int(11) DEFAULT '0',
  `gambar_produk` varchar(255) DEFAULT NULL,
  `tanggal_ditambahkan` datetime DEFAULT CURRENT_TIMESTAMP,
  `deskripsi_produk` text,
  `berat_produk` int(11) DEFAULT '0',
  `harga_produk` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `id_kat_produk`, `nama_produk`, `stok_produk`, `gambar_produk`, `tanggal_ditambahkan`, `deskripsi_produk`, `berat_produk`, `harga_produk`) VALUES
(6, 1, 'Madu Murni', 10, 'produk_687407fee1f7e.jpeg', '2025-07-13 21:24:46', '', 200, 200000),
(7, 1, 'Jeruk Herbal', 1, 'produk_6876959b5ce46.jpeg', '2025-07-16 00:53:31', 'Jeruk Herbal', 100, 20000),
(8, 2, 'Sabun Herbal', 10, 'produk_68856c6997c1f.jpeg', '2025-07-27 02:01:45', '', 500, 10000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_review_produk`
--

CREATE TABLE `tb_review_produk` (
  `id_review` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `nama_reviewer` varchar(100) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL,
  `komentar` text,
  `tanggal_review` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_staff_desa` varchar(50) NOT NULL,
  `status_staff` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `username`, `password`, `nama_staff_desa`, `status_staff`) VALUES
(10, 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', '', ''),
(11, 'pimpinan', '59335c9f58c78597ff73f6706c6c8fa278e08b3a', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_kategori_produk`
--
ALTER TABLE `tb_kategori_produk`
  ADD PRIMARY KEY (`id_kat_produk`);

--
-- Indexes for table `tb_order`
--
ALTER TABLE `tb_order`
  ADD PRIMARY KEY (`id_order`);

--
-- Indexes for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_order` (`id_order`);

--
-- Indexes for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  ADD PRIMARY KEY (`id_pelanggan`),
  ADD UNIQUE KEY `email_pelanggan` (`email_pelanggan`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD KEY `id_kat_produk` (`id_kat_produk`);

--
-- Indexes for table `tb_review_produk`
--
ALTER TABLE `tb_review_produk`
  ADD PRIMARY KEY (`id_review`),
  ADD KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_kategori_produk`
--
ALTER TABLE `tb_kategori_produk`
  MODIFY `id_kat_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tb_order`
--
ALTER TABLE `tb_order`
  MODIFY `id_order` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  MODIFY `id_detail` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tb_pelanggan`
--
ALTER TABLE `tb_pelanggan`
  MODIFY `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tb_review_produk`
--
ALTER TABLE `tb_review_produk`
  MODIFY `id_review` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tb_user`
--
ALTER TABLE `tb_user`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_order_detail`
--
ALTER TABLE `tb_order_detail`
  ADD CONSTRAINT `tb_order_detail_ibfk_1` FOREIGN KEY (`id_order`) REFERENCES `tb_order` (`id_order`);

--
-- Constraints for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD CONSTRAINT `tb_produk_ibfk_1` FOREIGN KEY (`id_kat_produk`) REFERENCES `tb_kategori_produk` (`id_kat_produk`);

--
-- Constraints for table `tb_review_produk`
--
ALTER TABLE `tb_review_produk`
  ADD CONSTRAINT `tb_review_produk_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
