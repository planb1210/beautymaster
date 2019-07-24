/*
Navicat MySQL Data Transfer

Source Server         : beautymaster
Source Server Version : 80011
Source Host           : localhost:3306
Source Database       : beautymaster

Target Server Type    : MYSQL
Target Server Version : 80011
File Encoding         : 65001

Date: 2019-07-24 22:02:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for booking
-- ----------------------------
DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking` (
  `Id` int(11) NOT NULL,
  `EmployeeId` int(11) DEFAULT NULL,
  `ServiceId` int(11) DEFAULT NULL,
  `BookingDate` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of booking
-- ----------------------------
INSERT INTO `booking` VALUES ('1', '2', '1', '2019-07-25 22:00:00');
SET FOREIGN_KEY_CHECKS=1;
