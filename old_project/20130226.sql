set names utf8;CREATE TABLE `bbsinfo` (
  `bbsId` int(11) NOT NULL auto_increment,
  `userName` varchar(20) NOT NULL,
  `title` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `bbsTime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`bbsId`),
  KEY `userName` (`userName`),
  CONSTRAINT `bbsinfo_ibfk_1` FOREIGN KEY (`userName`) REFERENCES `userinfo` (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE `userinfo` (
  `userName` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `userTime` timestamp NOT NULL default CURRENT_TIMESTAMP,
  PRIMARY KEY  (`userName`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
insert into `userinfo`(`userName`,`password`,`userTime`) values('ÀîËÄ','456789','2013-01-14 18:56:29');
insert into `userinfo`(`userName`,`password`,`userTime`) values('ÕÅÈý','123456','2013-01-14 18:56:22');

