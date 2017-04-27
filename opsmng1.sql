-- MySQL dump 10.13  Distrib 5.5.32, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: opsmanage1
-- ------------------------------------------------------
-- Server version	5.5.32-log

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
-- Table structure for table `link_js`
--

DROP TABLE IF EXISTS `link_js`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `link_js` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `url` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `relation_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `tips` varchar(200) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0',
  `tablestr` varchar(200) DEFAULT NULL,
  `linktype` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `link_js`
--

LOCK TABLES `link_js` WRITE;
/*!40000 ALTER TABLE `link_js` DISABLE KEYS */;
INSERT INTO `link_js` VALUES (1,'服务管理','navbar.php',0,0,0,'请根据左侧菜单点击操作','','dbstruct'),(2,'系统管理','navbar.php',0,0,0,'请根据左侧菜单点击操作','','dbstruct'),(3,'服务器信息','content.php',1,0,0,'位置:服务管理->服务器信息','server_info','dbstruct'),(4,'服务信息','content.php',1,0,0,'位置:服务管理->服务信息','service_info t1,server_info t2 where t1.host_id=t2.id','dbstruct'),(5,'维护信息','index.php?mid=5&fnctn=info',1,0,0,'位置:服务管理->服务维护','','dbstruct'),(6,'用户信息','index.php?mid=6&fnctn=info',2,0,0,'位置:系统管理->用户信息','','dbstruct'),(7,'菜单角色信息','index.php?mid=7&fnctn=info',2,0,0,'位置:系统管理->菜单角色信息','','dbstruct'),(8,'新增','index.php?mid=8&fnctn=info',4,2,0,'位置:服务管理->服务信息->新增','','dbstruct'),(9,'修改','index.php?mid=9&fnctn=info',4,3,0,'位置:服务管理->服务信息->修改','','dbstruct'),(10,'删除','info_deal.php?mid=10&fnctn=info',4,4,0,'位置:服务管理->服务信息->删除','','dbstruct'),(11,'新增','info_deal.php?mid=11&fnctn=info',8,2,1,'','','dbstruct'),(12,'修改','info_deal.php?mid=12&fnctn=info',9,3,1,'','','dbstruct'),(14,'新增','index.php?mid=14&fnctn=info',5,2,0,'位置:服务管理->维护信息->新增','','dbstruct'),(15,'维护','index.php?mid=15&fnctn=serviceop',5,5,0,'位置:服务管理->维护信息->维护','','dbstruct'),(16,'修改','index.php?mid=16&fnctn=info',5,3,0,'位置:服务管理->维护信息->修改','','dbstruct'),(17,'删除','info_deal.php?mid=17&fnctn=info',5,4,0,'位置:服务管理->维护信息->删除','','dbstruct'),(18,'新增','info_deal.php?mid=18&fnctn=info',14,2,1,'','','dbstruct'),(19,'维护','serviceop_deal.php?mid=19&fnctn=serviceop',15,5,1,'','','dbstruct'),(20,'修改','info_deal.php?mid=20&fnctn=info',16,3,1,'','','dbstruct'),(22,'新增','index.php?mid=22&fnctn=info',3,2,0,'位置:服务管理->服务器信息->新增','','dbstruct'),(23,'修改','index.php?mid=23&fnctn=info',3,3,0,'位置:服务管理->服务器信息->修改','','dbstruct'),(24,'删除','info_deal.php?mid=24&fnctn=info',3,4,0,'位置:服务管理->服务器信息->删除','','dbstruct'),(25,'新增','info_deal.php?mid=25&fnctn=info',22,2,1,'','','dbstruct'),(26,'修改','info_deal.php?mid=26&fnctn=info',23,3,1,'','','dbstruct');
/*!40000 ALTER TABLE `link_js` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `url` varchar(200) DEFAULT NULL,
  `relation_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `tips` varchar(200) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (1,'服务管理','index.php?mid=1',0,0,0,'请根据左侧菜单点击操作'),(2,'系统管理','index.php?mid=2',0,0,0,'请根据左侧菜单点击操作'),(3,'服务器信息','index.php?mid=3&fnctn=info',1,0,0,'位置:服务管理->服务器信息'),(4,'服务信息','index.php?mid=4&fnctn=info',1,0,0,'位置:服务管理->服务信息'),(5,'维护信息','index.php?mid=5&fnctn=info',1,0,0,'位置:服务管理->服务维护'),(6,'用户信息','index.php?mid=6&fnctn=info',2,0,0,'位置:系统管理->用户信息'),(7,'菜单角色信息','index.php?mid=7&fnctn=info',2,0,0,'位置:系统管理->菜单角色信息'),(8,'新增','index.php?mid=8&fnctn=info',4,2,0,'位置:服务管理->服务信息->新增'),(9,'修改','index.php?mid=9&fnctn=info',4,3,0,'位置:服务管理->服务信息->修改'),(10,'删除','info_deal.php?mid=10&fnctn=info',4,4,0,'位置:服务管理->服务信息->删除'),(11,'新增','info_deal.php?mid=11&fnctn=info',8,2,1,''),(12,'修改','info_deal.php?mid=12&fnctn=info',9,3,1,''),(14,'新增','index.php?mid=14&fnctn=info',5,2,0,'位置:服务管理->维护信息->新增'),(15,'维护','index.php?mid=15&fnctn=serviceop',5,5,0,'位置:服务管理->维护信息->维护'),(16,'修改','index.php?mid=16&fnctn=info',5,3,0,'位置:服务管理->维护信息->修改'),(17,'删除','info_deal.php?mid=17&fnctn=info',5,4,0,'位置:服务管理->维护信息->删除'),(18,'新增','info_deal.php?mid=18&fnctn=info',14,2,1,''),(19,'维护','serviceop_deal.php?mid=19&fnctn=serviceop',15,5,1,''),(20,'修改','info_deal.php?mid=20&fnctn=info',16,3,1,''),(22,'新增','index.php?mid=22&fnctn=info',3,2,0,'位置:服务管理->服务器信息->新增'),(23,'修改','index.php?mid=23&fnctn=info',3,3,0,'位置:服务管理->服务器信息->修改'),(24,'删除','info_deal.php?mid=24&fnctn=info',3,4,0,'位置:服务管理->服务器信息->删除'),(25,'新增','info_deal.php?mid=25&fnctn=info',22,2,1,''),(26,'修改','info_deal.php?mid=26&fnctn=info',23,3,1,'');
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `navmenu`
--

DROP TABLE IF EXISTS `navmenu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `navmenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) CHARACTER SET utf8mb4 DEFAULT NULL,
  `url` varchar(200) CHARACTER SET utf8mb4 DEFAULT NULL,
  `relation_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL DEFAULT '0',
  `type` int(11) NOT NULL DEFAULT '0',
  `tips` varchar(200) CHARACTER SET utf8mb4 NOT NULL DEFAULT '0',
  `tablestr` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `navmenu`
--

LOCK TABLES `navmenu` WRITE;
/*!40000 ALTER TABLE `navmenu` DISABLE KEYS */;
INSERT INTO `navmenu` VALUES (1,'服务管理','navbar.php',0,0,0,'请根据左侧菜单点击操作',''),(2,'系统管理','navbar.php',0,0,0,'请根据左侧菜单点击操作',''),(3,'服务器信息','content.php',1,0,0,'位置:服务管理->服务器信息','server_info'),(4,'服务信息','content.php',1,0,0,'位置:服务管理->服务信息','service_info t1,server_info t2 where t1.host_id=t2.id'),(5,'维护信息','index.php?mid=5&fnctn=info',1,0,0,'位置:服务管理->服务维护',''),(6,'用户信息','index.php?mid=6&fnctn=info',2,0,0,'位置:系统管理->用户信息',''),(7,'菜单角色信息','index.php?mid=7&fnctn=info',2,0,0,'位置:系统管理->菜单角色信息',''),(8,'新增','index.php?mid=8&fnctn=info',4,2,0,'位置:服务管理->服务信息->新增',''),(9,'修改','index.php?mid=9&fnctn=info',4,3,0,'位置:服务管理->服务信息->修改',''),(10,'删除','info_deal.php?mid=10&fnctn=info',4,4,0,'位置:服务管理->服务信息->删除',''),(11,'新增','info_deal.php?mid=11&fnctn=info',8,2,1,'',''),(12,'修改','info_deal.php?mid=12&fnctn=info',9,3,1,'',''),(14,'新增','index.php?mid=14&fnctn=info',5,2,0,'位置:服务管理->维护信息->新增',''),(15,'维护','index.php?mid=15&fnctn=serviceop',5,5,0,'位置:服务管理->维护信息->维护',''),(16,'修改','index.php?mid=16&fnctn=info',5,3,0,'位置:服务管理->维护信息->修改',''),(17,'删除','info_deal.php?mid=17&fnctn=info',5,4,0,'位置:服务管理->维护信息->删除',''),(18,'新增','info_deal.php?mid=18&fnctn=info',14,2,1,'',''),(19,'维护','serviceop_deal.php?mid=19&fnctn=serviceop',15,5,1,'',''),(20,'修改','info_deal.php?mid=20&fnctn=info',16,3,1,'',''),(22,'新增','index.php?mid=22&fnctn=info',3,2,0,'位置:服务管理->服务器信息->新增',''),(23,'修改','index.php?mid=23&fnctn=info',3,3,0,'位置:服务管理->服务器信息->修改',''),(24,'删除','info_deal.php?mid=24&fnctn=info',3,4,0,'位置:服务管理->服务器信息->删除',''),(25,'新增','info_deal.php?mid=25&fnctn=info',22,2,1,'',''),(26,'修改','info_deal.php?mid=26&fnctn=info',23,3,1,'','');
/*!40000 ALTER TABLE `navmenu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `op_service`
--

DROP TABLE IF EXISTS `op_service`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `op_service` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `service_id` int(11) DEFAULT NULL,
  `op_op_id` int(11) DEFAULT NULL,
  `script_user` varchar(10) DEFAULT NULL,
  `script_ip` varchar(20) DEFAULT NULL,
  `script_path_name` varchar(200) DEFAULT NULL,
  `log_path_name` varchar(100) DEFAULT NULL,
  `code_path` varchar(200) DEFAULT NULL,
  `tips` varchar(200) DEFAULT NULL,
  `op_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `op_service`
--

LOCK TABLES `op_service` WRITE;
/*!40000 ALTER TABLE `op_service` DISABLE KEYS */;
INSERT INTO `op_service` VALUES (1,9,1,'liujin','192.168.2.248','/data/ops_system/OP/rsync/moli/publish_code/pulish_code.sh','','/tmp/ztest/runtime/moli1',NULL,60),(4,9,3,'liujin','192.168.2.248','/data/ops_system/OP/rsync/moli/rsync_test_moli.sh','/data/ops_system/OP/rsync/moli/log','',NULL,30),(5,9,4,'liujin','192.168.2.248','/data/ops_system/OP/rsync/moli/update/update_test_moli.sh','/usr/local/tomcat_moli/logs/catalina.`date +%m`.out','',NULL,50),(6,9,5,'liujin','192.168.2.248','/data/ops_system/OP/rsync/moli/update/update_test_moli.sh','/usr/local/tomcat_moli/logs/catalina.`date +%m`.out','',NULL,20);
/*!40000 ALTER TABLE `op_service` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `server_info`
--

DROP TABLE IF EXISTS `server_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `server_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `host_name` varchar(50) DEFAULT NULL,
  `ip_pub` varchar(20) DEFAULT NULL,
  `ip_inner` varchar(20) DEFAULT NULL,
  `cpu` varchar(50) DEFAULT NULL,
  `memory` varchar(50) DEFAULT NULL,
  `hd` varchar(50) DEFAULT NULL,
  `elec` varchar(10) DEFAULT NULL,
  `sys_version` varchar(50) DEFAULT NULL,
  `expire_date` datetime DEFAULT NULL,
  `bandwith` varchar(10) DEFAULT NULL,
  `buytime` datetime DEFAULT NULL,
  `raid` varchar(20) DEFAULT NULL,
  `price` varchar(10) DEFAULT NULL,
  `brand` varchar(20) DEFAULT NULL,
  `remark` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `server_info`
--

LOCK TABLES `server_info` WRITE;
/*!40000 ALTER TABLE `server_info` DISABLE KEYS */;
INSERT INTO `server_info` VALUES (1,'192_168_2_248','192.168.2.248','192.168.2.248','8(XEON 5606 四核  2.13GH 2块)','32G(KST DDR3 ECC 8G*2)','520G(300G SAS*4)','0.8A','CentOS release 6.4 (Final)','0000-00-00 00:00:00','','2013-09-03 00:00:00','Raid1,0','11200','','原1.93'),(2,'192_168_2_122','192.168.2.122','192.168.2.122','4','2G','45G','','CentOS release 6.4 (Final)','0000-00-00 00:00:00','','0000-00-00 00:00:00','','','','公司虚拟机'),(3,'192_168_2_123','192.168.2.123','192.168.2.123','4','4G','45G','','CentOS release 6.4 (Final)','0000-00-00 00:00:00','','0000-00-00 00:00:00','','','','公司虚拟机'),(4,'192_168_2_124','192.168.2.124','192.168.2.124','4','2G','26G','','CentOS release 6.4 (Final)','0000-00-00 00:00:00','','0000-00-00 00:00:00','','','','公司虚拟机'),(5,'192_168_2_121','192.168.2.121','192.168.2.121','4','2G','26G','','CentOS release 6.4 (Final)','0000-00-00 00:00:00','','0000-00-00 00:00:00','','','','公司虚拟机'),(6,'192_168_2_127','192.168.2.127','192.168.2.127','4','6G','26G','','CentOS release 6.4 (Final)','0000-00-00 00:00:00','','0000-00-00 00:00:00','','','','公司虚拟机'),(7,'192_168_2_128','192.168.2.128','192.168.2.128','4','4G','26G','','CentOS release 6.4 (Final)','0000-00-00 00:00:00','','0000-00-00 00:00:00','','','','公司虚拟机'),(8,'192_168_2_251','192.168.2.251','192.168.2.251','8(XEON 5606 四核  2.13GH 2块)','32G(KST DDR3 ECC 8G*2)','520G(300G SAS*4)','0.8A','CentOS release 6.4 (Final)','0000-00-00 00:00:00','','2013-09-03 00:00:00','Raid1,0','11200','','原1.203');
/*!40000 ALTER TABLE `server_info` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `service_info`
--

DROP TABLE IF EXISTS `service_info`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `service_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `game_server_name` varchar(100) DEFAULT NULL,
  `host_id` int(11) DEFAULT NULL,
  `http_link` varchar(200) DEFAULT NULL,
  `u_p` varchar(100) DEFAULT NULL,
  `ip_bak` varchar(20) DEFAULT NULL,
  `ip_db_master` varchar(20) DEFAULT NULL,
  `name_db_master` varchar(100) DEFAULT NULL,
  `port_socket` int(11) DEFAULT NULL,
  `port_http` int(11) DEFAULT NULL,
  `port_tomcat` int(11) DEFAULT NULL,
  `port_hd2` int(11) DEFAULT NULL,
  `port_db_master` varchar(12) DEFAULT NULL,
  `container` varchar(100) DEFAULT NULL,
  `feature_pro` varchar(100) DEFAULT NULL,
  `jdk_version` varchar(20) DEFAULT NULL,
  `mem_mx` int(11) DEFAULT NULL,
  `mem_mn` int(11) DEFAULT NULL,
  `mem_pm` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=43 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `service_info`
--

LOCK TABLES `service_info` WRITE;
/*!40000 ALTER TABLE `service_info` DISABLE KEYS */;
INSERT INTO `service_info` VALUES (5,'充值测试服tomcat',2,'192.168.2.122:7013/charge/','','','192.168.2.122','charge',0,7013,8007,0,'3299','/usr/local/tomcat_charge/webapps/charge','.*usr/java/jdk.*/usr/local/tomcat_charge/conf/logging.properties.*','6',128,64,0),(6,'登录测试服tomcat',2,'192.168.2.122:7002/center/',NULL,'','192.168.2.122','center',8892,7002,8006,0,'3300','/usr/local/tomcat_center/webapps/center','.*usr/java/jdk.*/usr/local/tomcat_center/conf/logging.properties.*','6',256,128,0),(9,'魔力测试服100',1,NULL,NULL,'','192.168.2.248','moli,molibase,molilog',8897,7023,8007,0,'3306','/usr/local/tomcat_moli/webapps/moli1','.*usr/java/jdk.*/usr/local/tomcat_moli/conf/logging.properties.*','6',0,0,0),(18,'充值gate测试服tomcat',2,'192.168.2.122:8008/chargegate/',NULL,'','192.168.2.122','charge',0,8008,7015,0,'3299','/usr/local/tomcat_chargegate/webapps/chargegate','.*usr/java/jdk.*/usr/local/tomcat_chargegate/conf/logging.properties.*','6',128,64,0),(19,'帐号测试服tomcat',2,'192.168.2.122:7001/passport/',NULL,'','192.168.2.122','center',0,7001,8001,0,'3299','/usr/local/tomcat_passport/webapps/passport','.*usr/java/jdk.*/usr/local/tomcat_passport/conf/logging.properties.*','6',100,100,0),(20,'登录core测试服',2,NULL,NULL,'','192.168.2.122','center',0,0,0,0,'3300','/opt/centercore/doc','.*usr/java/jdk.*/opt/centercore/doc/WEB-INF/classes.*','0',0,0,0),(21,'登录third测试服',2,NULL,NULL,'','192.168.2.122','center',0,0,0,0,'3300','/opt/centerthird/doc','.*usr/java/jdk.*/opt/centerthird/doc/WEB-INF/classes.*','0',0,0,0),(22,'充值core测试服',2,NULL,NULL,'','192.168.2.122','charge',0,0,0,0,'3299','/opt/chargecore/doc','.*usr/java/jdk.*/opt/chargecore/doc/WEB-INF/classes.*','0',0,0,0),(23,'activemq192_168_2_122',2,'192.168.2.122:8161/admin/queues.jsp',NULL,'','','',0,0,0,0,'','/opt/activemq','.*usr/java/jdk.*/opt/activemq/conf.*','6',0,0,0),(24,'mysql_3299_192.168.2.122',2,NULL,NULL,'','192.168.2.122','center,charge',3299,0,0,0,'3299','/data/mysql_data/chargemysql0/','.*/usr/sbin/mysqld.*/data/mysql_data/chargemysql0/mysql.sock.*','0',0,0,0),(25,'mysql_3300_192.168.2.122',2,NULL,NULL,'','192.168.2.122','center,skyml_center',3300,0,0,0,'3300','/data/mysql_data/centermysql0/','.*/usr/sbin/mysqld.*/data/mysql_data/centermysql0/mysql.sock.*','0',0,0,0),(26,'梦幻编辑器tomcat',1,'http://192.168.2.248:7019/mheditor/main.do','shih/alk','','192.168.2.123','editlog,molibase_3361_123_mh',0,7019,8005,0,'3100','/usr/local/tomcat_edit/webapps/mheditor','.*usr/java/jdk.*/usr/local/tomcat_edit/conf/logging.properties.*','0',0,0,0),(27,'魔力编辑器tomcat',1,'http://192.168.2.248:7019/mleditor/main.do','shih/alk','','192.168.2.123','editlog,molibase_3501_123_ml',0,7019,8005,0,'3100','/usr/local/tomcat_edit/webapps/mleditor','.*usr/java/jdk.*/usr/local/tomcat_edit/conf/logging.properties.*','6',0,0,0),(28,'侠义编辑器tomcat',1,'http://192.168.2.248:7019/xyeditor/login!login.action','shih/alk','','192.168.2.123','editlog,basedb_3301_123_xy',0,7019,8005,0,'3100','/usr/local/tomcat_edit/webapps/xyeditor','.*usr/java/jdk.*/usr/local/tomcat_edit/conf/logging.properties.*','6',0,0,0),(29,'侠义测试服tomcat',3,NULL,NULL,'','192.168.2.123','userdb,relatedb,relaydb,basedb,logdb',8898,7006,8008,9102,'3301','/usr/local/tomcat_xiayi/webapps/xiayi','.*usr/java/jdk.*/usr/local/tomcat_xiayi/conf/logging.properties.*','6',512,512,0),(30,'梦幻测试服tomcat',3,NULL,NULL,'','192.168.2.123','moli,molibase,molilog',8896,7010,8006,0,'3361,3362','/usr/local/tomcat_mengh/webapps/moli2','.*usr/java/jdk.*/usr/local/tomcat_mengh/conf/logging.properties.*','6',0,0,0),(31,'魔力测试服tomcat',3,NULL,NULL,'','192.168.2.123','moli,molibase,molilog',8897,7024,8007,0,'3501','/usr/local/tomcat_moli/webapps/moli1','.*usr/java/jdk.*/usr/local/tomcat_moli/conf/logging.properties.*','6',0,0,0),(32,'斯凯魔力(冒泡)测试服tomcat',3,NULL,NULL,'','192.168.2.123','moli,molibase,molilog',8890,8001,8010,0,'3901','/usr/local/tomcat_skyml/webapps/moli1','.*usr/java/jdk.*/usr/local/tomcat_skyml/conf/logging.properties.*','6',128,64,0),(33,'斯凯魔力(冒泡)编辑器',1,'http://192.168.2.248:7021/mleditor/login!login.action','shih/alk','','192.168.2.123','editlog_new,molibase_3901_123_skml',0,7021,7020,0,'3901','/usr/local/tomcat_skymledit/webapps/mleditor','.*usr/java/jdk.*/usr/local/tomcat_skymledit/conf/logging.properties.*','6u38',128,64,64),(34,'绝色霸业测试服客服系统',5,'http://192.168.2.121:8012/clientservice/index!top.action','yuny/yy2015','','','',0,8012,8013,0,'','/usr/local/tomcat_clientserver/webapps/clientservice','.*usr/java/jdk.*/usr/local/tomcat_clientserver/conf/logging.properties.*','6u38',64,64,6),(35,'活动系统',5,'http://192.168.2.121:8006/activity/xiayi_new.action;mengh_new.action;moli.action;skmoli.action;beauty.action','','','192.168.2.121','activity',0,8006,8007,0,'3306','/usr/local/tomcat_activity/webapps/activity','.*usr/java/jdk.*/usr/local/tomcat_activity/conf/logging.properties.*','6u38',1536,1536,6),(36,'mysql_3306_192.168.2.121',5,'','','','192.168.2.121','activity',3306,0,0,0,'3306','/data/mysql_data/mysql3306','.*/usr/sbin/mysqld.*/data/mysql_data/mysql3306/mysql.sock.*','',0,0,0),(37,'mysql_3306_192.168.2.248',1,'','','','192.168.2.248','client_server,bug_info',3306,0,0,0,'3306','/data/mysql_data/mysql3306','.*/usr/sbin/mysqld.*/data/mysql_data/mysql3306/mysql.sock.*','',0,0,0),(38,'centergate测试服tomcat',2,'http://192.168.2.122:7007/centergate/','','','','',0,7007,7006,0,'','/usr/local/tomcat_centergate/webapps/centergate','.*usr/java/jdk.*/usr/local/tomcat_centergate/conf/logging.properties.*','6u38',256,128,0),(39,'mysql_3306_192.168.2.124',4,'','','','192.168.2.124','',0,0,0,0,'3306','/data/mysql_data/mysql3306','.*/usr/sbin/mysqld.*/data/mysql_data/mysql3306/mysql.sock.*','',0,0,0),(40,'passport测试服chuhan',4,'http://192.168.2.122:8002/passport/','','','192.168.2.124','account',0,8002,8003,0,'3306','/usr/local/tomcat_passport_chuhan/webapps/passport','.*usr/java/jdk.*/usr/local/tomcat_passport_chuhan/conf/logging.properties.*','6u38',1536,1536,0),(41,'agent测试服skyml',4,'http://192.168.2.124:7015/zs_skyagent/;skyagent;txagent','','','','',0,7015,7016,0,'','/usr/local/tomcat_skymlagent/webapps/zs_skyagent','.*usr/java/jdk.*/usr/local/tomcat_skymlagent/conf/logging.properties.*','6u38',64,32,0),(42,'center测试服skyml',4,'http://192.168.2.124:7015/zs_skyagent/;skyagent;txagent','','','','',0,7004,8009,0,'','/usr/local/tomcat_skymlcenter/webapps/center','.*usr/java/jdk.*/usr/local/tomcat_skymlcenter/conf/logging.properties.*','6u38',128,64,0);
/*!40000 ALTER TABLE `service_info` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` VALUES (1,'admin','admin'),(2,'fanyd','gll91!Gll'),(3,'guzq','123456');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wordbook`
--

DROP TABLE IF EXISTS `wordbook`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `wordbook` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `varname` varchar(100) DEFAULT NULL,
  `varvalue` varchar(200) DEFAULT NULL,
  `varsql` varchar(200) DEFAULT NULL,
  `menu_id` int(11) NOT NULL,
  `function_id` int(11) NOT NULL,
  `relation_id` int(11) NOT NULL,
  `colname` varchar(100) NOT NULL,
  `tablename` varchar(20) NOT NULL,
  `seq` int(11) NOT NULL,
  `type` varchar(20) NOT NULL DEFAULT 'text',
  `remark` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wordbook`
--

LOCK TABLES `wordbook` WRITE;
/*!40000 ALTER TABLE `wordbook` DISABLE KEYS */;
INSERT INTO `wordbook` VALUES (1,'$_SESSION[islogin]','YES|NO','$_SESSION[islogin]',0,0,0,'','',0,'text','记录是否登录'),(2,'fnctn','logout','fnctn',0,0,0,'','',0,'text','注销用户'),(3,'game_server_name','服务名称','game_server_name',4,0,0,'','',1,'text','*(游戏为游戏服名称)'),(4,'host_id','主机名称','host_name as host_id',4,1,0,'id,host_name','server_info',2,'text','*'),(5,'http_link','http链接','http_link',4,0,0,'','',3,'text','http访问链接'),(6,'u_p','用户/密码','u_p',4,0,0,'','',4,'text','用户密码用\'/\'分割;多组用\';\'分割'),(7,'ip_bak','服务备份ip','ip_bak',4,0,0,'','',6,'text',''),(8,'ip_db_master','主数据库IP','ip_db_master',4,0,0,'','',7,'text',''),(9,'name_db_master','数据库名称','name_db_master',4,0,0,'','',8,'text','若多个，名称以,隔开'),(11,'port_socket','程序端口','port_socket',4,0,0,'','',9,'text',''),(12,'port_http','web端口','port_http',4,0,0,'','',10,'text',''),(13,'port_tomcat','tomcat端口','port_tomcat',4,0,0,'','',11,'text',''),(14,'port_hd2','hd2端口','port_hd2',4,0,0,'','',12,'text',''),(15,'port_db_master','数据库端口','port_db_master',4,0,0,'','',13,'text',''),(16,'container','容器路径','container',4,0,0,'','',14,'text',''),(17,'feature_pro','进程特征','feature_pro',4,0,0,'','',15,'text',''),(18,'jdk_version','jdk版本','jdk_version',4,0,0,'','',16,'text',''),(19,'mem_mx','最大内存','mem_mx',4,0,0,'','',17,'text',''),(20,'mem_mn','最小内存','mem_mn',4,0,0,'','',18,'text',''),(21,'mem_pm','Perm内存','mem_pm',4,0,0,'','',19,'text',''),(22,'id','编号','t1.id',4,0,0,'','',20,'text','此项不可修改'),(23,'script_user','脚本账户','script_user',5,0,0,'','',1,'text','*(执行脚本的账户名称)'),(24,'script_ip','脚本ip','script_ip',5,0,0,'','',2,'text','*(执行脚本的ip)'),(25,'script_path_name','路径脚本','script_path_name',5,0,0,'','',3,'text','*(执行脚本的路径及名称)'),(26,'log_path_name','路径日志','log_path_name',5,0,0,'','',4,'text','(服务日志的路径及名称)'),(27,'service_id','维护服务','service_id',5,1,0,'id,game_server_name','service_info',5,'text','*(维护服务的名称)'),(28,'op_op_id','维护操作','op_op_id',5,2,0,'varname,varvalue','wordbook',6,'text','*(维护服务操作的名称)'),(36,'id','编号','id',5,0,0,'','',8,'text','此项不可修改'),(37,'1','install_发布代码','1',0,0,28,'','',1,'text',NULL),(38,'2','update_发布代码','2',0,0,28,'','',2,'text',NULL),(39,'3','rsync_同步代码','3',0,0,28,'','',3,'text',NULL),(40,'4','sh_停服','4',0,0,28,'','',4,'text',NULL),(41,'5','sh_开服','5',0,0,28,'','',5,'text',NULL),(42,'6','sh_打包地图','6',0,0,28,'','',6,'text',NULL),(43,'7','map_获取地图','7',0,0,28,'','',7,'text',NULL),(44,'8','dump_导出Base库','8',0,0,28,'','',8,'text',NULL),(45,'9','rsync_同步Base库','9',0,0,28,'','',9,'text',NULL),(46,'10','mysql_导入Base库','10',0,0,28,'','',10,'text',NULL),(47,'code_path','源代码路径','code_path',5,0,0,'','',7,'text','(源代码路径)'),(48,'host_name','主机名称','host_name',3,0,0,'','',48,'text','*'),(49,'ip_pub','外网ip','ip_pub',3,0,0,'','',49,'text','*'),(50,'ip_inner','内网ip','ip_inner',3,0,0,'','',50,'text','*'),(51,'cpu','物理核数','cpu',3,0,0,'','',51,'text','*'),(52,'memory','物理内存','memory',3,0,0,'','',52,'text','*'),(53,'hd','物理硬盘','hd',3,0,0,'','',53,'text','*'),(54,'sys_version','系统版本','sys_version',3,0,0,'','',54,'text','*'),(55,'bandwith','带宽','bandwith',3,0,0,'','',55,'text',''),(56,'buytime','购买时间','buytime',3,0,0,'','',56,'text',''),(57,'expire_date','到期时间','expire_date',3,0,0,'','',57,'text',''),(58,'raid','raid','raid',3,0,0,'','',58,'text',''),(59,'price','价格','price',3,0,0,'','',59,'text',''),(60,'brand','品牌','brand',3,0,0,'','',60,'text',''),(61,'elec','消耗电流','elec',3,0,0,'','',61,'text',''),(62,'remark','备注','remark',3,0,0,'','',62,'text',''),(63,'id','编号','id',3,0,0,'','',63,'text','此项不可修改');
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

-- Dump completed on 2017-04-27 18:35:34
