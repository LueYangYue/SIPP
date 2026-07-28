-- MySQL dump 10.13  Distrib 8.0.46, for Linux (x86_64)
--
-- Host: localhost    Database: sipp
-- ------------------------------------------------------
-- Server version	8.0.46-0ubuntu0.24.04.3

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `ketuaprogram`
--

DROP TABLE IF EXISTS `ketuaprogram`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `ketuaprogram` (
  `id` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `tpt_kp` FOREIGN KEY (`id`) REFERENCES `pensyarah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ketuaprogram`
--

LOCK TABLES `ketuaprogram` WRITE;
/*!40000 ALTER TABLE `ketuaprogram` DISABLE KEYS */;
INSERT INTO `ketuaprogram` VALUES ('P000001');
/*!40000 ALTER TABLE `ketuaprogram` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `kursus`
--

DROP TABLE IF EXISTS `kursus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `kursus` (
  `kod` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `nama` varchar(32) COLLATE utf8mb4_general_ci NOT NULL,
  `pensyarah` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`kod`),
  KEY `fk_kursus` (`pensyarah`),
  CONSTRAINT `fk_kursus` FOREIGN KEY (`pensyarah`) REFERENCES `pensyarah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `kursus`
--

LOCK TABLES `kursus` WRITE;
/*!40000 ALTER TABLE `kursus` DISABLE KEYS */;
INSERT INTO `kursus` VALUES ('PNG','PURATA NILAI GRED','P000001'),('TTTC3213','KEJURUTERAAN DATA','P000002'),('TTTE3503','PENGUJIAN PERISIAN','P000003'),('TTTU2983','PANGKALAN DATA LANJUTAN','P000003'),('TTTU3404','PEMBANGUNAN PERISIAN UTK IS','P000003'),('TTTU4086','PROJEK','P000002'),('TTTU4172','USULAN PROJEK','P000001');
/*!40000 ALTER TABLE `kursus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelajar`
--

DROP TABLE IF EXISTS `pelajar`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelajar` (
  `id` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `tahun` int NOT NULL DEFAULT '1',
  `semester` int NOT NULL DEFAULT '1',
  `status` varchar(16) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'Selamat',
  PRIMARY KEY (`id`),
  CONSTRAINT `tpt_pelajar` FOREIGN KEY (`id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelajar`
--

LOCK TABLES `pelajar` WRITE;
/*!40000 ALTER TABLE `pelajar` DISABLE KEYS */;
INSERT INTO `pelajar` VALUES ('A000001',3,6,'Berisiko'),('A000002',2,3,'Selamat'),('A000003',1,1,'Selamat'),('A000004',3,6,'Berisiko'),('A000005',3,7,'Berisiko'),('A000006',1,1,'Selamat');
/*!40000 ALTER TABLE `pelajar` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pelan`
--

DROP TABLE IF EXISTS `pelan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pelan` (
  `no` int NOT NULL AUTO_INCREMENT,
  `pelajar` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `pensyarah` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `prestasi` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `panduan` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`no`),
  KEY `fk_pelan_2` (`pensyarah`),
  KEY `fk_pelan_1` (`prestasi`),
  KEY `fk_pelan_3` (`pelajar`),
  CONSTRAINT `fk_pelan_1` FOREIGN KEY (`prestasi`) REFERENCES `prestasi` (`kod`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pelan_2` FOREIGN KEY (`pensyarah`) REFERENCES `pensyarah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_pelan_3` FOREIGN KEY (`pelajar`) REFERENCES `pelajar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pelan`
--

LOCK TABLES `pelan` WRITE;
/*!40000 ALTER TABLE `pelan` DISABLE KEYS */;
INSERT INTO `pelan` VALUES (1,'A000001','P000002','M000006','3; Jumpa penyelia FYP');
/*!40000 ALTER TABLE `pelan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengguna` (
  `id` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `kataLaluan` varchar(32) COLLATE utf8mb4_general_ci NOT NULL DEFAULT '1234567',
  `nama` varchar(64) COLLATE utf8mb4_general_ci NOT NULL,
  `sesi` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `peranan` int NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengguna`
--

LOCK TABLES `pengguna` WRITE;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` VALUES ('A000001','1234567','Pelajar A','2/20252026',3),('A000002','1234567','Pelajar B','2/20252026',3),('A000003','1234567','Pelajar C','2/20252026',3),('A000004','1234567','Pelajar D','2/20252026',3),('A000005','1234567','Pelajar E','2/20252026',3),('A000006','1234567','Pelajar F','2/20252026',3),('P000001','1234567','Ketua A','2/20252026',1),('P000002','1234567','Pensyarah B','2/20252026',2),('P000003','1234567','Pensyarah C','2/20252026',2),('P000004','1234567','Pensyarah D','2/20252026',2),('U000001','1234567','Penguji A','2/20232024',10);
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pensyarah`
--

DROP TABLE IF EXISTS `pensyarah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pensyarah` (
  `id` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `tpt_pensyarah` FOREIGN KEY (`id`) REFERENCES `pengguna` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pensyarah`
--

LOCK TABLES `pensyarah` WRITE;
/*!40000 ALTER TABLE `pensyarah` DISABLE KEYS */;
INSERT INTO `pensyarah` VALUES ('P000001'),('P000002'),('P000003'),('P000004');
/*!40000 ALTER TABLE `pensyarah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `peringatan`
--

DROP TABLE IF EXISTS `peringatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `peringatan` (
  `no` int NOT NULL AUTO_INCREMENT,
  `prestasi` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `masa` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dibaca` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`no`),
  KEY `fk_peringatan` (`prestasi`),
  CONSTRAINT `fk_peringatan` FOREIGN KEY (`prestasi`) REFERENCES `prestasi` (`kod`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `peringatan`
--

LOCK TABLES `peringatan` WRITE;
/*!40000 ALTER TABLE `peringatan` DISABLE KEYS */;
INSERT INTO `peringatan` VALUES (1,'M000005','2024-08-17 06:11:19',0),(2,'M000035','2024-08-17 06:11:42',0),(3,'M000006','2025-03-06 06:13:00',0),(4,'M000036','2025-03-06 06:13:11',0),(5,'M000007','2025-09-07 03:28:37',0),(6,'M000037','2025-09-07 03:28:45',0),(7,'M000038','2025-09-07 03:30:48',0),(8,'M000008','2026-02-28 03:35:27',0),(9,'M000039','2026-02-28 03:35:45',0);
/*!40000 ALTER TABLE `peringatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `prestasi`
--

DROP TABLE IF EXISTS `prestasi`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `prestasi` (
  `kod` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `pelajar` varchar(8) COLLATE utf8mb4_general_ci NOT NULL,
  `kursus` varchar(8) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'PNG',
  `sesi` varchar(16) COLLATE utf8mb4_general_ci NOT NULL,
  `mata` decimal(3,2) NOT NULL,
  `status` varchar(16) COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'T',
  PRIMARY KEY (`kod`),
  KEY `fk_prestasi_1` (`pelajar`),
  KEY `fk_prestasi_2` (`kursus`),
  CONSTRAINT `fk_prestasi_1` FOREIGN KEY (`pelajar`) REFERENCES `pelajar` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_prestasi_2` FOREIGN KEY (`kursus`) REFERENCES `kursus` (`kod`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `prestasi`
--

LOCK TABLES `prestasi` WRITE;
/*!40000 ALTER TABLE `prestasi` DISABLE KEYS */;
INSERT INTO `prestasi` VALUES ('M000001','A000001','TTTU2983','2/20232024',1.31,'P Berisiko'),('M000002','A000001','TTTU4172','2/20252026',1.32,'B Berisiko'),('M000003','A000001','TTTU4086','2/20252026',1.33,'B Selamat'),('M000004','A000001','PNG','1/20232024',3.16,'Selamat'),('M000005','A000001','PNG','2/20232024',1.32,'Berisiko'),('M000006','A000001','PNG','1/20242025',0.00,'Berisiko'),('M000007','A000001','PNG','2/20242025',1.32,'Berisiko'),('M000008','A000001','PNG','1/20252026',1.20,'Berisiko'),('M000009','A000001','PNG','2/20252026',1.28,'Selamat'),('M000010','A000002','TTTC3213','2/20242025',3.23,'D Selamat'),('M000011','A000002','TTTE3503','1/20252026',3.89,'D Selamat'),('M000012','A000002','TTTU3404','2/20252026',3.83,'B Selamat'),('M000013','A000002','PNG','2/20242025',3.23,'Selamat'),('M000014','A000002','PNG','1/20252026',3.89,'Selamat'),('M000015','A000002','PNG','2/20252026',3.83,'Selamat'),('M000016','A000003','TTTU2983','2/20252026',1.98,'B Berisiko'),('M000017','A000003','PNG','2/20252026',1.98,'Selamat'),('M000018','A000004','TTTU2983','2/20252026',2.34,'D Selamat'),('M000019','A000004','TTTC3213','2/20242025',2.34,'D Selamat'),('M000020','A000004','TTTE3503','2/20242025',1.00,'D Selamat'),('M000021','A000004','TTTU4086','2/20252026',1.31,'B Selamat'),('M000022','A000004','PNG','1/20232024',2.11,'Selamat'),('M000023','A000004','PNG','2/20232024',1.32,'Selamat'),('M000024','A000004','PNG','1/20242025',1.23,'Selamat'),('M000025','A000004','PNG','2/20242025',1.30,'Selamat'),('M000026','A000004','PNG','1/20252026',1.22,'Selamat'),('M000027','A000004','PNG','2/20252026',1.26,'Selamat'),('M000028','A000005','TTTU2983','2/20232024',1.34,'D Berisiko'),('M000029','A000005','TTTC3213','1/20242025',0.98,'D Berisiko'),('M000030','A000005','TTTE3503','1/20242025',1.22,'D Berisiko'),('M000031','A000005','TTTU3404','2/20242025',1.23,'D Berisiko'),('M000032','A000005','TTTU4172','1/20252026',1.53,'D Berisiko'),('M000033','A000005','TTTU4086','2/20252026',2.00,'B Selamat'),('M000034','A000005','PNG','1/20232024',3.15,'Selamat'),('M000035','A000005','PNG','2/20232024',1.24,'Berisiko'),('M000036','A000005','PNG','1/20242025',1.00,'Berisiko'),('M000037','A000005','PNG','2/20242025',1.32,'Berisiko'),('M000038','A000005','PNG','3/20242025',1.30,'Berisiko'),('M000039','A000005','PNG','1/20252026',1.58,'Berisiko');
/*!40000 ALTER TABLE `prestasi` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-07-28 16:40:04
