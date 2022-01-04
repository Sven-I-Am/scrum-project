-- MySQL dump 10.13  Distrib 8.0.27, for macos11 (arm64)
--
-- Host: localhost    Database: Scrum
-- ------------------------------------------------------
-- Server version	8.0.27

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
-- Table structure for table `CATEGORY`
--

DROP TABLE IF EXISTS `CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CATEGORY` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATEGORY`
--

LOCK TABLES `CATEGORY` WRITE;
/*!40000 ALTER TABLE `CATEGORY` DISABLE KEYS */;
INSERT INTO `CATEGORY` VALUES (1,'Card'),(2,'Toy'),(3,'Book'),(4,'Plushies'),(5,'Poster'),(6,'Pop Vinyl'),(7,'Badges'),(8,'Figurines'),(9,'Clothing'),(10,'Accessories');
/*!40000 ALTER TABLE `CATEGORY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PRODUCT`
--

DROP TABLE IF EXISTS `PRODUCT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PRODUCT` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `name` varchar(25) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                           `description` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                           `price` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                           `sold` tinyint(1) DEFAULT NULL,
                           `image` varchar(1000) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                           `userid` int DEFAULT NULL,
                           `selldate` date NOT NULL,
                           `categoryid` int DEFAULT NULL,
                           `uid` int DEFAULT NULL,
                           `condition` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                           PRIMARY KEY (`id`),
                           KEY `PRODUCT_FK` (`userid`),
                           KEY `PRODUCT_FK_1` (`categoryid`),
                           KEY `PRODUCT_FK_2` (`uid`),
                           CONSTRAINT `PRODUCT_FK` FOREIGN KEY (`userid`) REFERENCES `USER` (`userid`),
                           CONSTRAINT `PRODUCT_FK_1` FOREIGN KEY (`categoryid`) REFERENCES `CATEGORY` (`id`),
                           CONSTRAINT `PRODUCT_FK_2` FOREIGN KEY (`uid`) REFERENCES `Universe` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PRODUCT`
--

LOCK TABLES `PRODUCT` WRITE;
/*!40000 ALTER TABLE `PRODUCT` DISABLE KEYS */;
INSERT INTO `PRODUCT` VALUES (1,'Charmander card','ability to blaze','50',0,'https://i.ebayimg.com/images/g/f-wAAOSwIFJe5G25/s-l1600.jpg',1,'2021-12-26',1,1,'used'),(2,'Aang avatar state','Aang in avatar state, vinyl figure','90',0,'https://static.lacitedesnuages.be/97151-large_default/avatar-the-last-airbender-pop-animation-aang-all-elements-oversized-vinyl-figure-15cm-n1000.jpg',2,'2021-12-13',6,7,'new'),(3,'Rick&amp;Morty','Rick is a mad scientist who drags his grandson, Morty, on crazy sci-fi adventures.','10',0,'https://i.guim.co.uk/img/media/b563ac5db4b4a4e1197c586bbca3edebca9173cd/0_12_3307_1985/master/3307.jpg?width=465&amp;quality=45&amp;auto=format&amp;fit=max&amp;dpr=2&amp;s=1e7782501ddde0a9803bed9791f4eea1',27,'1984-01-01',1,1,'new');
/*!40000 ALTER TABLE `PRODUCT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Universe`
--

DROP TABLE IF EXISTS `Universe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Universe` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Universe`
--

LOCK TABLES `Universe` WRITE;
/*!40000 ALTER TABLE `Universe` DISABLE KEYS */;
INSERT INTO `Universe` VALUES (1,'Pokemon'),(2,'Marvel'),(3,'DC Universe'),(4,'Harry potter'),(5,'Rick & Morty'),(6,'Adventure Time'),(7,'Avatar TLA');
/*!40000 ALTER TABLE `Universe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `USER`
--

DROP TABLE IF EXISTS `USER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `USER` (
                        `userid` int NOT NULL AUTO_INCREMENT,
                        `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                        `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                        `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
                        `token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
                        `online` tinyint DEFAULT '0',
                        PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `USER`
--

LOCK TABLES `USER` WRITE;
/*!40000 ALTER TABLE `USER` DISABLE KEYS */;
INSERT INTO `USER` VALUES (1,'xedxx','zenixeee@gmail.com','$2y$10$vmt7J5l7CHJbVhAcvC7ZhOrMRpnVQjUAtD55JxAJpnxM51Esb0ZHC', null,0),(2,'xedxx','zenixeee@gmail.com','$2y$10$fq2Ksing3I5SvI6RY8l5oOc.bRphnbaoqydyED3QFwzOJMXRfnq2q',null,0),(3,'zain','zenimtiaz@gmail.com','$2y$10$vDMNJOz2muCtPiZGaLseGOnAJOgP9WpQusn4HPI2iGqN.KOZZ924O', null,0),(4,'test','zenixeee@gmail.com','$2y$10$xe6avbQEjKz1ZabmyWnyDe1yT1q0B1bQx5Fdvf4AmrB4ZBJO4I7EG', null,0),(5,'barabara','barabara@gmail.com','$2y$10$/6tt2fkukOySxfpKjsVBI.y6/F4OcH3wqKjBeI.j1CmEaOeG4U0se', null,0);
/*!40000 ALTER TABLE `USER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'Scrum'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-01-03 11:43:19