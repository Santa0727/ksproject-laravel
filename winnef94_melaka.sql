-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 28, 2019 at 11:36 PM
-- Server version: 5.7.28
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `winnef94_melaka`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_role`
--

CREATE TABLE `admin_role` (
  `role_id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `level` enum('R','W') NOT NULL DEFAULT 'W'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin_role`
--

INSERT INTO `admin_role` (`role_id`, `user_id`, `level`) VALUES
(1, 2, 'W'),
(2, 2, 'W'),
(4, 2, 'R'),
(1, 3, 'W'),
(2, 3, 'W'),
(3, 3, 'R');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(10) UNSIGNED NOT NULL,
  `show_id` int(10) UNSIGNED NOT NULL,
  `total` decimal(10,2) UNSIGNED NOT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL,
  `created_time` datetime NOT NULL,
  `status` enum('PENDING','CANCELED','CONFIRMED') NOT NULL DEFAULT 'PENDING',
  `helper_id` int(10) UNSIGNED NOT NULL,
  `confirmation_id` varchar(100) DEFAULT NULL,
  `payment_type` enum('CASH','CARD','PAYPAL','IPAY88','WECHAT') DEFAULT NULL,
  `client_name` varchar(100) NOT NULL,
  `client_email` varchar(100) NOT NULL,
  `client_phone` varchar(100) NOT NULL,
  `client_country` varchar(100) NOT NULL,
  `card_type` blob,
  `card_number` blob,
  `card_exp_month` blob,
  `card_exp_year` blob,
  `card_code` blob,
  `is_sent` tinyint(1) UNSIGNED NOT NULL DEFAULT '0',
  `send_time` datetime DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `duration` varchar(100) DEFAULT NULL,
  `venue_id` int(10) UNSIGNED NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `time` varchar(100) DEFAULT NULL,
  `description` text,
  `status` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `title`, `duration`, `venue_id`, `from_date`, `to_date`, `time`, `description`, `status`) VALUES
(1, 'RASA MELAKA (March, 2019)', '60', 1, '2019-03-01', '2019-03-31', '03:00 pm', NULL, 'T'),
(2, 'RASA MELAKA (AUGUST, 2019)', '75', 1, '2019-08-01', '2019-08-31', '03:00 pm, 08:00 pm', NULL, 'T'),
(3, 'RASA MELAKA (SEPTEMBER, 2019)', '75', 1, '2019-09-01', '2019-10-31', '03:00 pm', NULL, 'T'),
(4, 'new stage(test)', 'test duration', 1, '2019-10-12', '2019-10-26', NULL, 'I don\'t know about that', 'T'),
(5, 'Test Event', 'Test', 1, '2019-10-28', '2019-10-29', NULL, 'This is the Event for test', 'T'),
(6, 'Second Test Event', 'Second Test Event', 2, '2019-10-28', '2019-10-29', NULL, 'Second Test Event\r\nSecond Test Event\r\nSecond Test Event', 'T');

-- --------------------------------------------------------

--
-- Table structure for table `package`
--

CREATE TABLE `package` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `ticket_type` enum('M','NM','C','VIP','MC','F') NOT NULL DEFAULT 'M',
  `tickets` tinyint(3) UNSIGNED NOT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `package`
--

INSERT INTO `package` (`id`, `name`, `ticket_type`, `tickets`, `status`) VALUES
(1, 'BUY 2 FREE 1', 'VIP', 3, 'T'),
(2, 'BUY 2 FREE 1', 'C', 3, 'T'),
(3, 'BUY 3 FREE 1', 'C', 4, 'T'),
(4, 'BUY 3 FREE 1', 'VIP', 4, 'T');

-- --------------------------------------------------------

--
-- Table structure for table `package_price`
--

CREATE TABLE `package_price` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `package_id` int(10) UNSIGNED NOT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `quota` int(5) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `price`
--

CREATE TABLE `price` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `ticket_type` enum('M','NM','C','VIP','MC','F') NOT NULL DEFAULT 'M',
  `seats` text,
  `weekday_price` decimal(10,2) UNSIGNED DEFAULT NULL,
  `weekend_price` decimal(10,2) UNSIGNED DEFAULT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `price`
--

INSERT INTO `price` (`id`, `event_id`, `ticket_type`, `seats`, `weekday_price`, `weekend_price`, `status`) VALUES
(17, 3, 'NM', '[\"1\"]', 45.00, 60.00, 'T'),
(18, 3, 'M', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"61\",\"62\",\"63\",\"64\",\"65\",\"66\",\"67\",\"68\",\"69\",\"70\",\"71\",\"72\",\"73\",\"74\",\"75\",\"76\",\"77\",\"78\",\"79\",\"80\",\"81\",\"82\",\"83\",\"84\",\"85\",\"86\",\"87\",\"88\",\"89\",\"90\",\"91\",\"92\",\"93\",\"94\",\"95\",\"96\",\"97\",\"98\",\"99\",\"100\",\"101\",\"102\",\"103\",\"104\"]', 48.00, 50.00, 'T'),
(20, 4, 'M', '[\"1\",\"2\",\"3\",\"4\",\"5\",\"6\",\"7\",\"8\",\"9\",\"10\",\"11\",\"12\",\"13\",\"14\",\"15\",\"16\",\"17\",\"18\",\"19\",\"20\",\"21\",\"22\",\"23\",\"24\",\"25\",\"26\",\"27\",\"28\",\"29\",\"30\",\"31\",\"32\",\"33\",\"34\",\"35\",\"36\",\"37\",\"38\",\"39\",\"40\",\"41\",\"42\",\"43\",\"44\",\"45\",\"46\",\"47\",\"48\",\"49\",\"50\",\"51\",\"52\",\"53\",\"54\",\"55\",\"56\",\"57\",\"58\",\"59\",\"60\",\"113\",\"62\",\"63\",\"64\",\"65\",\"66\",\"67\",\"68\",\"69\",\"70\",\"71\",\"72\",\"73\",\"74\",\"75\",\"76\",\"77\",\"78\",\"79\",\"80\",\"81\",\"82\",\"83\",\"84\",\"85\",\"86\",\"87\",\"88\",\"89\",\"90\",\"91\",\"92\",\"93\",\"94\",\"95\",\"96\",\"97\",\"98\",\"99\",\"100\",\"101\",\"102\",\"103\",\"104\",\"105\",\"106\",\"107\",\"108\",\"109\",\"110\",\"111\",\"112\"]', 25.00, 32.00, 'T'),
(19, 3, 'VIP', '', 80.00, 90.00, 'F');

-- --------------------------------------------------------

--
-- Table structure for table `promotion_event`
--

CREATE TABLE `promotion_event` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `ticket_type` enum('M','NM','C','VIP','MC','F') DEFAULT NULL,
  `package_id` int(10) UNSIGNED DEFAULT NULL,
  `from_date` date NOT NULL,
  `to_date` date NOT NULL,
  `quota` int(5) UNSIGNED NOT NULL,
  `week` enum('WEEKDAY','WEEKEND','BOTH') NOT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'T',
  `limit_status` enum('T','F') NOT NULL DEFAULT 'F',
  `limit_start` date DEFAULT NULL,
  `limit_end` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `promotion_event`
--

INSERT INTO `promotion_event` (`id`, `name`, `event_id`, `ticket_type`, `package_id`, `from_date`, `to_date`, `quota`, `week`, `price`, `status`, `limit_status`, `limit_start`, `limit_end`) VALUES
(1, 'test', 3, NULL, 1, '2019-09-06', '2019-09-07', 100, 'BOTH', 20.00, 'T', 'F', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `name`, `description`, `status`) VALUES
(1, 'Account Management', NULL, 'T'),
(2, 'Agents Management', NULL, 'T'),
(3, 'Counters Management', NULL, 'T'),
(4, 'Hall management', NULL, 'T'),
(5, 'Shows management', NULL, 'T'),
(6, 'Booking management', NULL, 'T'),
(7, 'Reports management', NULL, 'T');

-- --------------------------------------------------------

--
-- Table structure for table `role_url`
--

CREATE TABLE `role_url` (
  `id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL,
  `url` varchar(255) NOT NULL,
  `level` enum('R','W') NOT NULL DEFAULT 'W',
  `status` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `show`
--

CREATE TABLE `show` (
  `id` int(10) UNSIGNED NOT NULL,
  `event_id` int(10) UNSIGNED NOT NULL,
  `date_time` datetime NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `show`
--

INSERT INTO `show` (`id`, `event_id`, `date_time`, `description`, `status`) VALUES
(1, 1, '2019-03-01 15:00:00', NULL, 'T'),
(2, 1, '2019-03-10 15:00:00', NULL, 'T'),
(3, 2, '2019-08-25 15:00:00', NULL, 'T'),
(4, 2, '2019-08-25 20:00:00', NULL, 'T'),
(24, 3, '2019-09-03 15:00:00', NULL, 'F'),
(21, 3, '2019-09-01 15:00:00', NULL, 'T'),
(22, 3, '2019-09-01 20:00:00', NULL, 'T'),
(23, 3, '2019-09-02 15:00:00', NULL, 'F'),
(25, 3, '2019-09-04 15:00:00', NULL, 'T'),
(26, 3, '2019-09-05 15:00:00', NULL, 'T'),
(27, 3, '2019-09-06 20:00:00', NULL, 'T'),
(28, 3, '2019-09-06 15:00:00', NULL, 'T'),
(29, 3, '2019-09-13 15:00:00', NULL, 'T'),
(31, 3, '2019-09-20 15:00:00', NULL, 'T'),
(32, 3, '2019-09-24 15:00:00', NULL, 'T'),
(33, 3, '2019-10-12 15:00:00', NULL, 'T'),
(34, 3, '2019-10-12 20:00:00', NULL, 'T'),
(35, 4, '2019-10-19 15:00:00', NULL, 'T'),
(36, 4, '2019-10-19 20:00:00', NULL, 'T');

-- --------------------------------------------------------

--
-- Table structure for table `ticket`
--

CREATE TABLE `ticket` (
  `id` int(10) UNSIGNED NOT NULL,
  `booking_id` int(10) UNSIGNED NOT NULL,
  `seat_id` int(10) UNSIGNED NOT NULL,
  `seat_name` varchar(50) NOT NULL,
  `ticket_type` enum('M','NM','C','VIP','MC','F') NOT NULL,
  `price_id` int(10) UNSIGNED NOT NULL,
  `price` decimal(10,2) UNSIGNED NOT NULL,
  `status` enum('A','S','P','L') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(10) UNSIGNED NOT NULL,
  `uid` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `discount` decimal(5,2) UNSIGNED DEFAULT NULL,
  `account_type` enum('ADMIN','SUB_ADMIN','AGENT','SUB_AGENT_LV3','SUB_AGENT_LV4','COUNTER') NOT NULL,
  `created_time` datetime NOT NULL,
  `creator_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `last_login` datetime DEFAULT NULL,
  `is_active` enum('T','F') NOT NULL DEFAULT 'T',
  `free` enum('T','F') DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `uid`, `name`, `email`, `password`, `phone`, `discount`, `account_type`, `created_time`, `creator_id`, `last_login`, `is_active`, `free`) VALUES
(1, 'admin', 'Administrator', 'admin@mail.com', '$2y$10$QGzHbd6YeG1IYFNz.wL3S.bvbZ67AFT.Yg6B4rCJeG3z.rmvyjFr2', '12345678', NULL, 'ADMIN', '2019-08-04 21:35:06', 0, '2019-10-28 15:02:38', 'T', NULL),
(2, 'subadmin1', 'sa1', 'sa1@mail.com', '$2y$10$QGzHbd6YeG1IYFNz.wL3S.bvbZ67AFT.Yg6B4rCJeG3z.rmvyjFr2', '123456', NULL, 'SUB_ADMIN', '2019-08-13 10:51:59', 1, NULL, 'T', NULL),
(3, 'zhigang', 'zhigang', 'zhigang@mail.com', '$2y$10$QGzHbd6YeG1IYFNz.wL3S.bvbZ67AFT.Yg6B4rCJeG3z.rmvyjFr2', '111222333', NULL, 'SUB_ADMIN', '2019-08-16 16:50:43', 1, NULL, 'T', NULL),
(4, 'cc1', 'ct1', 'ct1@mail.com', '$2y$10$QGzHbd6YeG1IYFNz.wL3S.bvbZ67AFT.Yg6B4rCJeG3z.rmvyjFr2', '1122334455', NULL, 'COUNTER', '2019-08-16 17:20:22', 1, NULL, 'T', 'T'),
(5, 'A1001', 'ag1111', 'ag12@mail.com', '$2y$10$QGzHbd6YeG1IYFNz.wL3S.bvbZ67AFT.Yg6B4rCJeG3z.rmvyjFr2', '98765111', 20.00, 'AGENT', '2019-08-17 02:38:26', 1, '2019-08-21 19:06:13', 'F', NULL),
(6, 'A1002', 'ag2', 'ag222@mail.com', '$2y$10$QGzHbd6YeG1IYFNz.wL3S.bvbZ67AFT.Yg6B4rCJeG3z.rmvyjFr2', '1245', 15.00, 'AGENT', '2019-08-17 02:38:59', 1, '2019-09-10 18:36:03', 'T', NULL),
(7, 'G1001', 'tg1', 'tg1@mail.com', '$2y$10$QGzHbd6YeG1IYFNz.wL3S.bvbZ67AFT.Yg6B4rCJeG3z.rmvyjFr2', '43', 15.00, 'AGENT', '2019-08-17 02:39:26', 1, NULL, 'T', NULL),
(8, 'A1001-1', 'aaa', 'aaa@mail.com', '$2y$10$QGzHbd6YeG1IYFNz.wL3S.bvbZ67AFT.Yg6B4rCJeG3z.rmvyjFr2', '111', NULL, 'SUB_AGENT_LV3', '2019-08-16 21:19:28', 5, NULL, 'T', NULL),
(9, 'A1003', 'new agent1', 'aaa@mail.com', '$2y$10$QGzHbd6YeG1IYFNz.wL3S.bvbZ67AFT.Yg6B4rCJeG3z.rmvyjFr2', NULL, NULL, 'AGENT', '2019-09-10 18:34:22', 1, NULL, 'T', NULL),
(10, 'Z1001', 'new rasa melaka agent', 'aaa@mail.com', '$2y$10$nZG6RIr/hnyzuPMsos.QHeYPTAWwklKZmlE9/eX1VgP1k3FliBLyW', '123', 10.00, 'AGENT', '2019-09-10 18:44:45', 1, NULL, 'T', NULL),
(11, 'A1004', 'KS TRAVEL', 'kstravel@yahoo.com', '$2y$10$fhD5XPI5kfO2dpVkS6jlg.ZCcBshk8VsMMOOSQYRGAqLc40KOvyMa', '017-111111', 20.00, 'AGENT', '2019-09-11 00:56:04', 1, '2019-09-11 01:10:42', 'T', NULL),
(12, 'test_subadmin3', 'nick', 'nick@nick.com', '$2y$10$O4WKEyWwdg/vncBrkwvq2u0M8kYL.TNUdTISITKpa6ZoT0I7mOLpK', '123123123123123', NULL, 'SUB_ADMIN', '2019-10-12 15:29:19', 1, NULL, 'T', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_payment_type`
--

CREATE TABLE `user_payment_type` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `payment_type` enum('CASH','CARD','PAYPAL','IPAY88','WECHAT') NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_payment_type`
--

INSERT INTO `user_payment_type` (`id`, `user_id`, `payment_type`) VALUES
(1, 6, 'CASH'),
(2, 6, 'PAYPAL'),
(4, 5, 'IPAY88'),
(5, 11, 'CASH'),
(6, 11, 'PAYPAL'),
(7, 11, 'IPAY88'),
(8, 6, 'IPAY88');

-- --------------------------------------------------------

--
-- Table structure for table `venue`
--

CREATE TABLE `venue` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `seats_count` int(10) UNSIGNED DEFAULT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venue`
--

INSERT INTO `venue` (`id`, `name`, `description`, `seats_count`, `status`) VALUES
(1, 'venue-1', NULL, 113, 'T'),
(2, 'test', 'test', NULL, 'T');

-- --------------------------------------------------------

--
-- Table structure for table `venue_seat`
--

CREATE TABLE `venue_seat` (
  `id` int(10) UNSIGNED NOT NULL,
  `venue_id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `floor` tinyint(3) UNSIGNED NOT NULL DEFAULT '0',
  `top` int(5) UNSIGNED DEFAULT NULL,
  `left` int(5) UNSIGNED DEFAULT NULL,
  `width` int(5) UNSIGNED DEFAULT NULL,
  `height` int(5) UNSIGNED DEFAULT NULL,
  `status` enum('T','F') NOT NULL DEFAULT 'T'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `venue_seat`
--

INSERT INTO `venue_seat` (`id`, `venue_id`, `name`, `floor`, `top`, `left`, `width`, `height`, `status`) VALUES
(1, 1, '1', 0, 805, 44, 22, 22, 'T'),
(2, 1, '2', 0, 805, 75, 22, 22, 'T'),
(3, 1, '3', 0, 805, 106, 22, 22, 'T'),
(4, 1, '4', 0, 805, 137, 22, 22, 'T'),
(5, 1, '5', 0, 805, 167, 22, 22, 'T'),
(6, 1, '6', 0, 805, 198, 22, 22, 'T'),
(7, 1, '7', 0, 803, 321, 22, 22, 'T'),
(8, 1, '8', 0, 803, 351, 22, 22, 'T'),
(9, 1, '9', 0, 803, 382, 22, 22, 'T'),
(10, 1, '10', 0, 803, 412, 22, 22, 'F'),
(11, 1, '11', 0, 803, 444, 22, 22, 'F'),
(12, 1, '12', 0, 803, 474, 22, 22, 'F'),
(13, 1, '13', 0, 804, 593, 22, 22, 'T'),
(14, 1, '14', 0, 804, 624, 22, 22, 'T'),
(15, 1, '15', 0, 804, 655, 22, 22, 'T'),
(16, 1, '16', 0, 804, 685, 22, 22, 'T'),
(17, 1, '17', 0, 803, 716, 22, 22, 'T'),
(18, 1, '18', 0, 803, 747, 22, 22, 'T'),
(19, 1, '19', 0, 767, 61, 22, 22, 'T'),
(20, 1, '20', 0, 767, 92, 22, 22, 'T'),
(21, 1, '21', 0, 766, 122, 22, 22, 'T'),
(22, 1, '22', 0, 766, 153, 22, 22, 'T'),
(23, 1, '23', 0, 766, 183, 22, 22, 'T'),
(24, 1, '24', 0, 767, 334, 22, 22, 'T'),
(25, 1, '25', 0, 767, 365, 22, 22, 'T'),
(26, 1, '26', 0, 768, 396, 22, 22, 'T'),
(27, 1, '27', 0, 767, 426, 22, 22, 'T'),
(28, 1, '28', 0, 767, 457, 22, 22, 'T'),
(29, 1, '29', 0, 765, 611, 22, 22, 'T'),
(30, 1, '30', 0, 765, 641, 22, 22, 'T'),
(31, 1, '31', 0, 765, 672, 22, 22, 'T'),
(32, 1, '32', 0, 766, 702, 22, 22, 'T'),
(33, 1, '33', 0, 765, 733, 22, 22, 'T'),
(34, 1, '34', 0, 729, 44, 22, 22, 'T'),
(35, 1, '35', 0, 729, 76, 22, 22, 'T'),
(36, 1, '36', 0, 727, 106, 22, 22, 'T'),
(37, 1, '37', 0, 729, 137, 22, 22, 'T'),
(38, 1, '38', 0, 728, 168, 22, 22, 'T'),
(39, 1, '39', 0, 729, 198, 22, 22, 'T'),
(40, 1, '40', 0, 729, 320, 22, 22, 'T'),
(41, 1, '41', 0, 729, 351, 22, 22, 'T'),
(42, 1, '42', 0, 728, 381, 22, 22, 'T'),
(43, 1, '43', 0, 728, 412, 22, 22, 'T'),
(44, 1, '44', 0, 728, 442, 22, 22, 'T'),
(45, 1, '45', 0, 728, 473, 22, 22, 'T'),
(46, 1, '46', 0, 728, 594, 22, 22, 'T'),
(47, 1, '47', 0, 729, 624, 22, 22, 'T'),
(48, 1, '48', 0, 729, 655, 22, 22, 'T'),
(49, 1, '49', 0, 728, 685, 22, 22, 'T'),
(50, 1, '50', 0, 728, 716, 22, 22, 'T'),
(51, 1, '51', 0, 728, 747, 22, 22, 'T'),
(52, 1, '52', 0, 689, 62, 22, 22, 'T'),
(53, 1, '53', 0, 689, 92, 22, 22, 'T'),
(54, 1, '54', 0, 690, 123, 22, 22, 'T'),
(55, 1, '55', 0, 689, 154, 22, 22, 'T'),
(56, 1, '56', 0, 689, 185, 22, 22, 'T'),
(57, 1, '57', 0, 691, 305, 22, 22, 'T'),
(58, 1, '58', 0, 691, 335, 22, 22, 'T'),
(59, 1, '59', 0, 691, 366, 22, 22, 'T'),
(60, 1, '60', 0, 691, 397, 22, 22, 'T'),
(113, 1, '112', 0, 548, 730, 25, 25, 'T'),
(62, 1, '62', 0, 691, 458, 22, 22, 'T'),
(63, 1, '63', 0, 691, 489, 22, 22, 'T'),
(64, 1, '64', 0, 689, 611, 22, 22, 'T'),
(65, 1, '65', 0, 689, 641, 22, 22, 'T'),
(66, 1, '66', 0, 689, 672, 22, 22, 'T'),
(67, 1, '67', 0, 689, 703, 22, 22, 'T'),
(68, 1, '68', 0, 689, 733, 22, 22, 'T'),
(69, 1, '69', 0, 652, 45, 22, 22, 'T'),
(70, 1, '70', 0, 652, 76, 22, 22, 'T'),
(71, 1, '71', 0, 652, 107, 22, 22, 'T'),
(72, 1, '72', 0, 652, 137, 22, 22, 'T'),
(73, 1, '73', 0, 652, 168, 22, 22, 'T'),
(74, 1, '74', 0, 652, 198, 22, 22, 'T'),
(75, 1, '75', 0, 653, 289, 22, 22, 'T'),
(76, 1, '76', 0, 653, 320, 22, 22, 'T'),
(77, 1, '77', 0, 654, 350, 22, 22, 'T'),
(78, 1, '78', 0, 654, 381, 22, 22, 'T'),
(79, 1, '79', 0, 654, 412, 22, 22, 'T'),
(80, 1, '80', 0, 654, 442, 22, 22, 'T'),
(81, 1, '81', 0, 654, 473, 22, 22, 'T'),
(82, 1, '82', 0, 654, 504, 22, 22, 'T'),
(83, 1, '83', 0, 652, 594, 22, 22, 'T'),
(84, 1, '84', 0, 652, 625, 22, 22, 'T'),
(85, 1, '85', 0, 652, 655, 22, 22, 'T'),
(86, 1, '86', 0, 652, 686, 22, 22, 'T'),
(87, 1, '87', 0, 652, 717, 22, 22, 'T'),
(88, 1, '88', 0, 652, 747, 22, 22, 'T'),
(89, 1, '89', 0, 615, 61, 22, 22, 'T'),
(90, 1, '90', 0, 615, 92, 22, 22, 'T'),
(91, 1, '91', 0, 615, 123, 22, 22, 'T'),
(92, 1, '92', 0, 615, 153, 22, 22, 'T'),
(93, 1, '93', 0, 615, 184, 22, 22, 'T'),
(94, 1, '94', 0, 616, 322, 22, 22, 'T'),
(95, 1, '95', 0, 616, 353, 22, 22, 'T'),
(96, 1, '96', 0, 616, 385, 22, 22, 'T'),
(97, 1, '97', 0, 616, 415, 22, 22, 'T'),
(98, 1, '98', 0, 616, 445, 22, 22, 'T'),
(99, 1, '99', 0, 616, 477, 22, 22, 'T'),
(100, 1, '100', 0, 615, 610, 22, 22, 'T'),
(101, 1, '101', 0, 615, 641, 22, 22, 'T'),
(102, 1, '102', 0, 615, 671, 22, 22, 'T'),
(103, 1, '103', 0, 615, 702, 22, 22, 'T'),
(104, 1, '104', 0, 615, 733, 22, 22, 'T'),
(105, 1, '105', 0, 549, 44, 25, 25, 'T'),
(106, 1, '106', 0, 550, 73, 25, 25, 'T'),
(107, 1, '107', 0, 550, 295, 25, 25, 'T'),
(108, 1, '108', 0, 513, 280, 25, 25, 'T'),
(109, 1, '109', 0, 434, 253, 25, 25, 'T'),
(110, 1, '110', 0, 401, 578, 25, 25, 'T'),
(111, 1, '111', 0, 86, 529, 25, 25, 'T'),
(112, 1, '112', 0, 84, 483, 25, 25, 'T'),
(114, 1, '113', 0, 89, 313, 25, 25, 'T');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_role`
--
ALTER TABLE `admin_role`
  ADD KEY `role_id` (`role_id`),
  ADD KEY `level` (`level`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`),
  ADD KEY `status` (`status`),
  ADD KEY `from_date` (`from_date`),
  ADD KEY `to_date` (`to_date`),
  ADD KEY `venue_id` (`venue_id`);

--
-- Indexes for table `package`
--
ALTER TABLE `package`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `ticket_type` (`ticket_type`),
  ADD KEY `tickets` (`tickets`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `package_price`
--
ALTER TABLE `package_price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `from_date` (`from_date`),
  ADD KEY `to_date` (`to_date`),
  ADD KEY `quota` (`quota`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `price`
--
ALTER TABLE `price`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `ticket_type` (`ticket_type`),
  ADD KEY `status` (`status`);
ALTER TABLE `price` ADD FULLTEXT KEY `seats` (`seats`);

--
-- Indexes for table `promotion_event`
--
ALTER TABLE `promotion_event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `package_id` (`package_id`),
  ADD KEY `from_date` (`from_date`),
  ADD KEY `to_date` (`to_date`),
  ADD KEY `quota` (`quota`),
  ADD KEY `status` (`status`),
  ADD KEY `ticket_type` (`ticket_type`),
  ADD KEY `week` (`week`),
  ADD KEY `name` (`name`),
  ADD KEY `limit_status` (`limit_status`),
  ADD KEY `limit_start` (`limit_start`),
  ADD KEY `limit_end` (`limit_end`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `status` (`status`),
  ADD KEY `name` (`name`);

--
-- Indexes for table `role_url`
--
ALTER TABLE `role_url`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `url` (`url`),
  ADD KEY `level` (`level`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `show`
--
ALTER TABLE `show`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_id` (`event_id`),
  ADD KEY `date_time` (`date_time`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`id`),
  ADD KEY `booking_id` (`booking_id`),
  ADD KEY `ticket_type` (`ticket_type`),
  ADD KEY `price_id` (`price_id`),
  ADD KEY `status` (`status`),
  ADD KEY `seat_id` (`seat_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `uid` (`uid`),
  ADD KEY `name` (`name`),
  ADD KEY `email` (`email`),
  ADD KEY `phone` (`phone`),
  ADD KEY `account_type` (`account_type`),
  ADD KEY `created_time` (`created_time`),
  ADD KEY `is_active` (`is_active`),
  ADD KEY `creator_id` (`creator_id`),
  ADD KEY `free` (`free`);

--
-- Indexes for table `user_payment_type`
--
ALTER TABLE `user_payment_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`,`payment_type`);

--
-- Indexes for table `venue`
--
ALTER TABLE `venue`
  ADD PRIMARY KEY (`id`),
  ADD KEY `name` (`name`),
  ADD KEY `status` (`status`);

--
-- Indexes for table `venue_seat`
--
ALTER TABLE `venue_seat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `venue_id` (`venue_id`),
  ADD KEY `name` (`name`),
  ADD KEY `floor` (`floor`),
  ADD KEY `status` (`status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `package`
--
ALTER TABLE `package`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `package_price`
--
ALTER TABLE `package_price`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `price`
--
ALTER TABLE `price`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `promotion_event`
--
ALTER TABLE `promotion_event`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role_url`
--
ALTER TABLE `role_url`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `show`
--
ALTER TABLE `show`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_payment_type`
--
ALTER TABLE `user_payment_type`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `venue`
--
ALTER TABLE `venue`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `venue_seat`
--
ALTER TABLE `venue_seat`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
