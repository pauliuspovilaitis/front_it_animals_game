CREATE DATABASE `frontit` DEFAULT CHARACTER SET utf8;
USE `frontit`;
CREATE TABLE `animals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `animal` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `features` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature` text NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
CREATE TABLE `matrix` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `feature_key` int(11) DEFAULT NULL,
  `animal_key` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id_UNIQUE` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

INSERT INTO `animals` (`animal`) VALUES('monkey');
INSERT INTO `animals` (`animal`) VALUES('bear');
INSERT INTO `features`(`feature`) VALUES('It has fur?');
INSERT INTO `features`(`feature`) VALUES('It eats fruits?');
INSERT INTO `features`(`feature`) VALUES('It is a bird?');
INSERT INTO `matrix`(`feature_key`,`animal_key`) VALUES(1,1);
INSERT INTO `matrix`(`feature_key`,`animal_key`) VALUES(1,2);
INSERT INTO `matrix`(`feature_key`,`animal_key`) VALUES(2,1);