/*
 Navicat MySQL Data Transfer

 Source Server         : localhost
 Source Server Type    : MySQL
 Source Server Version : 50505
 Source Host           : localhost
 Source Database       : sense

 Target Server Type    : MySQL
 Target Server Version : 50505
 File Encoding         : utf-8

 Date: 04/03/2018 15:37:57 PM
*/

SET NAMES utf8;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
--  Table structure for `option`
-- ----------------------------
DROP TABLE IF EXISTS `option`;
CREATE TABLE `option` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL COMMENT '问题的id',
  `option` varchar(4) NOT NULL,
  `description` varchar(128) NOT NULL,
  `creator_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `option`
-- ----------------------------
BEGIN;
INSERT INTO `option` VALUES ('1', '1', 'A', '选项描述A', '1'), ('2', '1', 'B', '选项描述B', '1'), ('3', '1', 'C', '选项描述C', '1'), ('4', '1', 'D', '选项描述D', '1');
COMMIT;

-- ----------------------------
--  Table structure for `participant`
-- ----------------------------
DROP TABLE IF EXISTS `participant`;
CREATE TABLE `participant` (
  `id` int(11) NOT NULL,
  `q_id` int(11) NOT NULL COMMENT '问卷id',
  `q_title` varchar(128) NOT NULL,
  `participant_id` int(11) NOT NULL COMMENT '参与人id',
  `participant` varchar(64) NOT NULL COMMENT '参与人昵称',
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
--  Table structure for `question`
-- ----------------------------
DROP TABLE IF EXISTS `question`;
CREATE TABLE `question` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `q_id` int(11) NOT NULL,
  `question` varchar(128) NOT NULL,
  `create_at` datetime NOT NULL,
  `creator_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `question`
-- ----------------------------
BEGIN;
INSERT INTO `question` VALUES ('1', '1', '问题1', '2018-04-02 09:13:23', '1'), ('2', '1', '问题2', '2018-04-02 09:13:33', '1'), ('3', '1', '问题3', '2018-04-02 09:13:55', '1');
COMMIT;

-- ----------------------------
--  Table structure for `questionnaire`
-- ----------------------------
DROP TABLE IF EXISTS `questionnaire`;
CREATE TABLE `questionnaire` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `creator_id` int(11) NOT NULL,
  `create_at` datetime NOT NULL,
  `delete` int(2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `questionnaire`
-- ----------------------------
BEGIN;
INSERT INTO `questionnaire` VALUES ('1', '问卷主题1', '1', '2018-04-02 08:48:23', '1');
COMMIT;

-- ----------------------------
--  Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `username` varchar(32) NOT NULL,
  `password` varchar(64) NOT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `create_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
--  Records of `user`
-- ----------------------------
BEGIN;
INSERT INTO `user` VALUES ('1', '维托', 'Vito', 'e10adc3949ba59abbe56e057f20f883e', '15895348728', '2018-03-30 00:00:00'), ('2', '维托1', 'Vito1', 'fcea920f7412b5da7be0cf42b8c93759', '15895348727', '2018-03-30 16:21:07');
COMMIT;

SET FOREIGN_KEY_CHECKS = 1;
