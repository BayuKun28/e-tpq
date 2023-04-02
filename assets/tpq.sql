-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 02, 2023 at 03:30 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tpq`
--

-- --------------------------------------------------------

--
-- Table structure for table `bulan`
--

DROP TABLE IF EXISTS `bulan`;
CREATE TABLE IF NOT EXISTS `bulan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bulan`
--

INSERT INTO `bulan` (`id`, `nama`) VALUES
(1, 'Januari'),
(2, 'Februari'),
(3, 'Maret'),
(4, 'April'),
(5, 'Mei'),
(6, 'Juni'),
(7, 'Juli'),
(8, 'Agustus'),
(9, 'September'),
(10, 'Oktober'),
(11, 'Nopember'),
(12, 'Desember');

-- --------------------------------------------------------

--
-- Table structure for table `identitas`
--

DROP TABLE IF EXISTS `identitas`;
CREATE TABLE IF NOT EXISTS `identitas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `app_name` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `identitas`
--

INSERT INTO `identitas` (`id`, `app_name`, `nama`, `alamat`, `no_hp`) VALUES
(1, 'E-TPQ', 'TPQ Darul Jannah Lalung Karanganyar', '9WRM+P49, Lalung, Karanganyar, Karanganyar Regency, Central Java 57716', '088888888');

-- --------------------------------------------------------

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_santri` int(11) NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  `nominal` double NOT NULL,
  `bulan` int(11) NOT NULL,
  `tahun` int(11) NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pembayaran`
--

INSERT INTO `pembayaran` (`id`, `id_santri`, `tanggal_pembayaran`, `nominal`, `bulan`, `tahun`, `keterangan`) VALUES
(1, 1, '2023-03-26 05:28:58', 100000, 3, 2023, 'lunas'),
(14, 8, '2023-03-28 09:22:53', 100000, 2, 2023, '123'),
(13, 8, '2023-03-28 12:14:54', 500000, 1, 2023, 'Lunas'),
(4, 6, '2023-03-26 05:47:12', 100000, 1, 2023, 'aa'),
(5, 6, '2023-03-26 05:48:15', 100000, 2, 2023, 'q'),
(6, 6, '2023-03-26 05:52:10', 100000, 3, 2023, 'ww'),
(12, 7, '2023-03-27 12:03:12', 200000, 1, 2023, 'Iuran Januarii'),
(11, 7, '2023-03-27 11:44:50', 100000, 3, 2023, 'lunas'),
(10, 6, '2023-03-26 13:14:33', 100000, 5, 2023, 'w'),
(15, 8, '2023-03-28 10:40:21', 100000, 3, 2023, '11'),
(16, 1, '2023-04-02 07:52:26', 20000, 4, 2023, 'Iuran Bulan April'),
(17, 10, '2023-04-02 10:11:19', 20000, 1, 2023, 'Bayar Januari'),
(18, 10, '2023-04-02 10:11:55', 25000, 2, 2023, 'Bayar Februari'),
(19, 10, '2023-04-02 10:12:04', 100000, 3, 2023, 'Bayar Maret');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE IF NOT EXISTS `pengguna` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int(1) DEFAULT NULL,
  `is_active` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `role` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `username`, `password`, `nama`, `role`, `is_active`) VALUES
(1, 'admin', '$2y$10$BNwXP8YdAeQqY97UD7mbG.9mVPJcJ4svg8c24hTSRIrEkLz3svpoS', 'Admin', 1, 1),
(3, 'bayu', '$2y$10$Enkpe.c8/S10pxohCwR9zO2mllq/28R0XW2wM51Ust1shR6tvWIBy', 'Bayu Prastyo', 1, 1),
(6, 'esti', '$2y$10$OyC8imde4RZ7NTSdfAD1Su47NtdMw/j72Wsl2bQWOsjcwnuLLru/O', 'Esti Setyaningrum', 1, 1),
(7, 'isnann', '$2y$10$fQufKWhLhLxfSDXplv7Q5uWKTO9BCcs/OTcu5mjIfW1JOIczFXVaG', 'isnann', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pengguna_level`
--

DROP TABLE IF EXISTS `pengguna_level`;
CREATE TABLE IF NOT EXISTS `pengguna_level` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `pengguna_level`
--

INSERT INTO `pengguna_level` (`id`, `level`) VALUES
(1, 'Admin'),
(2, 'Petugas'),
(3, 'Kepala'),
(4, 'Wali');

-- --------------------------------------------------------

--
-- Table structure for table `santri`
--

DROP TABLE IF EXISTS `santri`;
CREATE TABLE IF NOT EXISTS `santri` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `id_wali` int(11) NOT NULL,
  `jk` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `santri`
--

INSERT INTO `santri` (`id`, `nama`, `tanggal_lahir`, `alamat`, `id_wali`, `jk`, `is_active`) VALUES
(1, 'Catur Manunggal', '2023-03-02', 'Kebumen', 1, 'L', 1),
(2, 'Adi', '2023-03-25', 'Lampung', 1, 'L', 1),
(5, 'Ilyas', '2023-03-26', 'Potorono', 2, 'P', 1),
(6, 'Denny Caknan', '2023-03-26', 'Potorono', 3, 'L', 1),
(7, 'bona', '2023-04-08', 'Potorono', 5, 'L', 1),
(8, 'Santri Hosting', '2023-03-27', 'Mergangsan', 6, 'L', 1),
(9, '2', '2023-03-27', 'Potorono', 7, 'L', 1),
(10, 'Bayu Prastyo', '2023-04-02', 'Karanganyar', 8, 'L', 1);

-- --------------------------------------------------------

--
-- Table structure for table `wali`
--

DROP TABLE IF EXISTS `wali`;
CREATE TABLE IF NOT EXISTS `wali` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `is_active` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `wali`
--

INSERT INTO `wali` (`id`, `nama`, `alamat`, `no_hp`, `is_active`) VALUES
(1, 'Arif Muhammad', 'Ngawi', '08123123123123', 1),
(2, 'Brili Wibu', 'Palurr', '0829293211', 1),
(3, 'Catur Kurniawan', 'Adoh', '+6281328894356', 1),
(4, 'Anov', 'Bantul', '+628991909876', 1),
(5, 'abc', 'Adoh', '+628991907216', 1),
(6, 'Tes Sebelum Hosting', 'Jl.MH Thamrin ,Jakarta ', '+628991907216', 1),
(7, '1', '1', '1', 1),
(8, 'Esti Setyaningrum', 'Mojogedang', '+6289929293123', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`role`) REFERENCES `pengguna_level` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
