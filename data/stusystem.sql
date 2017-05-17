-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 2017-05-15 12:06:33
-- 服务器版本： 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `stusystem`
--

-- --------------------------------------------------------

--
-- 表的结构 `stu_admin`
--

CREATE TABLE IF NOT EXISTS `stu_admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `stu_admin`
--

INSERT INTO `stu_admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'admin@admin.com'),
(21, 'liwei', '97e8ee2f4ad8a1a455f668b6a059d32a', 'liwei_2014@outlook.com'),
(23, 'lidawei', '39e3dcadd5a95f049fe6966cecd75dde', 'liwei_2014@outlook.com'),
(26, '铁柱', 'c835e66e3123fbc35076a98f03006562', 'tiezhu@tiezhu.com'),
(27, '大牛', '76720c5adee75ce9c7779500893fb648', 'daniu@daniu.com'),
(28, 'maguang', 'cc87aad452b5a62dbf42519f0a22c6ea', 'maguang@maguang.com'),
(29, '张三', '01d7f40760960e7bd9443513f22ab9af', 'zhangsan@admin.com');

-- --------------------------------------------------------

--
-- 表的结构 `stu_class`
--

CREATE TABLE IF NOT EXISTS `stu_class` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `sId` int(10) unsigned NOT NULL,
  `cName` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=15 ;

--
-- 转存表中的数据 `stu_class`
--

INSERT INTO `stu_class` (`id`, `sId`, `cName`) VALUES
(1, 0, '汉语1班'),
(2, 0, '汉语2班'),
(5, 1, '数学1班'),
(8, 2, '英语1班'),
(9, 2, '英语2班'),
(14, 1, '数学2班');

-- --------------------------------------------------------

--
-- 表的结构 `stu_list`
--

CREATE TABLE IF NOT EXISTS `stu_list` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `sName` varchar(255) NOT NULL,
  `sId` int(10) NOT NULL,
  `cId` int(10) unsigned NOT NULL,
  `sSex` char(4) NOT NULL,
  `sNumber` char(13) NOT NULL,
  `sAddress` char(150) NOT NULL,
  `sRegTime` int(11) NOT NULL,
  `addTime` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- 转存表中的数据 `stu_list`
--

INSERT INTO `stu_list` (`id`, `sName`, `sId`, `cId`, `sSex`, `sNumber`, `sAddress`, `sRegTime`, `addTime`) VALUES
(25, '小花', 2, 8, '女', '2013000001021', '小花的家', 1375912800, 1494712800),
(27, '小王', 0, 1, '男', '2013000001023', '小王的家', 1430431200, 1494712800),
(29, '小王', 0, 1, '男', '2013000001025', '小王的家', 1375912800, 1494712800),
(30, '小王', 1, 5, '男', '2013000001026', '小王的家', 1368050400, 1494712800),
(31, '小王', 0, 1, '男', '2013000001027', '小王的家', 1375912800, 1494712800),
(32, '小王', 2, 8, '男', '2013000001028', '小王的家', 1408053600, 1494712800),
(33, '小王', 0, 1, '男', '2013000001029', '小王的家', 1375912800, 1494712800),
(34, '小王', 1, 5, '男', '2013000001030', '小王的家', 1376344800, 1494712800),
(35, '小王', 0, 1, '男', '2013000001031', '小王的家', 1375912800, 1494712800),
(36, '小王', 0, 1, '男', '2013000001032', '小王的家', 1375912800, 1494712800),
(37, '小红', 2, 9, '男', '2017002009037', '小红的家', 1502316000, 1494712800),
(38, '李伟', 2, 9, '男', '2014002009038', '老李家', 1409522400, 1494712800),
(39, '老马', 1, 5, '男', '2016001007039', '老马的家', 1464732000, 1494712800),
(40, '小纯', 0, 2, '男', '2014000002040', '小纯的家乡', 1401573600, 1494799200),
(41, '小树', 1, 14, '男', '2014000001041', '小数的家乡', 1462053600, 1494799200);

-- --------------------------------------------------------

--
-- 表的结构 `stu_school`
--

CREATE TABLE IF NOT EXISTS `stu_school` (
  `id` int(10) unsigned NOT NULL,
  `sName` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 转存表中的数据 `stu_school`
--

INSERT INTO `stu_school` (`id`, `sName`) VALUES
(0, '汉语系'),
(1, '数学系'),
(2, '英语系');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
