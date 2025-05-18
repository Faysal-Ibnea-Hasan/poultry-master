-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: poultrym_poultry_master
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `advice`
--

DROP TABLE IF EXISTS `advice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `advice` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `category` varchar(255) DEFAULT NULL,
  `tags` text DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `published` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `advice`
--

LOCK TABLES `advice` WRITE;
/*!40000 ALTER TABLE `advice` DISABLE KEYS */;
/*!40000 ALTER TABLE `advice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `batches`
--

DROP TABLE IF EXISTS `batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `batches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `batch_number` varchar(255) NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `chick_type_id` int(10) unsigned DEFAULT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `cost_per_chick` decimal(15,2) DEFAULT NULL,
  `arrival_date` date DEFAULT NULL,
  `initial_weight` decimal(8,2) DEFAULT NULL,
  `source_supplier` varchar(255) DEFAULT NULL,
  `shed_number` varchar(255) DEFAULT NULL,
  `status` enum('active','inactive','terminated') NOT NULL DEFAULT 'active' COMMENT 'active|inactive|terminated',
  `expected_finish_date` date DEFAULT NULL,
  `actual_finish_date` date DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `batches`
--

LOCK TABLES `batches` WRITE;
/*!40000 ALTER TABLE `batches` DISABLE KEYS */;
INSERT INTO `batches` VALUES (1,'BATCH001',4,1,'ZamZam',2850,3.00,'2025-03-18',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-03-19 21:48:46','2025-03-19 21:48:46'),(2,'test-1',13,2,'ssidur co',25,250.00,'2025-03-19',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-03-19 22:03:50','2025-03-19 22:03:50'),(3,'test-2',13,2,'Foysal co',100,1000.00,'2025-03-19',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-03-19 22:07:21','2025-03-19 22:07:21'),(4,'test-3',13,3,'Ss ltd',250,20500.00,'2025-03-19',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-03-19 22:12:24','2025-03-19 22:12:24'),(5,'test--1',14,1,'ZamZam',2850,3.00,'2025-03-21',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-03-21 00:45:15','2025-03-21 00:45:15'),(6,'test--2',14,1,'ZamZam',2850,3.00,'2025-03-21',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-03-21 00:45:35','2025-03-21 00:45:35'),(7,'ttt',14,1,'ydfh',100,300.00,'2025-03-21',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-03-21 01:06:53','2025-03-21 01:06:53'),(8,'test-Saidur',15,2,'test co',40,800.00,'2025-03-21',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-03-21 21:15:20','2025-03-21 21:15:20'),(9,'test -2',15,1,'Dddf',23,5000.00,'2025-03-21',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-03-21 21:26:49','2025-03-21 21:26:49'),(10,'testt',16,1,'fuad',60,3000.00,'2025-03-23',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-03-23 11:41:00','2025-03-23 11:41:00'),(11,'Batch-01',11,1,'Paragon',1000,70.00,'2025-03-24',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-03-24 22:50:11','2025-03-24 22:50:11'),(12,'test fuad',16,2,'fuad co',100,25.00,'2025-04-11',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-04-13 21:22:43','2025-04-13 21:22:43'),(13,'test',17,2,'ok',23,10.00,'2025-05-05',NULL,NULL,NULL,'active',NULL,NULL,NULL,'2025-05-05 15:16:09','2025-05-05 15:16:09');
/*!40000 ALTER TABLE `batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `breeds`
--

DROP TABLE IF EXISTS `breeds`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `breeds` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `average_life_span` int(11) DEFAULT NULL,
  `average_weight` decimal(8,2) DEFAULT NULL,
  `purpose` varchar(50) DEFAULT NULL COMMENT 'meat, eggs, etc',
  `characteristics` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `breeds`
--

LOCK TABLES `breeds` WRITE;
/*!40000 ALTER TABLE `breeds` DISABLE KEYS */;
INSERT INTO `breeds` VALUES (2,'EP (Efficiency Plus)',NULL,NULL,NULL,NULL,NULL,'2025-02-19 17:04:03','2025-03-03 17:07:29'),(3,'Ross-308',NULL,NULL,NULL,NULL,NULL,'2025-02-19 17:04:16','2025-03-03 17:07:47'),(4,'Cobb-500',NULL,NULL,NULL,NULL,NULL,'2025-02-19 17:04:24','2025-03-03 17:08:05'),(5,'IR (Indian River)',NULL,NULL,NULL,NULL,NULL,'2025-02-21 14:07:43','2025-03-03 17:09:04'),(6,'Lohmann Meat',NULL,NULL,NULL,NULL,NULL,'2025-03-02 17:01:24','2025-03-03 17:10:29'),(7,'Novogen Brown',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:14:33','2025-03-15 23:11:37'),(8,'Shaver Brown',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:14:41','2025-03-03 17:14:41'),(9,'Hyline Brown',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:15:35','2025-03-03 17:15:35'),(10,'Bovans Brown',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:15:48','2025-03-03 17:15:48'),(11,'ISA Brown',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:16:10','2025-03-03 17:16:10'),(12,'Quail Bird',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:16:20','2025-03-03 17:16:20'),(13,'Sonali (Normal)',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:17:00','2025-03-03 17:17:00'),(14,'Sonali (Hybrid)',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:17:11','2025-03-03 17:17:11'),(15,'Colour Bird/Sonali Super Hybrid',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:17:38','2025-03-03 17:17:38'),(16,'Duck (Meat Type)',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:21:34','2025-03-03 17:21:34'),(17,'Duck (Egg Type)',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:21:45','2025-03-03 17:21:45'),(18,'Hyline White',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:25:08','2025-03-03 17:25:08'),(19,'Lohmann LSL',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:25:23','2025-03-03 17:25:23'),(20,'Shaver White',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:25:35','2025-03-03 17:25:35'),(21,'Bovans White',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:25:48','2025-03-03 17:25:48'),(22,'Dekalb White',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:26:08','2025-03-03 17:26:08'),(23,'Brown Cock',NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:30:09','2025-03-03 17:30:09'),(24,'Arbor Acres',NULL,NULL,NULL,NULL,NULL,'2025-03-03 19:36:20','2025-03-03 19:36:20'),(25,'Lohmann White',NULL,NULL,NULL,NULL,NULL,'2025-03-04 12:43:38','2025-03-04 12:43:38'),(26,'Hisex Brown',NULL,NULL,NULL,NULL,NULL,'2025-03-06 22:41:39','2025-03-06 22:41:39'),(27,'Hisex White',NULL,NULL,NULL,NULL,NULL,'2025-03-06 22:41:49','2025-03-06 22:41:49'),(28,'Novogen White',NULL,NULL,NULL,NULL,NULL,'2025-03-15 23:11:55','2025-03-15 23:11:55'),(29,'Hubbard Colour Bird',NULL,NULL,NULL,NULL,NULL,'2025-03-15 23:13:27','2025-03-16 08:38:10'),(30,'Lohmann Brown',NULL,NULL,NULL,NULL,NULL,'2025-03-16 01:43:09','2025-03-16 01:43:09'),(31,'Sasso',NULL,NULL,NULL,NULL,NULL,'2025-03-16 09:16:51','2025-03-16 09:16:51');
/*!40000 ALTER TABLE `breeds` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `brooding_temperatures`
--

DROP TABLE IF EXISTS `brooding_temperatures`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `brooding_temperatures` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` int(10) unsigned DEFAULT NULL,
  `day_number` int(11) DEFAULT NULL,
  `target_temperature` decimal(8,2) DEFAULT NULL,
  `actual_temperature` decimal(8,2) DEFAULT NULL,
  `humidity_level` decimal(8,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `brooding_temperatures`
--

LOCK TABLES `brooding_temperatures` WRITE;
/*!40000 ALTER TABLE `brooding_temperatures` DISABLE KEYS */;
/*!40000 ALTER TABLE `brooding_temperatures` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache`
--

LOCK TABLES `cache` WRITE;
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cache_locks`
--

LOCK TABLES `cache_locks` WRITE;
/*!40000 ALTER TABLE `cache_locks` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_locks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `categories` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `categories`
--

LOCK TABLES `categories` WRITE;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chick_types`
--

DROP TABLE IF EXISTS `chick_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chick_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chick_types`
--

LOCK TABLES `chick_types` WRITE;
/*!40000 ALTER TABLE `chick_types` DISABLE KEYS */;
INSERT INTO `chick_types` VALUES (1,'Boiler','2025-03-05 16:38:00','2025-05-04 22:44:02'),(2,'Layer','2025-03-05 16:38:04','2025-03-05 16:38:04'),(3,'Colour Bird','2025-03-05 16:38:10','2025-03-05 16:38:10'),(4,'Duck','2025-03-05 16:38:15','2025-03-05 16:38:15');
/*!40000 ALTER TABLE `chick_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` text DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `logo` varchar(255) DEFAULT NULL,
  `registration_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'ACI Godrej',NULL,NULL,NULL,NULL,NULL,NULL,'2025-02-19 17:03:38','2025-03-03 17:30:47'),(2,'Aftab',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-01 08:15:46','2025-03-01 08:15:46'),(3,'Aman',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-01 08:16:00','2025-03-01 08:16:00'),(4,'A-1 Chicks (AG Agro)',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-01 08:16:16','2025-03-13 01:30:38'),(5,'71 Chicks (Alal Group)',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-01 08:16:27','2025-03-13 01:21:35'),(6,'Alma Chicks',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-01 08:16:36','2025-03-03 17:31:40'),(7,'CP Bangladesh',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-01 08:16:40','2025-03-03 17:31:59'),(8,'RRP Agro',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:32:26','2025-03-13 01:22:00'),(9,'Nahar Agro',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:32:33','2025-03-03 17:32:33'),(10,'Nourish',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:32:41','2025-03-03 17:32:41'),(11,'Swadesh Farms',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:32:53','2025-03-15 23:21:16'),(12,'People’s Chicks',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:33:02','2025-03-13 01:23:21'),(13,'Kazi Farms',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:33:15','2025-03-03 17:33:15'),(14,'Paragon',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:33:29','2025-03-03 17:33:29'),(15,'Astha',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:33:49','2025-03-03 17:33:49'),(16,'Fresh Chicks (Mahbub Group)',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:34:02','2025-03-13 01:24:45'),(17,'Meghna Chicks (Fresh Feed)',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:34:17','2025-03-13 01:24:26'),(18,'Diamond Chicks',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:34:38','2025-03-03 17:34:38'),(19,'One Chicks (Misham Agro)',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:35:09','2025-03-13 01:30:12'),(20,'Padma Chicks',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:36:48','2025-03-03 17:36:48'),(21,'Index Agro',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:37:55','2025-03-13 01:25:03'),(22,'New Hope',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:38:03','2025-03-03 17:38:03'),(23,'Provita Chicks',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:38:09','2025-03-13 01:25:17'),(24,'Quality Chicks',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:38:17','2025-03-13 01:25:28'),(25,'Planet Chicks',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:39:17','2025-03-03 17:39:17'),(26,'Gomoti Chicks',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:39:41','2025-03-03 17:39:41'),(27,'Chashi Agro',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:39:57','2025-03-03 17:39:57'),(28,'DG Chicks (Dhaka Group)',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:40:11','2025-03-13 01:25:51'),(29,'Abir Chicks',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:40:19','2025-03-03 17:40:19'),(30,'RMR Chicks',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:40:53','2025-03-03 17:40:53'),(31,'Haid Group',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:44:26','2025-03-03 17:44:26'),(32,'Akij Chicks',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:44:36','2025-03-03 17:44:36'),(33,'Abdullah Poultry (AP Feed)',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:45:21','2025-03-13 01:26:16'),(34,'Pushtiraj Chicks',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-03 17:45:32','2025-03-13 01:26:33'),(35,'Phenix Poultry',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-06 22:42:05','2025-03-13 01:27:46'),(36,'Care Chicks (Tamim Agro)',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-13 01:21:10','2025-03-13 01:21:10'),(37,'Goalando Hatchery',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-13 01:28:55','2025-03-13 01:28:55');
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company_and_chicks`
--

DROP TABLE IF EXISTS `company_and_chicks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company_and_chicks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_id` int(10) unsigned NOT NULL,
  `company_id` int(10) unsigned NOT NULL,
  `breed_id` int(10) unsigned NOT NULL,
  `chick_type_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company_and_chicks`
--

LOCK TABLES `company_and_chicks` WRITE;
/*!40000 ALTER TABLE `company_and_chicks` DISABLE KEYS */;
INSERT INTO `company_and_chicks` VALUES (1,3,6,3,1,'2025-03-15 22:45:04','2025-03-15 22:45:04'),(2,3,6,2,1,'2025-03-15 22:45:04','2025-03-15 22:45:04'),(3,3,6,6,1,'2025-03-15 22:45:04','2025-03-15 22:45:04'),(4,3,5,3,1,'2025-03-15 22:45:30','2025-03-15 22:45:30'),(5,3,5,2,1,'2025-03-15 22:45:30','2025-03-15 22:45:30'),(6,3,12,2,1,'2025-03-15 22:46:11','2025-03-15 22:46:11'),(7,3,12,3,1,'2025-03-15 22:46:11','2025-03-15 22:46:11'),(8,3,12,8,2,'2025-03-15 22:46:46','2025-03-15 22:46:46'),(9,3,12,22,2,'2025-03-15 22:46:46','2025-03-15 22:46:46'),(10,3,12,15,3,'2025-03-15 22:47:17','2025-03-15 22:47:17'),(11,3,9,3,1,'2025-03-15 22:47:44','2025-03-15 22:47:44'),(12,3,9,19,2,'2025-03-15 22:48:19','2025-03-15 22:48:19'),(13,3,9,25,2,'2025-03-15 22:48:19','2025-03-15 22:48:19'),(14,3,17,2,1,'2025-03-15 22:49:58','2025-03-15 22:49:58'),(15,3,17,3,1,'2025-03-15 22:49:58','2025-03-15 22:49:58'),(16,3,14,2,1,'2025-03-15 23:12:25','2025-03-15 23:12:25'),(17,3,14,7,2,'2025-03-15 23:13:07','2025-03-15 23:13:07'),(18,3,14,28,2,'2025-03-15 23:13:07','2025-03-15 23:13:07'),(19,3,14,29,3,'2025-03-15 23:13:51','2025-03-15 23:13:51'),(20,3,11,3,1,'2025-03-15 23:21:55','2025-03-15 23:21:55'),(21,3,11,6,1,'2025-03-15 23:21:55','2025-03-15 23:21:55'),(22,3,16,2,1,'2025-03-15 23:39:16','2025-03-15 23:39:16'),(23,3,16,3,1,'2025-03-15 23:39:16','2025-03-15 23:39:16'),(24,3,16,6,1,'2025-03-15 23:39:16','2025-03-15 23:39:16'),(25,3,16,24,1,'2025-03-15 23:39:16','2025-03-15 23:39:16'),(26,3,23,2,1,'2025-03-15 23:42:27','2025-03-15 23:42:27'),(27,3,23,5,1,'2025-03-15 23:42:27','2025-03-15 23:42:27'),(28,3,22,3,1,'2025-03-15 23:42:55','2025-03-15 23:42:55'),(29,3,22,24,1,'2025-03-15 23:42:55','2025-03-15 23:42:55'),(30,3,23,6,1,'2025-03-15 23:44:35','2025-03-15 23:44:35'),(31,3,1,2,1,'2025-03-15 23:45:21','2025-03-15 23:45:21'),(32,3,1,6,1,'2025-03-15 23:45:21','2025-03-15 23:45:21'),(33,3,3,2,1,'2025-03-15 23:46:34','2025-03-15 23:46:34'),(34,3,3,6,1,'2025-03-15 23:46:34','2025-03-15 23:46:34'),(35,3,36,2,1,'2025-03-15 23:48:13','2025-03-15 23:48:13'),(36,3,36,3,1,'2025-03-15 23:48:13','2025-03-15 23:48:13'),(37,3,36,6,1,'2025-03-15 23:48:13','2025-03-15 23:48:13'),(38,3,36,15,3,'2025-03-15 23:48:33','2025-03-15 23:48:33'),(39,3,2,2,1,'2025-03-15 23:50:46','2025-03-15 23:50:46'),(40,3,2,3,1,'2025-03-15 23:50:46','2025-03-15 23:50:46'),(41,3,9,29,3,'2025-03-15 23:51:02','2025-03-15 23:51:02'),(42,3,13,5,1,'2025-03-15 23:55:49','2025-03-15 23:55:49'),(43,3,13,3,1,'2025-03-15 23:55:49','2025-03-15 23:55:49'),(44,3,25,2,1,'2025-03-16 00:02:53','2025-03-16 00:02:53'),(45,3,25,29,3,'2025-03-16 00:03:09','2025-03-16 00:03:09'),(46,3,7,3,1,'2025-03-16 00:11:50','2025-03-16 00:11:50'),(47,3,8,4,1,'2025-03-16 00:14:59','2025-03-16 00:14:59'),(48,3,8,3,1,'2025-03-16 00:14:59','2025-03-16 00:14:59'),(49,3,8,29,3,'2025-03-16 00:15:23','2025-03-16 00:15:23'),(50,3,15,2,1,'2025-03-16 00:21:09','2025-03-16 00:21:09'),(51,3,15,3,1,'2025-03-16 00:21:09','2025-03-16 00:21:09'),(52,3,15,5,1,'2025-03-16 00:21:09','2025-03-16 00:21:09'),(53,3,19,5,1,'2025-03-16 00:23:09','2025-03-16 00:23:09'),(54,3,30,2,1,'2025-03-16 00:25:43','2025-03-16 00:25:43'),(55,3,30,6,1,'2025-03-16 00:25:43','2025-03-16 00:25:43'),(56,3,28,2,1,'2025-03-16 00:31:09','2025-03-16 00:31:09'),(57,3,28,4,1,'2025-03-16 00:31:09','2025-03-16 00:31:09'),(58,3,28,5,1,'2025-03-16 00:31:09','2025-03-16 00:31:09'),(59,3,37,15,3,'2025-03-16 00:39:48','2025-03-16 00:39:48'),(60,3,26,2,1,'2025-03-16 00:43:43','2025-03-16 00:43:43'),(61,3,26,15,3,'2025-03-16 00:44:01','2025-03-16 00:44:01'),(62,3,21,2,1,'2025-03-16 08:35:53','2025-03-16 08:35:53'),(63,3,21,11,2,'2025-03-16 08:36:16','2025-03-16 08:36:16'),(64,3,21,29,3,'2025-03-16 08:36:36','2025-03-16 08:36:36'),(65,3,1,2,1,'2025-03-16 08:37:03','2025-03-16 08:37:03'),(66,3,1,7,2,'2025-03-16 08:37:44','2025-03-16 08:37:44'),(67,3,3,3,1,'2025-03-16 09:15:04','2025-03-16 09:15:04'),(68,3,3,29,3,'2025-03-16 09:15:37','2025-03-16 09:15:37'),(69,3,7,3,1,'2025-03-16 11:11:01','2025-03-16 11:11:01'),(70,3,7,11,2,'2025-03-16 11:11:30','2025-03-16 11:11:30'),(72,3,28,26,2,'2025-03-16 18:56:52','2025-03-16 18:56:52'),(73,3,28,27,2,'2025-03-16 18:56:52','2025-03-16 18:56:52');
/*!40000 ALTER TABLE `company_and_chicks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dead_chickens`
--

DROP TABLE IF EXISTS `dead_chickens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `dead_chickens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned DEFAULT NULL,
  `batch_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `quantity` int(11) NOT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `weight` decimal(8,2) DEFAULT NULL,
  `disposal_method` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dead_chickens`
--

LOCK TABLES `dead_chickens` WRITE;
/*!40000 ALTER TABLE `dead_chickens` DISABLE KEYS */;
INSERT INTO `dead_chickens` VALUES (5,NULL,1,'2025-03-16',150,'Due to execisve heat',NULL,NULL,NULL,'2025-03-24 02:41:19','2025-03-24 02:41:19'),(7,NULL,1,'2025-03-16',150,'Due to execisve heat',NULL,NULL,NULL,'2025-03-24 18:45:58','2025-03-24 18:45:58'),(14,NULL,11,'2025-03-24',2,'Colibacillosis',NULL,NULL,NULL,'2025-03-24 22:52:31','2025-03-24 22:52:31'),(15,NULL,12,'2025-04-10',2,'iccha',NULL,NULL,NULL,'2025-04-14 12:29:32','2025-04-14 12:29:32');
/*!40000 ALTER TABLE `dead_chickens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `design_types`
--

DROP TABLE IF EXISTS `design_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `design_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `order` int(11) DEFAULT NULL,
  `isPro` tinyint(1) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `design_types`
--

LOCK TABLES `design_types` WRITE;
/*!40000 ALTER TABLE `design_types` DISABLE KEYS */;
INSERT INTO `design_types` VALUES (1,'Result',1,0,1,'2025-03-01 14:24:29','2025-03-01 14:24:29'),(2,'List',2,0,1,'2025-03-01 14:24:29','2025-03-01 14:24:29'),(3,'Static',3,0,1,'2025-03-01 14:24:29','2025-03-01 14:24:29'),(4,'Banner',4,0,1,'2025-03-01 14:24:29','2025-03-01 14:24:29'),(5,'Calculator',5,0,1,'2025-03-01 14:24:29','2025-03-01 14:24:29');
/*!40000 ALTER TABLE `design_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `diseases`
--

DROP TABLE IF EXISTS `diseases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `diseases` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `diseases`
--

LOCK TABLES `diseases` WRITE;
/*!40000 ALTER TABLE `diseases` DISABLE KEYS */;
/*!40000 ALTER TABLE `diseases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expense_types`
--

DROP TABLE IF EXISTS `expense_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expense_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expense_types`
--

LOCK TABLES `expense_types` WRITE;
/*!40000 ALTER TABLE `expense_types` DISABLE KEYS */;
INSERT INTO `expense_types` VALUES (1,'Feed Expense','food','2025-03-17 23:20:15','2025-03-19 04:13:22'),(2,'Medicine','medicine','2025-03-18 22:34:58','2025-03-18 22:34:58'),(3,'Transport Cost','transport','2025-03-24 00:49:55','2025-03-24 00:49:55'),(4,'Litter Cost','litter','2025-03-24 00:52:49','2025-03-24 00:52:49'),(5,'Labor Cost','labour','2025-03-24 00:53:03','2025-03-24 00:53:03'),(6,'Electricity Bill','electricity','2025-03-24 00:54:19','2025-03-24 00:56:54'),(7,'Other Cost','other','2025-03-24 00:54:46','2025-03-24 00:56:32'),(8,'Chicks Cost','cost_per_chick','2025-03-24 00:55:05','2025-03-24 00:55:05');
/*!40000 ALTER TABLE `expense_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `expenses`
--

DROP TABLE IF EXISTS `expenses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `expenses` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned DEFAULT NULL,
  `batch_id` int(10) unsigned NOT NULL,
  `date` date NOT NULL,
  `expense_type` int(10) unsigned NOT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `number_of_sack` int(11) DEFAULT NULL,
  `cost_per_sack` decimal(15,2) DEFAULT NULL,
  `food_type` int(10) unsigned DEFAULT NULL,
  `description` text DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `receipt_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `expenses`
--

LOCK TABLES `expenses` WRITE;
/*!40000 ALTER TABLE `expenses` DISABLE KEYS */;
INSERT INTO `expenses` VALUES (2,NULL,2,'2025-03-14',1,1000.00,10,100.00,1,NULL,NULL,NULL,NULL,'2025-03-18 19:13:56','2025-03-18 19:13:56'),(3,NULL,3,'2025-03-14',1,1000.00,10,100.00,1,NULL,NULL,NULL,NULL,'2025-03-18 22:08:41','2025-03-18 22:08:41'),(4,NULL,3,'2025-03-17',1,50.00,5,10.00,1,NULL,NULL,NULL,NULL,'2025-03-18 22:11:57','2025-03-18 22:11:57'),(5,NULL,3,'2025-03-14',2,50.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-18 22:35:41','2025-03-18 22:35:41'),(7,NULL,3,'2025-03-20',2,100.00,NULL,NULL,5,NULL,NULL,NULL,NULL,'2025-03-20 01:31:09','2025-03-20 01:31:09'),(8,NULL,2,'2025-03-20',2,150.00,NULL,NULL,5,NULL,NULL,NULL,NULL,'2025-03-20 01:39:00','2025-03-20 01:39:00'),(9,NULL,5,'2025-03-21',1,1000.00,2,500.00,2,NULL,NULL,NULL,NULL,'2025-03-21 02:08:51','2025-03-21 02:08:51'),(10,NULL,1,'2025-03-16',1,944.00,16,59.00,1,NULL,NULL,NULL,NULL,'2025-03-21 11:59:43','2025-03-21 12:00:30'),(11,NULL,5,'2025-03-21',2,30.00,NULL,NULL,5,NULL,NULL,NULL,NULL,'2025-03-21 13:49:29','2025-03-21 13:49:29'),(12,NULL,8,'2025-03-21',2,120.00,NULL,NULL,5,NULL,NULL,NULL,NULL,'2025-03-21 21:17:05','2025-03-21 21:17:05'),(13,NULL,8,'2025-03-21',1,1000.00,2,500.00,1,NULL,NULL,NULL,NULL,'2025-03-21 21:28:06','2025-03-21 21:28:06'),(14,NULL,8,'2025-03-21',1,230.00,1,230.00,5,NULL,NULL,NULL,NULL,'2025-03-21 21:31:38','2025-03-21 21:31:38'),(15,NULL,8,'2025-03-21',1,1500.00,5,300.00,6,NULL,NULL,NULL,NULL,'2025-03-21 21:32:05','2025-03-21 21:32:05'),(19,NULL,10,'2025-03-24',2,100.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-24 01:53:01','2025-03-24 21:58:55'),(22,NULL,10,'2025-03-24',1,3000.00,15,200.00,4,NULL,NULL,NULL,NULL,'2025-03-24 14:31:00','2025-03-24 21:54:45'),(24,NULL,10,'2025-03-24',1,500.00,5,100.00,3,NULL,NULL,NULL,NULL,'2025-03-24 22:04:46','2025-03-24 22:04:46'),(25,NULL,10,'2025-03-24',1,720.00,6,120.00,1,NULL,NULL,NULL,NULL,'2025-03-24 22:07:12','2025-03-24 22:07:12'),(26,NULL,11,'2025-03-24',2,8500.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-24 22:51:10','2025-03-24 22:51:10'),(27,NULL,10,'2025-03-26',7,300.00,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-26 16:40:11','2025-03-26 16:40:11');
/*!40000 ALTER TABLE `expenses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `food_types`
--

DROP TABLE IF EXISTS `food_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `food_types` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `food_types`
--

LOCK TABLES `food_types` WRITE;
/*!40000 ALTER TABLE `food_types` DISABLE KEYS */;
INSERT INTO `food_types` VALUES (1,'Broiler Starter','2025-03-17 23:20:31','2025-03-17 23:20:31'),(2,'Broiler Grower','2025-03-18 15:36:10','2025-03-18 15:36:10'),(3,'Sonali Starter','2025-03-18 15:36:18','2025-03-18 15:36:18'),(4,'Sonali Grower','2025-03-18 15:36:24','2025-03-18 15:36:24'),(5,'Broiler Finisher','2025-03-19 04:12:33','2025-03-19 04:12:33'),(6,'Sonali Finisher','2025-03-19 04:12:59','2025-03-19 04:12:59');
/*!40000 ALTER TABLE `food_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `job_batches`
--

LOCK TABLES `job_batches` WRITE;
/*!40000 ALTER TABLE `job_batches` DISABLE KEYS */;
/*!40000 ALTER TABLE `job_batches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) unsigned NOT NULL,
  `reserved_at` int(10) unsigned DEFAULT NULL,
  `available_at` int(10) unsigned NOT NULL,
  `created_at` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `jobs`
--

LOCK TABLES `jobs` WRITE;
/*!40000 ALTER TABLE `jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lighting_schedules`
--

DROP TABLE IF EXISTS `lighting_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lighting_schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` int(10) unsigned DEFAULT NULL,
  `day_number` int(11) DEFAULT NULL,
  `light_hours` int(11) DEFAULT NULL,
  `light_intensity` varchar(255) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lighting_schedules`
--

LOCK TABLES `lighting_schedules` WRITE;
/*!40000 ALTER TABLE `lighting_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `lighting_schedules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (93,'0001_01_01_000001_create_cache_table',1),(94,'0001_01_01_000002_create_jobs_table',1),(95,'2025_01_10_105008_create_companies_table',1),(96,'2025_01_10_105056_create_breeds_table',1),(97,'2025_01_10_105124_create_categories_table',1),(99,'2025_01_10_105217_create_dead_chickens_table',1),(101,'2025_01_10_105252_create_sells_table',1),(103,'2025_01_10_105330_create_lighting_schedules_table',1),(104,'2025_01_10_105415_create_brooding_temperatures_table',1),(105,'2025_01_10_105452_create_vaccination_schedules_table',1),(106,'2025_01_10_105505_create_advice_table',1),(108,'2025_01_10_112521_create_diseases_table',1),(110,'2025_01_18_064048_create_options_table',1),(111,'2025_01_18_064110_create_option_results_table',1),(112,'2025_01_18_064234_create_option_attributes_table',1),(113,'2025_01_31_052645_create_banners_table',1),(115,'2025_02_03_155236_create_personal_access_tokens_table',1),(116,'2025_02_17_163331_create_design_types_table',1),(117,'2025_02_26_144528_create_patches_table',2),(118,'2025_02_28_134721_create_option_patches_table',2),(119,'2025_02_01_160603_create_company_and_chicks_table',3),(120,'2025_03_04_160540_create_chick_types_table',4),(122,'0001_01_01_000000_create_users_table',5),(124,'2025_01_10_113324_create_subscribers_table',7),(125,'2025_01_10_105628_create_subscriptions_table',8),(126,'2025_03_08_210430_create_option_static_results_table',9),(128,'2025_01_10_105239_create_expenses_table',11),(129,'2025_03_17_200401_create_expense_types_table',12),(130,'2025_03_17_203120_create_food_types_table',12),(132,'2025_01_10_105140_create_batches_table',13),(133,'2025_01_10_105310_create_sell_lines_table',14),(134,'2025_05_02_004407_create_payment_transactions_table',15),(135,'2025_05_02_121146_create_translations_table',16);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `option_attributes`
--

DROP TABLE IF EXISTS `option_attributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option_attributes` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option_attributes`
--

LOCK TABLES `option_attributes` WRITE;
/*!40000 ALTER TABLE `option_attributes` DISABLE KEYS */;
INSERT INTO `option_attributes` VALUES (6,'Daily Feed Intake (gm)','2025-03-03 18:02:58','2025-03-03 18:02:58'),(7,'Cumulative Feed Intake (gm)','2025-03-03 18:03:15','2025-03-03 18:03:15'),(8,'Average Body Weight (gm)','2025-03-03 18:03:29','2025-03-03 18:03:29'),(9,'FCR','2025-03-03 18:03:48','2025-03-03 18:03:48'),(10,'Floor Space (Square Feet/Bird)','2025-03-03 18:04:08','2025-03-03 18:08:44'),(11,'Feeder (Number of Bird/Feeder)','2025-03-03 18:04:33','2025-03-03 18:04:33'),(12,'Drinker (Number of Bird/Drinker','2025-03-03 18:04:55','2025-03-03 18:04:55'),(13,'Floor Space (Quails/Square Feet)','2025-03-03 18:07:32','2025-03-03 18:07:32'),(14,'Egg Production (%)','2025-03-03 18:07:55','2025-03-03 18:07:55'),(15,'Lighting (Hours)','2025-03-03 18:08:08','2025-03-03 18:08:08'),(16,'Egg Weight (gm)','2025-03-03 18:09:29','2025-03-03 18:09:29'),(17,'Daily Water Intake (ml)','2025-03-03 18:10:53','2025-03-03 18:10:53');
/*!40000 ALTER TABLE `option_attributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `option_patches`
--

DROP TABLE IF EXISTS `option_patches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option_patches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `patch_id` int(10) unsigned NOT NULL,
  `option_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option_patches`
--

LOCK TABLES `option_patches` WRITE;
/*!40000 ALTER TABLE `option_patches` DISABLE KEYS */;
INSERT INTO `option_patches` VALUES (1,1,1,NULL,'2025-03-01 14:35:52'),(2,2,2,NULL,'2025-03-01 14:37:12'),(3,3,7,NULL,'2025-03-01 14:50:24'),(4,3,6,NULL,'2025-03-01 14:50:24'),(5,1,2,NULL,'2025-03-01 14:50:55'),(6,1,8,NULL,'2025-03-01 15:34:07'),(7,1,9,NULL,'2025-03-01 15:34:07'),(8,4,1,NULL,'2025-03-01 15:38:55'),(9,4,2,NULL,'2025-03-01 15:38:55'),(10,4,8,NULL,'2025-03-01 15:38:55'),(11,4,9,NULL,'2025-03-01 15:38:55'),(12,4,10,NULL,'2025-03-01 15:51:27'),(13,7,6,NULL,'2025-03-02 17:06:11'),(14,7,7,NULL,'2025-03-02 17:06:11'),(15,7,11,NULL,'2025-03-02 17:06:11'),(19,10,3,NULL,'2025-03-02 17:22:30'),(20,8,8,NULL,'2025-03-02 18:28:00'),(21,11,13,NULL,'2025-03-03 18:29:05'),(22,12,6,NULL,'2025-03-03 18:49:00'),(23,12,11,NULL,'2025-03-03 18:49:00'),(24,13,3,NULL,'2025-03-03 18:49:13'),(25,14,8,NULL,'2025-03-03 18:49:35'),(26,14,14,NULL,'2025-03-03 18:49:35'),(27,14,15,NULL,'2025-03-03 18:49:35'),(28,14,16,NULL,'2025-03-03 18:49:35'),(29,14,17,NULL,'2025-03-03 18:49:35'),(30,15,13,NULL,'2025-03-03 18:50:02'),(31,15,18,NULL,'2025-03-03 18:50:02'),(32,15,19,NULL,'2025-03-03 18:50:02'),(33,15,20,NULL,'2025-03-03 18:50:02'),(34,15,21,NULL,'2025-03-03 18:50:02'),(35,16,22,NULL,'2025-03-03 18:50:46'),(36,16,23,NULL,'2025-03-03 18:50:46'),(37,16,24,NULL,'2025-03-03 18:50:46'),(38,16,25,NULL,'2025-03-03 18:50:46'),(39,16,26,NULL,'2025-03-03 18:50:46'),(40,17,28,NULL,'2025-03-03 18:51:23'),(41,17,29,NULL,'2025-03-03 18:51:23'),(42,17,30,NULL,'2025-03-03 18:51:23'),(43,17,31,NULL,'2025-03-03 18:51:23'),(44,17,32,NULL,'2025-03-03 18:51:23'),(45,18,33,NULL,'2025-03-03 18:51:47'),(46,18,34,NULL,'2025-03-03 18:51:47'),(47,18,35,NULL,'2025-03-03 18:51:47'),(48,14,36,NULL,'2025-03-03 19:37:20'),(50,12,37,NULL,'2025-03-03 21:27:53'),(51,12,38,NULL,'2025-03-03 21:27:53'),(52,13,42,NULL,'2025-03-08 17:10:58'),(53,20,43,NULL,'2025-03-09 19:26:45'),(54,21,41,NULL,'2025-03-09 20:30:31'),(55,19,44,NULL,'2025-03-10 18:04:06'),(56,19,45,NULL,'2025-03-10 18:04:06'),(57,19,46,NULL,'2025-03-10 18:04:06'),(58,19,47,NULL,'2025-03-10 18:04:06'),(60,15,39,NULL,'2025-03-13 04:34:41'),(61,16,40,NULL,'2025-03-13 04:34:55'),(62,17,27,NULL,'2025-03-14 00:01:49'),(63,21,49,NULL,'2025-03-14 01:30:16'),(66,19,52,NULL,'2025-03-14 11:05:27'),(67,21,53,NULL,'2025-03-15 12:51:14'),(68,21,54,NULL,'2025-03-15 12:51:14'),(69,21,55,NULL,'2025-03-15 12:51:14'),(70,21,56,NULL,'2025-03-15 12:51:14'),(71,21,57,NULL,'2025-03-15 12:51:59'),(75,22,58,NULL,'2025-03-16 00:57:54'),(76,22,59,NULL,'2025-03-16 00:57:54'),(77,23,48,NULL,'2025-03-16 01:05:44'),(78,23,50,NULL,'2025-03-16 01:05:44'),(79,23,60,NULL,'2025-03-16 01:05:44'),(81,19,51,NULL,'2025-03-16 01:07:35'),(82,23,52,NULL,'2025-03-16 01:13:42'),(83,23,51,NULL,'2025-03-16 01:13:42'),(85,23,47,NULL,'2025-03-16 01:15:22'),(86,19,48,NULL,'2025-03-16 01:16:38'),(87,19,50,NULL,'2025-03-16 01:16:38'),(88,19,60,NULL,'2025-03-16 01:16:38'),(89,19,61,NULL,'2025-03-16 01:23:55'),(90,21,62,NULL,'2025-03-16 01:24:14'),(91,18,63,NULL,'2025-03-16 01:24:55'),(92,16,64,NULL,'2025-03-16 01:36:16'),(93,16,63,NULL,'2025-03-16 01:36:53'),(94,15,65,NULL,'2025-03-16 01:43:33'),(95,15,63,NULL,'2025-03-16 01:43:33'),(96,24,66,NULL,'2025-03-16 15:04:31');
/*!40000 ALTER TABLE `option_patches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `option_results`
--

DROP TABLE IF EXISTS `option_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option_results` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_id` bigint(20) unsigned NOT NULL,
  `breed_id` int(10) unsigned NOT NULL,
  `option_attribute_id` int(10) unsigned DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `day` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=308 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option_results`
--

LOCK TABLES `option_results` WRITE;
/*!40000 ALTER TABLE `option_results` DISABLE KEYS */;
INSERT INTO `option_results` VALUES (20,8,2,6,'12',1,'2025-03-17 14:40:32','2025-03-17 14:43:01'),(21,8,2,6,'16',2,'2025-03-17 14:42:46','2025-03-17 14:42:46'),(22,8,2,6,'20',3,'2025-03-17 14:45:23','2025-03-17 14:45:23'),(23,8,2,6,'25',4,'2025-03-17 14:45:54','2025-03-17 14:45:54'),(24,8,2,6,'28',5,'2025-03-17 14:46:26','2025-03-17 14:46:26'),(25,8,2,6,'31',6,'2025-03-17 14:47:20','2025-03-17 14:47:20'),(26,8,2,6,'34',7,'2025-03-17 14:47:44','2025-03-17 14:47:44'),(27,8,2,6,'38',8,'2025-03-17 14:48:03','2025-03-17 14:48:03'),(28,8,2,6,'43',9,'2025-03-17 14:48:33','2025-03-17 14:48:33'),(29,8,2,6,'48',10,'2025-03-17 14:48:58','2025-03-17 14:48:58'),(30,8,2,6,'51',11,'2025-03-17 14:49:32','2025-03-17 14:49:32'),(31,8,2,6,'58',12,'2025-03-17 14:50:02','2025-03-17 14:50:02'),(32,8,2,6,'63',13,'2025-03-17 14:50:28','2025-03-17 14:50:28'),(33,8,2,6,'68',14,'2025-03-17 14:50:48','2025-03-17 14:50:48'),(34,8,2,6,'73',15,'2025-03-17 14:51:34','2025-03-17 14:51:34'),(35,8,2,6,'79',16,'2025-03-17 14:55:27','2025-03-17 14:55:27'),(36,8,2,6,'85',17,'2025-03-17 14:55:50','2025-03-17 14:55:50'),(37,8,2,6,'92',18,'2025-03-17 14:56:13','2025-03-17 14:56:13'),(38,8,2,6,'98',19,'2025-03-17 14:56:38','2025-03-17 14:56:38'),(39,8,2,6,'103',20,'2025-03-17 14:57:01','2025-03-17 14:57:01'),(40,8,2,6,'109',21,'2025-03-17 14:57:30','2025-03-17 14:57:30'),(41,8,2,6,'115',22,'2025-03-17 15:01:22','2025-03-17 15:01:48'),(42,8,2,6,'120',23,'2025-03-17 15:02:21','2025-03-17 15:02:21'),(43,8,2,6,'126',24,'2025-03-17 15:02:45','2025-03-17 15:02:45'),(44,8,2,6,'132',25,'2025-03-17 15:03:07','2025-03-17 15:03:07'),(45,8,2,6,'138',26,'2025-03-17 15:03:46','2025-03-17 15:03:46'),(46,8,2,6,'143',27,'2025-03-17 15:04:14','2025-03-17 15:04:14'),(48,8,2,6,'148',28,'2025-03-17 15:05:20','2025-03-17 15:05:20'),(49,8,2,6,'153',29,'2025-03-17 15:05:48','2025-03-17 15:05:48'),(50,8,2,6,'159',30,'2025-03-17 15:07:24','2025-03-17 15:07:24'),(51,8,2,6,'164',31,'2025-03-17 15:07:53','2025-03-17 15:07:53'),(52,8,2,6,'170',32,'2025-03-17 15:08:30','2025-03-17 15:08:30'),(53,8,2,6,'174',33,'2025-03-17 15:09:06','2025-03-17 15:09:06'),(54,8,2,6,'179',34,'2025-03-17 15:09:35','2025-03-17 15:09:35'),(55,8,2,6,'183',35,'2025-03-17 15:10:16','2025-03-17 15:10:16'),(56,8,2,6,'188',36,'2025-03-17 15:10:42','2025-03-17 15:10:42'),(57,8,2,6,'192',37,'2025-03-17 15:11:10','2025-03-17 15:11:10'),(58,8,2,6,'195',38,'2025-03-17 15:11:41','2025-03-17 15:11:41'),(59,8,2,6,'199',39,'2025-03-17 15:12:05','2025-03-17 15:12:05'),(60,8,2,6,'202',40,'2025-03-17 15:12:46','2025-03-17 15:12:46'),(61,8,2,6,'206',41,'2025-03-17 15:13:38','2025-03-17 15:13:38'),(62,8,2,6,'208',42,'2025-03-17 15:14:00','2025-03-17 15:14:00'),(63,8,2,6,'211',43,'2025-03-17 15:14:48','2025-03-17 15:14:48'),(64,8,2,6,'214',44,'2025-03-17 15:15:14','2025-03-17 15:15:14'),(65,8,2,6,'216',45,'2025-03-17 15:15:35','2025-03-17 15:15:35'),(66,8,2,6,'219',46,'2025-03-17 15:17:55','2025-03-17 15:17:55'),(67,8,2,6,'220',47,'2025-03-17 15:18:21','2025-03-17 15:18:21'),(68,8,2,6,'223',48,'2025-03-17 15:18:43','2025-03-17 15:18:43'),(69,8,2,6,'224',49,'2025-03-17 15:19:08','2025-03-17 15:19:08'),(70,8,2,6,'225',50,'2025-03-17 15:19:40','2025-03-17 15:19:40'),(71,8,2,6,'227',51,'2025-03-17 15:20:05','2025-03-17 15:20:05'),(72,8,2,6,'228',52,'2025-03-17 15:20:25','2025-03-17 15:20:25'),(73,8,2,6,'228',53,'2025-03-17 15:20:49','2025-03-17 15:20:49'),(74,8,2,6,'230',54,'2025-03-17 15:21:06','2025-03-17 15:21:06'),(75,8,2,6,'230',55,'2025-03-17 15:21:31','2025-03-17 15:21:31'),(76,8,2,6,'230',56,'2025-03-17 15:21:47','2025-03-17 15:21:47'),(77,8,2,17,'20',1,'2025-03-17 15:28:26','2025-03-17 15:28:26'),(78,8,2,17,'28',2,'2025-03-17 15:28:47','2025-03-17 15:28:47'),(79,8,2,17,'34',3,'2025-03-17 15:29:07','2025-03-17 15:29:07'),(80,8,2,17,'42',4,'2025-03-17 15:29:27','2025-03-17 15:29:27'),(81,8,2,17,'47',5,'2025-03-17 15:29:47','2025-03-17 15:29:47'),(82,8,2,17,'53',6,'2025-03-17 15:30:07','2025-03-17 15:30:07'),(83,8,2,17,'58',7,'2025-03-17 15:30:31','2025-03-17 15:30:31'),(84,8,2,17,'65',8,'2025-03-17 15:30:54','2025-03-17 15:30:54'),(85,8,2,17,'72',9,'2025-03-17 15:31:12','2025-03-17 15:31:12'),(86,8,2,17,'81',10,'2025-03-17 15:31:32','2025-03-17 15:31:32'),(87,8,2,17,'87',11,'2025-03-17 15:31:52','2025-03-17 15:31:52'),(88,8,2,17,'98',12,'2025-03-17 15:32:12','2025-03-17 15:32:12'),(89,8,2,17,'108',13,'2025-03-17 15:32:30','2025-03-17 15:32:30'),(90,8,2,17,'115',14,'2025-03-17 15:32:49','2025-03-17 15:32:49'),(91,8,2,17,'125',15,'2025-03-17 17:00:30','2025-03-17 17:00:30'),(92,8,2,17,'135',16,'2025-03-17 17:00:59','2025-03-17 17:00:59'),(93,8,2,17,'144',17,'2025-03-17 17:01:18','2025-03-17 17:01:18'),(94,8,2,17,'156',18,'2025-03-17 17:01:45','2025-03-17 17:01:45'),(95,8,2,17,'166',19,'2025-03-17 17:02:10','2025-03-17 17:02:10'),(96,8,2,17,NULL,20,'2025-03-17 17:02:58','2025-03-17 17:02:58'),(97,8,2,17,'185',21,'2025-03-17 17:03:24','2025-03-17 17:03:24'),(98,8,2,17,'195',22,'2025-03-17 17:04:46','2025-03-17 17:04:46'),(99,8,2,17,'204',23,'2025-03-17 17:05:10','2025-03-17 17:05:10'),(100,8,2,17,'214',24,'2025-03-17 17:05:35','2025-03-17 17:05:35'),(101,8,2,17,'224',25,'2025-03-17 17:06:02','2025-03-17 17:06:02'),(102,8,2,17,'234',26,'2025-03-17 17:07:00','2025-03-17 17:07:00'),(103,8,2,17,'243',27,'2025-03-17 17:07:26','2025-03-17 17:07:26'),(104,8,2,17,'252',28,'2025-03-17 17:07:56','2025-03-17 17:07:56'),(105,8,2,17,'261',29,'2025-03-17 17:08:26','2025-03-17 17:08:26'),(106,8,2,17,'270',30,'2025-03-17 17:08:55','2025-03-17 17:08:55'),(107,8,2,17,'279',31,'2025-03-17 17:09:55','2025-03-17 17:09:55'),(108,8,2,17,'289',32,'2025-03-17 17:10:23','2025-03-17 17:10:23'),(109,8,2,17,'296',33,'2025-03-17 17:11:46','2025-03-17 17:11:46'),(110,8,2,17,'304',34,'2025-03-17 17:12:58','2025-03-17 17:12:58'),(111,8,2,17,'310',35,'2025-03-17 17:13:59','2025-03-17 17:13:59'),(112,8,2,17,'319',36,'2025-03-17 17:14:26','2025-03-17 17:14:26'),(113,8,2,17,'326',37,'2025-03-17 17:14:53','2025-03-17 17:14:53'),(114,8,2,17,'331',38,'2025-03-17 17:15:27','2025-03-17 17:15:27'),(115,8,2,17,'338',39,'2025-03-17 17:15:59','2025-03-17 17:15:59'),(116,8,2,17,'343',40,'2025-03-17 17:16:26','2025-03-17 17:16:26'),(117,8,2,17,'350',41,'2025-03-17 17:16:50','2025-03-17 17:16:50'),(118,8,2,17,'354',42,'2025-03-17 17:17:15','2025-03-17 17:17:15'),(119,8,2,17,'359',43,'2025-03-17 17:17:41','2025-03-17 17:17:41'),(120,8,2,17,'364',44,'2025-03-17 17:18:03','2025-03-17 17:18:03'),(121,8,2,17,'366',45,'2025-03-17 17:18:28','2025-03-17 17:18:28'),(122,8,2,17,'373',46,'2025-03-17 17:18:55','2025-03-17 17:18:55'),(123,8,2,17,'375',47,'2025-03-17 17:19:28','2025-03-17 17:19:28'),(124,8,2,17,'378',48,'2025-03-17 17:19:58','2025-03-17 17:19:58'),(125,8,2,17,'381',49,'2025-03-17 17:20:45','2025-03-17 17:20:45'),(126,8,2,17,'383',50,'2025-03-17 17:22:37','2025-03-17 17:22:37'),(127,8,2,17,'386',51,'2025-03-17 17:23:08','2025-03-17 17:23:08'),(128,8,2,17,'387',52,'2025-03-17 17:23:54','2025-03-17 17:23:54'),(129,8,2,17,'388',53,'2025-03-17 17:24:39','2025-03-17 17:24:39'),(130,8,2,17,'391',54,'2025-03-17 17:25:11','2025-03-17 17:25:11'),(131,8,2,17,'390',55,'2025-03-17 17:25:42','2025-03-17 17:25:42'),(132,8,2,17,'390',56,'2025-03-17 17:26:26','2025-03-17 17:26:26'),(133,8,2,7,'12',1,'2025-03-17 17:29:57','2025-03-17 17:29:57'),(134,8,2,7,'28',2,'2025-03-17 17:30:31','2025-03-17 17:30:31'),(135,8,2,7,'48',3,'2025-03-17 17:30:59','2025-03-17 17:30:59'),(136,8,2,7,'73',4,'2025-03-17 17:31:28','2025-03-17 17:31:28'),(137,8,2,7,'101',5,'2025-03-17 17:32:02','2025-03-17 17:32:02'),(138,8,2,7,'132',6,'2025-03-17 17:32:23','2025-03-17 17:32:23'),(139,8,2,7,'166',7,'2025-03-17 17:32:45','2025-03-17 17:32:45'),(140,8,2,7,'204',8,'2025-03-17 17:33:05','2025-03-17 17:33:05'),(141,8,2,7,'247',9,'2025-03-17 17:33:27','2025-03-17 17:33:27'),(142,8,2,7,'295',10,'2025-03-17 17:33:46','2025-03-17 17:33:46'),(143,8,2,7,'346',11,'2025-03-17 17:34:10','2025-03-17 17:34:10'),(144,8,2,7,'404',12,'2025-03-17 17:34:39','2025-03-17 17:34:39'),(145,8,2,7,'467',13,'2025-03-17 17:35:02','2025-03-17 17:35:02'),(146,8,2,7,'535',14,'2025-03-17 17:35:23','2025-03-17 17:35:23'),(147,8,2,7,'609',15,'2025-03-17 17:35:45','2025-03-17 17:35:45'),(148,8,2,7,'688',16,'2025-03-17 17:36:05','2025-03-17 17:36:05'),(149,8,2,7,'773',17,'2025-03-17 17:36:31','2025-03-17 17:36:31'),(150,8,2,7,'864',18,'2025-03-17 17:37:26','2025-03-17 17:37:26'),(151,8,2,7,'962',19,'2025-03-17 17:37:49','2025-03-17 17:37:49'),(152,8,2,7,'1065',20,'2025-03-17 17:38:36','2025-03-17 17:38:36'),(153,8,2,7,'1174',21,'2025-03-17 17:38:58','2025-03-17 17:38:58'),(154,8,2,7,'1289',22,'2025-03-17 17:39:27','2025-03-17 17:39:27'),(155,8,2,7,'1409',23,'2025-03-17 17:39:55','2025-03-17 17:39:55'),(156,8,2,7,'1535',24,'2025-03-17 17:40:19','2025-03-17 17:40:19'),(157,8,2,7,'1667',25,'2025-03-17 17:40:41','2025-03-17 17:40:41'),(158,8,2,7,'1805',26,'2025-03-17 17:41:10','2025-03-17 17:41:10'),(159,8,2,7,'1948',27,'2025-03-17 17:41:49','2025-03-17 17:41:49'),(160,8,2,7,'2096',28,'2025-03-17 17:42:59','2025-03-17 17:42:59'),(161,8,2,7,'2249',29,'2025-03-17 17:43:22','2025-03-17 17:43:22'),(162,8,2,7,'2408',30,'2025-03-17 17:43:46','2025-03-17 17:59:25'),(163,8,2,7,'2572',31,'2025-03-17 17:44:12','2025-03-17 17:44:12'),(164,8,2,7,'2742',32,'2025-03-17 17:44:37','2025-03-17 17:44:37'),(165,8,2,7,'2916',33,'2025-03-17 17:45:01','2025-03-17 17:45:01'),(166,8,2,7,'3095',34,'2025-03-17 17:45:25','2025-03-17 17:45:25'),(167,8,2,7,'3278',35,'2025-03-17 17:45:44','2025-03-17 17:45:44'),(168,8,2,7,'3465',36,'2025-03-17 17:46:09','2025-03-17 17:46:09'),(169,8,2,7,'3657',37,'2025-03-17 17:46:43','2025-03-17 17:46:43'),(170,8,2,7,'3852',38,'2025-03-17 17:47:06','2025-03-17 17:47:06'),(171,8,2,7,'4051',39,'2025-03-17 17:47:45','2025-03-17 17:47:45'),(172,8,2,7,'4252',40,'2025-03-17 17:48:07','2025-03-17 17:48:07'),(173,8,2,7,'4458',41,'2025-03-17 17:48:35','2025-03-17 17:48:35'),(174,8,2,7,'4666',42,'2025-03-17 17:49:03','2025-03-17 17:49:03'),(175,8,2,7,'4878',43,'2025-03-17 17:49:28','2025-03-17 17:49:28'),(176,8,2,7,'5092',44,'2025-03-17 17:49:57','2025-03-17 17:49:57'),(177,8,2,7,'5307',45,'2025-03-17 17:51:12','2025-03-17 17:51:12'),(178,8,2,7,'5526',46,'2025-03-17 17:51:36','2025-03-17 17:51:36'),(179,8,2,7,'5747',47,'2025-03-17 17:52:14','2025-03-17 17:52:14'),(180,8,2,7,'5969',48,'2025-03-17 17:53:13','2025-03-17 17:53:13'),(181,8,2,7,'6194',49,'2025-03-17 17:54:08','2025-03-17 17:54:08'),(182,8,2,7,'6419',50,'2025-03-17 17:54:39','2025-03-17 17:54:39'),(183,8,2,7,'6646',51,'2025-03-17 17:55:13','2025-03-17 17:55:13'),(184,8,2,7,'6874',52,'2025-03-17 17:55:47','2025-03-17 17:55:47'),(185,8,2,7,'7102',53,'2025-03-17 17:56:11','2025-03-17 17:56:11'),(186,8,2,7,'7332',54,'2025-03-17 17:56:34','2025-03-17 17:56:34'),(187,8,2,7,'7561',55,'2025-03-17 17:56:55','2025-03-17 17:56:55'),(188,8,2,7,'7991',56,'2025-03-17 17:57:17','2025-03-17 17:57:17'),(189,8,2,8,'43',0,'2025-03-17 18:02:50','2025-03-17 18:02:50'),(190,8,2,8,'63',1,'2025-03-17 18:03:14','2025-03-17 18:03:14'),(191,8,2,8,'82',2,'2025-03-17 18:03:29','2025-03-17 18:03:29'),(192,8,2,8,'103',3,'2025-03-17 18:03:51','2025-03-17 18:03:51'),(193,8,2,9,'127',4,'2025-03-17 18:04:12','2025-03-17 18:04:12'),(194,8,2,8,'153',5,'2025-03-17 18:04:33','2025-03-17 18:04:33'),(195,8,2,8,'184',6,'2025-03-17 18:04:52','2025-03-17 18:04:52'),(196,8,2,8,'216',7,'2025-03-17 18:05:11','2025-03-17 18:05:11'),(197,8,2,8,'252',8,'2025-03-17 18:05:28','2025-03-17 18:05:28'),(198,8,2,8,'290',9,'2025-03-17 18:05:47','2025-03-17 18:05:47'),(199,8,2,8,'333',10,'2025-03-17 18:06:09','2025-03-17 18:06:09'),(200,8,2,8,'380',11,'2025-03-17 18:06:38','2025-03-17 18:06:38'),(201,8,2,8,'430',12,'2025-03-17 18:06:58','2025-03-17 18:06:58'),(202,8,2,8,'483',13,'2025-03-17 18:07:18','2025-03-17 18:07:18'),(203,8,2,8,'541',14,'2025-03-17 18:07:41','2025-03-17 18:07:41'),(204,8,2,8,'603',15,'2025-03-17 18:08:10','2025-03-17 18:08:10'),(205,8,2,8,'667',16,'2025-03-17 18:08:49','2025-03-17 18:08:49'),(206,8,2,8,'734',17,'2025-03-17 18:09:11','2025-03-17 18:09:11'),(207,8,2,8,'805',18,'2025-03-17 18:09:39','2025-03-17 18:09:39'),(208,8,2,8,'879',19,'2025-03-17 18:10:00','2025-03-17 18:10:00'),(209,8,2,8,'956',20,'2025-03-17 18:35:19','2025-03-17 18:35:19'),(210,8,2,8,'1035',21,'2025-03-17 18:35:49','2025-03-17 18:35:49'),(211,8,2,8,'1117',22,'2025-03-17 18:36:17','2025-03-17 18:36:17'),(212,8,2,8,'1200',23,'2025-03-17 18:36:36','2025-03-17 18:36:36'),(213,8,2,8,'1285',24,'2025-03-17 18:37:01','2025-03-17 18:37:01'),(214,8,2,8,'1373',25,'2025-03-17 18:37:21','2025-03-17 18:37:21'),(215,8,2,8,'1464',26,'2025-03-17 18:37:39','2025-03-17 18:37:39'),(216,8,2,8,'1554',27,'2025-03-17 18:37:57','2025-03-17 18:37:57'),(217,8,2,8,'1647',28,'2025-03-17 18:38:16','2025-03-17 18:38:16'),(218,8,2,8,'1741',29,'2025-03-17 18:38:35','2025-03-17 18:38:35'),(219,8,2,8,'1836',30,'2025-03-17 18:38:56','2025-03-17 18:38:56'),(220,8,2,8,'1933',31,'2025-03-17 18:39:17','2025-03-17 18:39:17'),(221,8,2,8,'2031',32,'2025-03-17 18:39:39','2025-03-17 18:49:30'),(222,8,2,8,'2130',33,'2025-03-17 18:40:08','2025-03-17 18:40:08'),(223,8,2,8,'2229',34,'2025-03-17 18:40:30','2025-03-17 18:40:30'),(224,8,2,8,'2330',35,'2025-03-17 18:40:50','2025-03-17 18:40:50'),(225,8,2,8,'2430',36,'2025-03-17 18:41:10','2025-03-17 18:41:10'),(226,8,2,8,'2529',37,'2025-03-17 18:41:31','2025-03-17 18:41:31'),(227,8,2,8,'2631',38,'2025-03-17 18:41:50','2025-03-17 18:41:50'),(228,8,2,8,'2730',39,'2025-03-17 18:42:11','2025-03-17 18:42:11'),(229,8,2,8,'2830',40,'2025-03-17 18:42:30','2025-03-17 18:42:30'),(230,8,2,8,'2929',41,'2025-03-17 18:42:51','2025-03-17 18:42:51'),(231,8,2,8,'3028',42,'2025-03-17 18:43:10','2025-03-17 18:43:10'),(232,8,2,8,'3126',43,'2025-03-17 18:43:30','2025-03-17 18:43:30'),(233,8,2,8,'3225',44,'2025-03-17 18:43:50','2025-03-17 18:43:50'),(234,8,2,8,'3323',45,'2025-03-17 18:44:06','2025-03-17 18:44:06'),(235,8,2,8,'3419',46,'2025-03-17 18:44:25','2025-03-17 18:44:25'),(236,8,2,8,'3515',47,'2025-03-17 18:44:53','2025-03-17 18:44:53'),(237,8,2,8,'3609',48,'2025-03-17 18:45:21','2025-03-17 18:45:21'),(238,8,2,8,'3704',49,'2025-03-17 18:45:40','2025-03-17 18:45:40'),(239,8,2,8,'3797',50,'2025-03-17 18:45:58','2025-03-17 18:45:58'),(240,8,2,8,'3888',51,'2025-03-17 18:46:39','2025-03-17 18:46:39'),(241,8,2,8,'3977',52,'2025-03-17 18:47:05','2025-03-17 18:47:05'),(242,8,2,8,'4067',53,'2025-03-17 18:47:28','2025-03-17 18:47:28'),(243,8,2,8,'4153',54,'2025-03-17 18:47:50','2025-03-17 18:47:50'),(244,8,2,8,'4239',55,'2025-03-17 18:48:11','2025-03-17 18:48:11'),(245,8,2,8,'4324',56,'2025-03-17 18:48:39','2025-03-17 18:48:39'),(246,8,2,9,'Not Applicable',1,'2025-03-17 18:51:57','2025-03-17 18:51:57'),(247,8,2,9,'Not Applicable',2,'2025-03-17 18:52:25','2025-03-17 18:52:25'),(248,8,2,9,'Not Applicable',3,'2025-03-17 18:52:44','2025-03-17 18:52:44'),(249,8,2,9,'Not Applicable',4,'2025-03-17 18:53:05','2025-03-17 18:53:05'),(250,8,2,9,'Not Applicable',5,'2025-03-17 18:53:23','2025-03-17 18:53:23'),(251,8,2,9,'Not Applicable',6,'2025-03-17 18:53:40','2025-03-17 18:53:40'),(252,8,2,9,'Not Applicable',7,'2025-03-17 18:54:05','2025-03-17 18:54:05'),(253,8,2,9,'Not Applicable',8,'2025-03-17 18:54:23','2025-03-17 18:54:23'),(254,8,2,9,'Not Applicable',9,'2025-03-17 18:54:50','2025-03-17 18:54:50'),(255,8,2,9,'Not Applicable',10,'2025-03-17 18:55:12','2025-03-17 18:55:12'),(256,8,2,9,'Not Applicable',11,'2025-03-17 18:55:43','2025-03-17 18:55:43'),(257,8,2,9,'Not Applicable',12,'2025-03-17 18:56:02','2025-03-17 18:56:02'),(258,8,2,9,'Not Applicable',13,'2025-03-17 18:56:17','2025-03-17 18:56:17'),(259,8,2,9,'Not Applicable',14,'2025-03-17 18:56:32','2025-03-17 18:56:32'),(260,8,2,9,'1.01',15,'2025-03-17 18:56:55','2025-03-17 18:56:55'),(261,8,2,9,'1.03',16,'2025-03-17 18:57:21','2025-03-17 18:57:21'),(262,8,2,10,'1.05',17,'2025-03-17 18:57:45','2025-03-17 18:57:45'),(263,8,2,9,'1.07',18,'2025-03-17 18:58:12','2025-03-17 18:58:12'),(264,8,2,9,' 1.09',19,'2025-03-17 19:07:29','2025-03-17 19:07:29'),(265,8,2,9,'1.11',20,'2025-03-17 19:07:48','2025-03-17 19:07:48'),(266,8,2,9,'1.13',21,'2025-03-17 19:08:08','2025-03-17 19:08:08'),(267,8,2,9,'1.15',22,'2025-03-17 19:08:47','2025-03-17 19:08:47'),(268,8,2,9,'1.17',23,'2025-03-17 19:09:10','2025-03-17 19:09:10'),(269,8,2,9,'1.19',24,'2025-03-17 19:09:29','2025-03-17 19:09:29'),(270,8,2,9,'1.21',25,'2025-03-17 19:09:46','2025-03-17 19:09:46'),(271,8,2,9,'1.23',26,'2025-03-17 19:10:04','2025-03-17 19:10:04'),(272,8,2,9,'1.25',27,'2025-03-17 19:10:26','2025-03-17 19:10:26'),(273,8,2,9,'1.27',28,'2025-03-17 19:10:45','2025-03-17 19:10:45'),(274,8,2,9,'1.29',29,'2025-03-17 19:11:07','2025-03-17 19:11:07'),(275,8,2,9,'1.31',30,'2025-03-17 19:11:30','2025-03-17 19:11:30'),(276,8,2,9,'1.33',31,'2025-03-17 19:11:53','2025-03-17 19:11:53'),(277,8,2,9,'1.37',33,'2025-03-17 19:12:25','2025-03-17 19:12:25'),(278,8,2,9,'1.39',34,'2025-03-17 19:12:47','2025-03-17 19:12:47'),(279,8,2,10,'1.41',35,'2025-03-17 19:13:09','2025-03-17 19:13:09'),(280,8,2,9,'1.43',36,'2025-03-17 19:13:30','2025-03-17 19:13:30'),(281,8,2,9,'1.45',37,'2025-03-17 19:13:47','2025-03-17 19:13:47'),(282,8,2,9,'1.46',38,'2025-03-17 19:14:05','2025-03-17 19:14:05'),(283,8,2,9,'1.48',39,'2025-03-17 19:14:27','2025-03-17 19:14:27'),(284,8,2,9,'1.50',40,'2025-03-17 19:14:53','2025-03-17 19:14:53'),(285,8,2,9,'1.52',41,'2025-03-17 19:15:13','2025-03-17 19:15:13'),(286,8,2,9,'1.54',42,'2025-03-17 19:15:30','2025-03-17 19:15:30'),(287,8,2,9,'1.56',43,'2025-03-17 19:16:03','2025-03-17 19:16:03'),(288,8,2,9,'1.58',44,'2025-03-17 19:16:21','2025-03-17 19:16:21'),(289,8,2,9,'1.60',45,'2025-03-17 19:16:45','2025-03-17 19:16:45'),(290,8,2,9,'1.62',46,'2025-03-17 19:17:07','2025-03-17 19:17:07'),(291,8,2,9,'1.63',47,'2025-03-17 19:17:33','2025-03-17 19:17:33'),(292,8,2,9,'1.65',48,'2025-03-17 19:17:54','2025-03-17 19:17:54'),(293,8,2,9,'1.67',49,'2025-03-17 19:18:17','2025-03-17 19:18:17'),(294,8,2,9,'1.69',50,'2025-03-17 19:18:41','2025-03-17 19:18:41'),(295,8,2,9,'1.71',51,'2025-03-17 19:19:03','2025-03-17 19:19:03'),(296,8,2,9,'1.73',52,'2025-03-17 19:19:26','2025-03-17 19:19:26'),(297,8,2,9,'1.75',53,'2025-03-17 19:19:46','2025-03-17 19:19:46'),(298,8,2,9,'1.77',54,'2025-03-17 19:20:06','2025-03-17 19:20:06'),(299,8,2,9,'1.78',55,'2025-03-17 19:20:36','2025-03-17 19:20:36'),(300,8,2,9,'1.8',56,'2025-03-17 19:20:53','2025-03-17 19:20:53'),(301,8,2,10,'0.2',1,'2025-03-17 19:42:10','2025-03-17 19:42:10'),(302,8,2,10,'0.25',2,'2025-03-17 19:42:27','2025-03-17 19:42:27'),(303,8,2,10,'0.3',3,'2025-03-17 19:42:43','2025-03-17 19:42:43'),(304,8,2,10,'0.35',4,'2025-03-17 19:43:07','2025-03-17 19:43:07'),(305,8,2,10,'0.4',5,'2025-03-17 19:43:29','2025-03-17 19:43:29'),(306,8,2,10,'0.4',6,'2025-03-17 19:43:55','2025-03-17 19:43:55'),(307,8,2,10,'0.4',7,'2025-03-17 19:44:09','2025-03-17 19:44:09');
/*!40000 ALTER TABLE `option_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `option_static_results`
--

DROP TABLE IF EXISTS `option_static_results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `option_static_results` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `option_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `option_static_results`
--

LOCK TABLES `option_static_results` WRITE;
/*!40000 ALTER TABLE `option_static_results` DISABLE KEYS */;
INSERT INTO `option_static_results` VALUES (1,41,'Sonali Vaccine',NULL,'01JP2YEC6FDFBEGJW8WCQ77A5B.pdf','2025-03-09 20:28:26','2025-03-15 13:43:35'),(2,49,'Sonali Vaccine Schedule','Sonali Vaccine Schedule','01JV2Q0QH6BX7WK2GWTH572WXR.png','2025-03-14 01:29:52','2025-05-12 16:59:57');
/*!40000 ALTER TABLE `option_static_results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `options`
--

DROP TABLE IF EXISTS `options`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `options` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `design_type_id` int(10) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `sub_title` varchar(255) DEFAULT NULL,
  `content_type` varchar(255) DEFAULT NULL,
  `link` text DEFAULT NULL,
  `action` varchar(255) DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `isPro` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `options`
--

LOCK TABLES `options` WRITE;
/*!40000 ALTER TABLE `options` DISABLE KEYS */;
INSERT INTO `options` VALUES (3,2,'Company and Chicks','01JNEY0F9J7RHVFWCTQPBSP2HE.png','Company and Chicks',NULL,'L',NULL,NULL,3,1,1,'2025-02-19 17:02:52','2025-05-05 21:12:30'),(6,4,'Banner1','01JNEYD7X86305B8ENSGP0125K.jpg',NULL,NULL,NULL,NULL,NULL,4,1,0,'2025-02-23 16:21:43','2025-03-03 21:25:50'),(8,1,'EP (Efficiency Plus)','01JNER7M1DZZC9NA24DWP0YTCT.png','Enter Bird\'s Age in Days (0-56)',NULL,NULL,NULL,NULL,5,1,0,'2025-03-01 15:32:28','2025-03-17 15:23:18'),(11,4,'Banner2','01JNEYEEXTAEQVY7FFYXM8D64X.jpg',NULL,NULL,NULL,NULL,NULL,11,1,0,'2025-03-02 16:57:11','2025-03-03 21:26:30'),(13,1,'Novogen Brown','01JNETZFYHTBD26NQV70XZFEZX.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,12,1,0,'2025-03-03 18:27:44','2025-03-16 01:53:33'),(14,1,'Ross-308','01JNERAEEK5REV6S26CX1CF5F2.png','Enter Bird\'s Age in Days (0-45)',NULL,NULL,NULL,NULL,13,1,0,'2025-03-03 18:33:06','2025-03-16 01:54:08'),(15,1,'Lohmann Meat','01JNERB104BNZKT5F406GGQER5.png','Enter Bird\'s Age in Days (0-45)',NULL,NULL,NULL,NULL,14,1,0,'2025-03-03 18:33:57','2025-03-16 01:54:31'),(16,1,'IR (Indian River)','01JNERBPBM35WWR9PHSTA9TWP9.png','Enter Bird\'s Age in Days (0-45)',NULL,NULL,NULL,NULL,15,1,0,'2025-03-03 18:34:10','2025-03-16 01:54:50'),(17,1,'Cobb-500','01JNERC7P29762ACHNPTXNZP99.png','Enter Bird\'s Age in Days (0-45)',NULL,NULL,NULL,NULL,16,1,0,'2025-03-03 18:35:00','2025-03-16 01:55:10'),(18,1,'Shaver Brown','01JNEV078M18ZP2YP53MYR65SM.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,17,1,0,'2025-03-03 18:35:25','2025-03-16 01:56:00'),(19,1,'Bovans Brown','01JNEV0S8BY9SH33XV7G99KH7H.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,18,1,0,'2025-03-03 18:35:39','2025-03-16 01:56:21'),(20,1,'Hyline Brown','01JNEV1B8Y0A5FKEAEHPWHK64B.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,19,1,0,'2025-03-03 18:36:00','2025-03-16 01:56:34'),(21,1,'ISA Brown','01JNEV1YZBR5BD6NN5FCZHH5FC.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,20,1,0,'2025-03-03 18:36:34','2025-03-16 01:56:48'),(22,1,'Dekalb White','01JNEXE8HJYYQ06GVJMNRKRTP4.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,21,1,0,'2025-03-03 18:37:04','2025-03-16 01:57:07'),(23,1,'Hyline White','01JNEXEX0HJ5MRNNARQ11B56Q8.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,22,1,0,'2025-03-03 18:37:17','2025-03-16 01:57:23'),(24,1,'Bovans White','01JNEXFHJD20YVBQXBJRGTYDBN.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,23,1,0,'2025-03-03 18:37:33','2025-03-16 01:57:37'),(25,1,'Shaver White','01JNEXGK8MNFJ4CY5Q087BR5G9.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,24,1,0,'2025-03-03 18:37:50','2025-03-16 01:57:55'),(26,1,'Lohmann White LSL','01JNEXH944PG11SBZ3ZFWYT6JX.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,25,1,0,'2025-03-03 18:38:09','2025-03-16 01:58:08'),(27,1,'Quail Birds','01JNEY1EM6GVQ0J14GDEMDWKJ8.png','Enter Bird\'s Age in Weeks (0-80)',NULL,NULL,NULL,NULL,26,1,0,'2025-03-03 18:38:29','2025-03-16 01:58:43'),(28,1,'Sonali (Normal)','01JNEXJM8GW7HQ22EZN97Q35AW.png','Enter Bird\'s Age in Days (0-60)',NULL,NULL,NULL,NULL,27,1,0,'2025-03-03 18:39:00','2025-03-16 01:59:41'),(29,1,'Sonali (Hybrid)','01JNEXK55NXY6DBM53FQ8HFND9.png','Enter Bird\'s Age in Days (0-50)',NULL,NULL,NULL,NULL,28,1,0,'2025-03-03 18:39:26','2025-03-16 02:00:16'),(30,1,'Sonali (Super Hybrid)','01JNEXKREJ916Q8PHQDN2ZEHMP.png','Enter Bird\'s Age in Days (0-45)',NULL,NULL,NULL,NULL,29,1,0,'2025-03-03 18:40:04','2025-03-16 02:00:46'),(31,1,'Colour Birds','01JNEXMBNX1XX7J54BP5HQ5VMH.png','Enter Bird\'s Age in Days (0-45)',NULL,NULL,NULL,NULL,30,1,0,'2025-03-03 18:40:18','2025-03-16 02:01:08'),(32,1,'Brown Cock','01JNEY26PQRDJEW4PTGPRF9D5A.png','Enter Bird\'s Age in Days (0-70)',NULL,NULL,NULL,NULL,31,1,0,'2025-03-03 18:40:32','2025-03-16 02:01:33'),(33,1,'Duck (Meat Type)','01JNEXNFXXD4KA2X6SSQRCT4D4.png',NULL,NULL,NULL,NULL,NULL,32,1,0,'2025-03-03 18:40:53','2025-03-03 21:12:51'),(34,1,'Duck (Egg Type)','01JNEXP26EWCCW8HNVZJHKAM10.png',NULL,NULL,NULL,NULL,NULL,33,1,0,'2025-03-03 18:41:08','2025-03-03 21:13:10'),(35,1,'Duck (Pekin Star-13)','01JNEXQBKCAWWG03TKRRJWB94C.png','Enter Bird\'s Age in Days (0-45)',NULL,NULL,NULL,NULL,34,1,0,'2025-03-03 18:41:38','2025-03-16 02:02:41'),(36,1,'Arbor Acres','01JNER60S2R7CYDR3XNAB1BXJ0.png','Enter Bird\'s Age in Days (0-45)',NULL,NULL,NULL,NULL,35,1,0,'2025-03-03 19:37:01','2025-03-16 02:02:57'),(37,4,'Banner3','01JNEYFWTR8EKM5KM2EJV76T0R.jpg',NULL,NULL,NULL,NULL,NULL,36,1,0,'2025-03-03 21:27:17','2025-03-03 21:27:17'),(38,4,'Banner4','01JNEYGFKK725G2PAABZ7WX8PC.jpg',NULL,NULL,NULL,NULL,NULL,37,1,0,'2025-03-03 21:27:36','2025-03-03 21:27:36'),(39,1,'Hisex Brown','01JNPTB4ZWDPFQNE4A97V2R8SR.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,38,1,0,'2025-03-06 22:43:21','2025-03-16 02:03:32'),(40,1,'Hisex White','01JNPTBW6G4NY31NJ3G6VSGCY6.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,39,1,0,'2025-03-06 22:43:37','2025-03-16 02:03:15'),(41,3,'Broiler Vaccine Schedule','01JP8FK6S7811H7S2KVA4VBH6Z.png','Broiler Vaccination Schedule','Broiler Vaccination Schedule',NULL,NULL,NULL,40,1,0,'2025-03-08 16:05:35','2025-03-16 02:06:11'),(42,2,'Farm Manager','01JNVJNK51ZFZTCDAPY8E6XF3A.png','Keep Tracking of Your Farms',NULL,'M',NULL,NULL,41,1,0,'2025-03-08 17:10:06','2025-03-16 02:04:26'),(44,5,'FCR Calculator','01JNZYMTV19K0B72W5E4E4C1Z7.png','FCR Calculation','Feed Conversion Ratio','_fcr_',NULL,NULL,42,1,0,'2025-03-10 17:57:04','2025-03-10 18:03:37'),(45,5,'Light Calculator','01JNZYR17T1A49T4ENWVQPTDS9.png','Light Calculation','Light Calculator','_light_',NULL,NULL,43,1,0,'2025-03-10 17:58:49','2025-03-16 00:55:37'),(46,5,'Feed Calculator','01JNZYT37MDC5A6QWACNT4QNSX.png','Feed Calculation','Feed Requirements for Birds','_feed_',NULL,NULL,44,1,0,'2025-03-10 17:59:56','2025-03-16 02:07:25'),(47,5,'Bird Capacity','01JNZYVW1YCGNBEQKGF0A9ADKA.png','Bird Capacity Calculation',NULL,'_capacity_',NULL,NULL,45,1,0,'2025-03-10 18:00:54','2025-03-16 02:08:04'),(48,5,'Vaccine Water Calculator','01JP346WHX3H4GKWHRH5GAA2S6.png','Vaccine Water Calculation','Vaccine Water Calculator','_vacwater_',NULL,NULL,46,1,0,'2025-03-11 19:51:17','2025-03-16 02:09:02'),(49,3,'Sonali Vaccine Schedule','01JP8FNCDVQN9SME2AVTKK9GBV.png','Sonali Vaccination Schedule','Sonali Vaccine Schedule',NULL,NULL,NULL,47,1,0,'2025-03-14 01:28:23','2025-03-16 02:09:44'),(50,5,'Fumigation Calculator','01JPD0RVRAS57JCH1Y9KWDBYWH.png','Fumigation Calculation','Fumigation Calculator','_fumc_',NULL,NULL,48,1,0,'2025-03-14 10:36:10','2025-03-16 02:17:16'),(51,5,'Production Cost Calculator','01JPD0SJV0V1QBNHDJ3V00F28G.png','Production Cost Calculator','Production Cost Calculator','_proc_',NULL,NULL,49,1,0,'2025-03-14 10:37:46','2025-03-16 02:18:15'),(52,5,'Feed Mixing Calculator','01JPD0TY5VH89J1TEGYAZY0EH0.png','Feed Mixing Calculator','Feed Mixing Calculator','_fmc_',NULL,NULL,50,1,0,'2025-03-14 11:04:47','2025-03-16 02:18:42'),(53,3,'Layer Vaccine Schedule','01JPC8WJCMCHW1KGJ5MGMWYRRM.png','Layer Vaccination Schedule','Layer Vaccination Schedule',NULL,NULL,NULL,51,1,0,'2025-03-15 12:46:56','2025-03-16 02:19:39'),(54,3,'Colour Bird Vaccine Schedule','01JPC8XJKK79A7ZBV7VDAFJGPB.png','Colour Bird Vaccination Schedule','Colour Bird Vaccination Schedule',NULL,NULL,NULL,52,1,0,'2025-03-15 12:47:29','2025-03-16 02:20:21'),(55,3,'Duck Vaccine Schedule','01JPC8YNCEND5B9KPJEHS0T0BH.png','Duck Vaccination Schedule','Duck Vaccination Schedule',NULL,NULL,NULL,53,1,0,'2025-03-15 12:48:05','2025-03-16 02:21:02'),(56,3,'Quail Vaccine Schedule','01JPDQKKE5YVQXJGCPRBZ5TJX5.png','Quail Vaccination Schedule','Quail Vaccination Schedule',NULL,NULL,NULL,54,1,0,'2025-03-15 12:48:51','2025-03-16 02:23:25'),(57,3,'Brown Cock Vaccine Schedule','01JPC93E8T8CJBX4ZV0A45XJX6.png','Brown Cock Vaccination Schedule',NULL,NULL,NULL,NULL,55,1,0,'2025-03-15 12:50:41','2025-03-16 02:23:50'),(58,3,'Layer Lighting Schedule','01JPCBZ3D2SYBNZXSX067JF41N.png','Layer Lightning Schedule',NULL,NULL,NULL,NULL,56,1,0,'2025-03-15 13:40:45','2025-03-16 02:24:26'),(59,3,'Brooding Temperature','01JPCC0J593FH6MP6C75BEGGFT.png','Brooding Temperature Schedule','Brooding Temperature',NULL,NULL,NULL,57,1,0,'2025-03-15 13:41:33','2025-03-16 02:15:52'),(60,5,'Anthelmintic Calculator','01JPD0QT3ZQEYJ2FAX5Y5HADFD.png','Anthelmintic Calculator','Anthelmintic Calculation','_antc_',NULL,NULL,58,1,0,'2025-03-15 19:16:46','2025-03-16 02:14:24'),(61,5,'Upcoming...','01JPDM1ZK9Y257J6XDEN4VA5M9.png',NULL,NULL,NULL,NULL,NULL,64,1,0,'2025-03-16 01:21:22','2025-03-16 01:45:04'),(62,3,'Coming Soon...','01JPDM2R3P3N5FGEBKFYQ893F6.png',NULL,NULL,NULL,NULL,NULL,65,1,0,'2025-03-16 01:21:47','2025-03-16 01:45:22'),(63,1,'Coming...','01JPDM5VRXXQGNRPTGPX2BNASH.png',NULL,NULL,NULL,NULL,NULL,66,1,0,'2025-03-16 01:23:29','2025-03-16 01:45:39'),(64,1,'Novogen White','01JPDMW2V6WM2GGYJQ6SA5TE12.png','Enter Bird\'s Age in Weeks (0-100)','Novogen White Performance',NULL,NULL,NULL,62,1,0,'2025-03-16 01:35:38','2025-03-16 02:11:55'),(65,1,'Lohmann Brown','01JPDN83P97X6JDB3ABCR0WGEZ.png','Enter Bird\'s Age in Weeks (0-100)',NULL,NULL,NULL,NULL,63,1,0,'2025-03-16 01:42:12','2025-03-16 02:12:45'),(66,3,'Feeder & Drinker Chart','01JPF3038RVPS9WWZ9EJ38D72D.png',NULL,'Age-wise Feeder & Drinker Allotment',NULL,NULL,NULL,67,1,0,'2025-03-16 15:01:44','2025-03-16 15:01:44');
/*!40000 ALTER TABLE `options` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `patches`
--

DROP TABLE IF EXISTS `patches`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `patches` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `design_type_id` int(10) unsigned NOT NULL,
  `code` varchar(255) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `content_type` varchar(255) DEFAULT NULL,
  `order` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `patches_code_unique` (`code`),
  UNIQUE KEY `patches_order_unique` (`order`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `patches`
--

LOCK TABLES `patches` WRITE;
/*!40000 ALTER TABLE `patches` DISABLE KEYS */;
INSERT INTO `patches` VALUES (12,4,'P-0001','Coming Soon...',NULL,1,1,'2025-03-03 18:43:45','2025-03-03 18:43:45'),(13,2,'P-0002','Company & Chicks List',NULL,2,1,'2025-03-03 18:44:34','2025-03-03 18:44:34'),(14,1,'P-0003','Broiler Breed',NULL,3,1,'2025-03-03 18:45:09','2025-03-03 18:48:02'),(15,1,'P-0004','Brown Layer Breed',NULL,4,1,'2025-03-03 18:45:55','2025-03-03 18:45:55'),(16,1,'P-0005','White Layer Breed',NULL,5,1,'2025-03-03 18:46:10','2025-03-03 18:46:10'),(17,1,'P-0006','Sonali, Brown Cock & Quail',NULL,6,1,'2025-03-03 18:46:41','2025-03-14 00:00:56'),(18,1,'P-0007','Duck Breed',NULL,7,1,'2025-03-03 18:46:58','2025-03-14 00:01:13'),(19,5,'P-0008','Important Calculators',NULL,8,1,'2025-03-03 18:47:41','2025-03-03 18:47:41'),(21,3,'P-0010','Vaccination Schedule',NULL,10,1,'2025-03-09 20:30:01','2025-03-16 01:02:05'),(22,3,'P-0011','Layer Lighting & Brooding Temp',NULL,11,1,'2025-03-16 00:57:17','2025-03-16 01:01:46'),(24,3,'P-0012','Other Features',NULL,12,1,'2025-03-16 15:03:50','2025-03-16 15:03:50');
/*!40000 ALTER TABLE `patches` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment_transactions`
--

DROP TABLE IF EXISTS `payment_transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment_transactions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `subscription_id` bigint(20) unsigned NOT NULL,
  `subscriber_id` bigint(20) unsigned DEFAULT NULL,
  `payment_id` varchar(255) NOT NULL,
  `trx_id` varchar(255) DEFAULT NULL,
  `invoice` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `currency` varchar(255) DEFAULT NULL,
  `intent` varchar(255) DEFAULT NULL,
  `payment_time` timestamp NULL DEFAULT NULL,
  `payer_type` varchar(255) DEFAULT NULL,
  `payer_reference` varchar(255) DEFAULT NULL,
  `customer_msisdn` varchar(255) DEFAULT NULL,
  `payer_account` varchar(255) DEFAULT NULL,
  `max_refundable_amount` decimal(10,2) DEFAULT NULL,
  `status_code` varchar(255) DEFAULT NULL,
  `status_message` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `payment_transactions_payment_id_unique` (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment_transactions`
--

LOCK TABLES `payment_transactions` WRITE;
/*!40000 ALTER TABLE `payment_transactions` DISABLE KEYS */;
INSERT INTO `payment_transactions` VALUES (1,1,16,'TR0011ckjmv911746130455724',NULL,'SUB1746130455','Completed',1.00,'BDT','sale','2025-05-02 02:14:15',NULL,NULL,NULL,NULL,NULL,'0000','Successful','2025-05-02 02:14:15','2025-05-02 02:14:15'),(2,1,17,'TR0011vqjEfBC1746458806729',NULL,'SUB1746458806','Initiated',1.00,'BDT','sale','2025-05-05 21:26:46',NULL,NULL,NULL,NULL,NULL,'0000','Successful','2025-05-05 21:26:46','2025-05-05 21:26:46');
/*!40000 ALTER TABLE `payment_transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\User',2,'auth_token','012ce3e638f647433cc286721bba6a795876d445264c997b8cf7935664e685fc','[\"*\"]','2025-02-28 18:31:27',NULL,'2025-02-19 17:07:04','2025-02-28 18:31:27'),(2,'App\\Models\\User',2,'auth_token','be84f3c3c549274e406fc992d7d2ee686624fb6ff1785aac8eb214c42b8212b8','[\"*\"]',NULL,NULL,'2025-02-19 17:07:16','2025-02-19 17:07:16'),(3,'App\\Models\\User',2,'auth_token','1c06c4b9217120e5439c65f4fb3b06dbf0bc585d8c477b9a583e2b33d0058121','[\"*\"]','2025-03-02 15:51:35',NULL,'2025-02-20 04:46:04','2025-03-02 15:51:35'),(4,'App\\Models\\User',3,'auth_token','8623c7ba12c441eebbdefd125013f7522c05d1e174bf4095de17c29db2283f74','[\"*\"]',NULL,NULL,'2025-02-21 13:18:32','2025-02-21 13:18:32'),(5,'App\\Models\\User',3,'auth_token','aa7c038a89d52577955dbb9b85d83a08f9bc0cf8bf76343a42299d02194c6e68','[\"*\"]',NULL,NULL,'2025-02-21 13:19:40','2025-02-21 13:19:40'),(6,'App\\Models\\User',2,'auth_token','fcac8c4da3303c05e4a8b78781e45f5e638f3c2f6ee173cb7db4375aab307999','[\"*\"]',NULL,NULL,'2025-02-21 16:17:40','2025-02-21 16:17:40'),(7,'App\\Models\\User',2,'auth_token','9435255a1198fcdc8d512c8e9734a80502ffb2da40f5a7f62e14481e2d787be5','[\"*\"]',NULL,NULL,'2025-02-22 14:54:23','2025-02-22 14:54:23'),(8,'App\\Models\\User',3,'auth_token','9e0303c309bc3782500f24879c47d43485f815515cffcee8ee8c5bb14174688a','[\"*\"]','2025-02-22 16:52:05',NULL,'2025-02-22 16:26:54','2025-02-22 16:52:05'),(9,'App\\Models\\User',2,'auth_token','55c08de84818f013cc8c6da542a004daa2fe30e8a32114670a893b60e5494ba9','[\"*\"]',NULL,NULL,'2025-02-22 16:36:14','2025-02-22 16:36:14'),(10,'App\\Models\\User',3,'auth_token','6357ddfffbf9d635bf87a618d505cf3963fd6c108a0bb2c4e27b209191f3332a','[\"*\"]','2025-02-23 17:23:05',NULL,'2025-02-23 15:27:24','2025-02-23 17:23:05'),(11,'App\\Models\\User',3,'auth_token','9cd0a0ac33e72540c74af6ef6710c2f9e2210c224e0974b34e0b7289bf156baf','[\"*\"]','2025-02-25 04:42:07',NULL,'2025-02-23 17:27:08','2025-02-25 04:42:07'),(12,'App\\Models\\User',3,'auth_token','e9e6b2127da03ce9322203a7bc530e7c2897e453bf9ec9d9faa0b9ad25405f48','[\"*\"]','2025-02-24 17:00:14',NULL,'2025-02-24 16:57:53','2025-02-24 17:00:14'),(13,'App\\Models\\User',3,'auth_token','687532045e6ab1c81e2a62767b6f3b56f5eec56a74f4c2a30d01522810e9229e','[\"*\"]','2025-02-24 18:10:23',NULL,'2025-02-24 17:02:15','2025-02-24 18:10:23'),(14,'App\\Models\\User',3,'auth_token','af9f2ce7de83035d7d29dfe6d3db0696d9f71f40e8ba7162b5f4a3dda8ef7edd','[\"*\"]',NULL,NULL,'2025-02-24 19:14:57','2025-02-24 19:14:57'),(15,'App\\Models\\User',3,'auth_token','1b1992fb10b835813480d57234a00c884d92ce7e952c619a7db6ba71851f8622','[\"*\"]','2025-02-24 19:46:19',NULL,'2025-02-24 19:22:59','2025-02-24 19:46:19'),(16,'App\\Models\\User',3,'auth_token','d9e43c06bc949798baa0879557a16724213649290fa8b56c7048e5b9c2f1cd08','[\"*\"]','2025-02-25 10:23:31',NULL,'2025-02-25 04:51:12','2025-02-25 10:23:31'),(17,'App\\Models\\User',3,'auth_token','eb2deec285378c7d8e1b7ebceba285de17c065a6bed2e81937553efcd84155da','[\"*\"]','2025-03-02 16:45:24',NULL,'2025-02-25 15:11:37','2025-03-02 16:45:24'),(18,'App\\Models\\User',3,'auth_token','0b57299fd95dbb1347665f111091abbb6e03096a2960f0c8b9691b68a233f0b1','[\"*\"]','2025-02-28 18:45:12',NULL,'2025-02-25 18:04:50','2025-02-28 18:45:12'),(19,'App\\Models\\User',3,'auth_token','6ebbbfa96149f58fd22029218bd543c3cce76c67b647765a67bcfd3c3b8b98da','[\"*\"]','2025-03-05 15:43:50',NULL,'2025-02-28 18:47:25','2025-03-05 15:43:50'),(20,'App\\Models\\User',3,'auth_token','8cc05f3d45985c0b8bf6ba4790e3f8c605c5646313cc3d9add4e6406c5121850','[\"*\"]','2025-03-06 22:45:35',NULL,'2025-03-02 17:09:47','2025-03-06 22:45:35'),(21,'App\\Models\\User',3,'auth_token','ba8eab7c3a5b48632353794e6b4c224c8c69e3a1f96c671dfb858ce092234a51','[\"*\"]','2025-03-04 23:11:24',NULL,'2025-03-04 05:49:31','2025-03-04 23:11:24'),(22,'App\\Models\\User',4,'auth_token','d97b5a970241f140a6fd5afb76dd42ad9f352920d0101f699e8c568730670668','[\"*\"]','2025-03-09 20:39:14',NULL,'2025-03-04 16:51:44','2025-03-09 20:39:14'),(23,'App\\Models\\User',4,'auth_token','f87211f076b85b34cd4f66cd0a860639332c7f9c0575059f91ccd90f47eff622','[\"*\"]',NULL,NULL,'2025-03-04 16:51:54','2025-03-04 16:51:54'),(24,'App\\Models\\User',3,'auth_token','98f071fb100d05e6a67ce802efaea06cccdd359ce3652dd2a6fe26d66db01e32','[\"*\"]','2025-03-05 15:45:14',NULL,'2025-03-05 15:45:14','2025-03-05 15:45:14'),(25,'App\\Models\\User',3,'auth_token','21efc32ec040a2827a82e059d0ec56ab81f5297740d096bf33c8da8b87cf2fdd','[\"*\"]','2025-03-05 16:21:57',NULL,'2025-03-05 15:47:12','2025-03-05 16:21:57'),(26,'App\\Models\\User',3,'auth_token','c0222c9f4a07fde19013334c1e281ce0cd833286720d667f3204dd885885714a','[\"*\"]','2025-03-05 17:08:15',NULL,'2025-03-05 16:22:26','2025-03-05 17:08:15'),(27,'App\\Models\\User',3,'auth_token','955c064d0c5a3d681bf6e31633d7ec949f70d416c51496777e50b9f348b05805','[\"*\"]','2025-03-05 17:18:54',NULL,'2025-03-05 17:09:10','2025-03-05 17:18:54'),(28,'App\\Models\\User',4,'auth_token','e2759dd2c75e58366103717edbea839d663992b1f97fa3ccf5bb7d0c65bad7ca','[\"*\"]',NULL,NULL,'2025-03-06 16:49:14','2025-03-06 16:49:14'),(29,'App\\Models\\User',5,'auth_token','ae4823400947862c4f9f6300abc31b62e24ac680c7167de25cfd0a0b8e31f7d7','[\"*\"]',NULL,NULL,'2025-03-07 19:49:27','2025-03-07 19:49:27'),(30,'App\\Models\\User',6,'auth_token','72fb24c1bfd68aff74627531838b056d36920d2d7372f195537dbe0b2da51364','[\"*\"]',NULL,NULL,'2025-03-07 20:23:51','2025-03-07 20:23:51'),(31,'App\\Models\\User',7,'auth_token','e94c253840f0c19078e5fbcb51a020e10737f3bf7a16449877c8027c9a00f9ed','[\"*\"]',NULL,NULL,'2025-03-07 20:32:38','2025-03-07 20:32:38'),(32,'App\\Models\\User',8,'auth_token','85b53d85dc2e5fbc26993642a4af1db40c7c70d5ab24d472a9879b9255a85ee0','[\"*\"]',NULL,NULL,'2025-03-07 20:38:47','2025-03-07 20:38:47'),(33,'App\\Models\\User',9,'auth_token','55fd2349b9ce83b4aa824f6e5b52f36323c38bec2ed8f7dba6fe564e4366b4c9','[\"*\"]','2025-03-07 21:10:31',NULL,'2025-03-07 21:04:40','2025-03-07 21:10:31'),(35,'App\\Models\\User',9,'auth_token','c0b619c4180adfb0b0bdc413b4609603a30f9fd14dcdf9338df2c0e0b12337fc','[\"*\"]','2025-03-15 15:59:27',NULL,'2025-03-07 21:15:20','2025-03-15 15:59:27'),(36,'App\\Models\\User',9,'auth_token','0e338ac606d2ba4f79c130b29dca9e6f32e3bcdab6c58a376034a37f8ac9ae63','[\"*\"]','2025-03-07 23:13:31',NULL,'2025-03-07 23:08:00','2025-03-07 23:13:31'),(38,'App\\Models\\User',9,'auth_token','3c69811eb860478cbbda2c55344870e49b67b2f479574d75ef6ac6c7ab7ce6b4','[\"*\"]',NULL,NULL,'2025-03-07 23:19:12','2025-03-07 23:19:12'),(39,'App\\Models\\User',9,'auth_token','11e2684e9d59049a3ff94b191056009484d3720b9fea3aaf8732a1f17307ec95','[\"*\"]',NULL,NULL,'2025-03-07 23:26:54','2025-03-07 23:26:54'),(44,'App\\Models\\User',11,'auth_token','fdf28011d12b6ede3745d0873808cbd7f9a5db90409c187957dc7a576063a677','[\"*\"]','2025-03-08 19:30:13',NULL,'2025-03-08 19:13:49','2025-03-08 19:30:13'),(46,'App\\Models\\User',9,'auth_token','004040347a3d56278429135e3e44b9b5ce41c492e27cb24a3d5c035891d1c87f','[\"*\"]','2025-03-09 20:15:26',NULL,'2025-03-08 22:21:37','2025-03-09 20:15:26'),(49,'App\\Models\\User',9,'auth_token','fc2e6904f5ad84cd45a68c8a7b2c4ff7a4d14edc3ed433c07f163baf5d833a9e','[\"*\"]','2025-03-11 22:02:07',NULL,'2025-03-09 20:16:52','2025-03-11 22:02:07'),(50,'App\\Models\\User',9,'auth_token','5b01bdc47c9a289f032718e4e837b4238fe4decc8f8abb199be057ad0d74c140','[\"*\"]','2025-03-12 11:25:03',NULL,'2025-03-10 18:50:45','2025-03-12 11:25:03'),(51,'App\\Models\\User',9,'auth_token','b8049f130064c3443d65035ad51dca56b2469f4faa32c39c0ce4ca6fa26c6005','[\"*\"]','2025-03-11 22:19:17',NULL,'2025-03-11 22:05:15','2025-03-11 22:19:17'),(52,'App\\Models\\User',9,'auth_token','3b51fd5452373b3e2a5e8e66d246b8916cd32970a06b472b9bbb0171e516c802','[\"*\"]',NULL,NULL,'2025-03-11 22:13:14','2025-03-11 22:13:14'),(53,'App\\Models\\User',11,'auth_token','f7d94e8412f447605ea4278a00212c2fa61b3896ff602588258928e551494279','[\"*\"]','2025-03-15 19:23:49',NULL,'2025-03-12 16:27:39','2025-03-15 19:23:49'),(54,'App\\Models\\User',4,'auth_token','dcabb2f8d864d07646393cd4a413f91d9c1c7d36c8ce4229c76219c6fe35680c','[\"*\"]','2025-03-13 21:31:54',NULL,'2025-03-13 21:31:50','2025-03-13 21:31:54'),(55,'App\\Models\\User',4,'auth_token','b016efbd11510c962083a408628e67edc72a276667c9998f4e3f26ecdddf0833','[\"*\"]','2025-03-21 12:00:30',NULL,'2025-03-13 21:32:11','2025-03-21 12:00:30'),(56,'App\\Models\\User',9,'auth_token','a698d77a105d8b3e1aeb2be5c7a27ee508cbcaec94f543ffff8fb7aa0518cadd','[\"*\"]','2025-03-18 01:17:15',NULL,'2025-03-14 02:56:43','2025-03-18 01:17:15'),(58,'App\\Models\\User',11,'auth_token','8370d40665b887e6671e0d15d8af1402306ccf006c6ea56dc598645456938bd1','[\"*\"]','2025-03-24 14:52:27',NULL,'2025-03-15 19:59:20','2025-03-24 14:52:27'),(59,'App\\Models\\User',9,'auth_token','052c868df06540370338ecaf399fcf95acc9e173d6aa93953110c38d1ac3b7c4','[\"*\"]','2025-03-19 20:52:34',NULL,'2025-03-16 10:46:08','2025-03-19 20:52:34'),(60,'App\\Models\\User',13,'auth_token','57d008f66a3b6cea7bdcfedd5efd9976470d70405607e9f818588aad586cf5e7','[\"*\"]','2025-03-19 21:34:14',NULL,'2025-03-19 21:33:29','2025-03-19 21:34:14'),(61,'App\\Models\\User',4,'auth_token','70967f0f428e2aa88151a71137b29fe205bec63a843d96bdb514d6095e5d668d','[\"*\"]','2025-03-19 21:48:46',NULL,'2025-03-19 21:48:02','2025-03-19 21:48:46'),(62,'App\\Models\\User',13,'auth_token','db1495cc0eb0454168774d1208754d356e80925c1673720024e7058d66300da3','[\"*\"]','2025-03-20 01:39:17',NULL,'2025-03-19 21:55:16','2025-03-20 01:39:17'),(63,'App\\Models\\User',13,'auth_token','1518a65ba82699be617271ec78838b9ce1b03a968d18d1b7d89a384b1c2ed345','[\"*\"]',NULL,NULL,'2025-03-20 12:07:52','2025-03-20 12:07:52'),(64,'App\\Models\\User',14,'auth_token','60ec35c18b11e008e52cbe4fc6676145a4dee0dbb92cf0efc5f16806fb1afed8','[\"*\"]','2025-03-20 13:01:18',NULL,'2025-03-20 13:00:25','2025-03-20 13:01:18'),(65,'App\\Models\\User',14,'auth_token','d41b4020f90b03afff483f89c9b7f47387365c3214f4042af0e373b784ea382d','[\"*\"]','2025-03-21 16:46:22',NULL,'2025-03-20 13:05:28','2025-03-21 16:46:22'),(66,'App\\Models\\User',14,'auth_token','03ff90a7226698dcde7e6d07cf1299d69dd377e6dcc2b7ad4ca7ad16ff2a437f','[\"*\"]','2025-03-21 02:24:09',NULL,'2025-03-21 00:43:09','2025-03-21 02:24:09'),(67,'App\\Models\\User',14,'auth_token','2ba9b513be8b3901ca9d067213587207e07e28d218e57cd6f475ba7a963cb7c2','[\"*\"]',NULL,NULL,'2025-03-21 00:49:13','2025-03-21 00:49:13'),(68,'App\\Models\\User',15,'auth_token','580423915e6fcbab8b730712494fb44f9a6bd539c205399ba6c07e526d2277a2','[\"*\"]','2025-03-21 21:18:54',NULL,'2025-03-21 21:14:29','2025-03-21 21:18:54'),(69,'App\\Models\\User',15,'auth_token','f7a6b97d492fe97e2acdce2a88c7c5582ac102ebd0fa4e053fd8f8e22e52d159','[\"*\"]','2025-04-24 22:27:32',NULL,'2025-03-21 21:23:59','2025-04-24 22:27:32'),(70,'App\\Models\\User',16,'auth_token','e58373fd85269494c4d67e71c0c848c1378734ad64f0820a98470120a1307a8c','[\"*\"]','2025-03-23 11:37:24',NULL,'2025-03-23 11:37:17','2025-03-23 11:37:24'),(71,'App\\Models\\User',16,'auth_token','d6eaee1e5cb5a91b2748882ae5408ca0946c78895f211a3d0789abd0a9602cfe','[\"*\"]','2025-03-23 21:11:49',NULL,'2025-03-23 11:38:43','2025-03-23 21:11:49'),(72,'App\\Models\\User',4,'auth_token','7a4b36a16d8fecdfa49aec1bf032a6eeda561224ee1d093a815477d10cdcb9e3','[\"*\"]','2025-03-24 18:45:58',NULL,'2025-03-23 21:49:20','2025-03-24 18:45:58'),(73,'App\\Models\\User',4,'auth_token','b963ac09c5379c1883211d66a3c236b4963728b2258f424c475b0ba172a58f5c','[\"*\"]','2025-03-24 02:41:19',NULL,'2025-03-23 21:50:12','2025-03-24 02:41:19'),(75,'App\\Models\\User',4,'auth_token','74725fc8ab6fff5249fce8b57092166fd09b0d6f3fca931442fba0ee8057cae6','[\"*\"]','2025-03-25 23:39:16',NULL,'2025-03-24 18:17:37','2025-03-25 23:39:16'),(76,'App\\Models\\User',16,'auth_token','d522286815ca141356e4f00ec74d9f3db492e09b8d81a2d6c9b5d45f08cff4ea','[\"*\"]','2025-03-24 23:43:59',NULL,'2025-03-24 18:48:36','2025-03-24 23:43:59'),(78,'App\\Models\\User',16,'auth_token','00fe10cff934f909b55b3d891b542122150c96da59afa66219b2305fb1c63365','[\"*\"]','2025-03-25 23:31:15',NULL,'2025-03-24 23:44:11','2025-03-25 23:31:15'),(81,'App\\Models\\User',16,'auth_token','bed22744199f5687bd4412d2228cc5012a4a95409b71ca676dc5a999fb8dc009','[\"*\"]','2025-03-26 00:38:58',NULL,'2025-03-25 23:42:00','2025-03-26 00:38:58'),(82,'App\\Models\\User',16,'auth_token','81eda63beb736af71816fa767a064cc9548eb9da7cc9d67b1e9f5515d219ff43','[\"*\"]','2025-04-13 21:42:26',NULL,'2025-04-13 21:34:14','2025-04-13 21:42:26'),(83,'App\\Models\\User',16,'auth_token','8bd6c8f4c289c54c337c54301a9054c1358fe51ccbd380132ca3fc30320993c9','[\"*\"]','2025-04-26 20:36:27',NULL,'2025-04-14 12:15:28','2025-04-26 20:36:27'),(84,'App\\Models\\User',16,'auth_token','63c323c6df888c93c4203145e7506ccd82bc43ef4ba29f40d53dddbe2106f2a6','[\"*\"]','2025-04-29 22:47:07',NULL,'2025-04-26 16:38:54','2025-04-29 22:47:07'),(85,'App\\Models\\User',16,'auth_token','73e6bc114076afef82309171b70eb9aa13eeff4061ffdeef7f5b0e31a146a288','[\"*\"]','2025-04-26 23:43:51',NULL,'2025-04-26 22:45:02','2025-04-26 23:43:51'),(86,'App\\Models\\User',16,'auth_token','2aa9a535fcabdacca881700aab997a416efb2437870fabecd22388086016679f','[\"*\"]',NULL,NULL,'2025-04-30 22:01:17','2025-04-30 22:01:17'),(87,'App\\Models\\User',16,'auth_token','1146b7cf751ce07088d4c7ec0db66d77e55434b7a77ccd0d3dcc50a34b399ad2','[\"*\"]',NULL,NULL,'2025-04-30 22:02:07','2025-04-30 22:02:07'),(88,'App\\Models\\User',16,'auth_token','cc63ddfdf02f7223bc5faeb110cea5cd422594a235c4f2b58a8df3ce1702897f','[\"*\"]','2025-05-02 02:14:14',NULL,'2025-05-02 02:11:00','2025-05-02 02:14:14'),(89,'App\\Models\\User',17,'auth_token','d784c6b7af60c985144a4730d81793b319f2eb7c2150ecae5178299d5be9936c','[\"*\"]','2025-05-04 10:49:05',NULL,'2025-05-04 10:48:57','2025-05-04 10:49:05'),(90,'App\\Models\\User',17,'auth_token','64e0706eff386ea7b50932cec0f6af1ecd642fb787425044bb14af412f115489','[\"*\"]','2025-05-04 23:31:36',NULL,'2025-05-04 10:53:42','2025-05-04 23:31:36'),(91,'App\\Models\\User',17,'auth_token','136825885fe99b5da65f7841f8f363526a12b883fac5b1b652a937f3a26336e2','[\"*\"]','2025-05-05 21:26:45',NULL,'2025-05-04 22:39:16','2025-05-05 21:26:45'),(92,'App\\Models\\User',17,'auth_token','ac2b49a43471582bbf2f24c10a7e4d559540ecc2f56ebcf07c284178c9759f0e','[\"*\"]','2025-05-05 22:58:46',NULL,'2025-05-04 22:39:46','2025-05-05 22:58:46'),(93,'App\\Models\\User',17,'auth_token','3c6aadba1aa26f4c85fbf5de263aa396ef02806689f8070d38e46f886d23695a','[\"*\"]','2025-05-05 10:21:02',NULL,'2025-05-05 10:20:44','2025-05-05 10:21:02'),(95,'App\\Models\\User',17,'auth_token','45b271f940ab47cd19378575068673121950a394ba031bd7c14fa8aeb347e4b9','[\"*\"]','2025-05-05 22:38:04',NULL,'2025-05-05 11:53:40','2025-05-05 22:38:04'),(96,'App\\Models\\User',17,'auth_token','39362f13d2dc11d3e615ec0b497215997262286eb4eb845c0be7f0173bc5604e','[\"*\"]','2025-05-06 12:10:00',NULL,'2025-05-05 22:49:50','2025-05-06 12:10:00'),(98,'App\\Models\\User',17,'auth_token','0f71ddf9e339d18c60a5daca665f98730e0dc8e2b725f02774445928c6296a6b','[\"*\"]','2025-05-06 17:56:11',NULL,'2025-05-06 12:36:36','2025-05-06 17:56:11'),(99,'App\\Models\\User',18,'auth_token','71593597a9317c87b23e90fcbf2ebb62553412307e19e7543d96373feb52e3f0','[\"*\"]','2025-05-07 17:51:40',NULL,'2025-05-07 17:50:44','2025-05-07 17:51:40'),(100,'App\\Models\\User',18,'auth_token','954ad88a7354bf7452f9fa7dd8f9816e48a62a29ba7cc65528a4f4bdf72ddb3f','[\"*\"]','2025-05-07 17:53:00',NULL,'2025-05-07 17:51:40','2025-05-07 17:53:00'),(101,'App\\Models\\User',4,'auth_token','95b085d48e5a38d6b3342358275436d860041c8fdece08d6687d8d5cfaddc8cf','[\"*\"]',NULL,NULL,'2025-05-16 04:39:34','2025-05-16 04:39:34'),(102,'App\\Models\\User',4,'auth_token','a0a96460e62db598b33854cd99b263f250865a7dc8951dcd1b41e1c861f6df88','[\"*\"]',NULL,NULL,'2025-05-16 04:41:27','2025-05-16 04:41:27'),(103,'App\\Models\\User',4,'auth_token','afc81566f8f87dff7286aea3e3b372fc610dbd752e163422bcce3bee94510339','[\"*\"]',NULL,NULL,'2025-05-16 04:44:02','2025-05-16 04:44:02');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sell_lines`
--

DROP TABLE IF EXISTS `sell_lines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sell_lines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `sell_id` bigint(20) unsigned NOT NULL,
  `sell_description` varchar(255) DEFAULT NULL,
  `product_type` varchar(255) DEFAULT NULL COMMENT 'chickens|others',
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(15,2) DEFAULT NULL,
  `total_weight` decimal(15,2) DEFAULT NULL,
  `amount` decimal(15,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `sell_lines_sell_id_foreign` (`sell_id`),
  CONSTRAINT `sell_lines_sell_id_foreign` FOREIGN KEY (`sell_id`) REFERENCES `sells` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sell_lines`
--

LOCK TABLES `sell_lines` WRITE;
/*!40000 ALTER TABLE `sell_lines` DISABLE KEYS */;
INSERT INTO `sell_lines` VALUES (1,1,NULL,'1',25,300.00,2500.00,7500.00,'2025-03-19 23:10:21','2025-03-19 23:10:21'),(6,6,NULL,'1',3,120.00,4.50,540.00,'2025-04-14 12:35:32','2025-04-14 12:35:32'),(7,7,NULL,'1',2,112.50,4.20,472.50,'2025-04-14 12:38:41','2025-04-14 12:38:41'),(10,10,'ওষুধ','2',NULL,NULL,NULL,200.00,'2025-04-14 13:31:47','2025-04-14 13:31:47'),(11,11,'দড়ি,সুতা','2',NULL,NULL,NULL,120.00,'2025-04-14 13:33:36','2025-04-14 13:46:51');
/*!40000 ALTER TABLE `sell_lines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sells`
--

DROP TABLE IF EXISTS `sells`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sells` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `company_id` int(10) unsigned DEFAULT NULL,
  `batch_id` int(10) unsigned NOT NULL,
  `invoice_number` varchar(255) DEFAULT NULL,
  `customer_name` varchar(255) DEFAULT NULL,
  `customer_phone` varchar(255) DEFAULT NULL,
  `customer_address` text DEFAULT NULL,
  `sale_date` date NOT NULL,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `discount` decimal(10,2) DEFAULT NULL,
  `paid_amount` decimal(10,2) DEFAULT NULL,
  `payment_status` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sells`
--

LOCK TABLES `sells` WRITE;
/*!40000 ALTER TABLE `sells` DISABLE KEYS */;
INSERT INTO `sells` VALUES (1,NULL,1,NULL,'Saidur Rahman',NULL,NULL,'2025-03-19',NULL,NULL,NULL,NULL,NULL,NULL,'2025-03-19 23:10:21','2025-03-19 23:10:21'),(6,NULL,10,NULL,'fol',NULL,NULL,'2025-04-14',NULL,NULL,NULL,NULL,NULL,NULL,'2025-04-14 12:35:32','2025-04-14 12:35:32'),(7,NULL,12,NULL,'niloy',NULL,NULL,'2025-04-14',NULL,NULL,NULL,NULL,NULL,NULL,'2025-04-14 12:38:41','2025-04-14 12:38:41'),(10,NULL,10,NULL,NULL,NULL,NULL,'2025-04-14',NULL,NULL,NULL,NULL,NULL,NULL,'2025-04-14 13:31:47','2025-04-14 13:31:47'),(11,NULL,12,NULL,NULL,NULL,NULL,'2025-04-14',NULL,NULL,NULL,NULL,NULL,NULL,'2025-04-14 13:33:36','2025-04-14 13:33:36');
/*!40000 ALTER TABLE `sells` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('LPmE7Pp18ozRbZKT3FLQ3FPY19ttHE59moqMRqEi',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoiS3lWb0ltS2hRdldPbTgwdXNTRjdTMnpMVmdydmVBZ2lFRFF4RmtCbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9kYXRhYmFzZS1iYWNrdXAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkM0Z5ZlV0ZnVuRkp5dnFvL24zY1E5LlFSSUdHMWduVEhlSWlqMjNPdWZKL0FWSGNzSklYaDYiO3M6ODoiZmlsYW1lbnQiO2E6MDp7fX0=',1747584294),('UZ9iQadZkNPbKzB2fmMtCdKZf1AGKN5cEoJYTXEH',1,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTo2OntzOjY6Il90b2tlbiI7czo0MDoid05hYXNIVEVEWnU4OXZ6RzJ3SHQyMFRkZ3lqUjlRTjNqUWVKWlAzRyI7czozOiJ1cmwiO2E6MDp7fXM6OToiX3ByZXZpb3VzIjthOjE6e3M6MzoidXJsIjtzOjI3OiJodHRwOi8vMTI3LjAuMC4xOjgwMDAvYWRtaW4iO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTIkM0Z5ZlV0ZnVuRkp5dnFvL24zY1E5LlFSSUdHMWduVEhlSWlqMjNPdWZKL0FWSGNzSklYaDYiO30=',1747393803),('ZQ8kZfmPckFQ5ZFiecPRAToS7mClZePWmxH29tx6',NULL,'127.0.0.1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/136.0.0.0 Safari/537.36','YTo0OntzOjY6Il90b2tlbiI7czo0MDoiRE9FMnlvcDIzN2JOcm5OY0tYc0V3UmF2YkhUMk5rYW1kbmJYdjFiSCI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czoyNzoiaHR0cDovLzEyNy4wLjAuMTo4MDAwL2FkbWluIjt9czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9hZG1pbi9sb2dpbiI7fX0=',1747413259);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscribers`
--

DROP TABLE IF EXISTS `subscribers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscribers` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `subscription_id` bigint(20) unsigned NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `payment_status` enum('paid','partial-paid','unpaid') NOT NULL DEFAULT 'unpaid',
  `is_active` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 - Active, 0 - Expired',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subscribers_user_id_foreign` (`user_id`),
  KEY `subscribers_subscription_id_foreign` (`subscription_id`),
  CONSTRAINT `subscribers_subscription_id_foreign` FOREIGN KEY (`subscription_id`) REFERENCES `subscriptions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `subscribers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscribers`
--

LOCK TABLES `subscribers` WRITE;
/*!40000 ALTER TABLE `subscribers` DISABLE KEYS */;
INSERT INTO `subscribers` VALUES (1,17,1,'2025-05-04 16:02:14','2026-05-04 16:02:14','paid',1,NULL,NULL);
/*!40000 ALTER TABLE `subscribers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriptions` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `plan_name` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `type` enum('monthly','annual','lifetime') NOT NULL,
  `regular_price` decimal(15,2) NOT NULL,
  `offer_price` decimal(15,2) NOT NULL,
  `duration_days` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1 COMMENT '1 - active, 0 - inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (1,'Test','01JP81WJD2AGAABF8C8JZFASAT.jpeg','annual',1.00,1.00,365,1,'2025-03-13 21:27:38','2025-03-13 21:27:38'),(2,'Test','01JTGV6QXR68VK1AK1934T78PN.jpeg','monthly',500.00,50.00,30,1,'2025-05-05 12:09:32','2025-05-06 00:26:49');
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `translations`
--

DROP TABLE IF EXISTS `translations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `translations` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `translatable_type` varchar(255) NOT NULL,
  `translatable_id` bigint(20) unsigned NOT NULL,
  `key` varchar(255) NOT NULL,
  `locale` varchar(10) NOT NULL,
  `value` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `translations`
--

LOCK TABLES `translations` WRITE;
/*!40000 ALTER TABLE `translations` DISABLE KEYS */;
INSERT INTO `translations` VALUES (1,'App\\Models\\ChickType',1,'name','en','Boiler','2025-05-04 22:44:02','2025-05-04 22:44:02'),(2,'App\\Models\\ChickType',1,'name','bn','বয়লার','2025-05-04 22:44:02','2025-05-04 22:44:02'),(3,'App\\Models\\ChickType',2,'name','en','Layer','2025-05-04 22:45:49','2025-05-04 22:45:49'),(4,'App\\Models\\ChickType',2,'name','bn','লেয়ার','2025-05-04 22:45:49','2025-05-04 22:45:49'),(5,'App\\Models\\ChickType',3,'name','en','Colour Bird','2025-05-04 22:46:16','2025-05-04 22:46:16'),(6,'App\\Models\\ChickType',3,'name','bn','রঙিন পাখি','2025-05-04 22:46:16','2025-05-04 22:46:16'),(7,'App\\Models\\ChickType',4,'name','en','Duck','2025-05-04 22:46:42','2025-05-04 22:46:42'),(8,'App\\Models\\ChickType',4,'name','bn','হাঁস','2025-05-04 22:46:42','2025-05-04 22:46:42'),(9,'App\\Models\\Subscription',2,'plan_name','en','Test','2025-05-06 00:23:01','2025-05-06 00:23:01'),(10,'App\\Models\\Subscription',2,'plan_name','bn','Test','2025-05-06 00:23:01','2025-05-06 00:23:01'),(11,'App\\Models\\OptionStaticResult',2,'title','en','Sonali Vaccine Schedule','2025-05-12 16:57:49','2025-05-12 16:57:49'),(12,'App\\Models\\OptionStaticResult',2,'sub_title','en','Sonali Vaccine Schedule','2025-05-12 16:57:49','2025-05-12 16:57:49'),(13,'App\\Models\\OptionStaticResult',2,'title','bn','সোনালী ভ্যাকসিনের সময়সূচী','2025-05-12 16:57:49','2025-05-12 16:57:49'),(14,'App\\Models\\OptionStaticResult',2,'sub_title','bn','সোনালী ভ্যাকসিনের সময়সূচী','2025-05-12 16:57:49','2025-05-12 16:57:49'),(15,'App\\Models\\OptionStaticResult',2,'file','en','01JV2Q0QH6BX7WK2GWTH572WXR.png','2025-05-12 16:59:57','2025-05-12 16:59:57'),(16,'App\\Models\\OptionStaticResult',2,'file','bn','01JV2Q0QHAJDEPA6WDMFDABVSH.jpeg','2025-05-12 16:59:57','2025-05-12 16:59:57');
/*!40000 ALTER TABLE `translations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `country_code` varchar(10) NOT NULL,
  `address` text DEFAULT NULL,
  `isAdmin` tinyint(1) DEFAULT NULL,
  `isPro` tinyint(1) DEFAULT NULL,
  `otp` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `device_name` varchar(255) DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `last_login` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@poultry_master','admin@poultrymasterbd.com','2025-02-19 16:59:15','$2y$12$3FyfUtfunFJyvqo/n3cQ9.QRIGG1gnTHeIij23OufJ/AVHcsJIXh6','admin','+8801673724510','+88',NULL,1,NULL,NULL,1,NULL,NULL,NULL,'mbVLpyIe3F','2025-02-19 16:59:15','2025-02-19 16:59:15'),(4,'Faysal Ibnea Hasan',NULL,NULL,'$2y$12$mHZu8TyYo9KajxUe.FaCke/E8IgsYH2lBT8wNA7ArEDbI7OKbhGSK',NULL,'+8801577055760','880',NULL,1,1,NULL,1,'1','1','2025-05-16 04:44:02',NULL,'2025-03-04 16:51:26','2025-05-16 04:44:02'),(11,'Sajal',NULL,NULL,'$2y$12$nR/NPFKfjbWm7qtj9zQ4PuMzOOg70M9wMLQDp7JejhvzYeYNgUSNu',NULL,'+8801775662647','880',NULL,NULL,NULL,NULL,1,'CPH2605','saidurSecurityKey_CPH2605_23fa3f05eb9dea70_android_578777',NULL,NULL,'2025-03-08 19:13:35','2025-03-08 19:30:12'),(15,NULL,NULL,NULL,'$2y$12$VdRZdiICLSfyQh8rLj54ReMXY1qzrt4eU0iwg.LeHqF.ouWJY7mE6',NULL,'+8801642203796','880',NULL,NULL,NULL,NULL,1,'SM-A525F','saidurSecurityKey_SM-A525F_e7d50816c4e0fe8c_android_574788',NULL,NULL,'2025-03-21 21:13:59','2025-03-21 21:14:35'),(17,'সাঈদুর',NULL,NULL,'$2y$12$5VdpUw/OndB5e02znfCkc.t8Yni8FRXvdOaY93FBAYLRfGBXn8jn.',NULL,'+8801793208341','880',NULL,NULL,NULL,NULL,1,'SM-G977N','saidurSecurityKey_SM-G977N_9bce825817b93b13_android_077789',NULL,NULL,'2025-05-04 10:48:44','2025-05-05 11:56:34'),(18,NULL,NULL,NULL,'$2y$12$ObQgx7oXSiIb2Srds2w/1OabC9HCsMeYMn98Kr674JlfJq5LfoLwC',NULL,'+8801602066370','880',NULL,NULL,NULL,NULL,1,'1','1',NULL,NULL,'2025-05-07 17:40:53','2025-05-07 17:53:00');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `vaccination_schedules`
--

DROP TABLE IF EXISTS `vaccination_schedules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `vaccination_schedules` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `batch_id` int(10) unsigned DEFAULT NULL,
  `disease_id` int(10) unsigned DEFAULT NULL,
  `category_id` int(10) unsigned DEFAULT NULL,
  `vaccine_name` varchar(255) DEFAULT NULL,
  `scheduled_date` date DEFAULT NULL,
  `actual_date` date DEFAULT NULL,
  `dosage` varchar(255) DEFAULT NULL,
  `administration_method` varchar(255) DEFAULT NULL,
  `administered_by` varchar(255) DEFAULT NULL,
  `cost` decimal(8,2) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `vaccination_schedules`
--

LOCK TABLES `vaccination_schedules` WRITE;
/*!40000 ALTER TABLE `vaccination_schedules` DISABLE KEYS */;
/*!40000 ALTER TABLE `vaccination_schedules` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-05-18 22:07:09
