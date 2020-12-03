DROP DATABASE IF EXISTS `shopping_list`;
CREATE DATABASE `shopping_list`;
USE `shopping_list`;

CREATE TABLE `item` (
  `itemid` INT NOT NULL AUTO_INCREMENT,
  `description` VARCHAR(255) NOT NULL,
  `quantity` INT UNSIGNED NOT NULL DEFAULT 1,
  `datecreated` DATETIME NOT NULL,
  `dateupdated` DATETIME NULL,
  `datedeleted` DATETIME NULL,
  PRIMARY KEY (`itemid`),
  UNIQUE INDEX `itemid_UNIQUE` (`itemid` ASC)
);
