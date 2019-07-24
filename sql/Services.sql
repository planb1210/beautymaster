/*
Navicat MySQL Data Transfer

Source Server         : beautymaster
Source Server Version : 80011
Source Host           : localhost:3306
Source Database       : beautymaster

Target Server Type    : MYSQL
Target Server Version : 80011
File Encoding         : 65001

Date: 2019-07-24 22:02:54
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for services
-- ----------------------------
DROP TABLE IF EXISTS `services`;
CREATE TABLE `services` (
  `Id` int(11) NOT NULL,
  `Name` varchar(255) DEFAULT NULL,
  `Price` int(10) DEFAULT NULL,
  `Duration` float(10,0) DEFAULT NULL,
  `DivisionId` int(11) DEFAULT NULL,
  `Description` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- ----------------------------
-- Records of services
-- ----------------------------
INSERT INTO `services` VALUES ('1', 'Мужская стрижка', '200', '1', '1', 'Супер-пупер стрижка');
INSERT INTO `services` VALUES ('2', 'Женская трижка', '400', '1', '1', 'Женская супер стрижка');
INSERT INTO `services` VALUES ('3', 'Маникюр', '700', '2', '2', 'Отличнейший маникюр');
SET FOREIGN_KEY_CHECKS=1;
