-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 22, 2023 at 02:27 AM
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
