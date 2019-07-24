/*
Navicat MySQL Data Transfer

Source Server         : beautymaster
Source Server Version : 80011
Source Host           : localhost:3306
Source Database       : beautymaster

Target Server Type    : MYSQL
Target Server Version : 80011
File Encoding         : 65001

Date: 2019-07-24 22:02:01
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for schedule
-- ----------------------------
DROP TABLE IF EXISTS `schedule`;
CREATE TABLE `schedule` (
  `Id` int(11) DEFAULT NULL,
  `Yeahr` int(11) DEFAULT NULL,
  `Month` int(11) DEFAULT NULL,
  `EmployeeId` int(11) DEFAULT NULL,
  `Days` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of schedule
-- ----------------------------
INSERT INTO `schedule` VALUES ('1', '2019', '7', '2', '1;2;5;6;9;10;11;13;14');
SET FOREIGN_KEY_CHECKS=1;
