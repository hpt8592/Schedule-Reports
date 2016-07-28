-- phpMyAdmin SQL Dump
-- version 4.4.15.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jul 28, 2016 at 06:51 PM
-- Server version: 5.5.50-MariaDB
-- PHP Version: 5.6.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `p1`
--

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `id` int(11) unsigned NOT NULL,
  `to` varchar(255) NOT NULL DEFAULT '',
  `from` varchar(255) DEFAULT NULL,
  `cc` varchar(255) DEFAULT NULL,
  `bcc` varchar(255) DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `sql_query` text,
  `url` varchar(255) DEFAULT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `to`, `from`, `cc`, `bcc`, `subject`, `sql_query`, `url`, `active`) VALUES
(1, 'hpt8592pro@gmail.com', 'hardik@webmavens.in', 'hpt8592@gmail.com', NULL, 'Try 1', 'SELECT * FROM `sales`;SELECT * FROM `sales` WHERE `date`=''26/07/2016'';', NULL, 1),
(2, 'hpt8592pro@gmail.com', 'hardik@webmavens.in', 'hpt8592@gmail.com', NULL, 'Test', 'All||SELECT * FROM `sales`;On 27/7/2016||SELECT * FROM `sales` WHERE `date`=''27/07/2016'';', 'http://www.google.co.in', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sales`
--

CREATE TABLE IF NOT EXISTS `sales` (
  `id` int(25) NOT NULL,
  `item` varchar(25) NOT NULL,
  `time` varchar(10) NOT NULL,
  `date` varchar(16) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sales`
--

INSERT INTO `sales` (`id`, `item`, `time`, `date`) VALUES
(1, 'i4', '6:18 pm', '26/07/2016'),
(2, 'i3', '6:25 pm', '26/07/2016'),
(3, 'i7', '10:53', '27/07/2016');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `serial` bigint(20) NOT NULL,
  `id` int(11) NOT NULL,
  `day` varchar(2) NOT NULL,
  `mon` varchar(2) NOT NULL,
  `year` varchar(4) NOT NULL,
  `repeat_state` tinyint(1) NOT NULL,
  `eday` tinyint(1) NOT NULL,
  `eweek` tinyint(1) NOT NULL,
  `emonth` tinyint(1) NOT NULL,
  `eyear` tinyint(1) NOT NULL,
  `time` varchar(6) NOT NULL,
  `spl` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`serial`, `id`, `day`, `mon`, `year`, `repeat_state`, `eday`, `eweek`, `emonth`, `eyear`, `time`, `spl`) VALUES
(1, 1, '28', '07', '2016', 1, 1, 0, 0, 0, '17:00', 0),
(2, 2, '28', '07', '2016', 1, 0, 1, 0, 0, '17:40', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sales`
--
ALTER TABLE `sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`serial`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
