CREATE DATABASE ESP_Domotic;

USE ESP_Domotic;

CREATE TABLE `Users` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(300) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `lastName` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  PRIMARY KEY(id_user)
);

CREATE TABLE `Leds` (
  `id_led` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `location` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `pin` int DEFAULT NULL,
  `roomName` varchar(100) NOT NULL,
  PRIMARY KEY(id_led),
  FOREIGN KEY (id_user) REFERENCES Users(id_user)
) ;

CREATE TABLE `LedsRGB` (
  `id_rgb` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `location` varchar(100) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 0,
  `pin` int DEFAULT NULL,
  `roomName` varchar(100) NOT NULL,
  `red` int NOT NULL DEFAULT 0,
  `green` int NOT NULL DEFAULT 0,
  `blue` int NOT NULL DEFAULT 0,
  PRIMARY KEY(id_rgb),
  FOREIGN KEY (id_user) REFERENCES Users(id_user)
);

CREATE TABLE `Blinds` (
  `id_blind` int(11) NOT NULL AUTO_INCREMENT,
  `id_user` int(11) NOT NULL,
  `location` varchar(100) NOT NULL,
  `percentage` int(1) NOT NULL DEFAULT 0,
  `pin` int(11) DEFAULT NULL,
  `roomName` varchar(100) NOT NULL,
  PRIMARY KEY(id_blind),
  FOREIGN KEY (id_user) REFERENCES Users(id_user)
);


CREATE TABLE `Rooms` (
  `id_room` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `roomName` varchar(100) NOT NULL,
  PRIMARY KEY(id_room)
);
