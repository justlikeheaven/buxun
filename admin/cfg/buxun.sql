-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- 主机: 127.0.0.1
-- 生成日期: 2015 年 08 月 17 日 18:00
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
-- 表的结构 `cloth`
--

CREATE TABLE IF NOT EXISTS `cloth` (
  `id` int(10) NOT NULL,
  `cateid` int(10) NOT NULL COMMENT '类别id',
  `sellerid` int(10) NOT NULL COMMENT '卖家id',
  `name` varchar(50) NOT NULL COMMENT '名称',
  `price` int(10) NOT NULL COMMENT '价格',
  `img` varchar(200) NOT NULL COMMENT '图片',
  `ctime` int(10) NOT NULL COMMENT '创建时间',
  `mtime` int(10) NOT NULL COMMENT '修改时间'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='布料';

-- --------------------------------------------------------

--
-- 表的结构 `cloth_cate`
--

CREATE TABLE IF NOT EXISTS `cloth_cate` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(20) NOT NULL COMMENT '名称',
  `desc` varchar(100) NOT NULL COMMENT '描述'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT COMMENT='布料分类';

-- --------------------------------------------------------

--
-- 表的结构 `seller`
--

CREATE TABLE IF NOT EXISTS `seller` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` char(30) NOT NULL COMMENT '名称',
  `desc` varchar(300) NOT NULL COMMENT '描述',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COMMENT='商家' AUTO_INCREMENT=6 ;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL,
  `username` char(20) NOT NULL COMMENT '用户名',
  `passwrod` char(32) NOT NULL COMMENT '密码'
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户';

-- --------------------------------------------------------

--
-- 表的结构 `user_collect_cloth`
--

CREATE TABLE IF NOT EXISTS `user_collect_cloth` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `clothid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户收藏布料表';

-- --------------------------------------------------------

--
-- 表的结构 `user_collect_seller`
--

CREATE TABLE IF NOT EXISTS `user_collect_seller` (
  `id` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `sellerid` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COMMENT='用户收藏布料表';

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
