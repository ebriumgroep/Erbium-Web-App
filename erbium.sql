-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 29, 2018 at 07:52 PM
-- Server version: 5.7.19
-- PHP Version: 5.6.31

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
  PRIMARY KEY (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `full_name`, `username`, `password`, `salt`, `latitude`, `longitude`) VALUES
(21, 'User 111', 'user111', '872a2cfa8e8b2d1c7d242db1a94411fc245d023301b3874a9cbff398b6b5afeb', '2250f93dda581eaeb80f66d8098aac3f2aca17683c1ae775cf0b1db935aa76c1', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `device`
--

DROP TABLE IF EXISTS `device`;
CREATE TABLE IF NOT EXISTS `device` (
  `device_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(10) UNSIGNED NOT NULL,
  `hardware_id` varchar(45) NOT NULL,
  `token` varchar(45) NOT NULL,
  `type` varchar(45) NOT NULL,
  `Upload_Interval` varchar(45) DEFAULT NULL,
  `caught` int(11) DEFAULT '0',
  `tempCount` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`device_id`),
  KEY `client_id` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `client_id`, `hardware_id`, `token`, `type`, `Upload_Interval`, `caught`, `tempCount`) VALUES
(20, 21, 'sac_6', '5', 'Butterflies', 'FivePerDay', 7, 0),
(21, 21, 'sac1', '0', 'Moths', 'fiveperday', 3, 4),
(22, 21, 'sac2', '0', 'Moths', 'Everyhour', 1, 0),
(23, 21, 'sac3', '0', 'Moths', 'Everyhour', 5, 0),
(24, 21, 'sac4', '0', 'Moth', 'Everyhour', 2, 0),
(25, 21, 'sac5', '0', 'Moths', 'onceperday', 12, 0);

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
  PRIMARY KEY (`th_id`),
  KEY `device_id_idx` (`device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_humid`
--

INSERT INTO `temp_humid` (`th_id`, `temperature`, `humidity`, `time_stamp`, `device_id`) VALUES
(1, 36.5, 89.56, 1540837457, 21),
(2, 36.5, 89.56, 1540837457, 21),
(3, 36.5, 89.56, 1540837457, 21),
(4, 36.5, 89.56, 1540837457, 21),
(5, 36.5, 89.56, 1540837457, 21);

-- --------------------------------------------------------

--
-- Table structure for table `trap_count`
--

DROP TABLE IF EXISTS `trap_count`;
CREATE TABLE IF NOT EXISTS `trap_count` (
  `inc_id` int(11) NOT NULL AUTO_INCREMENT,
  `time_stamp` int(12) NOT NULL,
  `device_id` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`inc_id`),
  KEY `device_id` (`device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `trap_count`
--

INSERT INTO `trap_count` (`inc_id`, `time_stamp`, `device_id`) VALUES
(1, 1540837457, 20),
(2, 1540837457, 20),
(3, 1540837457, 20),
(4, 1540837457, 20),
(5, 1540837457, 20),
(6, 1540837457, 20),
(7, 1540837457, 21),
(8, 1540837457, 21),
(9, 1540837457, 21),
(10, 1540837457, 22),
(11, 1540837457, 23),
(12, 1540837457, 23),
(13, 1540837457, 23),
(14, 1540837457, 23),
(15, 1540837457, 23),
(16, 1540837457, 24),
(17, 1540837457, 24),
(18, 1540837457, 25),
(19, 1540837457, 25),
(20, 1540837457, 25),
(21, 1540837457, 25),
(22, 1540837457, 25),
(23, 1540837457, 25),
(24, 1540837457, 25),
(25, 1540837457, 25),
(26, 1540837457, 25),
(27, 1540837457, 25),
(28, 1540837457, 25),
(29, 1540837457, 25);

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
