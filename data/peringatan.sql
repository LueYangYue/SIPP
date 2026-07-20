-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2026 at 01:24 PM
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
(16, 'M000027', '2026-06-06 07:06:16', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `peringatan`
--
ALTER TABLE `peringatan`
  ADD PRIMARY KEY (`no`),
  ADD KEY `fk_peringatan` (`prestasi`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `peringatan`
--
ALTER TABLE `peringatan`
  MODIFY `no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peringatan`
--
ALTER TABLE `peringatan`
  ADD CONSTRAINT `fk_peringatan` FOREIGN KEY (`prestasi`) REFERENCES `prestasi` (`kod`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
