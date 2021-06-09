-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2021 at 08:18 AM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pangkalan`
--

-- --------------------------------------------------------

--
-- Table structure for table `akun`
--

CREATE TABLE `akun` (
  `id_akun` int(11) NOT NULL,
  `level` enum('Admin','Desa','Pangkalan','Pemilik') NOT NULL,
  `username` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` enum('Aktif','Tidak Aktif','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `akun`
--

INSERT INTO `akun` (`id_akun`, `level`, `username`, `password`, `status`) VALUES
(0, 'Admin', '12221', '00c1de56b1cbab48f9869c1460d70e76', 'Aktif'),
(1, 'Admin', 'admin', '21232f297a57a5a743894a0e4a801fc3', 'Aktif'),
(45, 'Desa', 'desa', 'e54cc06625bbadf12163b41a3cb92bf8', 'Aktif'),
(46, 'Pemilik', 'pemilik', '58399557dae3c60e23c78606771dfa3d', 'Aktif'),
(47, 'Pangkalan', 'pangkalan', '6e6bb6ef15e71de0346b7f5d8185072f', 'Aktif'),
(48, 'Admin', 'susiowati', 'a03467de27e2720ad2fe5115cf3920d3', 'Aktif');

-- --------------------------------------------------------

--
-- Table structure for table `desa`
--

CREATE TABLE `desa` (
  `id_desa` int(11) NOT NULL,
  `desa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `desa`
--

INSERT INTO `desa` (`id_desa`, `desa`) VALUES
(1, 'Kintapura lama'),
(2, 'Bukit Mulia'),
(3, 'Pasir Putih'),
(4, 'Riam Adungan'),
(5, 'Kintap Kecil'),
(6, 'Salaman');

-- --------------------------------------------------------

--
-- Table structure for table `masyarakat`
--

CREATE TABLE `masyarakat` (
  `no_kk` varchar(18) NOT NULL,
  `id_barcode` int(10) NOT NULL,
  `alamat` text NOT NULL,
  `nama_kepala` varchar(100) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `rt` varchar(5) NOT NULL,
  `file_barcode` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `masyarakat`
--

INSERT INTO `masyarakat` (`no_kk`, `id_barcode`, `alamat`, `nama_kepala`, `id_desa`, `rt`, `file_barcode`) VALUES
('12221', 2, 'bukit', 'Kim Seokjin', 1, '12', 'uass'),
('123456789', 5, 'bukit baru', 'Salim', 6, '12', '123456789.png'),
('1234587', 4, 'BB', 'Tina', 1, '12', '1234587.png'),
('13241', 5, 'D', 'FWE', 1, '1', '13241.png');

-- --------------------------------------------------------

--
-- Table structure for table `pangkalan`
--

CREATE TABLE `pangkalan` (
  `id_pangkalan` int(11) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `id_akun` int(11) DEFAULT NULL,
  `id_pemilik` int(11) DEFAULT NULL,
  `alamat_pangkalan` text NOT NULL,
  `no_telp_pangkalan` varchar(15) NOT NULL,
  `nama_pangkalan` varchar(100) NOT NULL,
  `penangung_jawab` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pangkalan`
--

INSERT INTO `pangkalan` (`id_pangkalan`, `id_desa`, `id_akun`, `id_pemilik`, `alamat_pangkalan`, `no_telp_pangkalan`, `nama_pangkalan`, `penangung_jawab`) VALUES
(0, 1, 1, 2, 'nnnn', '098765435566', 'kepo', 'Virgian'),
(2, 1, NULL, NULL, 'nnnn', '098765435566', 'Yasmingas', 'Virgian'),
(3, 1, NULL, 2, 'NDUWE BOJO SENG GALAK', '098781627612', 'YOWESBEN', 'YO WES BENN '),
(4, 1, 47, 4, 'bukit mulia rt 12', '09876544324', 'Nur TOKO', 'Fahri'),
(5, 2, 47, 4, 'dirumah pak giman', '0812773444742', 'Nandashop', 'Yasmin'),
(6, 6, 48, 4, 'yuhuuuu', '123719102', 'Beligasbeligas', 'Angres');

-- --------------------------------------------------------

--
-- Table structure for table `pembelian`
--

CREATE TABLE `pembelian` (
  `id_pembelian` int(11) NOT NULL,
  `id_pangkalan` int(11) DEFAULT NULL,
  `tgl_pembelian` date NOT NULL,
  `no_kk` varchar(18) DEFAULT NULL,
  `jml_tabung` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembelian`
--

INSERT INTO `pembelian` (`id_pembelian`, `id_pangkalan`, `tgl_pembelian`, `no_kk`, `jml_tabung`) VALUES
(0, 2, '2021-05-05', '12221', 0);

-- --------------------------------------------------------

--
-- Table structure for table `pemilik`
--

CREATE TABLE `pemilik` (
  `id_pemilik` int(11) NOT NULL,
  `nama_pemilik` varchar(50) NOT NULL,
  `alamat_pemilik` text NOT NULL,
  `no_telp_pemilik` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pemilik`
--

INSERT INTO `pemilik` (`id_pemilik`, `nama_pemilik`, `alamat_pemilik`, `no_telp_pemilik`) VALUES
(2, 'Akhmad Yani Palalng Tibain', 'Jl Kenanga', '1329999'),
(3, 'Susiowati', 'Kintap Lama Aja', '0812345366521'),
(4, 'Millenia Yasmine Tibian', 'Bukit', '082191533373');

-- --------------------------------------------------------

--
-- Table structure for table `petugas`
--

CREATE TABLE `petugas` (
  `id_petugas` int(11) NOT NULL,
  `nama_petugas` varchar(50) NOT NULL,
  `id_desa` int(11) DEFAULT NULL,
  `id_akun` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `petugas`
--

INSERT INTO `petugas` (`id_petugas`, `nama_petugas`, `id_desa`, `id_akun`) VALUES
(1, 'Tina tun', 1, NULL),
(2, 'Paijo', 1, NULL),
(4, 'Yasminnnnnnn cans', 1, NULL),
(5, 'Susiowati', 1, 48);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `akun`
--
ALTER TABLE `akun`
  ADD PRIMARY KEY (`id_akun`);

--
-- Indexes for table `desa`
--
ALTER TABLE `desa`
  ADD PRIMARY KEY (`id_desa`);

--
-- Indexes for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD PRIMARY KEY (`no_kk`),
  ADD KEY `id_desa` (`id_desa`);

--
-- Indexes for table `pangkalan`
--
ALTER TABLE `pangkalan`
  ADD PRIMARY KEY (`id_pangkalan`),
  ADD KEY `id_desa` (`id_desa`),
  ADD KEY `id_akun` (`id_akun`),
  ADD KEY `id_pemilik` (`id_pemilik`);

--
-- Indexes for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD PRIMARY KEY (`id_pembelian`),
  ADD KEY `id_pangkalan` (`id_pangkalan`),
  ADD KEY `no_kk` (`no_kk`);

--
-- Indexes for table `pemilik`
--
ALTER TABLE `pemilik`
  ADD PRIMARY KEY (`id_pemilik`);

--
-- Indexes for table `petugas`
--
ALTER TABLE `petugas`
  ADD PRIMARY KEY (`id_petugas`),
  ADD KEY `id_desa` (`id_desa`),
  ADD KEY `id_akun` (`id_akun`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `akun`
--
ALTER TABLE `akun`
  MODIFY `id_akun` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `desa`
--
ALTER TABLE `desa`
  MODIFY `id_desa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pangkalan`
--
ALTER TABLE `pangkalan`
  MODIFY `id_pangkalan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pembelian`
--
ALTER TABLE `pembelian`
  MODIFY `id_pembelian` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pemilik`
--
ALTER TABLE `pemilik`
  MODIFY `id_pemilik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `petugas`
--
ALTER TABLE `petugas`
  MODIFY `id_petugas` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `masyarakat`
--
ALTER TABLE `masyarakat`
  ADD CONSTRAINT `masyarakat_ibfk_1` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pangkalan`
--
ALTER TABLE `pangkalan`
  ADD CONSTRAINT `pangkalan_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pangkalan_ibfk_2` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pangkalan_ibfk_3` FOREIGN KEY (`id_pemilik`) REFERENCES `pemilik` (`id_pemilik`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `pembelian`
--
ALTER TABLE `pembelian`
  ADD CONSTRAINT `pembelian_ibfk_1` FOREIGN KEY (`id_pangkalan`) REFERENCES `pangkalan` (`id_pangkalan`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `pembelian_ibfk_2` FOREIGN KEY (`no_kk`) REFERENCES `masyarakat` (`no_kk`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `petugas`
--
ALTER TABLE `petugas`
  ADD CONSTRAINT `petugas_ibfk_1` FOREIGN KEY (`id_akun`) REFERENCES `akun` (`id_akun`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `petugas_ibfk_2` FOREIGN KEY (`id_desa`) REFERENCES `desa` (`id_desa`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
