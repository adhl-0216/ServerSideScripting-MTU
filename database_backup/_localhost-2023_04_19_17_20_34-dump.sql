-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: tbd_store
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
-- Table structure for table `inventory`
--

DROP TABLE IF EXISTS `inventory`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `inventory` (
  `PRODUCT_ID` int(11) NOT NULL AUTO_INCREMENT,
  `PRODUCT_TYPE` char(2) NOT NULL,
  `PRODUCT_NAME` varchar(50) NOT NULL,
  `PRODUCT_DESCRIPTION` varchar(200) NOT NULL,
  `UK_SIZE` tinyint(4) DEFAULT NULL,
  `PRICE` decimal(8,2) NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  PRIMARY KEY (`PRODUCT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,'FW','Luka 1','Nike',9,127.00,45),(2,'FW','Luka 2','Adidas',9,120.00,45),(3,'FW','Luka 1','Nike',9,123.00,45),(4,'FW','Luka 4','Nike',9,123.00,45),(5,'FW','Luka 1','Nike',9,123.00,45),(6,'FW','Luka 1','Nike',9,123.00,45),(7,'FW','Luka 1','Nike',9,123.00,45),(8,'FW','Luka 1','Nike',9,123.00,45),(9,'FW','Luka 1','Nike',9,123.00,45),(10,'FW','Luka 1','Nike',9,123.00,45),(11,'FW','Luka 1','Nike',9,123.00,45),(12,'FW','Luka 1','Nike',9,123.00,45),(13,'FW','Luka 1','Nike',9,123.00,45),(14,'JR','Jersey 1','NBA Jersey',10,80.00,50),(15,'JR','Jersey 1','NBA Jersey',10,80.00,50),(16,'JR','Jersey 1','NBA Jersey',10,80.00,50),(17,'JR','Jersey 1','NBA Jersey',10,80.00,50),(18,'JR','Jersey 1','NBA Jersey',10,80.00,50),(19,'JR','Jersey 1','NBA Jersey',10,80.00,50),(20,'AC','Basketball','Wilson Basketball',7,80.00,50),(21,'AC','Basketball','Wilson Basketball',7,80.00,50),(22,'AC','Basketball','Wilson Basketball',7,80.00,50),(23,'AC','Basketball','Wilson Basketball',7,80.00,50),(24,'AC','Basketball','Wilson Basketball',7,80.00,50);
/*!40000 ALTER TABLE `inventory` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales`
--

DROP TABLE IF EXISTS `sales`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales` (
  `SALE_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_NAME` varchar(20) NOT NULL,
  `SALE_DATE` datetime NOT NULL,
  PRIMARY KEY (`SALE_ID`),
  KEY `FK_Buyer` (`USER_NAME`),
  CONSTRAINT `FK_Buyer` FOREIGN KEY (`USER_NAME`) REFERENCES `users` (`USER_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sales_items`
--

DROP TABLE IF EXISTS `sales_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sales_items` (
  `SALE_ID` int(11) NOT NULL,
  `PRODUCT_ID` int(11) NOT NULL,
  `QUANTITY` int(11) NOT NULL,
  `COST` decimal(10,2) NOT NULL,
  PRIMARY KEY (`SALE_ID`),
  KEY `FK_ProductID` (`PRODUCT_ID`),
  CONSTRAINT `FK_ProductID` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `inventory` (`PRODUCT_ID`),
  CONSTRAINT `FK_SaleID` FOREIGN KEY (`SALE_ID`) REFERENCES `sales` (`SALE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_items`
--

LOCK TABLES `sales_items` WRITE;
/*!40000 ALTER TABLE `sales_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `sales_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `USER_NAME` varchar(20) NOT NULL,
  `USER_EMAIL` varchar(319) DEFAULT NULL,
  `USER_PASSWORD` binary(60) NOT NULL,
  `REGISTRATION_DATE` datetime NOT NULL,
  PRIMARY KEY (`USER_NAME`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES ('admin','admin@tbd_store.ie','$2y$10$q0yCRhoRhcLbinIiXDpMe.jTaDENNWyIPR5zckCo1X8gTmdBD3EQ2','2023-04-01 15:03:14'),('admin2','admin2@tbdstore.ie','$2y$10$hRLOsf21zmfp0lFqdR//Ee9e74S1vUUdOWVaulfmesywj.wGLH8Um','2023-04-19 17:17:36');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-04-19 17:20:34
