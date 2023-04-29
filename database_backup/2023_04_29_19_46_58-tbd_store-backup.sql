-- MariaDB dump 10.19  Distrib 10.4.27-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: tbd_store
-- ------------------------------------------------------
-- Server version	10.4.27-MariaDB

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
  `PRODUCT_IMG` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`PRODUCT_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inventory`
--

LOCK TABLES `inventory` WRITE;
/*!40000 ALTER TABLE `inventory` DISABLE KEYS */;
INSERT INTO `inventory` VALUES (1,'FW','Luka 1','Nike',9,127.00,7,'FW01.webp'),(2,'FW','Luka 2','Adidas',9,120.00,41,'FW02.webp'),(3,'FW','Luka 1','Nike',9,123.00,39,'FW03.webp'),(4,'FW','Luka 4','Nike',9,123.00,41,'FW04.webp'),(5,'FW','Luka 1','Nike',9,123.00,45,'FW05.webp'),(6,'FW','Luka 1','Nike',9,123.00,45,'FW06.webp'),(7,'FW','Luka 1','Nike',9,123.00,45,'FW07.webp'),(8,'FW','Luka 1','Nike',9,123.00,45,'FW08.webp'),(9,'FW','Luka 1','Nike',9,123.00,45,'FW09.webp'),(10,'FW','Luka 1','Nike',9,123.00,45,'FW10.webp'),(11,'FW','Luka 1','Nike',9,123.00,45,'FW11.webp'),(12,'FW','Luka 1','Nike',9,123.00,45,'FW12.webp'),(13,'FW','Luka 1','Nike',9,123.00,45,'FW13.webp'),(14,'JR','Jersey 1','NBA Jersey',10,80.00,18,'JR14.webp'),(15,'JR','Jersey 1','NBA Jersey',10,80.00,50,'JR15.webp'),(16,'JR','Jersey 1','NBA Jersey',10,80.00,49,'JR16.webp'),(17,'JR','Jersey 17','NBA Jersey',10,80.00,40,'JR17.webp'),(18,'JR','Jersey 18','NBA Jersey',10,80.00,39,'JR18.webp'),(19,'JR','Jersey 1','NBA Jersey',10,80.00,50,'JR19.webp'),(20,'AC','Basketball','Wilson Basketball',7,60.00,39,'AC20.webp'),(21,'AC','Basketball','Wilson Basketball',7,80.00,48,'AC21.webp'),(22,'AC','Basketball','Wilson Basketball',7,80.00,45,'AC22.webp'),(23,'AC','Basketball','Wilson Basketball',7,80.00,50,'AC23.webp'),(24,'AC','Basketball','Wilson Basketball',7,80.00,50,'AC24.webp'),(28,'AC','Wilson Drive Pro Drip ','Wilson Basketball',7,50.00,99,'nba-wilson-drive-pro-drip-basketball-size-7_ss4_p-12052276+.webp');
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
  `USER_ID` int(11) NOT NULL,
  `SALE_DATE` datetime NOT NULL,
  `TOTAL_SALE` decimal(11,2) DEFAULT NULL,
  PRIMARY KEY (`SALE_ID`),
  KEY `FK_Buyer` (`USER_ID`),
  CONSTRAINT `FK_BUYERS` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales`
--

LOCK TABLES `sales` WRITE;
/*!40000 ALTER TABLE `sales` DISABLE KEYS */;
INSERT INTO `sales` VALUES (72,0,'2023-04-29 18:33:54',210.00);
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
  KEY `FK_ProductID` (`PRODUCT_ID`),
  KEY `FK_SaleID` (`SALE_ID`),
  CONSTRAINT `FK_ProdID` FOREIGN KEY (`PRODUCT_ID`) REFERENCES `inventory` (`PRODUCT_ID`),
  CONSTRAINT `FK_SaleID` FOREIGN KEY (`SALE_ID`) REFERENCES `sales` (`SALE_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sales_items`
--

LOCK TABLES `sales_items` WRITE;
/*!40000 ALTER TABLE `sales_items` DISABLE KEYS */;
INSERT INTO `sales_items` VALUES (72,14,2,160.00),(72,28,1,50.00);
/*!40000 ALTER TABLE `sales_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_info`
--

DROP TABLE IF EXISTS `user_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_info` (
  `USER_ID` int(11) NOT NULL,
  `FIRST_NAME` varchar(50) DEFAULT NULL,
  `LAST_NAME` varchar(50) DEFAULT NULL,
  `ADDRESS` varchar(100) DEFAULT NULL,
  `ZIPCODE` varchar(10) DEFAULT NULL,
  `CITY` varchar(100) DEFAULT NULL,
  `STATE` varchar(100) DEFAULT NULL,
  `COUNTRY` varchar(100) DEFAULT NULL,
  `NAME_ON_CARD` varchar(50) DEFAULT NULL,
  `CARD_NUMBER` varchar(20) DEFAULT NULL,
  `CARD_EXPIRATION_DATE` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`USER_ID`),
  CONSTRAINT `user_info_users_USER_ID_fk` FOREIGN KEY (`USER_ID`) REFERENCES `users` (`USER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_info`
--

LOCK TABLES `user_info` WRITE;
/*!40000 ALTER TABLE `user_info` DISABLE KEYS */;
INSERT INTO `user_info` VALUES (16,'ADHL','ADHL','TTCA','1234','1234','1234','Ireland','ADHL','1234 1234 1234 1235','12/23');
/*!40000 ALTER TABLE `user_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `USER_ID` int(11) NOT NULL AUTO_INCREMENT,
  `USER_EMAIL` varchar(319) DEFAULT NULL,
  `USER_PASSWORD` binary(60) NOT NULL,
  `REGISTRATION_DATE` datetime NOT NULL,
  PRIMARY KEY (`USER_ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (0,'admin@tbdstore.ie','$2y$10$MdCdB2rBDAU4pE0XhRHApOFeQNYH5qadsaobQlF8WFNtVU22/pkQy','2023-04-24 14:37:24'),(15,'adhl@adhl.ie','$2y$10$jpaCTDLz23W.s7pFc0qOrOtHZO0Qs11YT6l5mfC.R1BEOgoLDnPIu','2023-04-27 11:04:18'),(16,'adhl@gmail.ie','$2y$10$vXxJzbWuxikThHMJcHp7eO8rfrJCpAg3/9MEcU4ya5NTA1J2kc/EK','2023-04-29 18:37:50');
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

-- Dump completed on 2023-04-29 19:46:58
