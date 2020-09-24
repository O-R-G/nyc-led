-- MySQL dump 10.13  Distrib 8.0.21, for Linux (x86_64)
--
-- Host: localhost    Database: n_y_c
-- ------------------------------------------------------
-- Server version	8.0.21-0ubuntu0.20.04.4

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
-- Table structure for table `media`
--

DROP TABLE IF EXISTS `media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `media` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `active` int unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `object` int unsigned DEFAULT NULL,
  `weight` float DEFAULT NULL,
  `rank` int unsigned DEFAULT NULL,
  `type` varchar(10) NOT NULL DEFAULT 'jpg',
  `caption` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `media`
--

LOCK TABLES `media` WRITE;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` VALUES (1,0,'2020-06-04 15:15:48','2020-06-04 15:15:48',16,NULL,NULL,'png',''),(2,0,'2020-06-04 15:15:48','2020-06-04 15:15:48',16,NULL,NULL,'png',''),(3,0,'2020-06-04 15:15:48','2020-06-04 15:15:48',16,NULL,NULL,'png',''),(4,1,'2020-06-04 15:16:20','2020-06-04 15:16:56',16,NULL,1,'png',''),(5,1,'2020-06-04 15:16:20','2020-06-04 15:16:56',16,NULL,1,'png',''),(6,1,'2020-06-04 15:16:20','2020-06-04 15:16:56',16,NULL,1,'png',''),(7,1,'2020-06-08 11:58:17','2020-06-08 12:12:58',16,NULL,1,'png',''),(8,1,'2020-06-08 11:58:17','2020-06-08 12:12:58',16,NULL,1,'png',''),(9,1,'2020-06-08 11:58:51','2020-06-08 11:59:18',18,NULL,1,'mov',''),(10,1,'2020-06-08 11:58:51','2020-06-08 11:59:18',18,NULL,1,'jpeg',''),(11,1,'2020-06-08 11:58:51','2020-06-08 11:59:18',18,NULL,1,'png',''),(12,1,'2020-06-08 12:18:02','2020-06-08 12:18:18',16,NULL,1,'png',''),(13,0,'2020-06-08 12:21:05','2020-06-08 12:22:29',12,NULL,1,'png',''),(14,0,'2020-06-08 12:22:29','2020-06-08 12:24:42',12,NULL,1,'png',''),(15,0,'2020-06-08 12:22:29','2020-06-08 12:24:42',12,NULL,1,'png',''),(16,1,'2020-06-08 12:24:42','2020-06-08 12:24:59',12,NULL,1,'jpeg',''),(17,1,'2020-06-08 12:24:42','2020-06-08 12:24:59',12,NULL,1,'jpeg','');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `objects`
--

DROP TABLE IF EXISTS `objects`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `objects` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `active` int unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `rank` int unsigned DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=33 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `objects`
--

LOCK TABLES `objects` WRITE;
/*!40000 ALTER TABLE `objects` DISABLE KEYS */;
INSERT INTO `objects` VALUES (1,0,'2020-02-27 17:13:47','2020-02-27 17:22:33',NULL,'text_1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'text-1',NULL,NULL,NULL,NULL,NULL,NULL,_binary 'hihi',NULL),(2,0,'2020-02-27 17:15:14','2020-02-27 17:22:49',NULL,'text_2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'text-2',NULL,NULL,NULL,NULL,NULL,NULL,_binary ' ( ^ − ^ ) ',NULL),(3,0,'2020-02-27 17:23:26','2020-02-27 17:35:27',NULL,'text_1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'text-1',NULL,NULL,NULL,NULL,NULL,NULL,_binary 'Hello',NULL),(4,0,'2020-02-27 17:23:58','2020-02-27 17:35:31',NULL,'text_2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'text-2',NULL,NULL,NULL,NULL,NULL,NULL,_binary '( ^ _ ^ )',NULL),(5,0,'2020-02-27 17:50:14','2020-04-23 17:50:47',NULL,'Text_1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'text-1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(7,0,'2020-02-27 17:53:14','2020-04-23 17:50:51',NULL,'_text2 :))',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'text2',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(8,0,'2020-03-02 16:48:18','2020-04-23 17:51:00',NULL,'一些隨機的文字 測試用',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'%E4%B8%80%E4%BA%9B%E9%9A%A8%E6%A9%9F%E7%9A%84%E6%96%87%E5%AD%97-%E6%B8%AC%E8%A9%A6%E7%94%A8',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(9,0,'2020-03-02 16:53:10','2020-04-23 17:50:42',NULL,'Demoras por el tráfico Habrá demoras por el tráfico el área de Alexander Hamilton Bridge y Amsterdam Avenue en Manhattan.',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'demoras-por-el-tr%C3%A1fico-habr%C3%A1-demoras-por-el-tr%C3%A1fico-el-%C3%A1rea-de-alexander-hamilton-bridge-y-amsterdam-avenue-en-manhattan',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(10,0,'2020-03-02 16:55:40','2020-04-23 17:50:56',NULL,'من المقرر إجراء تمرين استعداد للطوارئ بتاريخ March 3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'%D9%85%D9%86-%D8%A7%D9%84%D9%85%D9%82%D8%B1%D8%B1-%D8%A5%D8%AC%D8%B1%D8%A7%D8%A1-%D8%AA%D9%85%D8%B1%D9%8A%D9%86-%D8%A7%D8%B3%D8%AA%D8%B9%D8%AF%D8%A7%D8%AF-%D9%84%D9%84%D8%B7%D9%88%D8%A7%D8%B1%D8%A6-%D8%A8%D8%AA%D8%A7%D8%B1%D9%8A%D8%AE-march-3',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(11,1,'2020-04-23 17:51:07','2020-04-24 21:17:58',1,'_home',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'home',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(12,1,'2020-04-23 17:51:26','2020-08-04 15:35:26',20,'.Research',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'research',NULL,NULL,NULL,NULL,NULL,_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								',_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								<div><b>Research Fellowships</b></div><div>&nbsp;</div><div>We will fund artistic research. For too long the parameters of art have been too narrowly defined. While we are heartened by recent movements to expand these, it is not enough. We will directly provide funding for scholars, writers, curators, and artists to expand the borders of art and to hear from artists that have already stretched them and who could benefit from exposure to a broad public. Too often, writers cobble together a livelihood via an unsustainable gig economy where time for deep, focused research is hard to come by.&nbsp;</div><div><br></div><div>As Humanities departments in Universities shrink and tenure lines evaporate, there are increasingly less opportunities for meaningful scholarship. Our fellowship program interrupts this trend and allows thinkers to gather, research and present recuperative and forward-thinking scholarship to the public.</div><div><br></div><div><img src=\"/media/00017.jpeg\">&nbsp;<img src=\"/media/00016.jpeg\"><br></div><div><br></div><div><div><b>Transformative Publications</b></div><div><br></div><div>We seek out artists whose modest exposure belies their critical importance to the field and ask them what kind of book would move the needle for them.</div></div><div><br></div><div><div><b>Scholarly Exhibitions</b></div><div><div><br></div><div>We will stage exhibitions. Open to the public for extended runs, these exhibitions will distribute the artistic thinking we think is vital. through publications, exhibitions, uncredentialed access to our library and public programs.</div></div></div>',_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								'),(13,1,'2020-04-23 17:51:38','2020-08-04 15:35:55',100,'.Care',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'care',NULL,NULL,NULL,NULL,NULL,_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								',_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								<div>New York Consolidated *will* be located at</div><div><br></div><div><a href=\"https://maps.apple.com/?ll=40.738579,-74.001262&amp;_ext=EiYpKlX9lvZdREAxMn8ly3WAUsA5qCoj8xxfREBBnN/ri7N/UsBQAw%3D%3D&amp;t=k\">225 West 13th Street</a></div><div>New York, NY 10011</div><div>212 989 1200</div><div><br></div><div>Meanwhile, please find us at our temporary office</div><div><br></div><div><div>New York Consolidated&nbsp;</div><div>408 West 14th Street<br></div><div>4th floor</div><div>NY, NY 10014</div></div><div><br></div><div>Or be in touch via email</div><div><br></div><div><a href=\"mailto://info@n-y-c.org\">info@n-y-c.org</a></div><div><br></div><div>And sign up for our mailing list</div><div><br></div><div><a href=\"mailto://subscribe@n-y-c.org\">subscribe@n-y-c.org</a></div>\r\n																								',_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								'),(14,1,'2020-04-23 17:51:48','2020-06-16 15:46:28',10,'About',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'about',NULL,NULL,NULL,NULL,NULL,_binary '\r\n',_binary '\r\n																								\r\n																								<div><b>New York Consolidated is a new nonprofit arts organization created to foster a more equitable and sustainable arts ecosystem.&nbsp;</b><br></div><div><br></div><div>Opening late 2021 in&nbsp;downtown New York, we aim to hold space in the city’s center for artists and ideas to thrive and we will provide a safe place for artists and their ideas to evolve. New York City is constantly contested and always shifting. We will celebrate the unsung, the unfinished, and the under recognized; N-Y-C can provide a bulwark against the forces that make artistic life in the city increasingly untenable while remaining small and nimble enough to evolve and respond to and with its community.<br></div><div><div><br></div>We will fund&nbsp;<a href=\"http://n-y-c.local/research\">research</a>, stage <a href=\"/research\">exhibitions</a>, publish <a href=\"/research\">books</a>, provide <a href=\"/space\">a public space</a> for study and conversation, and <a href=\"/advocate\">advocate</a> for the diverse artists and platforms that are integral to the health and vibrancy of our society.&nbsp;</div><div><br></div><div>Our philosophy is based on the principle that art\'s value to society is best reflected through a diversity of stories and participants, and our mission is to nourish, sustain and present the breadth of artists and practices. We can seee a future where art’s value is determined by its cultural and social impact and where all artists benefit from resources and visibility.</div><div><br></div><div><div><b>Collaboration &amp;&nbsp;Infrastructure</b></div><div><br></div><div>Our work emerges against the backdrop of widespread societal reckoning with exclusionary practices past and present. We believe that creating an equitable future requires reflecting on our internal structures and modeling the change we would like to see through our own organizational processes. We prioritize collaborative and collective practices above singular, hierarchical approaches and see our peer organizations as allies not competitors. We apply this ethos of collaboration in our core programs and seek out opportunities to co-publish and co-produce with a wide range of collaborators to amplify voices and maximize impact.&nbsp;</div></div><div><br></div><div><div><b>Transparency / Accountability</b></div><div><br></div><div>We believe that an equitable future is built on transparency and accountability and that both concepts are currently being interrogated and challenged as they impact the workplace. We will commit to being at the vanguard of workplace practices.&nbsp;</div></div><div><br></div><div><div><b>Sustainability</b></div><div><br></div><div>As an organization founded at the height of the climate crisis, we have an obligation to our planet and our peers to work sustainably. We are collaborating with a new climate organization Art to Zero as their first pilot organization. We will work with them to assess and reduce our carbon footprint and produce a roadmap for other arts organizations to work sustainably.</div></div>',_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								<div><div><b>Infrastructure &amp; Collaboration</b></div><div><br></div><div>Our work emerges against the backdrop of widespread societal reckoning with exclusionary practices past and present. We believe that creating an equitable future requires reflecting on our internal structures and modeling the change we would like to see through our own organizational processes. We prioritize collaborative and collective practices above singular, hierarchical approaches and see our peer organizations as allies not competitors. We apply this ethos of collaboration in our core programs and seek out opportunities to co-publish and co-produce with a wide range of collaborators to amplify voices and maximize impact.&nbsp;</div><div><br></div><div><b>Transparency / Accountability</b></div><div><br></div><div>We believe that an equitable future is built on transparency and accountability and that both concepts are currently being interrogated and challenged as they impact the workplace. We will commit to being at the vanguard of workplace practices.&nbsp;</div><div><br></div><div>We believe that an equitable future is built on transparency and accountability - explain what we do to this end. Potential Ideas: Fully lateral workforce (everyone paid the same??); Proactive Unionization? - Founding Partnership with Local 2110? Transparency Workgroup collaboration? Wage (obv). Sector wide best practices? Vetting process for Board Members? Research is shared - How? Everything is archived and accessible- What is radical transparency and radical accessibility? **Anne: mentioned document museums are circulating to attempt to be proactive about this?</div><div><br></div><div><b>Sustainability</b></div><div><br></div><div>As an organization founded at the height of the climate crisis, we have an obligation to our planet and our peers to work sustainably. We are collaborating with a new climate organization Art to Zero as their first pilot organization. We will work with them to assess and reduce our carbon footprint and produce a roadmap for other arts organizations to work sustainably.</div><div><b><br></b></div><div><b><br></b></div><div><b><br></b></div><div><b><br></b></div><div><b>I. Research fellowships</b></div><div>&nbsp;</div><div>We will fund artistic research. For too long the parameters of art have been too narrowly defined. While we are heartened by recent movements to expand these, it is not enough. We will directly provide funding for scholars, writers, curators, and artists to expand the borders of art and to hear from artists that have already stretched them and who could benefit from exposure to a broad public. Too often, writers cobble together a livelihood via an unsustainable gig economy where time for deep, focused research is hard to come by.&nbsp;</div><div><br></div><div>As Humanities departments in Universities shrink and tenure lines evaporate, there are increasingly less opportunities for meaningful scholarship. Our fellowship program interrupts this trend and allows thinkers to gather, research and present recuperative and forward-thinking scholarship to the public.</div><div><br></div><div><b>II. Scholarly exhibitions</b></div><div><br></div><div>We will stage exhibitions. Open to the public for extended runs, these exhibitions will distribute the artistic thinking we think is vital. through publications, exhibitions, uncredentialed access to our library and public programs.</div><div><br></div><div><b>III. Transformative publications<br></b></div><div><br></div><div>We seek out artists whose modest exposure belies their critical importance to the field and ask them what kind of book would move the needle for them.</div><div><br></div><div><b>IV. Holistic support</b><br></div><div><br></div><div>In addition to providing critical research, exhibitions and publications for artists, we train a holistic lens on their practices and intervene to help them craft a long term strategy to amplify the impact of their work. This work is iterative and highly collaborative, drawing on the incredible work of peer organizations to leverage collective wisdom and resources to advance art and culture. Areas of focus include but are not limited to legacy and stewardship, production support, conservation, and beyond.</div><div><br></div><div><b>V. Ecosystem advocacy</b></div></div><div><br></div><div><div>We will address aspects of collegiality and mutual support whereby our community can operate with the best interest of our ecosystem in mind. We will establish industry standards/best practices such as WAGE certification.</div><div><br></div><div>We will set up a mentorship program between senior and junior art dealers. Through our collaborative work with Artists Acquisition Club, we help the community have a voice in what is represented in our museums. And with the N-Y-C Giving Circle - *new idea* piggybacking on the concept of AAC, we can form a donors group that can purchase works to be donated to museums? On artists we research?</div></div>'),(15,0,'2020-04-23 17:52:01','2020-06-04 15:50:07',40,'Books',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'books',NULL,NULL,NULL,NULL,NULL,_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								',_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								<div><div><b>III. Transformative Publications</b></div><div><br></div><div>We seek out artists whose modest exposure belies their critical importance to the field and ask them what kind of book would move the needle for them.</div></div>',_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								<br>'),(16,1,'2020-04-23 17:52:15','2020-08-04 15:35:37',60,'.Access',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'space',NULL,NULL,NULL,NULL,NULL,_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								',_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								<div><div><b>Space&nbsp;</b></div><div><br></div><div>We will open to the public in late 2021 in a three-story former warehouse in the west village. 225 West 13th street is an historic, 8,000-square foot building erected in 1909 as the warehouse for the New York Consolidated Card Company. Our once-industrial building has been a hub for artists and creative practices spanning the visual arts, film, and music since the 1970s.&nbsp;</div><div><br></div><div><img src=\"/media/00004.png\">&nbsp;<img src=\"/media/00012.png\"><br></div><div><br></div><div>N-Y-C evolves this legacy by making this formerly private space public, acknowledging art’s essential contribution to the vitality of our city, and the urgent need to hold space in the city’s center for the heterogeneous practices that define its culture.&nbsp;</div></div><div><br></div><div>Demolition is currently proceeding at 225 West 13th Street with Phase 1 reopening in New York City. We will post site pictures to Instagram @n_y_c on a regular basis.&nbsp;</div><div><br></div><div><img src=\"/media/00008.png\">&nbsp;<img src=\"/media/00007.png\"><br></div>\r\n																								',_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								'),(17,0,'2020-04-23 17:52:29','2020-06-04 15:50:11',50,'Exhibitions',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'exhibitions',NULL,NULL,NULL,NULL,NULL,_binary '\r\n																								\r\n																								\r\n																								\r\n																								',_binary '\r\n																								\r\n																								\r\n																								\r\n																								<div><b>II. Scholarly Exhibitions</b></div><div><div><br></div><div>We will stage exhibitions. Open to the public for extended runs, these exhibitions will distribute the artistic thinking we think is vital. through publications, exhibitions, uncredentialed access to our library and public programs.</div></div>',_binary '\r\n																								\r\n																								\r\n																								\r\n																								'),(18,1,'2020-06-04 11:06:09','2020-08-04 15:35:46',80,'.Advocacy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'advocacy',NULL,NULL,NULL,NULL,NULL,_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								',_binary '\r\n																								<div><b>Advocacy</b><br></div><div><br></div><div>We will address aspects of collegiality and mutual support whereby our community can operate with the best interest of our ecosystem in mind. We will establish industry standards/best practices such as WAGE certification.</div><div><br></div><div>We will set up a mentorship program between senior and junior art dealers. Through our collaborative work with Artists Acquisition Club, we help the community have a voice in what is represented in our museums. And with the N-Y-C Giving Circle - *new idea* piggybacking on the concept of AAC, we can form a donors group that can purchase works to be donated to museums? On artists we research?</div><div><br></div><div>\r\n\r\n<video width=\"100%\">\r\n  <source src=\"/media/00009.mov\" type=\"video/mp4\">\r\n</video>\r\n\r\n</div><div><br></div><div><div>In addition to providing critical research, exhibitions and publications for artists, we train a holistic lens on their practices and intervene to help them craft a long term strategy to amplify the impact of their work. This work is iterative and highly collaborative, drawing on the incredible work of peer organizations to leverage collective wisdom and resources to advance art and culture. Areas of focus include but are not limited to legacy and stewardship, production support, conservation, and beyond.</div></div>',_binary '\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								\r\n																								'),(19,0,'2020-06-04 11:06:57','2020-06-04 12:58:04',10,'Advocacy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'advocacy',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL),(20,0,'2020-06-04 13:40:12','2020-06-04 15:48:19',20,'Collaboration',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'infrastructure-collaboration',NULL,NULL,NULL,NULL,NULL,_binary '\r\n																								\r\n																								\r\n																								\r\n																								',_binary '<b>Collaboration &amp;&nbsp;</b><b>Infrastructure</b><div><br></div><div>Our work emerges against the backdrop of widespread societal reckoning with exclusionary practices past and present. We believe that creating an equitable future requires reflecting on our internal structures and modeling the change we would like to see through our own organizational processes. We prioritize collaborative and collective practices above singular, hierarchical approaches and see our peer organizations as allies not competitors. We apply this ethos of collaboration in our core programs and seek out opportunities to co-publish and co-produce with a wide range of collaborators to amplify voices and maximize impact.&nbsp;<br></div>',_binary '\r\n																								\r\n																								\r\n																								\r\n																								'),(21,0,'2020-06-04 13:40:45','2020-06-04 15:48:14',30,'Transparency',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'transparency',NULL,NULL,NULL,NULL,NULL,_binary '\r\n																								',_binary '<div><b>Transparency / Accountability</b></div><div><br></div><div>We believe that an equitable future is built on transparency and accountability and that both concepts are currently being interrogated and challenged as they impact the workplace. We will commit to being at the vanguard of workplace practices.&nbsp;</div><div><br></div><div>We believe that an equitable future is built on transparency and accountability - explain what we do to this end. Potential Ideas: Fully lateral workforce (everyone paid the same??); Proactive Unionization? - Founding Partnership with Local 2110? Transparency Workgroup collaboration? Wage (obv). Sector wide best practices? Vetting process for Board Members? Research is shared - How? Everything is archived and accessible- What is radical transparency and radical accessibility? **Anne: mentioned document museums are circulating to attempt to be proactive about this?</div>\r\n																								',_binary '\r\n																								'),(22,0,'2020-06-04 13:41:00','2020-06-04 15:48:11',40,'Sustainability',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'sustainability',NULL,NULL,NULL,NULL,NULL,_binary '\r\n																								',_binary '<div><b>Sustainability</b></div><div><br></div><div>As an organization founded at the height of the climate crisis, we have an obligation to our planet and our peers to work sustainably. We are collaborating with a new climate organization Art to Zero as their first pilot organization. We will work with them to assess and reduce our carbon footprint and produce a roadmap for other arts organizations to work sustainably.</div>\r\n																								',_binary '\r\n																								');
/*!40000 ALTER TABLE `objects` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wires`
--

DROP TABLE IF EXISTS `wires`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wires` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `active` int unsigned NOT NULL DEFAULT '1',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  `fromid` int unsigned DEFAULT NULL,
  `toid` int unsigned DEFAULT NULL,
  `weight` float NOT NULL DEFAULT '1',
  `notes` blob,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wires`
--

LOCK TABLES `wires` WRITE;
/*!40000 ALTER TABLE `wires` DISABLE KEYS */;
INSERT INTO `wires` VALUES (1,0,'2020-02-27 17:13:47','2020-02-27 17:22:33',0,1,1,NULL),(2,0,'2020-02-27 17:15:14','2020-02-27 17:22:49',0,2,1,NULL),(3,0,'2020-02-27 17:23:26','2020-02-27 17:35:27',0,3,1,NULL),(4,0,'2020-02-27 17:23:58','2020-02-27 17:35:31',0,4,1,NULL),(5,0,'2020-02-27 17:50:14','2020-04-23 17:50:47',0,5,1,NULL),(6,1,'2020-02-27 17:50:31','2020-02-27 17:50:31',0,6,1,NULL),(7,0,'2020-02-27 17:53:14','2020-04-23 17:50:51',0,7,1,NULL),(8,0,'2020-03-02 16:48:18','2020-04-23 17:51:00',0,8,1,NULL),(9,0,'2020-03-02 16:53:10','2020-04-23 17:50:42',0,9,1,NULL),(10,0,'2020-03-02 16:55:40','2020-04-23 17:50:56',0,10,1,NULL),(11,1,'2020-04-23 17:51:07','2020-04-23 17:51:07',0,11,1,NULL),(12,1,'2020-04-23 17:51:26','2020-04-23 17:51:26',0,12,1,NULL),(13,1,'2020-04-23 17:51:38','2020-04-23 17:51:38',0,13,1,NULL),(14,1,'2020-04-23 17:51:48','2020-04-23 17:51:48',0,14,1,NULL),(15,0,'2020-04-23 17:52:01','2020-06-04 15:50:07',0,15,1,NULL),(16,1,'2020-04-23 17:52:15','2020-04-23 17:52:15',0,16,1,NULL),(17,0,'2020-04-23 17:52:29','2020-06-04 15:50:11',0,17,1,NULL),(18,0,'2020-06-04 11:06:09','2020-06-04 12:58:21',0,18,1,NULL),(19,0,'2020-06-04 11:06:57','2020-06-04 12:58:04',14,19,1,NULL),(20,0,'2020-06-04 12:58:14','2020-06-04 15:48:23',14,18,1,NULL),(21,0,'2020-06-04 13:40:12','2020-06-04 15:48:19',14,20,1,NULL),(22,0,'2020-06-04 13:40:45','2020-06-04 15:48:14',14,21,1,NULL),(23,0,'2020-06-04 13:41:00','2020-06-04 15:48:11',14,22,1,NULL),(24,1,'2020-06-04 15:48:02','2020-06-04 15:48:02',0,18,1,NULL),(25,0,'2020-07-27 16:08:59','2020-07-27 16:27:51',0,31,1,NULL),(26,1,'2020-07-27 16:09:54','2020-07-27 16:09:54',0,32,1,NULL),(27,0,'2020-07-27 16:28:03','2020-07-27 16:28:10',32,12,1,NULL);
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

-- Dump completed on 2020-09-07 21:32:38