SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

-- 管理员表
--
-- CREATE TABLE `admin` (
--   `id` INT (10) unsigned NOT NULL COMMENT '用户ID',
--   `group_id` INT (11) NOT NULL DEFAULT '1' COMMENT '用户组id',
--   `username` CHAR (16) NOT NULL COMMENT '用户名',
--   `password` CHAR (32) NOT NULL COMMENT '密码',
--   `last_login_time` TIMESTAMP NULL DEFAULT NULL COMMENT '最后登录时间',
--   `last_login_ip` text COMMENT '最后登录IP'
-- )ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='后台用户表';
--
-- INSERT INTO `admin` VALUES (1,1,'sampson','b68a89a9d6a1a538dc8b5ce1a88519f0','2017-05-03 07:58:17','127.0.0.1');
--
-- -- 组权限表
--
-- CREATE TABLE `auth_group`(
--   `id` INT (8) unsigned NOT NULL,
--   `title` CHAR (100) NOT NULL DEFAULT '',
--   `status` INT (1) NOT NULL DEFAULT '1' COMMENT '1:启用 0:禁用',
--   `rules` text NOT NULL
-- )ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='组权限表';
--
-- INSERT INTO `auth_group` VALUES (1,'超级管理员',1,'1,2,3,4,5,6,7,8,9,10');

-- 管理员权限对照表

-- CREATE TABLE `auth_group_access` (
--   `id` int(10) unsigned NOT NULL,
--   `uid` int(11) NOT NULL,
--   `group_id` int(11) NOT NULL
-- ) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
--
-- INSERT INTO `auth_group_access` VALUES (1, 1, 1);

-- 文章类型表

-- CREATE TABLE `article_category`(
--   `id` INT (8) unsigned NOT NULL ,
--   `pid` INT (8) unsigned NOT NULL DEFAULT 0 COMMENT '上级',
--   `name` text NOT NULL COMMENT '类型',
--   `status` int(11) NOT NULL COMMENT '1:开启0:关闭',
--   `remark` text NOT NULL COMMENT '备注',
--   `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
-- )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COMMENT='文章类型';

-- 文章表
-- CREATE TABLE `article`(
--   `id` INT (8) unsigned NOT NULL ,
--   `category_id` INT (8) unsigned NOT NULL DEFAULT 0 COMMENT '类别id',
--   `title` text NOT NULL DEFAULT '' COMMENT '文章标题',
--   `brief` text NOT NULL COMMENT '简介',
--   `content` text NOT NULL COMMENT '文章内容',
--   `remark` text,
--   `visiter` int(11) NOT NULL DEFAULT '0',
--   `status` int(11) NOT NULL COMMENT '1:开启0:关闭',
--   `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
-- )ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `status` (`status`);

ALTER TABLE `article`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `article_category`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `auth_group`
  ADD PRIMARY KEY (`id`);

ALTER TABLE `auth_group_access`
  ADD PRIMARY KEY (`id`);