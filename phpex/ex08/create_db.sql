-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: Jun 08, 2011, 01:31 PM
-- 伺服器版本: 6.0.4
-- PHP 版本: 6.0.0-dev

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `guestbook2`
-- 
-- CREATE DATABASE `guestbook` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
-- USE `b13_25362198_guestbook`;
USE `tryDB`;
-- --------------------------------------------------------

-- 
-- 資料表格式： `message`
-- 

CREATE TABLE `member` (
  `id` int(15) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;


