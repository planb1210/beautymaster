/*
Navicat MySQL Data Transfer

Source Server         : beautymaster
Source Server Version : 80011
Source Host           : localhost:3306
Source Database       : beautymaster

Target Server Type    : MYSQL
Target Server Version : 80011
File Encoding         : 65001

Date: 2019-10-21 16:37:30
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for booking
-- ----------------------------
DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `EmployeeId` int(11) DEFAULT NULL,
  `ServiceId` int(11) DEFAULT NULL,
  `ClientId` int(11) DEFAULT NULL,
  `BookingTime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `Comment` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
SET FOREIGN_KEY_CHECKS=1;
