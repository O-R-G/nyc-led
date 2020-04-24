-- MySQL dump 10.13  Distrib 5.7.29, for Linux (x86_64)
--
-- Host: localhost    Database: nyc_led
-- ------------------------------------------------------
-- Server version	5.7.29-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `media` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` int(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `object` int(10) unsigned DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `rank` int(10) unsigned DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'jpg',
  `caption` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objects`
--

DROP TABLE IF EXISTS `objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `objects` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` int(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `rank` int(10) unsigned DEFAULT NULL,
  `name1` tinytext,
  `name2` tinytext,
  `address1` text,
  `address2` text,
  `city` tinytext,
  `state` tinytext,
  `zip` tinytext,
  `country` tinytext,
  `phone` tinytext,
  `fax` tinytext,
  `url` tinytext,
  `email` tinytext,
  `begin` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `head` tinytext,
  `deck` mediumblob,
  `body` mediumblob,
  `notes` mediumblob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objects`
--

LOCK TABLES `objects` WRITE;
/*!40000 ALTER TABLE `objects` DISABLE KEYS */;
INSERT INTO `objects` VALUES (1,0,'2020-02-27 17:13:47','2020-02-27 17:22:33',NULL,'text_1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'text-1',NULL,NULL,NULL,NULL,NULL,NULL,_binary 'hihi',NULL),(2,0,'2020-02-27 17:15:14','2020-02-27 17:22:49',NULL,'text_2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'text-2',NULL,NULL,NULL,NULL,NULL,NULL,_binary ' ( ^ − ^ ) ',NULL),(3,0,'2020-02-27 17:23:26','2020-02-27 17:35:27',NULL,'text_1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'text-1',NULL,NULL,NULL,NULL,NULL,NULL,_binary 'Hello',NULL),(4,0,'2020-02-27 17:23:58','2020-02-27 17:35:31',NULL,'text_2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'text-2',NULL,NULL,NULL,NULL,NULL,NULL,_binary '( ^ _ ^ )',NULL),(5,1,'2020-02-27 17:50:14','2020-03-07 09:00:54',NULL,': ) ...$&///////',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'text-1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,1,'2020-02-27 17:53:14','2020-02-27 17:53:14',NULL,'_text2 :))',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'text2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,1,'2020-03-02 16:48:18','2020-03-02 16:48:18',NULL,'一些隨機的文字 測試用',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'%E4%B8%80%E4%BA%9B%E9%9A%A8%E6%A9%9F%E7%9A%84%E6%96%87%E5%AD%97-%E6%B8%AC%E8%A9%A6%E7%94%A8',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,1,'2020-03-02 16:53:10','2020-03-02 16:53:10',NULL,'Demoras por el tráfico Habrá demoras por el tráfico el área de Alexander Hamilton Bridge y Amsterdam Avenue en Manhattan.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demoras-por-el-tr%C3%A1fico-habr%C3%A1-demoras-por-el-tr%C3%A1fico-el-%C3%A1rea-de-alexander-hamilton-bridge-y-amsterdam-avenue-en-manhattan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,1,'2020-03-02 16:55:40','2020-03-02 16:55:40',NULL,'من المقرر إجراء تمرين استعداد للطوارئ بتاريخ March 3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'%D9%85%D9%86-%D8%A7%D9%84%D9%85%D9%82%D8%B1%D8%B1-%D8%A5%D8%AC%D8%B1%D8%A7%D8%A1-%D8%AA%D9%85%D8%B1%D9%8A%D9%86-%D8%A7%D8%B3%D8%AA%D8%B9%D8%AF%D8%A7%D8%AF-%D9%84%D9%84%D8%B7%D9%88%D8%A7%D8%B1%D8%A6-%D8%A8%D8%AA%D8%A7%D8%B1%D9%8A%D8%AE-march-3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,1,'2020-03-07 09:00:12','2020-03-07 09:00:12',NULL,'is a new nonprofit arts organization created to foster an equitable arts ecosystem and combat exclusionary practices past and present.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'is-a-new-nonprofit-arts-organization-created-to-foster-an-equitable-arts-ecosystem-and-combat-exclusionary-practices-past-and-present',NULL,NULL,NULL,NULL,NULL,NULL,_binary 'is a new nonprofit arts organization created to foster an equitable arts ecosystem and combat exclusionary practices past and present.',NULL);
/*!40000 ALTER TABLE `objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wires`
--

DROP TABLE IF EXISTS `wires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wires` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `active` int(1) unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `fromid` int(10) unsigned DEFAULT NULL,
  `toid` int(10) unsigned DEFAULT NULL,
  `weight` float NOT NULL DEFAULT '1',
  `notes` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wires`
--

LOCK TABLES `wires` WRITE;
/*!40000 ALTER TABLE `wires` DISABLE KEYS */;
INSERT INTO `wires` VALUES (1,0,'2020-02-27 17:13:47','2020-02-27 17:22:33',0,1,1,NULL),(2,0,'2020-02-27 17:15:14','2020-02-27 17:22:49',0,2,1,NULL),(3,0,'2020-02-27 17:23:26','2020-02-27 17:35:27',0,3,1,NULL),(4,0,'2020-02-27 17:23:58','2020-02-27 17:35:31',0,4,1,NULL),(5,1,'2020-02-27 17:50:14','2020-02-27 17:50:14',0,5,1,NULL),(6,1,'2020-02-27 17:50:31','2020-02-27 17:50:31',0,6,1,NULL),(7,1,'2020-02-27 17:53:14','2020-02-27 17:53:14',0,7,1,NULL),(8,1,'2020-03-02 16:48:18','2020-03-02 16:48:18',0,8,1,NULL),(9,1,'2020-03-02 16:53:10','2020-03-02 16:53:10',0,9,1,NULL),(10,1,'2020-03-02 16:55:40','2020-03-02 16:55:40',0,10,1,NULL),(11,1,'2020-03-07 09:00:12','2020-03-07 09:00:12',0,11,1,NULL);
/*!40000 ALTER TABLE `wires` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-04-23 12:44:26
