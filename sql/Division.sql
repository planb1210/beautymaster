/*
Navicat MySQL Data Transfer

Source Server         : beautymaster
Source Server Version : 80011
Source Host           : localhost:3306
Source Database       : beautymaster

Target Server Type    : MYSQL
Target Server Version : 80011
File Encoding         : 65001

Date: 2019-07-24 22:00:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for division
-- ----------------------------
DROP TABLE IF EXISTS `division`;
CREATE TABLE `division` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Description` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of division
-- ----------------------------
INSERT INTO `division` VALUES ('1', 'Парикмахерская', 'збс парикмахерская');
INSERT INTO `division` VALUES ('2', 'Маникюрная', 'маник');
SET FOREIGN_KEY_CHECKS=1;
