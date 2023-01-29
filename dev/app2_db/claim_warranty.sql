-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 29, 2023 at 02:13 PM
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
-- Database: `claim_warranty`
--

-- --------------------------------------------------------

--
-- Table structure for table `job_site`
--

DROP TABLE IF EXISTS `job_site`;
CREATE TABLE IF NOT EXISTS `job_site` (
  `id` int NOT NULL AUTO_INCREMENT,
  `job_site` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `job_site` (`job_site`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `job_site`
--

INSERT INTO `job_site` (`id`, `job_site`) VALUES
(5, 'ABP'),
(3, 'ADW'),
(2, 'BA'),
(6, 'BIB'),
(7, 'HO'),
(11, 'HSM'),
(8, 'KJB'),
(9, 'MHU'),
(1, 'MIP'),
(10, 'MLP'),
(4, 'SKS');

-- --------------------------------------------------------

--
-- Table structure for table `populasi`
--

DROP TABLE IF EXISTS `populasi`;
CREATE TABLE IF NOT EXISTS `populasi` (
  `id` int NOT NULL AUTO_INCREMENT,
  `machine_maker` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_unit` varchar(48) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_unit` varchar(48) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `populasi`
--

INSERT INTO `populasi` (`id`, `machine_maker`, `model_unit`, `code_unit`) VALUES
(1, 'KOMATSU', 'PC1250SP-11R', 'E1232'),
(2, 'KOMATSU', 'PC1250SP-11R', 'E1234'),
(3, 'KOMATSU', 'PC1250SP-11R', 'E1236'),
(4, 'CATERPILLAR', 'CAT6015', 'E6105'),
(5, 'KOMATSU', 'PC500LC-10R', 'E519'),
(6, 'KOMATSU', 'PC500LC-10R', 'E520'),
(7, 'KOMATSU', 'PC500LC-10R', 'E521'),
(8, 'KOMATSU', 'PC500LC-10R', 'E522'),
(9, 'KOMATSU', 'PC500LC-10R', 'E529'),
(10, 'KOMATSU', 'PC500LC-10R', 'E530'),
(11, 'KOMATSU', 'PC400LC-8R', 'E427'),
(12, 'KOMATSU', 'PC400LC-8R', 'E428'),
(13, 'KOMATSU', 'PC210-10M0', 'E2115'),
(14, 'KOMATSU', 'PC210-10M0', 'E2116'),
(15, 'KOMATSU', 'PC210-10M0', 'E2126'),
(16, 'KOMATSU', 'PC210-10M0', 'E2127'),
(17, 'KOMATSU', 'PC210-10M0', 'E2138'),
(18, 'KOMATSU', 'PC210-10M0', 'E2139'),
(19, 'KOMATSU', 'PC210-10M0', 'E2153'),
(20, 'KOMATSU', 'PC210-10M0', 'E2154'),
(21, 'KOMATSU', 'PC210-10M0', 'E2155'),
(22, 'KOMATSU', 'D155A-6', 'D1548'),
(23, 'KOMATSU', 'D85ESS-2', 'D85115'),
(24, 'KOMATSU', 'D85ESS-2', 'D85116'),
(25, 'KOMATSU', 'D85ESS-2', 'D85117'),
(26, 'KOMATSU', 'D85ESS-2', 'D85118'),
(27, 'KOMATSU', 'D85ESS-2', 'D85119'),
(28, 'KOMATSU', 'D85ESS-2', 'D85135'),
(29, 'KOMATSU', 'D85ESS-2', 'D85138'),
(30, 'KOMATSU', 'D85ESS-2', 'D85139'),
(31, 'KOMATSU', 'D85ESS-2', 'D85140'),
(32, 'KOMATSU', 'HD785-7', 'HD78366'),
(33, 'KOMATSU', 'HD785-7', 'HD78367'),
(34, 'KOMATSU', 'HD785-7', 'HD78368'),
(35, 'KOMATSU', 'HD785-7', 'HD78369'),
(36, 'KOMATSU', 'HD785-7', 'HD78370'),
(37, 'KOMATSU', 'HD785-7', 'HD78388'),
(38, 'KOMATSU', 'HD785-7', 'HD78389'),
(39, 'KOMATSU', 'HD785-7', 'HD78390'),
(40, 'KOMATSU', 'HD785-7', 'HD78391'),
(41, 'KOMATSU', 'HD785-7', 'HD78392'),
(42, 'KOMATSU', 'HD785-7', 'HD78393'),
(43, 'KOMATSU', 'HD785-7', 'HD78394'),
(44, 'KOMATSU', 'HD785-7', 'HD78395'),
(45, 'KOMATSU', 'HD785-7', 'HD78396'),
(46, 'KOMATSU', 'HD785-7', 'HD78397'),
(47, 'KOMATSU', 'WA480-6', 'WA4801'),
(48, 'KOMATSU', 'GD755-5R', 'GD7507'),
(49, 'KOMATSU', 'GD755-5R', 'GD7508'),
(50, 'KOMATSU', 'GD755-5R', 'GD7512'),
(51, 'KOMATSU', 'WA480-6', 'WA4805'),
(52, 'SAKAI', 'SV526DF', 'VS16'),
(53, 'MERCEDES-BENZ', 'AROCS 4845K', 'DA4818'),
(54, 'MERCEDES-BENZ', 'AROCS 4845K', 'DA4819'),
(55, 'MERCEDES-BENZ', 'AROCS 4845K', 'DA4820'),
(56, 'MERCEDES-BENZ', 'AROCS 4845K', 'DA4821'),
(57, 'MERCEDES-BENZ', 'AROCS 4845K', 'DA4822'),
(58, 'MERCEDES-BENZ', 'AROCS 4845K', 'DA4823'),
(59, 'MERCEDES-BENZ', 'AROCS 4845K', 'DA4824'),
(60, 'MERCEDES-BENZ', 'AXOR 2528CX', 'DA25011'),
(61, 'MERCEDES-BENZ', 'AXOR 2528CX', 'DA25012'),
(62, 'MERCEDES-BENZ', 'AXOR 2528CX', 'DA25013'),
(63, 'MERCEDES-BENZ', 'AXOR 2528CX', 'DA25014'),
(64, 'MERCEDES-BENZ', 'AXOR 2528CX', 'DA25015'),
(65, 'MERCEDES-BENZ', 'AXOR 2528CX', 'DA25016'),
(66, 'MERCEDES-BENZ', 'AXOR 2528CX', 'DA25017'),
(67, 'MERCEDES-BENZ', 'AXOR 2528CX', 'DA25018'),
(68, 'MERCEDES-BENZ', 'AXOR 2528CX', 'DA25019'),
(69, 'MERCEDES-BENZ', 'AXOR 2528CX', 'DA25020'),
(70, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40040'),
(71, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40041'),
(72, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40042'),
(73, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40043'),
(74, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40044'),
(75, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40045'),
(76, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40046'),
(77, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40047'),
(78, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40048'),
(79, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40049'),
(80, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40059'),
(81, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40060'),
(82, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40061'),
(83, 'MERCEDES-BENZ', 'AROCS 4040K (6X4) A/T', 'DA40062'),
(84, 'MERCEDES-BENZ', 'AXOR 2528RMC', 'WT2510'),
(85, 'MERCEDES-BENZ', 'AXOR 2528RMC', 'WT2515'),
(86, 'MERCEDES-BENZ', 'AXOR 2528RMC', 'WT2519'),
(87, 'MERCEDES-BENZ', 'AXOR 2528C', 'LT2502'),
(88, 'MERCEDES-BENZ', 'AXOR 2528C', 'LT2509'),
(89, 'MERCEDES-BENZ', 'AXOR 2528C', 'CT2503'),
(90, 'DIECI', 'SAMSON 75.10', 'THDS04'),
(91, 'FORKLIFT', 'FD50AYT-10', 'FL16'),
(92, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL273'),
(93, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL274'),
(94, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL275'),
(95, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL276'),
(96, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL284'),
(97, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL285'),
(98, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL286'),
(99, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL287'),
(100, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL288'),
(101, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL289'),
(102, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL304'),
(103, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL305'),
(104, 'BINA PERTIWI', 'AM-LTH90-66-KST', 'TL306'),
(105, 'CATERPILLAR', 'OTMXAHS38KD', 'CP46'),
(106, 'CATERPILLAR', 'XAHS400 PACE CUD WUX', 'CP54'),
(107, 'MILLER', 'BIG BLUE600X', 'WL36'),
(108, 'MILLER', 'BIG BLUE600X', 'WL40'),
(109, 'CATERPILLAR', 'ASM6', 'GS55'),
(110, 'CATERPILLAR', 'ASM5', 'GS56'),
(111, 'CATERPILLAR', 'DE450E0', 'GSDE12'),
(112, 'CATERPILLAR', 'DE450E0', 'GSDE13'),
(113, 'MULTIFLO', 'RF100MV', 'MF1001'),
(114, 'YANMAR', 'TS230R', 'WP52');

-- --------------------------------------------------------

--
-- Table structure for table `warranty_proposal`
--

DROP TABLE IF EXISTS `warranty_proposal`;
CREATE TABLE IF NOT EXISTS `warranty_proposal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `jobsite` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `claim_date` date NOT NULL,
  `claim_to` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `warranty_decision` varchar(24) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `closing_date` date DEFAULT NULL,
  `brand_unit` varchar(32) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_unit` varchar(48) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `code_unit` varchar(48) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sn_unit` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `major_component` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `sn_component` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status_unit` varchar(64) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `amount_part` int DEFAULT NULL,
  `final_amount` int DEFAULT NULL,
  `component` varchar(128) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sub_component` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `part_number` varchar(128) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `fitment_date` date NOT NULL,
  `trouble_date` date NOT NULL,
  `hm/km_fitment` int NOT NULL,
  `hm/km_trouble` int NOT NULL,
  `lifetime` int NOT NULL,
  `problem_issue` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `supporting_comments` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `schedule_follow_up` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remark_progress` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci,
  `created_by` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by1` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approved_by2` varchar(64) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `follow_up_by` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'isinya sama dengan data claim_to',
  `foto_unit_depan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_unit_samping` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_sn_unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_hm/km_unit` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `foto_komponen_rusak` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
