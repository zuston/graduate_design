# ************************************************************
# Sequel Pro SQL dump
# Version 4500
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.1.63)
# Database: bookManage
# Generation Time: 2016-04-13 17:24:23 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin`;

CREATE TABLE `admin` (
  `admin_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(20) NOT NULL DEFAULT '' COMMENT '管理员名',
  `admin_password` varchar(20) NOT NULL DEFAULT '' COMMENT '管理员密码',
  `admin_provision` tinyint(4) NOT NULL COMMENT '管理员权限：1=>全部权限，2=>查看权限，3=>部分修改权限',
  PRIMARY KEY (`admin_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;

INSERT INTO `admin` (`admin_id`, `admin_name`, `admin_password`, `admin_provision`)
VALUES
	(1,'zuston','zuston',1);

/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table admin_book_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_book_log`;

CREATE TABLE `admin_book_log` (
  `abl_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `adl_count` int(11) NOT NULL COMMENT '添加数量',
  `adl_create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`abl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table admin_login_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `admin_login_log`;

CREATE TABLE `admin_login_log` (
  `all_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) NOT NULL,
  `all_login_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`all_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table book
# ------------------------------------------------------------

DROP TABLE IF EXISTS `book`;

CREATE TABLE `book` (
  `book_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `book_code` varchar(20) NOT NULL DEFAULT '' COMMENT '书籍编号：E1234',
  `book_name` varchar(20) NOT NULL DEFAULT '' COMMENT '书籍名称',
  `book_author` varchar(20) NOT NULL DEFAULT '' COMMENT '书籍作者',
  `book_price` int(11) NOT NULL COMMENT '书籍价格（转化为分）',
  `book_type` tinyint(4) NOT NULL COMMENT '书籍类别：1=>文史，2=>理工科，3=>医学',
  `book_count` int(11) NOT NULL COMMENT '书籍藏量',
  PRIMARY KEY (`book_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;

INSERT INTO `book` (`book_id`, `book_code`, `book_name`, `book_author`, `book_price`, `book_type`, `book_count`)
VALUES
	(1,'E1234','老人与海','海明威',3200,1,4);

/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `user_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_name` varchar(20) NOT NULL DEFAULT '' COMMENT '用户名',
  `user_email` varchar(20) NOT NULL DEFAULT '' COMMENT '邮箱',
  `user_password` varchar(20) NOT NULL DEFAULT '' COMMENT '密码',
  `user_age` int(11) NOT NULL COMMENT '年龄',
  `user_sex` tinyint(4) NOT NULL COMMENT '性别；1=>男，0=>女',
  `user_class` int(11) DEFAULT '0' COMMENT '班级: 71（班）',
  `user_type` tinyint(4) DEFAULT '0' COMMENT '用户类型：0=>教师，1=>本科，2=>研究生，3=>博士',
  `user_major` tinyint(11) DEFAULT '0' COMMENT '用户专业：0=>教师，1=>软件工程，2=>物联网，3=>计算机师范,',
  `user_grade` int(11) DEFAULT '0' COMMENT '用户年级：2012(级)',
  `user_academy` tinyint(4) DEFAULT '0' COMMENT '用户学院：0=>教师，1=>计算机，2=>外国语',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`user_id`, `user_name`, `user_email`, `user_password`, `user_age`, `user_sex`, `user_class`, `user_type`, `user_major`, `user_grade`, `user_academy`)
VALUES
	(1,'张俊帆','jinxi32@163.com','shacha123',24,1,71,1,1,2012,1);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_book_relation
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_book_relation`;

CREATE TABLE `user_book_relation` (
  `ubr_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `book_id` int(11) NOT NULL,
  `ubr_create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '用户借书日',
  `ubr_due_at` timestamp NULL DEFAULT NULL COMMENT '用户还书到期日',
  `ubr_absorted` tinyint(4) NOT NULL DEFAULT '0' COMMENT '借书用户和书关系表，表是否还书的状态码：0=>已废弃，1=>可用',
  PRIMARY KEY (`ubr_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `user_book_relation` WRITE;
/*!40000 ALTER TABLE `user_book_relation` DISABLE KEYS */;

INSERT INTO `user_book_relation` (`ubr_id`, `user_id`, `book_id`, `ubr_create_at`, `ubr_due_at`, `ubr_absorted`)
VALUES
	(1,1,1,'2016-04-09 21:27:48','2016-05-09 00:00:00',0);

/*!40000 ALTER TABLE `user_book_relation` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user_login_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_login_log`;

CREATE TABLE `user_login_log` (
  `ull_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `ull_login_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ull_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table user_state_log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user_state_log`;

CREATE TABLE `user_state_log` (
  `usl_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `usl_state` tinyint(4) NOT NULL COMMENT '用户借书状态:1=>无借书，2=>借书中，3=>到期未还',
  `usl_total_count` int(11) NOT NULL COMMENT '用户总的可借',
  `usl_rest_count` int(11) NOT NULL COMMENT '用户剩余可借数量',
  PRIMARY KEY (`usl_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `user_state_log` WRITE;
/*!40000 ALTER TABLE `user_state_log` DISABLE KEYS */;

INSERT INTO `user_state_log` (`usl_id`, `user_id`, `usl_state`, `usl_total_count`, `usl_rest_count`)
VALUES
	(1,1,2,4,3);

/*!40000 ALTER TABLE `user_state_log` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
