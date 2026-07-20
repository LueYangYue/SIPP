-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2026 at 08:01 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipp`
--

-- --------------------------------------------------------

--
-- Table structure for table `ketuaprogram`
--

CREATE TABLE `ketuaprogram` (
  `id` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ketuaprogram`
--

INSERT INTO `ketuaprogram` (`id`) VALUES
('P000001');

-- --------------------------------------------------------

--
-- Table structure for table `kursus`
--

CREATE TABLE `kursus` (
  `kod` varchar(8) NOT NULL,
  `nama` varchar(32) NOT NULL,
  `pensyarah` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kursus`
--

INSERT INTO `kursus` (`kod`, `nama`, `pensyarah`) VALUES
('PNG', 'PURATA NILAI GRED', 'P000001'),
('TTTC3213', 'KEJURUTERAAN DATA', 'P000002'),
('TTTE3503', 'PENGUJIAN PERISIAN', 'P000003'),
('TTTU2983', 'PANGKALAN DATA LANJUTAN', 'P000003'),
('TTTU3404', 'PEMBANGUNAN PERISIAN UTK IS', 'P000003'),
('TTTU4086', 'PROJEK', 'P000002'),
('TTTU4172', 'USULAN PROJEK', 'P000001');

-- --------------------------------------------------------

--
-- Table structure for table `pelajar`
--

CREATE TABLE `pelajar` (
  `id` varchar(8) NOT NULL,
  `tahun` int(11) NOT NULL DEFAULT 1,
  `semester` int(11) NOT NULL DEFAULT 1,
  `status` varchar(16) NOT NULL DEFAULT 'Selamat'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelajar`
--

INSERT INTO `pelajar` (`id`, `tahun`, `semester`, `status`) VALUES
('A000001', 3, 6, 'Berisiko'),
('A000002', 2, 3, 'Selamat'),
('A000003', 1, 1, 'Selamat'),
('A000004', 3, 6, 'Berisiko'),
('A000005', 3, 7, 'Berisiko'),
('A000006', 1, 1, 'Selamat');

-- --------------------------------------------------------

--
-- Table structure for table `pelan`
--

CREATE TABLE `pelan` (
  `no` int(11) NOT NULL,
  `pelajar` varchar(8) NOT NULL,
  `pensyarah` varchar(8) NOT NULL,
  `prestasi` varchar(8) NOT NULL,
  `panduan` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pelan`
--

INSERT INTO `pelan` (`no`, `pelajar`, `pensyarah`, `prestasi`, `panduan`) VALUES
(1, 'A000001', 'P000002', 'M000006', '3; Jumpa penyelia FYP'),
(2, 'A000001', 'P000003', 'M000009', '1; Belajar sampai 6 PM'),
(3, 'A000001', 'P000003', 'M000009', '1; Belajar sampai pukul 7 PM pada hari Isnin.');

-- --------------------------------------------------------

--
-- Table structure for table `pengguna`
--

CREATE TABLE `pengguna` (
  `id` varchar(8) NOT NULL,
  `kataLaluan` varchar(32) NOT NULL DEFAULT '1234567',
  `nama` varchar(64) NOT NULL,
  `sesi` varchar(16) NOT NULL,
  `peranan` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pengguna`
--

INSERT INTO `pengguna` (`id`, `kataLaluan`, `nama`, `sesi`, `peranan`) VALUES
('A000001', '1234567', 'Pelajar A', '2/20252026', 3),
('A000002', '1234567', 'Pelajar B', '2/20252026', 3),
('A000003', '1234567', 'Pelajar C', '2/20252026', 3),
('A000004', '1234567', 'Pelajar D', '2/20252026', 3),
('A000005', '1234567', 'Pelajar E', '2/20252026', 3),
('A000006', '1234567', 'Pelajar F', '2/20252026', 3),
('P000001', '1234567', 'Ketua A', '2/20252026', 1),
('P000002', '1234567', 'Pensyarah B', '2/20252026', 2),
('P000003', '1234567', 'Pensyarah C', '2/20252026', 2),
('P000004', '1234567', 'Pensyarah D', '2/20252026', 2),
('U000001', '1234567', 'Penguji A', '2/20232024', 10);

-- --------------------------------------------------------

--
-- Table structure for table `pensyarah`
--

CREATE TABLE `pensyarah` (
  `id` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pensyarah`
--

INSERT INTO `pensyarah` (`id`) VALUES
('P000001'),
('P000002'),
('P000003'),
('P000004');

-- --------------------------------------------------------

--
-- Table structure for table `peringatan`
--

CREATE TABLE `peringatan` (
  `no` int(11) NOT NULL,
  `prestasi` varchar(8) NOT NULL,
  `masa` timestamp NOT NULL DEFAULT current_timestamp(),
  `dibaca` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `peringatan`
--

INSERT INTO `peringatan` (`no`, `prestasi`, `masa`, `dibaca`) VALUES
(1, 'M000005', '2026-06-06 06:11:19', 0),
(2, 'M000006', '2026-06-06 06:11:42', 0),
(3, 'M000007', '2026-06-06 06:13:00', 0),
(4, 'M000008', '2026-06-06 06:13:11', 0),
(5, 'M000009', '2026-06-06 06:13:20', 0),
(6, 'M000015', '2026-06-06 06:15:00', 0),
(7, 'M000016', '2026-06-06 06:15:48', 0),
(8, 'M000017', '2026-06-06 06:16:07', 0),
(9, 'M000018', '2026-06-06 06:59:35', 0),
(10, 'M000019', '2026-06-06 07:00:00', 0),
(11, 'M000022', '2026-06-06 07:05:13', 0),
(12, 'M000023', '2026-06-06 07:05:37', 0),
(13, 'M000024', '2026-06-06 07:05:47', 0),
(14, 'M000025', '2026-06-06 07:05:56', 0),
(15, 'M000026', '2026-06-06 07:06:07', 0),
(16, 'M000027', '2026-06-06 07:06:16', 0),
(17, 'M000009', '2026-07-05 22:57:37', 0),
(18, 'M000009', '2026-07-10 02:41:55', 0),
(19, 'M000009', '2026-07-10 02:48:15', 0);

-- --------------------------------------------------------

--
-- Table structure for table `prestasi`
--

CREATE TABLE `prestasi` (
  `kod` varchar(8) NOT NULL,
  `pelajar` varchar(8) NOT NULL,
  `kursus` varchar(8) NOT NULL DEFAULT 'PNG',
  `sesi` varchar(16) NOT NULL,
  `mata` decimal(3,2) NOT NULL,
  `status` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prestasi`
--

INSERT INTO `prestasi` (`kod`, `pelajar`, `kursus`, `sesi`, `mata`, `status`) VALUES
('M000001', 'A000001', 'TTTU2983', '2/20252026', 1.31, 'Berisiko'),
('M000002', 'A000001', 'TTTU4172', '2/20252026', 1.32, 'Berisiko'),
('M000003', 'A000001', 'TTTU4086', '2/20252026', 1.33, 'Berisiko'),
('M000004', 'A000001', 'PNG', '1/20232024', 3.16, 'Selamat'),
('M000005', 'A000001', 'PNG', '2/20232024', 1.32, 'Berisiko'),
('M000006', 'A000001', 'PNG', '1/20242025', 0.00, 'Berisiko'),
('M000007', 'A000001', 'PNG', '2/20242025', 1.32, 'Berisiko'),
('M000008', 'A000001', 'PNG', '1/20252026', 1.20, 'Berisiko'),
('M000009', 'A000001', 'PNG', '2/20252026', 1.28, 'Berisiko'),
('M000010', 'A000002', 'TTTC3213', '2/20242025', 3.23, 'Selamat'),
('M000011', 'A000002', 'TTTE3503', '1/20252026', 3.89, 'Selamat'),
('M000012', 'A000002', 'TTTU3404', '2/20252026', 3.83, 'Selamat'),
('M000013', 'A000004', 'TTTU4086', '2/20252026', 1.31, 'Berisiko'),
('M000014', 'A000004', 'PNG', '1/20232024', 3.16, 'Selamat'),
('M000015', 'A000004', 'PNG', '2/20232024', 1.32, 'Berisiko'),
('M000016', 'A000004', 'PNG', '1/20242025', 0.00, 'Berisiko'),
('M000017', 'A000004', 'PNG', '2/20242025', 1.30, 'Berisiko'),
('M000018', 'A000004', 'PNG', '1/20252026', 1.22, 'Berisiko'),
('M000019', 'A000004', 'PNG', '2/20252026', 1.26, 'Berisiko'),
('M000020', 'A000005', 'TTTU4086', '2/20252026', 1.30, 'Berisiko'),
('M000021', 'A000005', 'PNG', '1/20232024', 3.14, 'Selamat'),
('M000022', 'A000005', 'PNG', '2/20232024', 1.32, 'Berisiko'),
('M000023', 'A000005', 'PNG', '1/20242025', 0.30, 'Berisiko'),
('M000024', 'A000005', 'PNG', '2/20242025', 1.00, 'Berisiko'),
('M000025', 'A000005', 'PNG', '3/20242025', 1.30, 'Berisiko'),
('M000026', 'A000005', 'PNG', '1/20252026', 1.22, 'Berisiko'),
('M000027', 'A000005', 'PNG', '2/20252026', 1.24, 'Berisiko');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ketuaprogram`
--
ALTER TABLE `ketuaprogram`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kursus`
--
ALTER TABLE `kursus`
  ADD PRIMARY KEY (`kod`),
  ADD KEY `fk_kursus` (`pensyarah`);

--
-- Indexes for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pelan`
--
ALTER TABLE `pelan`
  ADD PRIMARY KEY (`no`),
  ADD KEY `fk_pelan_2` (`pensyarah`),
  ADD KEY `fk_pelan_1` (`prestasi`),
  ADD KEY `fk_pelan_3` (`pelajar`);

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pensyarah`
--
ALTER TABLE `pensyarah`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peringatan`
--
ALTER TABLE `peringatan`
  ADD PRIMARY KEY (`no`),
  ADD KEY `fk_peringatan` (`prestasi`);

--
-- Indexes for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD PRIMARY KEY (`kod`),
  ADD KEY `fk_prestasi_1` (`pelajar`),
  ADD KEY `fk_prestasi_2` (`kursus`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pelan`
--
ALTER TABLE `pelan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `peringatan`
--
ALTER TABLE `peringatan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ketuaprogram`
--
ALTER TABLE `ketuaprogram`
  ADD CONSTRAINT `tpt_kp` FOREIGN KEY (`id`) REFERENCES `pensyarah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kursus`
--
ALTER TABLE `kursus`
  ADD CONSTRAINT `fk_kursus` FOREIGN KEY (`pensyarah`) REFERENCES `pensyarah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelajar`
--
ALTER TABLE `pelajar`
  ADD CONSTRAINT `tpt_pelajar` FOREIGN KEY (`id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pelan`
--
ALTER TABLE `pelan`
  ADD CONSTRAINT `fk_pelan_1` FOREIGN KEY (`prestasi`) REFERENCES `prestasi` (`kod`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pelan_2` FOREIGN KEY (`pensyarah`) REFERENCES `pensyarah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_pelan_3` FOREIGN KEY (`pelajar`) REFERENCES `pelajar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pensyarah`
--
ALTER TABLE `pensyarah`
  ADD CONSTRAINT `tpt_pensyarah` FOREIGN KEY (`id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `peringatan`
--
ALTER TABLE `peringatan`
  ADD CONSTRAINT `fk_peringatan` FOREIGN KEY (`prestasi`) REFERENCES `prestasi` (`kod`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `prestasi`
--
ALTER TABLE `prestasi`
  ADD CONSTRAINT `fk_prestasi_1` FOREIGN KEY (`pelajar`) REFERENCES `pelajar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_prestasi_2` FOREIGN KEY (`kursus`) REFERENCES `kursus` (`kod`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
