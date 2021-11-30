-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: blog
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
-- Table structure for table `author`
--

DROP TABLE IF EXISTS `author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `author` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Fname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Lname` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Title` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `Experties` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  `email` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Password` varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'Tadesse ','Alemayehu','MR','programmer','email24t@gmail.com','123'),(7,'Tadesse ','Alemayehu','mr','aa','email24t1@gmail.com','111'),(26,'Tadesse ','Alemayehu','Mr ','programmer','itsamateriflife@gmail','123'),(30,'Tadesse ','Alemayehu','aa','aa','email24t3@gmail.com','aa'),(49,'Tadesse ','Alemayehu','mr','aaa','Bname@Branch.com','111'),(51,'Tadesse ','Alemayehu','ww','ww','Bname2@Branch.com','111'),(54,'Tadesse ','Alemayehu','ss','ss','email24td1@gmail.com','ss'),(57,'Tadesse ','Alemayehu','ss','ss','alemayehust1@yahoo.com','ss'),(60,'Tadesse ','Alemayehu','aa','aa','coderootgram2@zooape.net','aa'),(63,'Tadesse ','Alemayehu','xx','xx','email24xt@gmail.com','xx'),(68,'Tadesse ','Alemayehu','cc','cc','email24ct1@gmail.com','cc'),(71,'Tadesse ','Alemayehu','bb','bb','emaibl24t@gmail.com','bb'),(73,'Tadesse ','Alemayehu','aaa','aaa','1email24t@gmail.com','aaa'),(104,'Tadesse ','Alemayehu','mm','mm','alemayehut1@yahoo.comm','mm'),(105,'Tadesse ','Alemayehu','aa','aa','alemayehuct1@yahoo.com','aa'),(106,'aa','bb','','','Bxname@Branch.com','aaa');
/*!40000 ALTER TABLE `author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `blog`
--

DROP TABLE IF EXISTS `blog`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `blog` (
  `id` int NOT NULL AUTO_INCREMENT,
  `timeof` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `author` int DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `author` (`author`) USING BTREE,
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`author`) REFERENCES `author` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (1,'2021-11-30 14:26:53',1,'this is the blog title','computer Science'),(2,'2021-11-30 14:27:00',1,'this is the blog title','computer Science'),(3,'2021-11-30 14:28:47',1,'this is the blog title','computer Science'),(4,'2021-11-30 14:29:14',1,'this is the blog title','computer Science'),(5,'2021-11-30 14:29:17',1,'this is the blog title','computer Science'),(6,'2021-11-30 14:29:21',1,'this is the blog title','computer Science'),(7,'2021-11-30 14:29:23',1,'this is the blog title','computer Science');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `content`
--

DROP TABLE IF EXISTS `content`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `content` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Bid` int DEFAULT NULL,
  `orderOf` double NOT NULL,
  `contentType` int DEFAULT NULL,
  `content` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  PRIMARY KEY (`id`),
  KEY `Bid` (`Bid`) USING BTREE,
  CONSTRAINT `content_ibfk_1` FOREIGN KEY (`Bid`) REFERENCES `blog` (`id`),
  CONSTRAINT `content_ibfk_2` FOREIGN KEY (`Bid`) REFERENCES `blog` (`id`),
  CONSTRAINT `content_ibfk_3` FOREIGN KEY (`Bid`) REFERENCES `blog` (`id`),
  CONSTRAINT `content_ibfk_4` FOREIGN KEY (`Bid`) REFERENCES `blog` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,1,-0.8361730166,1,'When we insert a new record into the \'Persons\' table, we do NOT have to specify a value for the \'Personid\' column (a unique value will be added automatically):\r\nWhen we insert a new record into the \'Persons\' table, we do NOT have to \r\nspecify a value for the \'Personid\' column (a unique value will be added automatically):When we insert a new record into the \'Persons\' table, we do NOT have to specify a value for the \'Personid\' column (a unique value will be added automatically):');
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-11-30 15:20:29
