ALTER TABLE  `wit` ADD  `latest_version` INT NULL;
ALTER TABLE  `wit` ADD INDEX (  `latest_version` );
ALTER TABLE  `wit` ADD FOREIGN KEY (  `latest_version` ) REFERENCES  `witower`.`version` (
`id`
) ON DELETE NO ACTION ON UPDATE CASCADE ;
update wit inner join 
(
select * from 
(
select * from version order by id desc
)version_ordered
group by wit
)version_grouped
on version_grouped.wit=wit.id
set wit.latest_version=version_grouped.id;

ALTER TABLE  `version` ADD  `num` INT NOT NULL AFTER  `id`;
update wit set latest_version = null;
delete from version_comment;
delete from version;
delete from wit;
ALTER TABLE  `version` ADD  `name` VARCHAR( 255 ) NOT NULL AFTER  `wit`;
ALTER TABLE  `user` ADD  `group` VARCHAR( 255 ) NOT NULL AFTER  `email`;
ALTER TABLE  `version` ADD  `hidden` BOOLEAN NOT NULL AFTER  `score_company`;

ALTER TABLE  `version` ADD FOREIGN KEY (  `project` ) REFERENCES  `witower`.`project` (
`id`
) ON DELETE NO ACTION ON UPDATE CASCADE ;

ALTER TABLE  `wit` ADD  `deleted` BOOLEAN NOT NULL AFTER  `selected`;
ALTER TABLE  `version` CHANGE  `hidden`  `deleted` TINYINT( 1 ) NOT NULL;

CREATE TABLE IF NOT EXISTS `finance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` decimal(10,2) NOT NULL,
  `item` varchar(255) NOT NULL,
  `summary` varchar(255) NOT NULL,
  `datetime` datetime NOT NULL,
  `project` int(11) DEFAULT NULL,
  `user` int(11) NOT NULL,
  `time` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `amount` (`amount`),
  KEY `datetime` (`datetime`),
  KEY `time` (`time`),
  KEY `user` (`user`),
  KEY `project` (`project`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_2` FOREIGN KEY (`project`) REFERENCES `project` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`user`) REFERENCES `user` (`id`) ON DELETE NO ACTION ON UPDATE CASCADE;
-- server upgraded
