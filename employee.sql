-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Sep 05, 2017 at 05:14 AM
-- Server version: 5.5.36
-- PHP Version: 5.4.25
-- @author : Engr. Nayab Bukhari, Syed

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `employee`
--
CREATE DATABASE IF NOT EXISTS `employee` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `employee`;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

DROP TABLE IF EXISTS `employee`;
CREATE TABLE IF NOT EXISTS `employee` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `dob` date NOT NULL,
  `SSN` varchar(9) COLLATE utf8_unicode_ci NOT NULL COMMENT 'SSN (Social Security Number)',
  `status` binary(1) NOT NULL DEFAULT '0' COMMENT '1=Yes , 0 = No',
  `phone` int(17) DEFAULT NULL COMMENT 'include country code start 00',
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL COMMENT 'username',
  `address` varchar(400) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `SSN` (`SSN`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Employee General Details' AUTO_INCREMENT=2 ;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`id`, `name`, `dob`, `SSN`, `status`, `phone`, `email`, `address`) VALUES
(1, 'Engr. Nayab Bukhari, Syed', '1979-12-25', '015544887', '0', 303654123, 'nayab@beccity.com', 'Bukhari house Pakistan');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `language` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `language` (`language`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `language`) VALUES
(1, 'English'),
(2, 'French'),
(3, 'Spanish');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `employee_id` int(11) NOT NULL,
  `action` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `FK_log_employee_id` (`employee_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `employee_id`, `action`, `timestamp`) VALUES
(1, 1, 'added', '2017-09-05 08:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

DROP TABLE IF EXISTS `portfolio`;
CREATE TABLE IF NOT EXISTS `portfolio` (
  `id` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `lang_id` int(11) NOT NULL,
  `introduction` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `education` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `work_experience` varchar(1000) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_portfolio_employee_id` (`employee_id`),
  KEY `FK_portfolio_language_id` (`lang_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='Employee Portfolio';

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`id`, `employee_id`, `lang_id`, `introduction`, `education`, `work_experience`) VALUES
(1, 1, 1, 'Intro from Engr. Nayab Bukhari Syed', 'Master in Computer Science', '5+ years in international computer industry');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `log`
--
ALTER TABLE `log`
  ADD CONSTRAINT `FK_log_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`);

--
-- Constraints for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD CONSTRAINT `FK_portfolio_employee_id` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`id`),
  ADD CONSTRAINT `FK_portfolio_language_id` FOREIGN KEY (`lang_id`) REFERENCES `language` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
