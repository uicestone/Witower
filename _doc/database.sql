SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";
CREATE DATABASE `witower` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `witower`;

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `total_bonus` decimal(10,2) NOT NULL DEFAULT '0.00',
  `frozen_bonus` decimal(10,2) NOT NULL DEFAULT '0.00',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `company` (`id`, `description`, `total_bonus`, `frozen_bonus`) VALUES
(1, '', '1000000.00', '0.00'),
(2, '', '50000.00', '0.00'),
(3, '', '32000.00', '8000.00');

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `item` (`item`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `config` (`id`, `item`, `value`) VALUES
(1, 'recommended_project', '1'),
(2, 'recommended_vote', '2');

CREATE TABLE IF NOT EXISTS `nav` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `ui_name` varchar(255) NOT NULL,
  `uri` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `nav` (`id`, `group`, `name`, `ui_name`, `uri`) VALUES
(1, 'primary', 'index', '首页', ''),
(2, 'primary', 'project', '项目', 'project'),
(3, 'primary', 'vote', '投票', 'vote');

CREATE TABLE IF NOT EXISTS `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `company` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`company`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `product` (`id`, `name`, `description`, `company`) VALUES
(1, '雪碧', '晶晶亮 透心凉', 3),
(2, 'Bouns系列运动鞋', '', 1),
(3, '百事可乐', '产品描述产品描述产品描述产品描述产品描述产品描述产品描述', 3);

CREATE TABLE IF NOT EXISTS `product_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `tag` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `product` (`product`),
  KEY `tag` (`tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

INSERT INTO `product_tag` (`id`, `product`, `tag`) VALUES
(3, 2, 2),
(4, 2, 1),
(5, 1, 5);

CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `wit_start` date NOT NULL,
  `wit_end` date NOT NULL,
  `vote_start` date NOT NULL,
  `vote_end` date NOT NULL,
  `bonus` decimal(10,2) NOT NULL,
  `company` int(11) NOT NULL,
  `witters` int(11) NOT NULL DEFAULT '0',
  `voters` int(11) NOT NULL,
  `favorites` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `date_start` (`wit_start`),
  KEY `date_end` (`wit_end`),
  KEY `user` (`company`),
  KEY `product` (`product`),
  KEY `users` (`witters`),
  KEY `vote_start` (`vote_start`),
  KEY `vote_end` (`vote_end`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

INSERT INTO `project` (`id`, `product`, `name`, `summary`, `wit_start`, `wit_end`, `vote_start`, `vote_end`, `bonus`, `company`, `witters`, `voters`, `favorites`) VALUES
(1, 2, 'Adidas Bouns运动鞋春季校园推广', 'Adidas公司计划在2014年春季推出Bouns Max 2014款运动鞋', '2013-01-01', '2013-06-30', '2013-07-09', '2013-08-09', '5000.00', 1, 1, 0, 1),
(2, 1, '雪碧2013校园推广', '雪碧2013校园推广', '2013-01-01', '2013-06-04', '2013-06-07', '2013-07-07', '8000.00', 3, 0, 0, 0),
(3, 3, '百事可乐2013校园推广', '祝你百事可乐！', '2013-06-13', '2013-07-13', '0000-00-00', '0000-00-00', '2000.00', 3, 0, 0, 0);

CREATE TABLE IF NOT EXISTS `project_candidate` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `candidate` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  `score_witower` decimal(10,2) NOT NULL,
  `score_company` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project-candidate` (`project`,`candidate`),
  KEY `candidate` (`candidate`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `project_candidate` (`id`, `candidate`, `project`, `votes`, `score_witower`, `score_company`) VALUES
(1, 5, 2, 6, '6.00', '5.00'),
(2, 7, 2, 2, '2.00', '4.00');

CREATE TABLE IF NOT EXISTS `project_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `tag` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project` (`project`),
  KEY `tag` (`tag`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `project_tag` (`id`, `project`, `tag`) VALUES
(1, 1, 4),
(2, 2, 4);

CREATE TABLE IF NOT EXISTS `project_vote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `candidate` int(11) NOT NULL,
  `voter` int(11) NOT NULL,
  `votes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `project-candidate-voter` (`project`,`candidate`,`voter`),
  KEY `candidate` (`candidate`),
  KEY `voter` (`voter`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

INSERT INTO `project_vote` (`id`, `project`, `candidate`, `voter`, `votes`) VALUES
(1, 2, 5, 6, 3),
(2, 2, 5, 7, 2),
(5, 2, 5, 8, 1),
(6, 2, 7, 8, 2);

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

INSERT INTO `tag` (`id`, `name`) VALUES
(1, '运动'),
(2, '服饰'),
(4, '校园'),
(5, '饮料');

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `follows` int(11) NOT NULL DEFAULT '0',
  `fans` int(11) NOT NULL DEFAULT '0',
  `statuses` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `name` (`name`),
  UNIQUE KEY `email` (`email`),
  KEY `password` (`password`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

INSERT INTO `user` (`id`, `name`, `password`, `email`, `follows`, `fans`, `statuses`) VALUES
(1, 'Adidas', '123', 'market@adidas.com', 0, 0, 0),
(2, 'Nike', '123', 'market@nike.com', 0, 0, 0),
(3, '百事', '123', 'market@pepsi.com', 0, 0, 0),
(5, 'uicestone', '123', 'uicestone@gmail.com', 0, 0, 0),
(6, 'mouse', '123', 'mouse@gmail.com', 0, 0, 0),
(7, 'bull', '123', 'bull@witower.com', 0, 0, 0),
(8, 'tiger', '123', 'tiger@witower.com', 0, 0, 0);

CREATE TABLE IF NOT EXISTS `user_bonus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `bonus` decimal(10,2) NOT NULL,
  `project` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `project` (`project`),
  KEY `time` (`time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `user_bonus` (`id`, `user`, `bonus`, `project`, `time`) VALUES
(1, 5, '5377.78', 2, 1371491608),
(2, 7, '2622.22', 2, 1371491608);

CREATE TABLE IF NOT EXISTS `user_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `item` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `item` (`item`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user_favorite_project` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `project` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `project` (`project`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `user_favorite_project` (`id`, `user`, `project`) VALUES
(1, 5, 1);

CREATE TABLE IF NOT EXISTS `user_follow` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idol` int(11) NOT NULL,
  `fan` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idol` (`idol`),
  KEY `fan` (`fan`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=10 ;

INSERT INTO `user_follow` (`id`, `idol`, `fan`) VALUES
(1, 1, 5),
(6, 3, 5),
(7, 3, 8),
(8, 6, 8),
(9, 7, 8);

CREATE TABLE IF NOT EXISTS `user_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `content` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `user_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `content` varchar(255) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `time` (`time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

INSERT INTO `user_status` (`id`, `user`, `type`, `content`, `url`, `time`) VALUES
(1, 5, NULL, '测试微博', NULL, 1371439421),
(2, 5, NULL, '另一条测试微博～～', NULL, 1371445996);

CREATE TABLE IF NOT EXISTS `user_status_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `status` (`status`),
  KEY `user` (`user`),
  KEY `time` (`time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `version` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `project` int(11) NOT NULL,
  `wit` int(11) NOT NULL,
  `content` text NOT NULL,
  `score_witower` decimal(3,1) NOT NULL,
  `score_company` decimal(3,1) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  KEY `time` (`time`),
  KEY `wit` (`wit`),
  KEY `project` (`project`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

INSERT INTO `version` (`id`, `project`, `wit`, `content`, `score_witower`, `score_company`, `user`, `time`) VALUES
(1, 1, 1, '这是一段文案', '7.0', '6.0', 5, 0),
(2, 2, 2, '文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容', '6.0', '5.0', 5, 0),
(5, 1, 5, '<p>Bouns气垫，一飞冲天。Bouns气垫，一飞冲天。</p>\n<p>Bouns气垫，一飞冲天。Bouns气垫，一飞冲天。</p>', '0.0', '0.0', 5, 1371131484),
(6, 1, 1, '<p>这是一段文案</p>\n<p>编辑</p>', '0.0', '0.0', 5, 1371131823),
(7, 2, 2, '<p>文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容</p>', '0.0', '0.0', 5, 1371137424),
(8, 2, 6, '<p>晶晶亮，透心凉</p>\n<p>晶晶亮，透心凉</p>', '0.0', '4.0', 7, 1371180762);

CREATE TABLE IF NOT EXISTS `version_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `version` int(11) NOT NULL,
  `content` varchar(255) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `version` (`version`),
  KEY `user` (`user`),
  KEY `time` (`time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

INSERT INTO `version_comment` (`id`, `version`, `content`, `user`, `time`) VALUES
(1, 1, '这个不错！', 5, 0);

CREATE TABLE IF NOT EXISTS `wit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `project` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  `selected` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `project` (`project`),
  KEY `user` (`user`),
  KEY `time` (`time`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

INSERT INTO `wit` (`id`, `name`, `content`, `project`, `user`, `time`, `selected`) VALUES
(1, '文案标题1', '<p>这是一段文案</p>\n<p>编辑</p>', 1, 5, 1371131823, 0),
(2, '雪碧广告文案', '<p>文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容文案内容</p>', 2, 5, 1371137424, 0),
(5, 'Bouns气垫，一飞冲天', '<p>Bouns气垫，一飞冲天。Bouns气垫，一飞冲天。</p>\n<p>Bouns气垫，一飞冲天。Bouns气垫，一飞冲天。</p>', 1, 5, 1371131484, 0),
(6, '晶晶亮，透心凉', '<p>晶晶亮，透心凉</p>\n<p>晶晶亮，透心凉</p>', 2, 7, 1371180762, 0);


ALTER TABLE `company`
  ADD CONSTRAINT `company_ibfk_1` FOREIGN KEY (`id`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`company`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_ibfk_1` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `product_tag_ibfk_2` FOREIGN KEY (`tag`) REFERENCES `tag` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `project`
  ADD CONSTRAINT `project_ibfk_1` FOREIGN KEY (`product`) REFERENCES `product` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `project_ibfk_3` FOREIGN KEY (`company`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `project_candidate`
  ADD CONSTRAINT `project_candidate_ibfk_2` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `project_candidate_ibfk_3` FOREIGN KEY (`candidate`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `project_tag`
  ADD CONSTRAINT `project_tag_ibfk_1` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `project_tag_ibfk_2` FOREIGN KEY (`tag`) REFERENCES `tag` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `project_vote`
  ADD CONSTRAINT `project_vote_ibfk_1` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `project_vote_ibfk_2` FOREIGN KEY (`candidate`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `project_vote_ibfk_3` FOREIGN KEY (`voter`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `user_bonus`
  ADD CONSTRAINT `user_bonus_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_bonus_ibfk_2` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `user_config`
  ADD CONSTRAINT `user_config_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `user_favorite_project`
  ADD CONSTRAINT `user_favorite_project_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_favorite_project_ibfk_2` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `user_follow`
  ADD CONSTRAINT `user_follow_ibfk_1` FOREIGN KEY (`idol`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_follow_ibfk_2` FOREIGN KEY (`fan`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `user_profile`
  ADD CONSTRAINT `user_profile_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `user_status`
  ADD CONSTRAINT `user_status_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `user_status_comment`
  ADD CONSTRAINT `user_status_comment_ibfk_1` FOREIGN KEY (`status`) REFERENCES `user_status` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `user_status_comment_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `version`
  ADD CONSTRAINT `version_ibfk_1` FOREIGN KEY (`wit`) REFERENCES `wit` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `version_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `version_comment`
  ADD CONSTRAINT `version_comment_ibfk_1` FOREIGN KEY (`version`) REFERENCES `version` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `version_comment_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;

ALTER TABLE `wit`
  ADD CONSTRAINT `wit_ibfk_1` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `wit_ibfk_2` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
