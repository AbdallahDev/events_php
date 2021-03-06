-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2018 at 01:14 PM
-- Server version: 10.1.26-MariaDB
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
-- Database: `eventsdev`
--

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `event_entity_name` varchar(150) NOT NULL DEFAULT '' COMMENT 'here i made the default value empty coz it''s not always filled',
  `time` time NOT NULL,
  `event_appointment` varchar(30) DEFAULT '' COMMENT 'i''ll make it''s default value empty string "" coz it''s not always set',
  `subject` text NOT NULL,
  `event_date` date NOT NULL,
  `hall_id` int(11) NOT NULL,
  `event_place` varchar(150) NOT NULL DEFAULT '' COMMENT 'i''ll make it''s default value empty string "" coz it''s not always set',
  `event_insertion_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id_insert` int(11) NOT NULL,
  `event_edit_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id_edit` int(11) NOT NULL DEFAULT '-1',
  `directorate_id` int(11) NOT NULL DEFAULT '2' COMMENT 'the default value of this column is 2 coz all the users are from the legislative affairs directorate, so i wan''t need to change the value by code later.',
  `event_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `event_entity_name`, `time`, `event_appointment`, `subject`, `event_date`, `hall_id`, `event_place`, `event_insertion_date`, `user_id_insert`, `event_edit_date`, `user_id_edit`, `directorate_id`, `event_status`) VALUES
(945, 'لجنة مشتركة', '14:13:00', '', '', '2018-11-26', 0, '', '2018-11-26 14:13:51', 30566, '0000-00-00 00:00:00', -1, 2, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=946;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
