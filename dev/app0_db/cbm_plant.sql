-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Waktu pembuatan: 25 Jul 2023 pada 09.06
-- Versi server: 8.0.31
-- Versi PHP: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cbm_plant`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `auth`
--

DROP TABLE IF EXISTS `auth`;
CREATE TABLE IF NOT EXISTS `auth` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `role` varchar(16) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data untuk tabel `auth`
--

INSERT INTO `auth` (`id_user`, `username`, `password`, `role`) VALUES
(1, 'superadmin', '$2y$10$ZmOSQ3vPAStDSWFLyBhdmOCsZw1LP.9uFhUXbSOg6jLQv.NHrmcZm', 'owner'),
(2, 'admin', '$2y$10$77P4Rlj/HypzPEOCKHHcv.C11t0b4uq..eCSOSzFNpQ8FNaECv00G', 'worker');

-- --------------------------------------------------------

--
-- Struktur dari tabel `cbm_item`
--

DROP TABLE IF EXISTS `cbm_item`;
CREATE TABLE IF NOT EXISTS `cbm_item` (
  `idcbm_item` int NOT NULL,
  `id_upload` int NOT NULL,
  `jeniscbm` varchar(128) NOT NULL,
  `workgroup` varchar(64) NOT NULL,
  `unitcode` varchar(64) NOT NULL,
  `model` varchar(64) NOT NULL,
  `component` varchar(64) NOT NULL,
  `date_pap` date NOT NULL,
  `hm_pap` int NOT NULL,
  `oil_change` varchar(45) NOT NULL,
  `sample_result` varchar(45) NOT NULL,
  `analysis_lab` text,
  `rekomendasi_lab` text,
  PRIMARY KEY (`idcbm_item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_upload`
--

DROP TABLE IF EXISTS `data_upload`;
CREATE TABLE IF NOT EXISTS `data_upload` (
  `id_upload` int NOT NULL,
  `nama_file_ori` varchar(255) NOT NULL,
  `lokasi` varchar(255) NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id_upload`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='untuk mencatat waktu upload data yang dilakukan dengan cara import dari file Excel.';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
