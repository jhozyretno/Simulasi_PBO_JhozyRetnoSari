-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 17, 2026 at 03:01 AM
-- Server version: 8.0.30
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_simulasi_pbo_ti1c_jhozyretnosari`
--

-- --------------------------------------------------------

--
-- Table structure for table `tabel_pendaftaran`
--

CREATE TABLE `tabel_pendaftaran` (
  `id_pendaftaran` int NOT NULL,
  `nama_calon` varchar(100) NOT NULL,
  `asal_sekolah` varchar(100) NOT NULL,
  `nilai_ujian` decimal(5,2) NOT NULL,
  `biaya_pendaftaran_dasar` decimal(10,2) NOT NULL,
  `jalur_pendaftaran` enum('Reguler','Prestasi','Kedinasan') NOT NULL,
  `pilihan_prodi` varchar(100) DEFAULT NULL,
  `lokasi_kampus` varchar(100) DEFAULT NULL,
  `jenis_prestasi` varchar(100) DEFAULT NULL,
  `tingkat_prestasi` varchar(100) DEFAULT NULL,
  `sk_ikatan_dinas` varchar(100) DEFAULT NULL,
  `instansi_sponsor` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tabel_pendaftaran`
--

INSERT INTO `tabel_pendaftaran` (`id_pendaftaran`, `nama_calon`, `asal_sekolah`, `nilai_ujian`, `biaya_pendaftaran_dasar`, `jalur_pendaftaran`, `pilihan_prodi`, `lokasi_kampus`, `jenis_prestasi`, `tingkat_prestasi`, `sk_ikatan_dinas`, `instansi_sponsor`) VALUES
(1, 'Andi Supriyadi', 'SMAN 1 Cilacap', '85.50', '250000.00', 'Reguler', 'Informatika', 'Kampus Utama', NULL, NULL, NULL, NULL),
(2, 'Budi Santoso', 'SMAN 2 Cilacap', '82.00', '250000.00', 'Reguler', 'Sistem Informasi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(3, 'Citra Lestari', 'SMKN 1 Cilacap', '88.00', '250000.00', 'Reguler', 'Informatika', 'Kampus Utama', NULL, NULL, NULL, NULL),
(4, 'Dewi Maharani', 'SMAN 3 Cilacap', '79.50', '250000.00', 'Reguler', 'Teknik Komputer', 'Kampus Cabang', NULL, NULL, NULL, NULL),
(5, 'Eko Prasetyo', 'SMAN 1 Sampang', '81.00', '250000.00', 'Reguler', 'Informatika', 'Kampus Utama', NULL, NULL, NULL, NULL),
(6, 'Fajar Hidayat', 'SMKN 2 Cilacap', '84.50', '250000.00', 'Reguler', 'Manajemen', 'Kampus Cabang', NULL, NULL, NULL, NULL),
(7, 'Gita Pratiwi', 'SMAN 1 Majenang', '86.00', '250000.00', 'Reguler', 'Sistem Informasi', 'Kampus Utama', NULL, NULL, NULL, NULL),
(8, 'Hendra Wijaya', 'SMAN 1 Cilacap', '92.50', '200000.00', 'Prestasi', 'Informatika', 'Kampus Utama', 'Olimpiade Komputer', 'Nasional', NULL, NULL),
(9, 'Intan Permata', 'SMAN 2 Cilacap', '90.00', '200000.00', 'Prestasi', 'Sistem Informasi', 'Kampus Utama', 'Lomba Cerdas Cermat', 'Provinsi', NULL, NULL),
(10, 'Joko Susanto', 'SMKN 1 Cilacap', '91.50', '200000.00', 'Prestasi', 'Teknik Komputer', 'Kampus Utama', 'LKS Web Design', 'Nasional', NULL, NULL),
(11, 'Kartika Sari', 'SMAN 1 Kroya', '89.00', '200000.00', 'Prestasi', 'Manajemen', 'Kampus Cabang', 'Debat Bahasa Inggris', 'Provinsi', NULL, NULL),
(12, 'Lukman Hakim', 'SMAN 3 Cilacap', '93.00', '200000.00', 'Prestasi', 'Informatika', 'Kampus Utama', 'Olimpiade Matematika', 'Nasional', NULL, NULL),
(13, 'Maya Anggraini', 'SMAN 1 Sidareja', '88.50', '200000.00', 'Prestasi', 'Sistem Informasi', 'Kampus Utama', 'Lomba Menulis Essay', 'Kabupaten', NULL, NULL),
(14, 'Nina Amelia', 'SMAN 1 Majenang', '94.00', '200000.00', 'Prestasi', 'Informatika', 'Kampus Utama', 'Hackathon Nasional', 'Nasional', NULL, NULL),
(15, 'Oskar Saputra', 'SMAN 1 Cilacap', '87.00', '0.00', 'Kedinasan', 'Informatika', 'Kampus Utama', NULL, NULL, 'SK-KD-001', 'Kementerian Kominfo'),
(16, 'Putri Rahayu', 'SMAN 2 Cilacap', '86.50', '0.00', 'Kedinasan', 'Sistem Informasi', 'Kampus Utama', NULL, NULL, 'SK-KD-002', 'Pemkab Cilacap'),
(17, 'Rizky Maulana', 'SMKN 1 Cilacap', '89.50', '0.00', 'Kedinasan', 'Teknik Komputer', 'Kampus Utama', NULL, NULL, 'SK-KD-003', 'PT Pertamina'),
(18, 'Siti Aminah', 'SMAN 1 Kroya', '88.00', '0.00', 'Kedinasan', 'Manajemen', 'Kampus Cabang', NULL, NULL, 'SK-KD-004', 'Kementerian Keuangan'),
(19, 'Teguh Wibowo', 'SMAN 3 Cilacap', '85.00', '0.00', 'Kedinasan', 'Informatika', 'Kampus Utama', NULL, NULL, 'SK-KD-005', 'BPS'),
(20, 'Umar Bakri', 'SMAN 1 Sampang', '87.50', '0.00', 'Kedinasan', 'Sistem Informasi', 'Kampus Utama', NULL, NULL, 'SK-KD-006', 'Kementerian Kominfo');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  ADD PRIMARY KEY (`id_pendaftaran`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tabel_pendaftaran`
--
ALTER TABLE `tabel_pendaftaran`
  MODIFY `id_pendaftaran` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
