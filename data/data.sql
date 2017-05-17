CREATE DATABASE IF NOT EXISTS `stuSystem`;
USE `stuSystem`;

-- 管理员表 --
DROP TABLE IF EXISTS `stu_admin`;
CREATE TABLE `stu_admin`(
  `id` TINYINT UNSIGNED AUTO_INCREMENT KEY ,
  `username` VARCHAR(20) NOT NULL UNIQUE,
  `password` VARCHAR(32) NOT NULL,
  `email` VARCHAR(60) NOT NULL
);

-- 系别 --
DROP TABLE IF EXISTS `stu_school`;
CREATE TABLE `stu_school`(
  `id` INT UNSIGNED NOT NULL KEY,
  `sName` VARCHAR(30) NOT NULL
);

-- 班级 --
DROP TABLE IF EXISTS `stu_class`;
CREATE TABLE `stu_class`(
  `id` INT UNSIGNED NOT NULL KEY,
  `sId` INT UNSIGNED NOT NULL ,
  `cName` VARCHAR(30) NOT NULL
);

-- 学生 --
DROP TABLE IF EXISTS `stu_list`;
CREATE TABLE `stu_list`(
  `id` SMALLINT UNSIGNED NOT NULL AUTO_INCREMENT KEY,
  `sName` VARCHAR(255) NOT NULL,
  `cId` INT UNSIGNED NOT NULL ,
  `sSex` CHAR(4) NOT NULL ,
  `sNumber` CHAR(12) NOT NULL,
  `sAddress` CHAR(150) NOT NULL ,
  `sRegTime` INT(11) NOT NULL ,
  `addTime` INT(11) NOT NULL
);