-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- �D��: localhost
-- �إߤ��: Nov 29, 2013, 05:28 AM
-- ���A������: 5.0.51
-- PHP ����: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- ��Ʈw: `test`
-- 

-- --------------------------------------------------------

-- 
-- ��ƪ�榡�G `person2`
-- 

CREATE TABLE `person2` (
  `id` tinyint(3) NOT NULL auto_increment,
  `name` varchar(10) NOT NULL default '',
  `phone` varchar(12) NOT NULL default '',
  `address` varchar(50) default NULL,
  `birthday` date default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 ;

-- 
-- �C�X�H�U��Ʈw���ƾڡG `person2`
-- 

INSERT INTO `person2` VALUES (1, '�}�o��', '1234567', '�������T����', '1980-02-14');
INSERT INTO `person2` VALUES (2, '�����p', '7654321', '�����������', '1980-12-13');
INSERT INTO `person2` VALUES (3, '���ߤ�', '5432456', '��������s��', '1976-01-17');
INSERT INTO `person2` VALUES (4, '�d�ު�', '3136783', '���������Y�m', '1979-11-05');
INSERT INTO `person2` VALUES (5, '�\�\�\', '8730933', '�x�n�����q�m', '1980-04-30');
INSERT INTO `person2` VALUES (6, '���K�p', '3675512', '���L���椻��', '1980-05-22');
INSERT INTO `person2` VALUES (7, '��  ��', '8719938', '�������T����', '1981-01-09');
INSERT INTO `person2` VALUES (8, '�}�ө�', '3918274', '���������s��', '1979-12-31');
INSERT INTO `person2` VALUES (9, '�P�R��', '3847349', '�x�n���ñd��', '1976-11-11');
INSERT INTO `person2` VALUES (10, '�P�q��', '3782393', '�Ÿq�����l��', '1981-02-11');
INSERT INTO `person2` VALUES (11, '�G�ꦨ', '7842742', '�����������', '1978-05-14');
INSERT INTO `person2` VALUES (12, '�d�T�N', '6748242', '���������s��', '1977-07-25');
