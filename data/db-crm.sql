/*
SQLyog Ultimate v12.5.0 (64 bit)
MySQL - 5.5.53 : Database - db_crm
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_crm` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `db_crm`;

/*Table structure for table `dept` */

DROP TABLE IF EXISTS `dept`;

CREATE TABLE `dept` (
  `dept_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `dept_name` varchar(20) NOT NULL COMMENT '部门名称',
  `dept_leader_id` varchar(10) NOT NULL COMMENT '部门领导id',
  `dept_location` varchar(50) NOT NULL COMMENT '地区',
  `dept_user_id` int(10) NOT NULL,
  PRIMARY KEY (`dept_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/*Table structure for table `goods` */

DROP TABLE IF EXISTS `goods`;

CREATE TABLE `goods` (
  `goods_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '商品id',
  `goods_name` varchar(50) DEFAULT NULL COMMENT '商品名称',
  `goods_fenlei_id` int(10) NOT NULL COMMENT '商品分类id',
  `goods_jinjia` varchar(10) DEFAULT NULL COMMENT '商品进价',
  `goods_price` varchar(10) NOT NULL COMMENT '商品售价',
  `goods_inventory` int(10) NOT NULL DEFAULT '0' COMMENT '商品库存',
  `goods_beizhu` varchar(250) DEFAULT NULL COMMENT '商品备注',
  `goods_litpic` mediumtext COMMENT '商品图片路径',
  `goods_parent_id` int(10) NOT NULL COMMENT '商品所属者id',
  `goods_user_id` int(10) NOT NULL COMMENT '商品创建者id',
  `goods_sign` int(15) DEFAULT NULL COMMENT '商品时间标签',
  PRIMARY KEY (`goods_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/*Table structure for table `goods_fenlei` */

DROP TABLE IF EXISTS `goods_fenlei`;

CREATE TABLE `goods_fenlei` (
  `fenlei_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '分类ID',
  `fenlei_name` varchar(30) NOT NULL COMMENT '分类名称',
  `fenlei_parent_id` int(10) NOT NULL COMMENT '分类设置者父id',
  PRIMARY KEY (`fenlei_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/*Table structure for table `kehu` */

DROP TABLE IF EXISTS `kehu`;

CREATE TABLE `kehu` (
  `id` int(10) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `kehu_parent_id` int(10) NOT NULL COMMENT '客户所属员工id',
  `kehu_number` int(10) NOT NULL COMMENT '客户编号',
  `kehu_name` varchar(50) DEFAULT NULL COMMENT '客户姓名',
  `kehu_phone` varchar(15) DEFAULT NULL COMMENT '客户手机号',
  `kehu_sex` int(1) DEFAULT NULL COMMENT '客户性别',
  `kehu_birthday` varchar(30) DEFAULT NULL COMMENT '生日',
  `kehu_addr` varchar(200) DEFAULT NULL COMMENT '地址',
  `kehu_beizhu` varchar(250) DEFAULT NULL COMMENT '备注信息',
  `kehu_tel2` varchar(15) DEFAULT NULL COMMENT '手机2',
  `kehu_qq` int(15) DEFAULT NULL COMMENT 'qq',
  `kehu_weixin` varchar(20) DEFAULT NULL COMMENT '微信',
  `kehu_email` varchar(30) DEFAULT NULL COMMENT '邮箱',
  `kehu_vip_id` int(2) DEFAULT '1' COMMENT '会员等级id',
  `kehu_created_time` varchar(20) DEFAULT NULL COMMENT '创建客户时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/*Table structure for table `sales` */

DROP TABLE IF EXISTS `sales`;

CREATE TABLE `sales` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `sales_id` int(20) NOT NULL COMMENT '销售订单编号',
  `sales_goods_id` int(10) NOT NULL COMMENT '销售商品id',
  `sales_kehu_id` int(10) NOT NULL COMMENT '客户id',
  `sales_usere_id` int(10) NOT NULL COMMENT '销售人员id',
  `sales_price` varchar(10) NOT NULL COMMENT '销售价格',
  `sales_methods` varchar(20) DEFAULT NULL COMMENT '销售支付方式',
  `sales_number` int(10) NOT NULL COMMENT '销售数量',
  `sales_time` varchar(20) DEFAULT NULL COMMENT '订单时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `services` */

DROP TABLE IF EXISTS `services`;

CREATE TABLE `services` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `service_name` varchar(60) DEFAULT NULL COMMENT '服务名称',
  `service_leibie` varchar(20) DEFAULT NULL COMMENT '服务分类',
  `service_price` varchar(20) DEFAULT NULL COMMENT '服务价格',
  `service_neirong` varchar(5000) DEFAULT NULL COMMENT '服务内容详细',
  `service_beizhu` varchar(250) DEFAULT NULL COMMENT '备注信息',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*Table structure for table `user_group` */

DROP TABLE IF EXISTS `user_group`;

CREATE TABLE `user_group` (
  `group_id` int(10) NOT NULL AUTO_INCREMENT COMMENT '用户组id',
  `group_name` varchar(20) DEFAULT NULL COMMENT '用户组名',
  `group_desc` varchar(20) DEFAULT NULL COMMENT '用户组描述',
  PRIMARY KEY (`group_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '用户id',
  `user_name` varchar(10) NOT NULL COMMENT '用户名',
  `user_pwd` varchar(64) NOT NULL COMMENT '用户密码',
  `user_sex` int(1) NOT NULL COMMENT '用户性别 0-男 1-女',
  `user_store_name` varchar(50) NOT NULL COMMENT '用户店铺名称',
  `user_dept_id` int(11) NOT NULL DEFAULT '0' COMMENT '用户部门id',
  `user_group_id` int(11) NOT NULL COMMENT '用户组id',
  `user_token` varchar(32) NOT NULL COMMENT '用户token',
  `user_currenname` varchar(20) NOT NULL COMMENT '用户真实姓名',
  `user_parent_id` int(10) NOT NULL COMMENT '用户上级id',
  PRIMARY KEY (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/*Table structure for table `vip_level` */

DROP TABLE IF EXISTS `vip_level`;

CREATE TABLE `vip_level` (
  `id` int(2) NOT NULL AUTO_INCREMENT COMMENT 'id',
  `level` int(2) DEFAULT NULL COMMENT '会员等级',
  `desc` varchar(10) DEFAULT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
