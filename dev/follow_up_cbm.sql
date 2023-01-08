-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 08, 2023 at 09:56 AM
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
-- Table structure for table `komponen`
--

DROP TABLE IF EXISTS `komponen`;
CREATE TABLE IF NOT EXISTS `komponen` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama_komponen` varchar(64) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nama_komponen` (`nama_komponen`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `komponen`
--

INSERT INTO `komponen` (`id`, `nama_komponen`) VALUES
(18, 'All Axle (Diff & Final Drive)'),
(19, 'Battery'),
(5, 'Brake Cooling'),
(14, 'Circle'),
(3, 'Damper'),
(9, 'Differential'),
(1, 'Engine'),
(10, 'Front Differential'),
(21, 'Front Suspension LH'),
(20, 'Front Suspension RH'),
(6, 'Front Swing Machinery'),
(8, 'Left Final Drive'),
(2, 'Power Take Off'),
(15, 'Rear Differential'),
(16, 'Rear Left Final Drive'),
(23, 'Rear Suspension LH'),
(22, 'Rear Suspension RH'),
(11, 'Rear Swing Machinery'),
(12, 'Right Final Drive'),
(17, 'Right Right Final Drive'),
(13, 'Right Tandem'),
(7, 'Swing Machinery'),
(4, 'Transmission');

-- --------------------------------------------------------

--
-- Table structure for table `populasi`
--

DROP TABLE IF EXISTS `populasi`;
CREATE TABLE IF NOT EXISTS `populasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `model_unit` varchar(48) NOT NULL,
  `code_unit` varchar(48) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=118 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `populasi`
--

INSERT INTO `populasi` (`id`, `model_unit`, `code_unit`) VALUES
(1, 'PC1250SP-11R', 'E1232'),
(2, 'PC1250SP-11R', 'E1234'),
(3, 'PC1250SP-11R', 'E1236'),
(4, 'CAT6015', 'E6105'),
(5, 'PC500LC-10R', 'E519'),
(6, 'PC500LC-10R', 'E520'),
(7, 'PC500LC-10R', 'E521'),
(8, 'PC500LC-10R', 'E522'),
(9, 'PC500LC-10R', 'E529'),
(10, 'PC500LC-10R', 'E530'),
(11, 'PC400LC-8R', 'E427'),
(12, 'PC400LC-8R', 'E428'),
(13, 'PC210-10M0', 'E2115'),
(14, 'PC210-10M0', 'E2116'),
(15, 'PC210-10M0', 'E2126'),
(16, 'PC210-10M0', 'E2127'),
(17, 'PC210-10M0', 'E2138'),
(18, 'PC210-10M0', 'E2139'),
(19, 'PC210-10M0', 'E2153'),
(20, 'PC210-10M0', 'E2154'),
(21, 'PC210-10M0', 'E2155'),
(22, 'D155A-6', 'D1548'),
(23, 'D85ESS-2', 'D85115'),
(24, 'D85ESS-2', 'D85116'),
(25, 'D85ESS-2', 'D85117'),
(26, 'D85ESS-2', 'D85118'),
(27, 'D85ESS-2', 'D85119'),
(28, 'D85ESS-2', 'D85135'),
(29, 'D85ESS-2', 'D85138'),
(30, 'D85ESS-2', 'D85139'),
(31, 'D85ESS-2', 'D85140'),
(32, 'HD785-7', 'HD78366'),
(33, 'HD785-7', 'HD78367'),
(34, 'HD785-7', 'HD78368'),
(35, 'HD785-7', 'HD78369'),
(36, 'HD785-7', 'HD78370'),
(37, 'HD785-7', 'HD78388'),
(38, 'HD785-7', 'HD78389'),
(39, 'HD785-7', 'HD78390'),
(40, 'HD785-7', 'HD78391'),
(41, 'HD785-7', 'HD78392'),
(42, 'HD785-7', 'HD78393'),
(43, 'HD785-7', 'HD78394'),
(44, 'HD785-7', 'HD78395'),
(45, 'HD785-7', 'HD78396'),
(46, 'HD785-7', 'HD78397'),
(47, 'WA480-6', 'WA4801'),
(48, 'GD755-5R', 'GD7507'),
(49, 'GD755-5R', 'GD7508'),
(50, 'GD755-5R', 'GD7512'),
(51, 'WA480-6', 'WA4805'),
(52, 'SV526DF', 'VS16'),
(53, 'AROCS 4845K', 'DA4818'),
(54, 'AROCS 4845K', 'DA4819'),
(55, 'AROCS 4845K', 'DA4820'),
(56, 'AROCS 4845K', 'DA4821'),
(57, 'AROCS 4845K', 'DA4822'),
(58, 'AROCS 4845K', 'DA4823'),
(59, 'AROCS 4845K', 'DA4824'),
(60, 'AXOR 2528CX', 'DA25011'),
(61, 'AXOR 2528CX', 'DA25012'),
(62, 'AXOR 2528CX', 'DA25013'),
(63, 'AXOR 2528CX', 'DA25014'),
(64, 'AXOR 2528CX', 'DA25015'),
(65, 'AXOR 2528CX', 'DA25016'),
(66, 'AXOR 2528CX', 'DA25017'),
(67, 'AXOR 2528CX', 'DA25018'),
(68, 'AXOR 2528CX', 'DA25019'),
(69, 'AXOR 2528CX', 'DA25020'),
(70, 'AROCS 4040K (6X4) A/T', 'DA40040'),
(71, 'AROCS 4040K (6X4) A/T', 'DA40041'),
(72, 'AROCS 4040K (6X4) A/T', 'DA40042'),
(73, 'AROCS 4040K (6X4) A/T', 'DA40043'),
(74, 'AROCS 4040K (6X4) A/T', 'DA40044'),
(75, 'AROCS 4040K (6X4) A/T', 'DA40045'),
(76, 'AROCS 4040K (6X4) A/T', 'DA40046'),
(77, 'AROCS 4040K (6X4) A/T', 'DA40047'),
(78, 'AROCS 4040K (6X4) A/T', 'DA40048'),
(79, 'AROCS 4040K (6X4) A/T', 'DA40049'),
(80, 'AROCS 4040K (6X4) A/T', 'DA40059'),
(81, 'AROCS 4040K (6X4) A/T', 'DA40060'),
(82, 'AROCS 4040K (6X4) A/T', 'DA40061'),
(83, 'AROCS 4040K (6X4) A/T', 'DA40062'),
(84, 'AXOR 2528RMC', 'WT2510'),
(85, 'AXOR 2528RMC', 'WT2515'),
(86, 'AXOR 2528RMC', 'WT2519'),
(87, 'AXOR 2528C', 'LT2502'),
(88, 'AXOR 2528C', 'LT2509'),
(89, 'AXOR 2528C', 'CT2503'),
(90, 'SAMSON 75.10', 'THDS04'),
(91, 'FD50AYT-10', 'FL16'),
(92, 'AM-LTH90-66-KST', 'TL273'),
(93, 'AM-LTH90-66-KST', 'TL274'),
(94, 'AM-LTH90-66-KST', 'TL275'),
(95, 'AM-LTH90-66-KST', 'TL276'),
(96, 'AM-LTH90-66-KST', 'TL284'),
(97, 'AM-LTH90-66-KST', 'TL285'),
(98, 'AM-LTH90-66-KST', 'TL286'),
(99, 'AM-LTH90-66-KST', 'TL287'),
(100, 'AM-LTH90-66-KST', 'TL288'),
(101, 'AM-LTH90-66-KST', 'TL289'),
(102, 'AM-LTH90-66-KST', 'TL304'),
(103, 'AM-LTH90-66-KST', 'TL305'),
(104, 'AM-LTH90-66-KST', 'TL306'),
(105, 'OTMXAHS38KD', 'CP46'),
(106, 'XAHS400 PACE CUD WUX', 'CP54'),
(107, 'BIG BLUE600X', 'WL36'),
(108, 'BIG BLUE600X', 'WL40'),
(109, 'ASM6', 'GS55'),
(110, 'ASM5', 'GS56'),
(111, 'DE450E0', 'GSDE12'),
(112, 'DE450E0', 'GSDE13'),
(113, 'RF100MV', 'MF1001'),
(114, 'TS230R', 'WP52');

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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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

-- --------------------------------------------------------

--
-- Table structure for table `resume_follow_up_cbm`
--

DROP TABLE IF EXISTS `resume_follow_up_cbm`;
CREATE TABLE IF NOT EXISTS `resume_follow_up_cbm` (
  `no_follow_up` int NOT NULL AUTO_INCREMENT,
  `code_unit` varchar(32) NOT NULL,
  `model` varchar(32) NOT NULL,
  `komponen` varchar(64) NOT NULL,
  `cbm` varchar(32) NOT NULL,
  `deskripsi_problem` text NOT NULL,
  `rekomendasi_follow_up` varchar(255) NOT NULL,
  `plan_date_follow_up` date NOT NULL,
  `input_timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'waktu input',
  `executed` tinyint(1) DEFAULT '0' COMMENT '1 = yes, 0 = no',
  `date_executed` date DEFAULT NULL COMMENT 'date executed if yes',
  `pic` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL COMMENT 'nama Person in Charge',
  `follow_up_status` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `reason_if_cancelled` varchar(255) DEFAULT NULL COMMENT 'alasan (jika dibatalkan)',
  `input2_timestamp` timestamp NULL DEFAULT NULL COMMENT 'waktu input untuk data follow up CBM yang sudah dieksekusi',
  PRIMARY KEY (`no_follow_up`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
