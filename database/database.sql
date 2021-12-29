--
-- Table structure for table `CATEGORY`
--
DROP TABLE IF EXISTS `CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CATEGORY` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `name` varchar(100) CHARACTER SET UTF8 COLLATE utf8_general_ci DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Table structure for table `UNIVERSE`
--
DROP TABLE IF EXISTS `UNIVERSE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `UNIVERSE` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `type` varchar(100) DEFAULT NULL,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Table structure for table `USER`
--
DROP TABLE IF EXISTS `USER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `USER` (
                        `userid` int NOT NULL AUTO_INCREMENT,
                        `username` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                        `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                        `password` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
                        PRIMARY KEY (`userid`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;
--
-- Table structure for table `PRODUCT`
--
DROP TABLE IF EXISTS `PRODUCT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PRODUCT` (
                           `id` int NOT NULL AUTO_INCREMENT,
                           `name` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                           `condition` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                           `description` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                           `price` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
                           `sold` tinyint(1) DEFAULT NULL,
                           `image` text NOT NULL,
                           `userid` int DEFAULT NULL,
                           `selldate` date NOT NULL,
                           `categoryid` int DEFAULT NULL,
                           `uid` int DEFAULT NULL,
                           PRIMARY KEY (`id`),
                           KEY `PRODUCT_FK` (`userid`),
                           KEY `PRODUCT_FK_1` (`categoryid`),
                           KEY `PRODUCT_FK_2` (`uid`),
                           CONSTRAINT `PRODUCT_FK` FOREIGN KEY (`userid`) REFERENCES `USER` (`userid`),
                           CONSTRAINT `PRODUCT_FK_1` FOREIGN KEY (`categoryid`) REFERENCES `CATEGORY` (`id`),
                           CONSTRAINT `PRODUCT_FK_2` FOREIGN KEY (`uid`) REFERENCES `UNIVERSE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
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
-- Dumping data for table `UNIVERSE`
--
LOCK TABLES `UNIVERSE` WRITE;
/*!40000 ALTER TABLE `UNIVERSE` DISABLE KEYS */;
INSERT INTO `UNIVERSE` VALUES (1,'pokemon'),(2,'marvel'),(3,'DC Universe'),(4,'Harry potter'),(5,'Rick & Morty'),(6,'Adventure Time'),(7,'Avatar the last aribender');
/*!40000 ALTER TABLE `UNIVERSE` ENABLE KEYS */;
UNLOCK TABLES;
--
-- Dumping data for table `USER`
--
LOCK TABLES `USER` WRITE;
/*!40000 ALTER TABLE `USER` DISABLE KEYS */;
INSERT INTO `USER` VALUES (1,'test1','zenixeee@gmail.com','$2y$10$vmt7J5l7CHJbVhAcvC7ZhOrMRpnVQjUAtD55JxAJpnxM51Esb0ZHC'),(2,'test2','zenixeee@gmail.com','$2y$10$fq2Ksing3I5SvI6RY8l5oOc.bRphnbaoqydyED3QFwzOJMXRfnq2q'),(3,'test3','zenimtiaz@gmail.com','$2y$10$vDMNJOz2muCtPiZGaLseGOnAJOgP9WpQusn4HPI2iGqN.KOZZ924O'),(4,'test4','zenixeee@gmail.com','$2y$10$xe6avbQEjKz1ZabmyWnyDe1yT1q0B1bQx5Fdvf4AmrB4ZBJO4I7EG'),(5,'test5','barabara@gmail.com','$2y$10$/6tt2fkukOySxfpKjsVBI.y6/F4OcH3wqKjBeI.j1CmEaOeG4U0se');
/*!40000 ALTER TABLE `USER` ENABLE KEYS */;
UNLOCK TABLES;
--
-- Dumping data for table `PRODUCT`
--
LOCK TABLES `PRODUCT` WRITE;
/*!40000 ALTER TABLE `PRODUCT` DISABLE KEYS */;
INSERT INTO `PRODUCT` VALUES (1,'Charmander card','used','ability to blaze','50',1,'https://i.ebayimg.com/images/g/f-wAAOSwIFJe5G25/s-l1600.jpg',1,'2021-12-26',1,1),(2,'Aang avatar state','new','Aang in avatar state, vinyl figure','90',1,'https://static.lacitedesnuages.be/97151-large_default/avatar-the-last-airbender-pop-animation-aang-all-elements-oversized-vinyl-figure-15cm-n1000.jpg',2,'2021-12-13',7,6);
/*!40000 ALTER TABLE `PRODUCT` ENABLE KEYS */;
UNLOCK TABLES;