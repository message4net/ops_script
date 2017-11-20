-- MySQL dump 10.13  Distrib 5.6.22, for osx10.10 (x86_64)
--
-- Host: 127.0.0.1    Database: weather
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
INSERT INTO `menu` VALUES (1,'系统管理',0,NULL,0),(2,'文档管理',0,NULL,0),(8,'文章管理',2,NULL,0),(4,'权限管理',1,'role',0),(5,'用户管理',1,'user',0),(6,'个人管理',0,NULL,0),(7,'修改密码',6,NULL,1);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
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
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
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
INSERT INTO `role_func` VALUES (1,4,1),(1,4,2),(1,4,3),(1,4,4),(1,4,5),(1,4,7),(1,4,8),(1,4,11),(1,4,12),(1,5,15),(1,5,16),(1,5,17),(1,5,18),(1,5,19),(1,5,20),(1,5,21),(1,5,22),(1,5,24),(1,5,25);
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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin12',1,1),(2,'u1','u1',1,1),(7,'u3','u3',1,1),(6,'u2','u2',1,1),(5,'u10','u10',1,1);
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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wordbook`
--

LOCK TABLES `wordbook` WRITE;
/*!40000 ALTER TABLE `wordbook` DISABLE KEYS */;
INSERT INTO `wordbook` VALUES (1,1,0,'编号ID','id',1,4,1,NULL,NULL,NULL),(2,1,0,'权限名称','name',2,4,0,NULL,NULL,NULL),(3,2,0,'权限明细',NULL,3,4,0,'select role_id mainid,a.id subid,name from menu a,role_menu b where b.menu_sub_id=a.id',NULL,') ;'),(4,3,0,'新增','func_add',1,4,0,NULL,NULL,NULL),(5,3,0,'批删除','func_delall',2,4,0,NULL,NULL,NULL),(6,4,0,'权限名称','name',0,4,0,NULL,NULL,NULL),(7,5,0,'编辑','func_mod_',1,4,0,NULL,NULL,NULL),(8,5,1,'删除','func_del_',3,4,0,NULL,NULL,NULL),(9,6,0,'权限明细','detail',1,4,0,'select id,name from menu where parent_id>0 group by id;',NULL,NULL),(16,1,0,'用户名称','name',2,5,0,NULL,NULL,NULL),(11,5,0,'设置','func_set_',2,4,0,NULL,NULL,NULL),(12,7,0,'创建者','creator',0,4,0,'select a.id mainid,b.name from role a, role b where a.creator=b.id',NULL,');'),(15,1,0,'编号ID','id',1,5,1,NULL,NULL,NULL),(17,1,0,'用户密码','password',3,5,0,'',NULL,''),(26,4,0,'用户名称','name',0,5,0,NULL,NULL,NULL),(18,3,0,'新增','func_add',1,5,0,NULL,NULL,NULL),(19,3,0,'批删除','func_delall',2,5,0,NULL,NULL,NULL),(20,7,0,'权限名称','role_id',1,5,0,'select a.id mainid,b.name from role a, role b where a.creator=b.id',NULL,');'),(21,5,0,'编辑','func_mod_',1,5,0,NULL,NULL,NULL),(22,5,1,'删除','func_del_',3,5,0,NULL,NULL,NULL),(23,8,0,'权限名称','rolename',1,5,0,'select id,name from role;',NULL,NULL),(25,7,0,'创建者','creator',0,5,0,'select a.id mainid,b.name from role a, role b where a.creator=b.id',NULL,');');
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

-- Dump completed on 2017-11-21  3:35:40
