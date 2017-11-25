-- MySQL dump 10.13  Distrib 5.6.22, for osx10.10 (x86_64)
--
-- Host: 127.0.0.1    Database: manager_news_weather
-- ------------------------------------------------------
-- Server version	5.5.33

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
-- Table structure for table `article`
--

DROP TABLE IF EXISTS `article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
INSERT INTO `article` VALUES (1,'a','b',0,'2017-11-24 03:50:23',1,'v'),(2,'a','b',0,'2017-11-24 04:00:03',1,'v'),(3,'a','b',0,'2017-11-24 04:02:29',1,'c'),(4,'a','b',0,'2017-11-23 21:05:30',1,'c'),(5,'a','b',0,'2017-11-23 21:07:00',1,'c'),(6,'a','b',0,'2017-11-23 21:07:18',1,'c'),(7,'b','c',0,'2017-11-23 21:08:05',1,'d'),(8,'c','d',0,'2017-11-23 21:08:53',1,'a'),(9,'c','d',0,'2017-11-23 21:10:08',1,'a'),(10,'c','d',0,'2017-11-23 21:10:49',1,'a'),(11,'c','d',0,'2017-11-23 21:10:58',1,'a'),(12,'a','b',0,'2017-11-23 21:11:14',1,'c'),(13,'a','b',0,'2017-11-23 21:12:00',1,'c'),(14,'a','b',0,'2017-11-23 21:12:35',1,'c'),(15,'a','b',0,'2017-11-23 21:13:28',1,'c'),(16,'a','b',0,'2017-11-23 21:13:37',1,'c'),(17,'a','b',0,'2017-11-23 21:14:36',1,'c'),(18,'a','b',0,'2017-11-25 06:59:51',1,'c'),(19,'c','d',0,'2017-11-25 07:01:01',1,'f'),(20,'ddddd','ssss',0,'2017-11-25 10:27:00',9,'ddddd'),(21,'ddddd','ssss',0,'2017-11-25 10:27:26',9,'ddddd'),(22,'ddddd1111','ssss',0,'2017-11-25 10:27:47',9,'ddddd'),(23,'aa','aa',0,'2017-11-25 10:37:45',1,'aa'),(24,'aa1','aa1',0,'2017-11-25 10:38:01',1,'aa1'),(25,'aa11','aa11',0,'2017-11-25 10:38:14',1,'aa11'),(26,'b1','b1',0,'2017-11-25 10:41:52',1,'b1'),(27,'b12','2b1',0,'2017-11-25 10:42:03',1,'b12'),(28,'b123','2b12',0,'2017-11-25 10:42:15',1,'b122');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `tablename` varchar(50) DEFAULT NULL,
  `flag_set` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'系统管理',0,NULL,0),(2,'文档管理',0,NULL,0),(8,'文章管理',2,'article',0),(4,'权限管理',1,'role',0),(5,'用户管理',1,'user',0),(6,'个人管理',0,NULL,0),(7,'修改密码',6,NULL,1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pic_art`
--

DROP TABLE IF EXISTS `pic_art`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pic_art` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `art_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pic_art`
--

LOCK TABLES `pic_art` WRITE;
/*!40000 ALTER TABLE `pic_art` DISABLE KEYS */;
INSERT INTO `pic_art` VALUES (2,'1_1511468075_0_34495e3b7b2eedd03934319e3b302846.jpeg',17),(7,'1_1511602678_0_4b4387d0d27afc9351c7219808ad77a0.jpeg',24),(8,'1_1511602692_0_4b4387d0d27afc9351c7219808ad77a0.jpeg',25),(9,'1_1511602692_1_4b4387d0d27afc9351c7219808ad77a0.jpeg',25),(10,'1_1511602692_2_4b4387d0d27afc9351c7219808ad77a0.jpeg',25),(11,'1_1511602922_0_4b4387d0d27afc9351c7219808ad77a0.jpeg',27),(12,'1_1511602933_0_4b4387d0d27afc9351c7219808ad77a0.jpeg',28),(13,'1_1511602933_1_4b4387d0d27afc9351c7219808ad77a0.jpeg',28),(14,'1_1511602933_2_4b4387d0d27afc9351c7219808ad77a0.jpeg',28);
/*!40000 ALTER TABLE `pic_art` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `creator` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,'管理权限',1),(2,'用户权限',1);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_func`
--

DROP TABLE IF EXISTS `role_func`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_func` (
  `role_id` int(11) NOT NULL,
  `menu_sub_id` int(11) NOT NULL,
  `wordbook_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`menu_sub_id`,`wordbook_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_func`
--

LOCK TABLES `role_func` WRITE;
/*!40000 ALTER TABLE `role_func` DISABLE KEYS */;
INSERT INTO `role_func` VALUES (1,4,1),(1,4,2),(1,4,3),(1,4,4),(1,4,5),(1,4,7),(1,4,8),(1,4,11),(1,4,12),(1,5,15),(1,5,16),(1,5,17),(1,5,18),(1,5,19),(1,5,20),(1,5,21),(1,5,22),(1,5,25),(1,8,27),(1,8,28),(1,8,29),(1,8,30),(1,8,31),(1,8,32),(1,8,36),(1,8,37),(1,8,38),(1,8,39),(2,8,27),(2,8,28),(2,8,29),(2,8,30),(2,8,31),(2,8,38),(2,8,39);
/*!40000 ALTER TABLE `role_func` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_menu`
--

DROP TABLE IF EXISTS `role_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_sub_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_sub_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_menu`
--

LOCK TABLES `role_menu` WRITE;
/*!40000 ALTER TABLE `role_menu` DISABLE KEYS */;
INSERT INTO `role_menu` VALUES (1,4),(1,5),(1,7),(2,7),(1,8),(2,8);
/*!40000 ALTER TABLE `role_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status_article`
--

DROP TABLE IF EXISTS `status_article`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status_article` (
  `status_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status_article`
--

LOCK TABLES `status_article` WRITE;
/*!40000 ALTER TABLE `status_article` DISABLE KEYS */;
INSERT INTO `status_article` VALUES (2,'CMA'),(4,'中国气象报'),(0,'未审'),(1,'已审'),(3,'省局外网');
/*!40000 ALTER TABLE `status_article` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `creator` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin12',1,1),(7,'u3','u3',1,1),(6,'u2','u2',1,1),(5,'u10','u10',1,2),(8,'u11','u11',1,2),(9,'u18','u181',1,2);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_col`
--

DROP TABLE IF EXISTS `user_col`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_col` (
  `user_id` int(11) NOT NULL,
  `menu_sub_id` int(11) NOT NULL,
  `wordbook_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`menu_sub_id`,`wordbook_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_col`
--

LOCK TABLES `user_col` WRITE;
/*!40000 ALTER TABLE `user_col` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_col` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wordbook`
--

DROP TABLE IF EXISTS `wordbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wordbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` int(11) NOT NULL,
  `flag` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `colnameid` varchar(50) DEFAULT NULL,
  `seq` int(11) NOT NULL DEFAULT '0',
  `menu_sub_id` int(11) DEFAULT NULL,
  `flag_set` int(11) NOT NULL DEFAULT '0',
  `sqlstr_head` varchar(1000) DEFAULT NULL,
  `sqlstr_body` varchar(1000) DEFAULT NULL,
  `sqlstr_foot` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wordbook`
--

LOCK TABLES `wordbook` WRITE;
/*!40000 ALTER TABLE `wordbook` DISABLE KEYS */;
INSERT INTO `wordbook` VALUES (1,1,0,'编号ID','id',1,4,1,NULL,NULL,NULL),(2,1,0,'权限名称','name',2,4,0,NULL,NULL,NULL),(3,2,0,'权限明细',NULL,3,4,0,'select role_id mainid,a.id subid,name from menu a,role_menu b where b.menu_sub_id=a.id',NULL,') ;'),(4,3,0,'新增','func_add',1,4,0,NULL,NULL,NULL),(5,3,0,'批删除','func_delall',2,4,0,NULL,NULL,NULL),(6,4,0,'权限名称','name',0,4,0,NULL,NULL,NULL),(7,5,0,'编辑','func_mod_',1,4,0,NULL,NULL,NULL),(8,5,1,'删除','func_del_',3,4,0,NULL,NULL,NULL),(9,6,0,'权限明细','detail',1,4,0,'select id,name from menu where parent_id>0 group by id;',NULL,NULL),(16,1,0,'用户名称','name',2,5,0,NULL,NULL,NULL),(11,5,0,'设置','func_set_',2,4,0,NULL,NULL,NULL),(12,7,0,'创建者','creator',0,4,0,'select a.id mainid,b.name from role a, role b where a.creator=b.id',NULL,');'),(15,1,0,'编号ID','id',1,5,1,NULL,NULL,NULL),(17,1,0,'用户密码','password',3,5,0,'',NULL,''),(26,4,0,'用户名称','name',0,5,0,NULL,NULL,NULL),(18,3,0,'新增','func_add',1,5,0,NULL,NULL,NULL),(19,3,0,'批删除','func_delall',2,5,0,NULL,NULL,NULL),(20,7,0,'权限名称','role_id',1,5,0,'select id mainid,name from role',NULL,');'),(21,5,0,'编辑','func_mod_',1,5,0,NULL,NULL,NULL),(22,5,1,'删除','func_del_',3,5,0,NULL,NULL,NULL),(23,8,0,'权限名称','rolename',1,5,0,'select id,name from role;',NULL,NULL),(25,7,0,'创建者','creator',0,5,0,'select id mainid,name from role',NULL,');'),(27,1,0,'编号ID','id',0,8,1,NULL,NULL,NULL),(28,1,0,'标题','name',1,8,0,NULL,NULL,NULL),(29,1,0,'作者','author',2,8,0,NULL,NULL,NULL),(30,1,0,'日期','addtime',3,8,0,NULL,NULL,NULL),(31,3,0,'新增','artl_add',0,8,0,NULL,NULL,NULL),(33,4,0,'标题','name',0,8,0,NULL,NULL,NULL),(34,4,0,'作者','author',1,8,0,NULL,NULL,NULL),(35,4,0,'上传者','user_id',2,8,0,NULL,NULL,NULL),(36,5,0,'查阅','artl_mod_',0,8,0,NULL,NULL,NULL),(38,7,0,'状态','status_id',0,8,0,'select status_id mainid,name from status_article',NULL,NULL),(39,7,0,'上传者','id',1,8,0,'select id mainid,name from user',NULL,NULL),(40,8,0,'状态','status_id',0,8,0,'select status_id mainid,name from status_article',NULL,NULL),(41,8,0,'上传者','id',1,8,0,'select id mainid,name from user',NULL,NULL);
/*!40000 ALTER TABLE `wordbook` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-11-25 17:54:17
