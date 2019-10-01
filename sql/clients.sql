/*
Navicat MySQL Data Transfer

Source Server         : beautymaster
Source Server Version : 80011
Source Host           : localhost:3306
Source Database       : beautymaster

Target Server Type    : MYSQL
Target Server Version : 80011
File Encoding         : 65001

Date: 2019-10-01 11:57:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for clients
-- ----------------------------
DROP TABLE IF EXISTS `clients`;
CREATE TABLE `clients` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Phone` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SET FOREIGN_KEY_CHECKS=1;
