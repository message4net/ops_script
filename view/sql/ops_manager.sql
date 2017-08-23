/*
SQLyog Ultimate v8.32 
MySQL - 5.5.5-10.1.19-MariaDB : Database - ops_manager
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`ops_manager` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `ops_manager`;

/*Table structure for table `menu` */

DROP TABLE IF EXISTS `menu`;

CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `parent_id` int(11) NOT NULL,
  `tablename` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

/*Data for the table `menu` */

insert  into `menu`(`id`,`name`,`parent_id`,`tablename`) values (1,'系统管理',0,NULL),(2,'服务管理',0,NULL),(3,'服务器管理',0,NULL),(4,'权限管理',1,'role'),(5,'用户管理',1,'user');

/*Table structure for table `menu_role` */

DROP TABLE IF EXISTS `menu_role`;

CREATE TABLE `menu_role` (
  `menu_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`menu_id`,`role_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Data for the table `menu_role` */

insert  into `menu_role`(`menu_id`,`role_id`) values (4,1),(4,9),(4,12),(4,13),(5,1),(5,9),(5,11),(5,12);

/*Table structure for table `role` */

DROP TABLE IF EXISTS `role`;

CREATE TABLE `role` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

/*Data for the table `role` */

insert  into `role`(`id`,`name`) values (1,'默认权限'),(2,'测试权限'),(11,'test2'),(13,'test1'),(12,'testa'),(9,'全部权限'),(10,'空权限'),(14,'test3');

/*Table structure for table `user` */

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(15) DEFAULT NULL,
  `password` varchar(30) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

/*Data for the table `user` */

insert  into `user`(`id`,`name`,`password`,`role_id`) values (1,'fanyd','fanyd12',1);

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
  `sqlstr_head` varchar(1000) DEFAULT NULL,
  `sqlstr_body` varchar(1000) DEFAULT NULL,
  `sqlstr_foot` varchar(1000) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

/*Data for the table `wordbook` */

insert  into `wordbook`(`id`,`type`,`flag`,`name`,`colnameid`,`seq`,`menu_sub_id`,`sqlstr_head`,`sqlstr_body`,`sqlstr_foot`) values (1,1,0,'编号ID','id',1,4,NULL,NULL,NULL),(2,1,0,'权限名称','name',2,4,NULL,NULL,NULL),(3,2,0,'权限明细',NULL,3,4,'select role_id mainid,a.id subid,name from menu a,menu_role b where b.menu_id=a.id and role_id in (',NULL,') ;'),(4,3,0,'新增','func_add',1,4,NULL,NULL,NULL),(5,3,0,'批删除','func_delall',2,4,NULL,NULL,NULL),(6,4,0,'搜索',NULL,0,4,NULL,NULL,NULL),(7,5,0,'编辑','func_mod_',1,4,NULL,NULL,NULL),(8,5,1,'删除','func_del_',2,4,NULL,NULL,NULL),(9,6,0,'权限明细','detail',1,4,'select id,name from menu where parent_id>0 group by id;',NULL,NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
