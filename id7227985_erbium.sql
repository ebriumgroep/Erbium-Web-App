-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 07, 2018 at 10:40 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id7227985_erbium`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `client_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `full_name` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `full_name`, `username`, `password`, `salt`, `latitude`, `longitude`, `Admin`) VALUES
(21, 'User 111', 'user111', '872a2cfa8e8b2d1c7d242db1a94411fc245d023301b3874a9cbff398b6b5afeb', '2250f93dda581eaeb80f66d8098aac3f2aca17683c1ae775cf0b1db935aa76c1', 29.1265448, '-30.5684651', 1),
(22, 'User Two', 'user2', '9f53821947b75c191539b442a2079dc1a44aae1ed94b752d2510be6b1af40c17', 'b4f5e44910df674f917ff019f33beb8fb6bc7f01306562fbfb3e13494ce9854f', NULL, NULL, 0),
(23, 'User Three', 'user3', '763fdeae6baf2b01400f78596b5e4abf29d9da135a1b6bf02a02819177d9e379', 'de8a39e8da1348f6d17e756cfcb4875a0f93c0269207c14d04da841b346fe61a', NULL, NULL, 0),
(24, 'Anrich Moulder', 'Anrichm12345', '123', '3213124', 12, '11', 0),
(25, 'testing', 'myprogram', '123', NULL, -27.42454280605233, '19.955341339111328', 0),
(26, 'Riaan', 'riaan@gmail.com', '123', NULL, -25.76020975278077, '28.227934587280288', 0),
(28, 'sean', 'sean@gmail.com', '123', NULL, -25.758663724632704, '28.250422227661147', 0);

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
CREATE TABLE IF NOT EXISTS `device` (
  `device_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(10) UNSIGNED DEFAULT NULL,
  `token` varchar(45) NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `trap_group` varchar(45) DEFAULT NULL,
  `Upload_Interval` varchar(45) NOT NULL DEFAULT 'Every Hour',
  `Sensing_Interval` varchar(20) NOT NULL DEFAULT 'Every Hour',
  `caught` int(11) NOT NULL DEFAULT '0',
  `tempCount` int(11) NOT NULL DEFAULT '0',
  `Battery_Percent` int(11) NOT NULL DEFAULT '0',
  `latitude` varchar(40) DEFAULT NULL,
  `longitude` varchar(40) DEFAULT NULL,
  `signal_strength` varchar(12) NOT NULL DEFAULT 'Unavailable',
  `last_updated` varchar(20) NOT NULL DEFAULT 'Unavailable',
  `data_available` varchar(20) NOT NULL DEFAULT 'Unavailable',
  PRIMARY KEY (`device_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `client_id`, `token`, `description`, `trap_group`, `Upload_Interval`, `Sensing_Interval`, `caught`, `tempCount`, `Battery_Percent`, `latitude`, `longitude`, `signal_strength`, `last_updated`, `data_available`) VALUES
(20, 21, 'sac_6', 'waterpump', 'Butterflies', 'Every hour', 'Every hour', 7, 0, 76, '-25.75217018660249', '28.228192079345718', 'Unavailable', 'Unavailable', 'Unavailable'),
(21, 21, 'sac1', 'pump2', 'Moths', 'Every hour', 'Every hour', 3, 8, 0, '-25.757272282088362', '28.231453645507827', 'Unavailable', 'Unavailable', 'Unavailable'),
(22, 21, 'sac2', '0', 'Moths', 'Every hour', 'Every hour', 1, 0, 0, '-25.760828158403434', '28.24733232287599', 'Unavailable', 'Unavailable', 'Unavailable'),
(23, 21, 'sac3', '0', 'Moths', 'Every hour', 'Every hour', 5, 0, 0, '-25.757426887620678', '28.226303804199233', 'Unavailable', 'Unavailable', 'Unavailable'),
(24, 21, 'sac99', '88', 'Butterflies', 'Every hour', 'Every hour', 2, 0, 32, '-25.749541748843935', '28.2106826188965', 'Unavailable', 'Unavailable', 'Unavailable'),
(25, 21, 'sac55', '0', 'Moths', 'Every hour', 'Every hour', 19, 0, 48, '-25.763765541123696', '28.22664712695314', '65', 'Unavailable', '0'),
(26, 21, 'as22', '46', 'Moths', 'Every hour', 'Every hour', 1, 0, 0, '-25.741501460561782', '28.232826936523452', 'Unavailable', 'Unavailable', 'Unavailable'),
(27, 21, 'sac20', '0', 'Moths', 'Every hour', 'Every hour', 1, 0, 12, '-25.752634022522127', '28.248963105957046', 'Unavailable', 'Unavailable', 'Unavailable'),
(28, 21, 'sac_900', '0', 'Moths', 'Every hour', 'Every hour', 11, 0, 0, '-25.767321222964462', '28.25256799487306', 'Unavailable', 'Unavailable', 'Unavailable'),
(29, 21, 's', '0', 's', 'Every hour', 'Every hour', 1, 0, 0, '-25.75217018660249', '28.226818788330093', 'Unavailable', 'Unavailable', 'Unavailable'),
(30, 21, 'trap46', '0', 'Moths', 'Every hour', 'Every hour', 4, 0, 0, '-25.736089421725186', '28.23488687304689', 'Unavailable', 'Unavailable', 'Unavailable'),
(31, 21, '222', '0', 'Moths', 'Every hour', 'Every hour', 1, 0, 0, '', '', 'Unavailable', 'Unavailable', 'Unavailable'),
(34, 21, 'trap0001', 'The trap that does the most', 'Caterpillars', 'Once a Day', 'Every Year', 0, 0, 0, '98.656313212', '13.232656565', 'Unavailable', 'Unavailable', 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `device_id` int(10) UNSIGNED NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL,
  KEY `device_id` (`device_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`device_id`, `latitude`, `longitude`) VALUES
(21, -25.760518955994716, 28.224243867675796),
(22, -25.760518955994716, 28.224243889898993),
(31, -25.756344644667337, 28.248791444580093);

-- --------------------------------------------------------

--
-- Table structure for table `temp_humid`
--

DROP TABLE IF EXISTS `temp_humid`;
CREATE TABLE IF NOT EXISTS `temp_humid` (
  `th_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `temperature` float NOT NULL,
  `humidity` float NOT NULL,
  `time_stamp` int(12) NOT NULL,
  `device_id` int(10) UNSIGNED NOT NULL,
  `data_loss_flag` tinyint(4) NOT NULL,
  `signal_strength` int(11) NOT NULL,
  `bit_error_rate` int(11) NOT NULL,
  `battery_percentage` int(11) NOT NULL,
  PRIMARY KEY (`th_id`),
  KEY `device_id_idx` (`device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_humid`
--

INSERT INTO `temp_humid` (`th_id`, `temperature`, `humidity`, `time_stamp`, `device_id`, `data_loss_flag`, `signal_strength`, `bit_error_rate`, `battery_percentage`) VALUES
(1, 36.5, 89.56, 1543599710, 21, 0, 0, 0, 0),
(2, 36.5, 86.56, 1543599710, 21, 0, 0, 0, 0),
(3, 36.5, 89.56, 1540837457, 21, 0, 0, 0, 0),
(4, 36.5, 89.56, 1540837457, 21, 0, 0, 0, 0),
(5, 36.5, 89.56, 1540837457, 21, 0, 0, 0, 0),
(6, 4, 10, 1542537906, 24, 0, 0, 0, 0),
(7, 6, 20, 1542537906, 24, 0, 0, 0, 0),
(8, 31, 0, 1542231477, 21, 0, 26, 4, 12),
(9, 31, 29.5, 1542231477, 21, 0, 26, 4, 12),
(10, 31, -1, 1542231477, 21, 0, 26, 4, 12),
(11, 31, -1, 1542231477, 21, 0, 26, 4, 12);

-- --------------------------------------------------------

--
-- Table structure for table `trap_count`
--

DROP TABLE IF EXISTS `trap_count`;
CREATE TABLE IF NOT EXISTS `trap_count` (
  `inc_id` int(11) NOT NULL AUTO_INCREMENT,
  `time_stamp` int(12) NOT NULL,
  `device_id` int(10) UNSIGNED NOT NULL,
  `data_loss_flag` tinyint(4) NOT NULL,
  `signal_strength` int(11) NOT NULL,
  `bit_error_rate` int(11) NOT NULL,
  `battery_percentage` int(11) NOT NULL,
  PRIMARY KEY (`inc_id`),
  KEY `device_id` (`device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trap_count`
--

INSERT INTO `trap_count` (`inc_id`, `time_stamp`, `device_id`, `data_loss_flag`, `signal_strength`, `bit_error_rate`, `battery_percentage`) VALUES
(31, 1540837557, 25, 1, 31, 5, 60),
(32, 1540837557, 25, 1, 31, 5, 60),
(33, 1543622400, 25, 1, 31, 5, 60),
(34, 1543622400, 26, 1, 31, 5, 60),
(35, 1543622400, 27, 1, 31, 5, 60),
(36, 1543622400, 28, 1, 31, 5, 60),
(37, 1543622400, 28, 1, 31, 5, 60),
(38, 1543622400, 29, 1, 31, 5, 60),
(39, 1543622400, 30, 1, 31, 5, 60),
(41, 1543795200, 31, 1, 31, 5, 60),
(42, 1543795200, 30, 1, 31, 5, 60),
(43, 1543795200, 30, 1, 31, 5, 60),
(44, 1543795200, 30, 1, 31, 5, 60),
(45, 1543795200, 28, 1, 31, 5, 60),
(46, 1543795200, 28, 1, 31, 5, 60),
(47, 1543795200, 28, 1, 31, 5, 60),
(48, 1543795200, 25, 1, 31, 5, 60),
(49, 1544140800, 25, 1, 31, 5, 60),
(50, 1544140800, 25, 1, 31, 5, 60),
(51, 1544140800, 28, 1, 31, 5, 60),
(52, 1544140800, 28, 1, 31, 5, 60),
(53, 1544140800, 28, 1, 31, 5, 60),
(54, 1544140800, 28, 1, 31, 5, 60),
(55, 1544140800, 28, 1, 31, 5, 60),
(56, 1544140800, 28, 1, 31, 5, 60);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `device`
--
ALTER TABLE `device`
  ADD CONSTRAINT `device_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`);

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`);

--
-- Constraints for table `temp_humid`
--
ALTER TABLE `temp_humid`
  ADD CONSTRAINT `temp_humid_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`);

--
-- Constraints for table `trap_count`
--
ALTER TABLE `trap_count`
  ADD CONSTRAINT `trap_count_ibfk_1` FOREIGN KEY (`device_id`) REFERENCES `device` (`device_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
