-- phpMyAdmin SQL Dump
-- version 3.4.8
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2013 年 09 月 13 日 03:10
-- 服务器版本: 5.1.60
-- PHP 版本: 5.2.17p1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 数据库: `openvpn`
--

-- --------------------------------------------------------

--
-- 表的结构 `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `username` char(32) NOT NULL,
  KEY `username` (`username`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `coin`
--

DROP TABLE IF EXISTS `coin`;
CREATE TABLE IF NOT EXISTS `coin` (
  `user` varchar(20) NOT NULL,
  `type` text NOT NULL,
  `date` double NOT NULL,
  `num` varchar(10) NOT NULL,
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=gbk;

-- --------------------------------------------------------

--
-- 表的结构 `cookie`
--

DROP TABLE IF EXISTS `cookie`;
CREATE TABLE IF NOT EXISTS `cookie` (
  `sso` varchar(64) NOT NULL,
  `user` varchar(20) NOT NULL,
  `ip` varchar(20) NOT NULL,
  `time` int(12) NOT NULL,
  KEY `user` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `info`
--

DROP TABLE IF EXISTS `info`;
CREATE TABLE IF NOT EXISTS `info` (
  `content` longtext CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  `type` text NOT NULL,
  `subject` varchar(20) NOT NULL DEFAULT 'info',
  `date` int(11) NOT NULL,
  `ip` varchar(16) NOT NULL,
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `username` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `start_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `end_time` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `trusted_ip` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `trusted_port` int(10) DEFAULT NULL,
  `protocol` varchar(16) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remote_ip` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remote_netmask` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bytes_received` bigint(20) DEFAULT '0',
  `bytes_sent` bigint(20) DEFAULT '0',
  `status` int(10) NOT NULL DEFAULT '1',
  `total_used` bigint(20) NOT NULL DEFAULT '0',
  KEY `idx_username` (`username`),
  KEY `idx_start_time` (`start_time`),
  KEY `idx_end_time` (`end_time`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 表的结构 `resource`
--

DROP TABLE IF EXISTS `resource`;
CREATE TABLE IF NOT EXISTS `resource` (
  `name` varchar(80) DEFAULT NULL,
  `date` int(11) DEFAULT NULL,
  `description` text,
  `ip` varchar(16) NOT NULL,
  `downloadtimes` int(5) NOT NULL,
  `user` varchar(20) NOT NULL,
  `comment` int(11) NOT NULL DEFAULT '0',
  `subject` char(33) NOT NULL,
  KEY `name` (`name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `subject` char(22) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `name` char(33) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `show` int(11) NOT NULL DEFAULT '1',
  `remark` text CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  UNIQUE KEY `subject` (`subject`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 表的结构 `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `username` char(32) COLLATE utf8_unicode_ci NOT NULL,
  `password` char(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  `active` int(10) NOT NULL DEFAULT '1',
  `creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `name` char(32) CHARACTER SET gbk COLLATE gbk_bin NOT NULL,
  `email` char(128) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(300) CHARACTER SET gbk COLLATE gbk_bin NOT NULL,
  `quota_cycle` int(10) NOT NULL DEFAULT '30',
  `quota_bytes` bigint(20) NOT NULL DEFAULT '1073741824',
  `enabled` int(10) NOT NULL DEFAULT '1',
  `used_quota` bigint(20) NOT NULL DEFAULT '0',
  `left_quota` bigint(20) NOT NULL DEFAULT '1073741824',
  `coin` int(11) NOT NULL DEFAULT '100',
  PRIMARY KEY (`username`),
  KEY `idx_active` (`active`),
  KEY `idx_enabled` (`enabled`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
