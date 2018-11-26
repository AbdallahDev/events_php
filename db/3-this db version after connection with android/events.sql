-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2018 at 10:59 AM
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
  `committee_id` int(11) NOT NULL DEFAULT '2' COMMENT 'i''ll make the default valus as 2 coz i''m intending to delete this column in the future',
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

INSERT INTO `events` (`id`, `committee_id`, `event_entity_name`, `time`, `event_appointment`, `subject`, `event_date`, `hall_id`, `event_place`, `event_insertion_date`, `user_id_insert`, `event_edit_date`, `user_id_edit`, `directorate_id`, `event_status`) VALUES
(914, 10, '', '10:26:00', '', '', '2018-11-26', 0, '', '2018-11-26 10:26:27', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(915, 10, '', '10:26:00', '', '', '2018-11-26', 0, '', '2018-11-26 10:26:56', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(916, 10, '', '10:26:00', '', '', '2018-11-26', 0, '', '2018-11-26 10:27:12', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(917, 20, '', '10:27:00', '', '', '2018-11-26', 0, '', '2018-11-26 10:27:17', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(918, 24, '', '10:27:00', '', '', '2018-11-26', 0, '', '2018-11-26 10:27:38', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(919, 24, '', '10:27:00', '', '', '2018-11-26', 0, '', '2018-11-26 10:27:59', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(920, 10, '', '10:28:00', '', '', '2018-11-26', 0, '', '2018-11-26 10:28:13', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(921, 2, '', '01:00:00', NULL, 'subjec', '2018-11-05', 3, '', '2018-11-26 11:46:31', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(922, 2, '', '01:00:00', '', 'subject', '2018-11-05', 3, '', '2018-11-26 11:59:09', 30566, '0000-00-00 00:00:00', -1, 2, 0);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=923;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
