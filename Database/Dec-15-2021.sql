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
  `profilePic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE KEY `email` (`email`) USING BTREE,
  UNIQUE KEY `profilePic` (`profilePic`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `author`
--

LOCK TABLES `author` WRITE;
/*!40000 ALTER TABLE `author` DISABLE KEYS */;
INSERT INTO `author` VALUES (1,'Tadesse ','Alemayehu','mr','Full stack developer ','email24t@gmail.com','123','./files/blogsData/images/profilePicture/profile1.png'),(2,'Tadesse1','Alemayehu','mr','programmer','itsamateriflife@gmail','222','./files/blogsData/images/profilePicture/profile2.png'),(3,'$firstName','$lastName','$title','$experties','$email','$password',NULL),(4,'$firstName','$lastName','$title','$experties','$email2','$password',NULL),(5,'Tadesse ','xcvxcvcx','ccc','ccc','coderootgram2@zooape.net','yyy',NULL),(6,'Tadesse ','xcvxcvcx','dd','ddd','Bname@Branch.com','ddd',NULL),(11,'xxx','yyy','dd','dd','Bbname@Branch.com','ddd','./files/blogsData/images/profilePicture/profile11.png');
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
  `cover` varchar(255) DEFAULT 'files/blogsData/images/blogCover/default.png',
  PRIMARY KEY (`id`) USING BTREE,
  KEY `author` (`author`) USING BTREE,
  CONSTRAINT `blog_ibfk_1` FOREIGN KEY (`author`) REFERENCES `author` (`id`) ON DELETE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `blog`
--

LOCK TABLES `blog` WRITE;
/*!40000 ALTER TABLE `blog` DISABLE KEYS */;
INSERT INTO `blog` VALUES (1,'2021-12-11 15:51:25',1,' yyyyy       ',' yyyyy   ','files/blogsData/images/blogCover/9vojbqcv2i3cajgk0ri0tbtjvv_cover.png'),(2,'2021-12-11 20:29:07',1,' Mastering margin collapsing              ',' Mastering margin collapsing             ','files/blogsData/images/blogCover/1639243731_cover.png'),(3,'2021-12-11 20:31:13',1,' xxxxxx      ',' xxxxxx     ','files/blogsData/images/blogCover/1639243869_cover.png'),(4,'2021-12-14 19:41:15',NULL,' How to Fix Recovered Files that Won’t Open or Corrupted - Stellar ',' How to Fix Recovered files  ','files/blogsData/images/blogCover/default.png');
/*!40000 ALTER TABLE `blog` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8mb4 */ ;
/*!50003 SET character_set_results = utf8mb4 */ ;
/*!50003 SET collation_connection  = utf8mb4_0900_ai_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`network`@`%`*/ /*!50003 TRIGGER `beforeInsertBlog` BEFORE INSERT ON `blog` FOR EACH ROW begin 
if NEW.cover='default' then set NEW.cover="files/blogsData/images/blogCover/default.png";
end if;
end */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

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
  `remark` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Bid` (`Bid`) USING BTREE,
  CONSTRAINT `content_ibfk_1` FOREIGN KEY (`Bid`) REFERENCES `blog` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `content`
--

LOCK TABLES `content` WRITE;
/*!40000 ALTER TABLE `content` DISABLE KEYS */;
INSERT INTO `content` VALUES (1,1,0,1,'this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover \r\n\r\nthis is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover \r\n\r\nthis is blog with cover this is blog with cover this is blog with cover this is blog with cover this is blog with cover ',NULL),(2,1,1,1,'this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 \r\n\r\nthis is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 this is blog with cover photo 2 ',NULL),(3,1,2,1,'this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog \r\n\r\nthis is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog this is summary of the blog ',NULL),(4,1,0.1639226697,3,'files/blogsData/images/blogPart/0.1639226697.png','not set'),(5,1,1.1639227024,2,'select b.id, b.timeOf, b.author, b.title, b.type, b.cover from blog as b; \r\n\r\nselect a.fname, a.lname, a.title, a.experties, a.email, a.profilePic from author as a where a.id=1;\r\n\r\nselect c.orderOf, c.contentType, c.content, c.remark from content as c where c.bid=1;\r\n\r\ntruncate content;\r\ntruncate blog;\r\nselect * from content;\r\nalter table content drop constraint content_ibfk_1;\r\nalter table content add constraint foreign key(bid) references blog(id);','SQL'),(6,1,1.1639227058,0,'summary','not set'),(7,2,0,1,'The top and bottom margins of blocks are sometimes combined (collapsed) into a single margin whose size is the largest of the individual margins (or just one of them, if they are equal), a behavior known as margin collapsing. Note that the margins of floating and absolutely positioned elements never collapse.\r\n\r\nMargin collapsing occurs in three basic cases:',NULL),(8,2,1,1,'he margins of adjacent siblings are collapsed (except when the latter sibling needs to be cleared past floats).',NULL),(9,2,2,1,'If there is no border, padding, inline part, block formatting context created, or clearance to separate the margin-top of a block from the margin-top of one or more of its descendant blocks; or no border, padding, inline content, height, or min-height to separate the margin-bottom of a block from the margin-bottom of one or more of its descendant blocks, then those margins collapse. The collapsed margin ends up outside the parent.',NULL),(10,2,1.1639243548,0,'Adjacent siblings','not set'),(11,2,0.1639243585,0,'Adjacent siblings','not set'),(12,2,1.1639243633,0,'No content separating parent and descendants','not set'),(13,2,2.1639243681,0,'Empty blocks','not set'),(14,3,0,1,'asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af \r\n\r\nasdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af \r\n\r\n\r\nasdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af ',NULL),(15,3,1,1,'asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af \r\n\r\nasdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af \r\n\r\nasdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af asdfds fafds af ',NULL),(16,3,2,1,' 6 files changed, 76 insertions(+), 32 deletions(-)\r\n rewrite files/blogsData/images/profilePicture/profile1.png (96%)\r\n create mode 100644 files/blogsData/images/profilePicture/profile2.png 6 files changed, 76 insertions(+), 32 deletions(-)\r\n rewrite files/blogsData/images/profilePicture/profile1.png (96%)\r\n create mode 100644 files/blogsData/images/profilePicture/profile2.png 6 files changed, 76 insertions(+), 32 deletions(-)\r\n rewrite files/blogsData/images/profilePicture/profile1.png (96%)\r\n create mode 100644 files/blogsData/images/profilePicture/profile2.png 6 files changed, 76 insertions(+), 32 deletions(-)\r\n rewrite files/blogsData/images/profilePicture/profile1.png (96%)\r\n create mode 100644 files/blogsData/images/profilePicture/profile2.png',NULL),(17,3,0.1639243793,3,'files/blogsData/images/blogPart/0.1639243793.png','not set'),(18,3,1.1639243829,2,'} else if (isset($_POST[\'addSubTitle\'])) {\r\n    if ($_POST[\'subTitle\'] == &quot;&quot;) {\r\n        header(&quot;location: ./AddBlog.php&quot;);\r\n    } else {\r\n        $index = (sizeof($_SESSION[\'textArea\']) - 1) + time() / 10000000000;\r\n        updatePreviewOrder($index, &quot;subTitle&quot;, $_POST[\'subTitle\']);\r\n        header(&quot;location: ./AddBlog.php&quot;);\r\n    }\r\n} else if (isset($_POST[\'uploadBlogCover\'])) {\r\n    $img = $_POST[\'blogCover\'];\r\n    $img = str_replace(\'data:image/png;base64,\', \'\', $img);\r\n    $img = str_replace(\' \', \'+\', $img);\r\n    $data = base64_decode($img);\r\n    $newImage = imagecreatefromstring($data);\r\n    if (isset($_SESSION[\'cover\'])) {\r\n        unlink(&quot;./files/blogsData/temp-cover/&quot; . $_SESSION[\'cover\'] . &quot;_cover.png&quot;);\r\n    }\r\n    $_SESSION[\'cover\'] = time();\r\n    $location = &quot;./files/blogsData/temp-cover/&quot; . $_SESSION[\'cover\'] . &quot;_cover.png&quot;;\r\n    createTumnbnail($newImage, $location, 200);\r\n}\r\n','PHP'),(19,3,1.1639243841,0,'summary','not set'),(20,4,0,1,'How to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - Stellar\r\n\r\nHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - Stellar\r\n\r\nHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - Stellar',NULL),(21,4,1,1,'How to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - Stellar\r\n\r\nHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - Stellar\r\n\r\nHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - Stellar',NULL),(22,4,2,1,'How to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - Stellar\r\n\r\nHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - Stellar\r\n\r\nHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - StellarHow to Fix Recovered Files that Won’t Open or Corrupted - Stellar',NULL),(23,4,0.1639499898,0,'how hard it is ?','not set'),(24,4,1.1639499915,0,'picture of how','not set'),(25,4,1.1639499947,3,'files/blogsData/images/blogPart/1.1639499947.png','not set'),(26,4,1.163949996,0,'summary','not set'),(27,4,2.1639499994,0,'a working php code','not set'),(28,4,2.1639500014,2,' &lt;?php\r\n                    foreach ($contents as $data) :\r\n                        if ($data[\'contentType\'] == 0) {\r\n                    ?&gt;\r\n                            &lt;p class=&quot;subTitle&quot;&gt;&lt;?php echo $data[\'content\']; ?&gt;&lt;/p&gt;\r\n                        &lt;?php\r\n                        } else if ($data[\'contentType\'] == 1) {\r\n                            $lines = explode(&quot;\\n&quot;, $data[\'content\']);\r\n                            foreach ($lines as $p) :\r\n                                echo &quot;&lt;p&gt;&quot; . $p . &quot;&lt;/p&gt;&quot;;\r\n                            endforeach;\r\n                        } else if ($data[\'contentType\'] == 2) {\r\n\r\n                        ?&gt;\r\n                            &lt;pre&gt;\r\n                            &lt;code class=&quot;language-&lt;?php echo $data[\'remark\']; ?&gt;&quot;&gt;\r\n                            &lt;?php echo $data[\'content\'] . $BR; ?&gt;\r\n                            &lt;/code&gt;\r\n                            &lt;/pre&gt;\r\n                        &lt;?php\r\n                        } else if ($data[\'contentType\'] == 3) {\r\n                        ?&gt;','PHP'),(29,4,2.1639500023,0,'all the best','not set');
/*!40000 ALTER TABLE `content` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subscriptions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-15 22:45:47
