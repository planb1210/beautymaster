/*
Navicat MySQL Data Transfer

Source Server         : beautymaster
Source Server Version : 80011
Source Host           : localhost:3306
Source Database       : beautymaster

Target Server Type    : MYSQL
Target Server Version : 80011
File Encoding         : 65001

Date: 2019-07-24 22:01:52
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for skills
-- ----------------------------
DROP TABLE IF EXISTS `skills`;
CREATE TABLE `skills` (
  `Id` int(11) NOT NULL,
  `EmployeeId` int(11) DEFAULT NULL,
  `ServiceId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of skills
-- ----------------------------
INSERT INTO `skills` VALUES ('1', '2', '1');
INSERT INTO `skills` VALUES ('2', '2', '2');
INSERT INTO `skills` VALUES ('3', '3', '3');
SET FOREIGN_KEY_CHECKS=1;
