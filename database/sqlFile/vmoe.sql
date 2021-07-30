/*
 Navicat Premium Data Transfer

 Source Server Type    : MySQL
 Source Server Version : 50733
 Source Schema         : vmoe

 Target Server Type    : MySQL
 Target Server Version : 50733
 File Encoding         : 65001

 Date: 26/07/2021 18:29:22
*/

SET NAMES utf8mb4;
SET
FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for user
-- ----------------------------
DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user`
(
    `id`          int unsigned NOT NULL AUTO_INCREMENT,
    `account`     char(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin     NOT NULL DEFAULT '' COMMENT '设备唯一标识',
    `phone`       char(15) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin     NOT NULL DEFAULT '' COMMENT '手机号',
    `avatar`      varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '头像',
    `nickname`    varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '昵称',
    `status`      tinyint unsigned NOT NULL COMMENT '状态 0已封禁1生效2申请中',
    `inviter`     int unsigned NOT NULL DEFAULT '0' COMMENT '邀请人',
    `soft_delete` int unsigned NOT NULL DEFAULT '0' COMMENT '软删除',
    `create_time` int unsigned NOT NULL,
    `update_time` int unsigned NOT NULL,
    `lat`         decimal(10, 6)                                                  DEFAULT NULL COMMENT '纬度',
    `lng`         decimal(10, 6)                                                  DEFAULT NULL COMMENT '精度',
    PRIMARY KEY (`id`),
    UNIQUE KEY `u_account` (`account`,`soft_delete`) USING BTREE,
    KEY           `i_account` (`account`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;
-- ----------------------------
-- Table structure for user_login
-- ----------------------------
DROP TABLE IF EXISTS `user_login`;
CREATE TABLE `user_login`
(
    `id`          int(10) unsigned NOT NULL AUTO_INCREMENT,
    `account`     char(20) COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '设备唯一标识',
    `salt`        char(4) COLLATE utf8mb4_bin           DEFAULT NULL COMMENT '盐值',
    `password`    char(32) COLLATE utf8mb4_bin NOT NULL COMMENT '密码',
    `user_id`     int(10) unsigned NOT NULL COMMENT '用户id',
    `create_time` int(10) unsigned NOT NULL,
    `update_time` int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`),
    KEY           `i_account` (`account`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;


DROP TABLE IF EXISTS `collect`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `collect`
(
    `id`          int unsigned NOT NULL AUTO_INCREMENT,
    `uid`         int unsigned NOT NULL COMMENT '用户id',
    `service_id`  int unsigned NOT NULL COMMENT '服务表id',
    `create_time` int unsigned NOT NULL,
    `update_time` int unsigned NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='服务收藏表';

DROP TABLE IF EXISTS `number`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `number`
(
    `id`          int unsigned NOT NULL AUTO_INCREMENT,
    `uid`         int unsigned NOT NULL COMMENT '用户id',
    `title`       varchar(255) COLLATE utf8mb4_bin DEFAULT NULL COMMENT '标题',
    `start_time`  int unsigned NOT NULL COMMENT '服务表id',
    `is_end`      tinyint unsigned NOT NULL DEFAULT '0' COMMENT '是否结束',
    `soft_delete` tinyint unsigned NOT NULL DEFAULT '0' COMMENT '软删除',
    `create_time` int unsigned NOT NULL,
    `update_time` int unsigned NOT NULL,
    `who_is_now`  int unsigned NOT NULL COMMENT '现在到了哪个号 row表id',
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='排号表';


DROP TABLE IF EXISTS `number_row`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `number_row`
(
    `id`             int unsigned NOT NULL AUTO_INCREMENT,
    `uid`            int unsigned NOT NULL COMMENT '用户id',
    `number_id`      int unsigned NOT NULL COMMENT '排号表Id',
    `phone`          char(15) COLLATE utf8mb4_bin DEFAULT NULL COMMENT '手机号 或者其他能够及时联络方式',
    `is_called`      tinyint unsigned NOT NULL COMMENT '是否叫过了',
    `last_call_time` int unsigned NOT NULL COMMENT '上次叫号时间',
    `create_time`    int unsigned NOT NULL,
    `update_time`    int unsigned NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin COMMENT='排号顺序表';

-- ----------------------------
-- Table structure for service
-- ----------------------------
DROP TABLE IF EXISTS `service`;
CREATE TABLE `service`
(
    `id`           int(10) unsigned NOT NULL AUTO_INCREMENT,
    `title`        varchar(255) COLLATE utf8mb4_bin NOT NULL DEFAULT '' COMMENT '标题',
    `content`      text COLLATE utf8mb4_bin COMMENT '内容',
    `service_type` tinyint(1) NOT NULL COMMENT '1 妆娘 2 道具 3 摄影',
    `type`         tinyint(1) NOT NULL COMMENT '1 服务 2 需求',
    `low_price`    decimal(10, 3)                            DEFAULT NULL COMMENT '最低价',
    `high_price`   decimal(10, 3)                            DEFAULT NULL COMMENT '最高价',
    `soft_delete`  int(10) unsigned NOT NULL DEFAULT '0' COMMENT '软删除',
    `start_time`   int(10) unsigned NOT NULL COMMENT '开始时间',
    `end_time`     int(10) unsigned NOT NULL COMMENT '结束时间',
    `create_time`  int(10) unsigned NOT NULL,
    `update_time`  int(10) unsigned NOT NULL,
    PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_bin;

SET
FOREIGN_KEY_CHECKS = 1;
