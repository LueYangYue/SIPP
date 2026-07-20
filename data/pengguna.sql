-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 12, 2026 at 08:00 AM
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

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pengguna`
--
ALTER TABLE `pengguna`
  ADD PRIMARY KEY (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
