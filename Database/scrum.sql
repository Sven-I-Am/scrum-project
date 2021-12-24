CREATE TABLE `CATEGORY` (
  `categoryid` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4,
  `id` int NOT NULL,
  PRIMARY KEY (`categoryid`),
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4_0900_ai_ci;


CREATE TABLE `PRODUCT` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `description` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `price` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `sold` tinyint(1) DEFAULT NULL,
  `image` blob,
  `userid` int DEFAULT NULL,
  `selldate` date NOT NULL,
  PRIMARY KEY (`id`),
  ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;

CREATE TABLE `USER` (
  `userid` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `password` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ;
