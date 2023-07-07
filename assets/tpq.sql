-- MySQL dump 10.13  Distrib 8.0.33, for Linux (x86_64)
--
-- Host: localhost    Database: tpq
-- ------------------------------------------------------
-- Server version	8.0.33-0ubuntu0.22.04.2

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
-- Table structure for table `bulan`
--

DROP TABLE IF EXISTS `bulan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `bulan` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `bulan`
--

LOCK TABLES `bulan` WRITE;
/*!40000 ALTER TABLE `bulan` DISABLE KEYS */;
INSERT INTO `bulan` VALUES (1,'Januari'),(2,'Februari'),(3,'Maret'),(4,'April'),(5,'Mei'),(6,'Juni'),(7,'Juli'),(8,'Agustus'),(9,'September'),(10,'Oktober'),(11,'Nopember'),(12,'Desember');
/*!40000 ALTER TABLE `bulan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `identitas`
--

DROP TABLE IF EXISTS `identitas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `identitas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `app_name` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `no_hp` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `identitas`
--

LOCK TABLES `identitas` WRITE;
/*!40000 ALTER TABLE `identitas` DISABLE KEYS */;
INSERT INTO `identitas` VALUES (1,'E-TPQ','TPQ Darul Jannah Lalung Karanganyar','9WRM+P49, Lalung, Karanganyar, Karanganyar Regency, Central Java 57716','088888888');
/*!40000 ALTER TABLE `identitas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pembayaran`
--

DROP TABLE IF EXISTS `pembayaran`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pembayaran` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_santri` int NOT NULL,
  `tanggal_pembayaran` datetime NOT NULL,
  `nominal` double NOT NULL,
  `bulan` int NOT NULL,
  `tahun` int NOT NULL,
  `keterangan` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pembayaran`
--

LOCK TABLES `pembayaran` WRITE;
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
INSERT INTO `pembayaran` VALUES (1,1,'2023-03-26 05:28:58',100000,3,2023,'lunas'),(14,8,'2023-03-28 09:22:53',100000,2,2023,'123'),(13,8,'2023-03-28 12:14:54',500000,1,2023,'Lunas'),(4,6,'2023-03-26 05:47:12',100000,1,2023,'aa'),(5,6,'2023-03-26 05:48:15',100000,2,2023,'q'),(6,6,'2023-03-26 05:52:10',100000,3,2023,'ww'),(12,7,'2023-03-27 12:03:12',200000,1,2023,'Iuran Januarii'),(11,7,'2023-03-27 11:44:50',100000,3,2023,'lunas'),(10,6,'2023-03-26 13:14:33',100000,5,2023,'w'),(15,8,'2023-03-28 10:40:21',100000,3,2023,'11'),(16,1,'2023-04-02 07:52:26',20000,4,2023,'Iuran Bulan April'),(17,10,'2023-04-02 10:11:19',20000,1,2023,'Bayar Januari'),(18,10,'2023-04-02 10:11:55',25000,2,2023,'Bayar Februari'),(19,10,'2023-04-02 10:12:04',100000,3,2023,'Bayar Maret'),(20,8,'2023-04-05 08:38:36',20000,4,2023,'111'),(21,8,'2023-04-05 08:39:57',100000,5,2023,'22'),(22,10,'2023-04-06 12:21:15',20000,4,2023,'123'),(23,11,'2023-05-20 14:35:20',25000,1,2023,'123'),(24,2,'2023-05-22 20:56:16',25000,1,2023,'123'),(25,2,'2023-05-22 21:12:39',25000,2,2023,'Pembayaran Paketm'),(26,10,'2023-07-05 10:36:45',25000,5,2023,'2'),(27,10,'2023-07-05 10:49:28',10000,6,2023,'10'),(28,10,'2023-07-07 13:17:11',20000,7,2023,'LUNAS');
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengguna`
--

DROP TABLE IF EXISTS `pengguna`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengguna` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` int DEFAULT NULL,
  `is_active` int NOT NULL,
  `id_wali` int DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `role` (`role`),
  CONSTRAINT `pengguna_ibfk_1` FOREIGN KEY (`role`) REFERENCES `pengguna_level` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengguna`
--

LOCK TABLES `pengguna` WRITE;
/*!40000 ALTER TABLE `pengguna` DISABLE KEYS */;
INSERT INTO `pengguna` VALUES (1,'admin','$2y$10$BNwXP8YdAeQqY97UD7mbG.9mVPJcJ4svg8c24hTSRIrEkLz3svpoS','Admin',1,1,0),(14,'petugas','$2y$10$vRWxKKVloghP2BGqnOjNMOGH81FpMPlO/RE4Ic8gJgoHSDe3uNqpa','petugas',2,1,0),(15,'kepala','$2y$10$80cHyVt2t00EPhh6B.8Ii.y1uBtgMhzBj.TXNrFZEzh67a/TVT7.m','kepala',3,1,0),(16,'esti','$2y$10$JBR/Qw5WkbKxwJliSF3HPu5wIQXS3v44q.LQdVYWTkdivcI7I315i','Esti Setyaningrum',4,1,8);
/*!40000 ALTER TABLE `pengguna` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pengguna_level`
--

DROP TABLE IF EXISTS `pengguna_level`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `pengguna_level` (
  `id` int NOT NULL AUTO_INCREMENT,
  `level` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pengguna_level`
--

LOCK TABLES `pengguna_level` WRITE;
/*!40000 ALTER TABLE `pengguna_level` DISABLE KEYS */;
INSERT INTO `pengguna_level` VALUES (1,'Admin'),(2,'Petugas'),(3,'Kepala'),(4,'Wali');
/*!40000 ALTER TABLE `pengguna_level` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `santri`
--

DROP TABLE IF EXISTS `santri`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `santri` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `alamat` text NOT NULL,
  `id_wali` int NOT NULL,
  `jk` varchar(255) NOT NULL,
  `is_active` int NOT NULL,
  `nominal` double DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `santri`
--

LOCK TABLES `santri` WRITE;
/*!40000 ALTER TABLE `santri` DISABLE KEYS */;
INSERT INTO `santri` VALUES (1,'Catur Manunggal','2023-03-02','Kebumen',1,'L',1,20000),(2,'Adi','2023-03-25','Lampung',9,'L',1,20000),(5,'Ilyas','2023-03-26','Potorono',2,'P',1,20000),(6,'Denny Caknan','2023-03-26','Potorono',3,'L',1,20000),(7,'bona','2023-04-08','Potorono',5,'L',1,20000),(8,'Santri Hosting','2023-03-27','Mergangsan',6,'L',1,20000),(9,'2','2023-03-27','Potorono',7,'L',2,20000),(10,'Bayu Prastyo','2023-04-02','Karanganyar',8,'L',1,20000),(11,'SANTRI AJA','2023-04-11','Jumantono',9,'L',2,20000),(12,'siapa','2023-07-07','ss',10,'L',2,20000);
/*!40000 ALTER TABLE `santri` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wali`
--

DROP TABLE IF EXISTS `wali`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wali` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `no_hp` varchar(255) NOT NULL,
  `is_active` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wali`
--

LOCK TABLES `wali` WRITE;
/*!40000 ALTER TABLE `wali` DISABLE KEYS */;
INSERT INTO `wali` VALUES (1,'Arif Muhammad','Ngawi','+628123123123123',0),(2,'Brili Wibu','Palurr','+62829293211',0),(3,'Catur Kurniawan','Adoh','+6281328894356',0),(4,'Anov','Bantul','+628991909876',0),(5,'abc','Adoh','+628991907216',0),(6,'Tes Sebelum Hosting','Jl.MH Thamrin ,Jakarta ','+628991907216',1),(7,'1','1','1',0),(8,'Esti Setyaningrum','Mojogedang','+628991907216',1),(9,'WALI AJA','WALI AJA1','+6285156073268',1),(10,'Gendut','Palur','+6283113895059',1);
/*!40000 ALTER TABLE `wali` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'tpq'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-07-07 14:15:08
