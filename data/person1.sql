-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: Nov 29, 2013, 05:28 AM
-- 伺服器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `test`
-- 

-- --------------------------------------------------------

-- 
-- 資料表格式： `person1`
-- 

CREATE TABLE `person1` (
  `id` tinyint(3) NOT NULL auto_increment,
  `name` varchar(10) NOT NULL default '',
  `phone` varchar(12) NOT NULL default '',
  `address` varchar(50) default NULL,
  `birthday` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 ;

-- 
-- 列出以下資料庫的數據： `person1`
-- 

INSERT INTO `person1` VALUES (1, '徐得恩', '1234567', '高雄市三民區', '1980-02-14');
INSERT INTO `person1` VALUES (2, '莊明峰', '7654321', '高雄市左營區', '1980-12-13');
INSERT INTO `person1` VALUES (3, '陳立夫', '5432456', '高雄縣鳳山市', '1976-01-17');
INSERT INTO `person1` VALUES (4, '吳技炎', '3136783', '高雄縣僑頭鄉', '1979-11-05');
INSERT INTO `person1` VALUES (5, '許功蓋', '8730933', '台南縣關廟鄉', '1980-04-30');
INSERT INTO `person1` VALUES (6, '郭春如', '3675512', '雲林縣斗六市', '1980-05-22');
INSERT INTO `person1` VALUES (7, '葛  悅', '8719938', '高雄市三民區', '1981-01-09');
INSERT INTO `person1` VALUES (8, '徐志明', '3918274', '高雄市鼓山區', '1979-12-31');
INSERT INTO `person1` VALUES (9, '周麗華', '3847349', '台南縣永康市', '1976-11-11');
INSERT INTO `person1` VALUES (10, '周秀芳', '3782393', '嘉義縣朴子市', '1981-02-11');
INSERT INTO `person1` VALUES (11, '鄭國成', '7842742', '高雄市左營區', '1978-05-14');
INSERT INTO `person1` VALUES (12, '吳俊吉', '6748242', '高雄縣岡山鎮', '1977-07-25');
