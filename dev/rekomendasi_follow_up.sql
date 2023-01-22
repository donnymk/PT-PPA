-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2023 at 02:26 AM
-- Server version: 8.0.31
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `follow_up_cbm`
--

-- --------------------------------------------------------

--
-- Table structure for table `rekomendasi_follow_up`
--

DROP TABLE IF EXISTS `rekomendasi_follow_up`;
CREATE TABLE IF NOT EXISTS `rekomendasi_follow_up` (
  `id` int NOT NULL AUTO_INCREMENT,
  `rekomendasi` varchar(128) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `rekomendasi` (`rekomendasi`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `rekomendasi_follow_up`
--

INSERT INTO `rekomendasi_follow_up` (`id`, `rekomendasi`) VALUES
(16, 'Buatkan TI sebagai data dan bukti dasar melakukan claim waranty'),
(7, 'Buka & Periksa Oil Pan'),
(2, 'Cek apakah ada partikel logam kasar pada Drain magnetic plug'),
(15, 'Cek Floating Seal Dari Indikasi Kebocoran'),
(14, 'Cek Kebocoran Cooling System menggunakan Radiator Cap Tester'),
(8, 'Check Oil Pressure'),
(11, 'Lakukan Adjustment'),
(5, 'Lakukan Cutting Filter & Analisa partikel pada elementnya'),
(12, 'Lakukan Flushing'),
(13, 'Lakukan pemeriksaan pada Fuel System'),
(6, 'Lakukan penambahan Oli'),
(10, 'Lakukan penggantian Oli & Resampling'),
(9, 'Lakukan PPM'),
(4, 'Periksa Apakah Ada Abnormal Noise'),
(3, 'Periksa Apakah ada Rembesan Pada Floating Seal'),
(1, 'Resampling (Tanpa penggantian oli)'),
(17, 'Ukur Ulang SOH/SOC, Ganti Terminal Battery Jika Rusak/Berjamur');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
