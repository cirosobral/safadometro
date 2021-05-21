CREATE DATABASE IF NOT EXISTS `safadometro` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;

USE `safadometro`;

CREATE TABLE `safados` (
    `data` date NOT NULL,
    `anjo` float NOT NULL,
    `vagabundo` float NOT NULL,
    PRIMARY KEY (`data`)
) ENGINE = InnoDB DEFAULT CHARSET = utf8;