-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2018 at 07:07 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.8

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

CREATE TABLE `client` (
  `client_id` int(10) UNSIGNED NOT NULL,
  `full_name` varchar(45) DEFAULT NULL,
  `username` varchar(45) NOT NULL,
  `password` varchar(255) NOT NULL,
  `salt` varchar(255) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` varchar(45) DEFAULT NULL,
  `Admin` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `full_name`, `username`, `password`, `salt`, `latitude`, `longitude`, `Admin`) VALUES
(21, 'User 111', 'user111', '872a2cfa8e8b2d1c7d242db1a94411fc245d023301b3874a9cbff398b6b5afeb', '2250f93dda581eaeb80f66d8098aac3f2aca17683c1ae775cf0b1db935aa76c1', -25.75444474610541, '28.231430053710938', 1),
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

CREATE TABLE `device` (
  `device_id` int(10) UNSIGNED NOT NULL,
  `client_id` int(10) UNSIGNED NOT NULL,
  `token` varchar(45) NOT NULL,
  `description` varchar(45) NOT NULL,
  `trap_group` varchar(45) NOT NULL,
  `Upload_Interval` varchar(45) DEFAULT NULL,
  `Sensing_Interval` varchar(20) NOT NULL DEFAULT 'Every hour',
  `caught` int(11) DEFAULT NULL,
  `tempCount` int(11) NOT NULL,
  `Battery_Percent` int(11) NOT NULL,
  `latitude` varchar(40) NOT NULL,
  `longitude` varchar(40) NOT NULL,
  `signal_strength` varchar(12) NOT NULL DEFAULT 'Unavailable',
  `last_updated` varchar(20) NOT NULL DEFAULT 'Unavailable',
  `data_available` varchar(20) NOT NULL DEFAULT 'Unavailable'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `device`
--

INSERT INTO `device` (`device_id`, `client_id`, `token`, `description`, `trap_group`, `Upload_Interval`, `Sensing_Interval`, `caught`, `tempCount`, `Battery_Percent`, `latitude`, `longitude`, `signal_strength`, `last_updated`, `data_available`) VALUES
(20, 21, 'sac_6', 'waterpump', 'Butterflies', 'Everyhour', 'Every hour', 7, 0, 76, '-25.75217018660249', '28.228192079345718', 'Unavailable', 'Unavailable', 'Unavailable'),
(21, 21, 'sac1', 'pump2', 'Moths', 'fiveperday', 'Every hour', 3, 4, 0, '-25.757272282088362', '28.231453645507827', 'Unavailable', 'Unavailable', 'Unavailable'),
(22, 21, 'sac2', '0', 'Moths', 'Everyhour', 'Every hour', 1, 0, 0, '-25.760828158403434', '28.24733232287599', 'Unavailable', 'Unavailable', 'Unavailable'),
(23, 21, 'sac3', '0', 'Moths', 'Everyhour', 'Every hour', 5, 0, 0, '-25.757426887620678', '28.226303804199233', 'Unavailable', 'Unavailable', 'Unavailable'),
(24, 21, 'sac99', '88', 'Butterflies', 'onceperday', 'Every hour', 2, 0, 32, '-25.749541748843935', '28.2106826188965', 'Unavailable', 'Unavailable', 'Unavailable'),
(25, 21, 'sac55', '0', 'Moths', 'onceperday', 'Every hour', 12, 0, 0, '-25.763765541123696', '28.22664712695314', 'Unavailable', 'Unavailable', 'Unavailable'),
(26, 21, 'as22', '46', 'Moths', 'threeperday', 'Every hour', 0, 0, 0, '-25.741501460561782', '28.232826936523452', 'Unavailable', 'Unavailable', 'Unavailable'),
(27, 21, 'sac20', '0', 'Moths', 'Everyhour', 'Every hour', 0, 0, 12, '-25.752634022522127', '28.248963105957046', 'Unavailable', 'Unavailable', 'Unavailable'),
(28, 21, 'sac_900', '0', 'Moths', 'fiveperday', 'Every hour', 0, 0, 0, '-25.767321222964462', '28.25256799487306', 'Unavailable', 'Unavailable', 'Unavailable'),
(29, 21, 's', '0', 's', 'Everyhour', 'Every hour', 0, 0, 0, '-25.75217018660249', '28.226818788330093', 'Unavailable', 'Unavailable', 'Unavailable'),
(30, 21, 'trap46', '0', 'Moths', 'Everyhour', 'Every hour', 0, 0, 0, '-25.736089421725186', '28.23488687304689', 'Unavailable', 'Unavailable', 'Unavailable'),
(31, 21, '222', '0', 'Moths', 'Everyhour', 'Every hour', 0, 0, 0, '', '', 'Unavailable', 'Unavailable', 'Unavailable');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `device_id` int(10) UNSIGNED NOT NULL,
  `latitude` double NOT NULL,
  `longitude` double NOT NULL
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

CREATE TABLE `temp_humid` (
  `th_id` int(10) UNSIGNED NOT NULL,
  `temperature` float NOT NULL,
  `humidity` float NOT NULL,
  `time_stamp` int(12) NOT NULL,
  `device_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `temp_humid`
--

INSERT INTO `temp_humid` (`th_id`, `temperature`, `humidity`, `time_stamp`, `device_id`) VALUES
(1, 36.5, 89.56, 1543599710, 21),
(2, 36.5, 86.56, 1543599710, 21),
(3, 36.5, 89.56, 1540837457, 21),
(4, 36.5, 89.56, 1540837457, 21),
(5, 36.5, 89.56, 1540837457, 21),
(6, 4, 10, 1542537906, 24),
(7, 6, 20, 1542537906, 24);

-- --------------------------------------------------------

--
-- Table structure for table `trap_count`
--

CREATE TABLE `trap_count` (
  `inc_id` int(11) NOT NULL,
  `time_stamp` int(12) NOT NULL,
  `device_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `device`
--
ALTER TABLE `device`
  ADD PRIMARY KEY (`device_id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD KEY `device_id` (`device_id`);

--
-- Indexes for table `temp_humid`
--
ALTER TABLE `temp_humid`
  ADD PRIMARY KEY (`th_id`),
  ADD KEY `device_id_idx` (`device_id`);

--
-- Indexes for table `trap_count`
--
ALTER TABLE `trap_count`
  ADD PRIMARY KEY (`inc_id`),
  ADD KEY `device_id` (`device_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `device`
--
ALTER TABLE `device`
  MODIFY `device_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `temp_humid`
--
ALTER TABLE `temp_humid`
  MODIFY `th_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trap_count`
--
ALTER TABLE `trap_count`
  MODIFY `inc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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
