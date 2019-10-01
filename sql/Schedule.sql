/*
Navicat MySQL Data Transfer

Source Server         : beautymaster
Source Server Version : 80011
Source Host           : localhost:3306
Source Database       : beautymaster

Target Server Type    : MYSQL
Target Server Version : 80011
File Encoding         : 65001

Date: 2019-10-01 11:57:31
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for schedule
-- ----------------------------
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `Id` int(11) NOT NULL,
  `Yeahr` varchar(11) DEFAULT NULL,
  `Month` varchar(11) DEFAULT NULL,
  `EmployeeId` int(11) DEFAULT NULL,
  `Days` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SET FOREIGN_KEY_CHECKS=1;
