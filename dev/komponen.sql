-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2023 at 02:25 AM
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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
