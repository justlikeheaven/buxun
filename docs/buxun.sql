-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2015 年 08 月 24 日 20:16
-- 服务器版本: 5.5.27
-- PHP 版本: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `buxun`
--

-- --------------------------------------------------------

--
-- 表的结构 `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE IF NOT EXISTS `product` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `cateid` int(10) NOT NULL COMMENT '类别id',
  `sellerid` int(10) NOT NULL COMMENT '卖家id',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `price` int(10) NOT NULL COMMENT '价格',
  `img_model` varchar(50) NOT NULL COMMENT '模特效果图',
  `img_product` varchar(50) NOT NULL DEFAULT '' COMMENT '布料高清大图',
  `desc` text NOT NULL COMMENT '详细介绍',
  `ctime` int(10) NOT NULL COMMENT '创建时间',
  `mtime` int(10) NOT NULL COMMENT '修改时间',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='布料';

-- --------------------------------------------------------

--
-- 表的结构 `product_hot`
--

DROP TABLE IF EXISTS `product_hot`;
CREATE TABLE IF NOT EXISTS `product_hot` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` int(10) unsigned NOT NULL COMMENT '商品id',
  `hot` tinyint(1) unsigned NOT NULL COMMENT '是否最热，0-否，1-是',
  PRIMARY KEY (`id`),
  UNIQUE KEY `product_id` (`product_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='最热商品';

-- --------------------------------------------------------

--
-- 表的结构 `seller`
--

DROP TABLE IF EXISTS `seller`;
CREATE TABLE IF NOT EXISTS `seller` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL COMMENT '名称',
  `desc` text NOT NULL COMMENT '描述',
  `img` varchar(100) NOT NULL COMMENT '商家图片',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商家';

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` char(20) NOT NULL COMMENT '用户名',
  `passwrod` char(32) NOT NULL COMMENT '密码',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户';

-- --------------------------------------------------------

--
-- 表的结构 `user_collect_cloth`
--

DROP TABLE IF EXISTS `user_collect_cloth`;
CREATE TABLE IF NOT EXISTS `user_collect_cloth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `clothid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户收藏布料表';

-- --------------------------------------------------------

--
-- 表的结构 `user_collect_seller`
--

DROP TABLE IF EXISTS `user_collect_seller`;
CREATE TABLE IF NOT EXISTS `user_collect_seller` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `sellerid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户收藏布料表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
