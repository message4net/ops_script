/*
SQLyog Ultimate v8.32 
MySQL - 5.5.5-10.1.19-MariaDB : Database - manager_news_weather
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`manager_news_weather` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `manager_news_weather`;

/*Table structure for table `article` */

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(1000) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL,
  `addtime` datetime DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `content` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `article` */

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `tablename` varchar(50) DEFAULT NULL,
  `flag_set` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`parent_id`,`tablename`,`flag_set`) values (1,'系统管理',0,NULL,0),(2,'文档管理',0,NULL,0),(8,'文章管理',2,NULL,0),(4,'权限管理',1,'role',0),(5,'用户管理',1,'user',0),(6,'个人管理',0,NULL,0),(7,'修改密码',6,NULL,1);

/*Table structure for table `pic_art` */

DROP TABLE IF EXISTS `pic_art`;

CREATE TABLE `pic_art` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `art_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pic_art` */

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `creator` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

/*Data for the table `role` */

insert  into `role`(`id`,`name`,`creator`) values (1,'管理权限',1),(2,'用户权限',1);

/*Table structure for table `role_func` */

DROP TABLE IF EXISTS `role_func`;

CREATE TABLE `role_func` (
  `role_id` int(11) NOT NULL,
  `menu_sub_id` int(11) NOT NULL,
  `wordbook_id` int(11) NOT NULL,
  PRIMARY KEY (`role_id`,`menu_sub_id`,`wordbook_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `role_func` */

insert  into `role_func`(`role_id`,`menu_sub_id`,`wordbook_id`) values (1,4,1),(1,4,2),(1,4,3),(1,4,4),(1,4,5),(1,4,7),(1,4,8),(1,4,11),(1,4,12),(1,5,15),(1,5,16),(1,5,17),(1,5,18),(1,5,19),(1,5,20),(1,5,21),(1,5,22),(1,5,25),(1,8,27),(1,8,28),(1,8,29),(1,8,30),(1,8,31),(1,8,32),(1,8,36),(1,8,37),(1,8,38),(1,8,39),(2,8,27),(2,8,28),(2,8,29),(2,8,30),(2,8,31),(2,8,38),(2,8,39);

/*Table structure for table `role_menu` */

DROP TABLE IF EXISTS `role_menu`;

CREATE TABLE `role_menu` (
  `role_id` int(11) NOT NULL,
  `menu_sub_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_sub_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `role_menu` */

insert  into `role_menu`(`role_id`,`menu_sub_id`) values (1,4),(1,5),(1,7),(2,7),(1,8),(2,8);

/*Table structure for table `status_article` */

DROP TABLE IF EXISTS `status_article`;

CREATE TABLE `status_article` (
  `status_id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*Data for the table `status_article` */

insert  into `status_article`(`status_id`,`name`) values (0,'未发'),(1,'已发'),(2,'未审'),(3,'已审');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `creator` int(11) NOT NULL DEFAULT '0',
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`password`,`creator`,`role_id`) values (1,'admin','admin12',1,1),(2,'u1','u1',1,1),(7,'u3','u3',1,1),(6,'u2','u2',1,1),(5,'u10','u10',1,2),(8,'u11','u11',1,2),(9,'u18','u181',1,2);

/*Table structure for table `user_col` */

DROP TABLE IF EXISTS `user_col`;

CREATE TABLE `user_col` (
  `user_id` int(11) NOT NULL,
  `menu_sub_id` int(11) NOT NULL,
  `wordbook_id` int(11) NOT NULL,
  PRIMARY KEY (`user_id`,`menu_sub_id`,`wordbook_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `user_col` */

/*Table structure for table `wordbook` */

DROP TABLE IF EXISTS `wordbook`;

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

/*Data for the table `wordbook` */

insert  into `wordbook`(`id`,`type`,`flag`,`name`,`colnameid`,`seq`,`menu_sub_id`,`flag_set`,`sqlstr_head`,`sqlstr_body`,`sqlstr_foot`) values (1,1,0,'编号ID','id',1,4,1,NULL,NULL,NULL),(2,1,0,'权限名称','name',2,4,0,NULL,NULL,NULL),(3,2,0,'权限明细',NULL,3,4,0,'select role_id mainid,a.id subid,name from menu a,role_menu b where b.menu_sub_id=a.id',NULL,') ;'),(4,3,0,'新增','func_add',1,4,0,NULL,NULL,NULL),(5,3,0,'批删除','func_delall',2,4,0,NULL,NULL,NULL),(6,4,0,'权限名称','name',0,4,0,NULL,NULL,NULL),(7,5,0,'编辑','func_mod_',1,4,0,NULL,NULL,NULL),(8,5,1,'删除','func_del_',3,4,0,NULL,NULL,NULL),(9,6,0,'权限明细','detail',1,4,0,'select id,name from menu where parent_id>0 group by id;',NULL,NULL),(16,1,0,'用户名称','name',2,5,0,NULL,NULL,NULL),(11,5,0,'设置','func_set_',2,4,0,NULL,NULL,NULL),(12,7,0,'创建者','creator',0,4,0,'select a.id mainid,b.name from role a, role b where a.creator=b.id',NULL,');'),(15,1,0,'编号ID','id',1,5,1,NULL,NULL,NULL),(17,1,0,'用户密码','password',3,5,0,'',NULL,''),(26,4,0,'用户名称','name',0,5,0,NULL,NULL,NULL),(18,3,0,'新增','func_add',1,5,0,NULL,NULL,NULL),(19,3,0,'批删除','func_delall',2,5,0,NULL,NULL,NULL),(20,7,0,'权限名称','role_id',1,5,0,'select id mainid,name from role',NULL,');'),(21,5,0,'编辑','func_mod_',1,5,0,NULL,NULL,NULL),(22,5,1,'删除','func_del_',3,5,0,NULL,NULL,NULL),(23,8,0,'权限名称','rolename',1,5,0,'select id,name from role;',NULL,NULL),(25,7,0,'创建者','creator',0,5,0,'select id mainid,name from role',NULL,');'),(27,1,0,'编号ID','id',0,8,1,NULL,NULL,NULL),(28,1,0,'标题','name',1,8,0,NULL,NULL,NULL),(29,1,0,'作者','author',2,8,0,NULL,NULL,NULL),(30,1,0,'日期','addtime',3,8,0,NULL,NULL,NULL),(31,3,0,'新增','artl_add',0,8,0,NULL,NULL,NULL),(33,4,0,'标题','name',0,8,0,NULL,NULL,NULL),(34,4,0,'作者','author',1,8,0,NULL,NULL,NULL),(35,4,0,'上传者','user_id',2,8,0,NULL,NULL,NULL),(36,5,0,'查阅','artl_mod_',0,8,0,NULL,NULL,NULL),(38,7,0,'状态','status_id',0,8,0,'select status_id mainid,name from status_article',NULL,NULL),(39,7,0,'上传者','id',1,8,0,'select id mainid,name from user',NULL,NULL),(40,8,0,'状态','status_id',0,8,0,'select status_id mainid,name from status_article',NULL,NULL),(41,8,0,'上传者','id',1,8,0,'select id mainid,name from user',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
