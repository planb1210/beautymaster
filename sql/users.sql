/*
Navicat MySQL Data Transfer

Source Server         : beautymaster
Source Server Version : 80011
Source Host           : localhost:3306
Source Database       : beautymaster

Target Server Type    : MYSQL
Target Server Version : 80011
File Encoding         : 65001

Date: 2019-10-01 11:57:51
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(500) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL,
  `Role` int(255) DEFAULT NULL,
  `Password` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SET FOREIGN_KEY_CHECKS=1;
