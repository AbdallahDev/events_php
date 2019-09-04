-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 04, 2019 at 12:45 PM
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
-- Database: `eventsdevtest`
--

-- --------------------------------------------------------

--
-- Table structure for table `backgrounds`
--

CREATE TABLE `backgrounds` (
  `background_id` int(11) NOT NULL,
  `background_path` varchar(150) NOT NULL,
  `background_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `backgrounds`
--

INSERT INTO `backgrounds` (`background_id`, `background_path`, `background_status`) VALUES
(506, '../imgs/backgrounds/background.png', 0),
(514, '../imgs/backgrounds/background_black.png', 0),
(524, '../imgs/backgrounds/events.jpg', 0),
(527, '../imgs/backgrounds/الشاشة.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `committee_id` int(11) NOT NULL,
  `committee_name` varchar(100) NOT NULL,
  `event_entity_category_id` int(11) NOT NULL COMMENT 'this column to add event_entity_category_id so that the system can know to which category the event belongs',
  `committee_rank` int(11) NOT NULL DEFAULT '1' COMMENT 'this row to give committees rank as the one in the internal JHR rules of procedure, and i made the default value as 1 coz most of the event entities dosen''t need a rank',
  `directorate_id` int(11) NOT NULL DEFAULT '2' COMMENT 'i''ve made the default value for the directorate_id as 2 coz all the users are from this directorate so i''ll not need to change it using the code'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='this table to store event entities, but it called committees coz i started the project with it, but i''ll try to change it in the future to event_entities';

--
-- Dumping data for table `committees`
--

INSERT INTO `committees` (`committee_id`, `committee_name`, `event_entity_category_id`, `committee_rank`, `directorate_id`) VALUES
(2, '', 0, 500, 2),
(3, '', 0, 500, 3),
(4, '', 0, 500, 4),
(9, 'لجنة العمل والتنمية الاجتماعية والسكان', 1, 11, 2),
(10, 'اللجنة القانونية', 1, 1, 2),
(11, 'لجنة الخدمات العامة والنقل', 1, 13, 2),
(12, 'لجنة التربية والتعليم والثقافة', 1, 6, 2),
(13, 'لجنة الشؤون الخارجية', 1, 4, 2),
(14, 'لجنة النزاهة والشفافية وتقصي الحقائق', 1, 19, 2),
(15, 'لجنة الصحة والبيئة', 1, 9, 2),
(16, 'لجنة الشباب والرياضة', 1, 7, 2),
(17, 'لجنة الاقتصاد والاستثمار', 1, 3, 2),
(19, 'لجنة السياحة والاثار', 1, 14, 2),
(20, 'لجنة الاخوة الاردنية السعودية', 3, 1, 3),
(21, 'لجنة الاخوة الاردنية الجزائرية', 3, 1, 3),
(22, 'لجنة الاخوة الاردنية القطرية', 3, 1, 3),
(23, 'لجنة الاخوة البرلمانية الاردنية اللبنانية', 3, 1, 3),
(24, 'كتلة الوفاء والعهد', 2, 1, 4),
(28, 'كتلة التجديد', 2, 1, 4),
(31, 'لجنة الطاقة والثروة المعدنية', 1, 12, 2),
(38, 'اللجنة المالية', 1, 2, 2),
(39, 'اللجنة الادارية', 1, 5, 2),
(40, 'لجنة التوجيه الوطني والاعلام', 1, 8, 2),
(41, 'لجنة الزراعة والمياه', 1, 10, 2),
(42, 'لجنة الحريات العامة وحقوق الانسان', 1, 15, 2),
(43, 'لجنة فلسطين', 1, 16, 2),
(44, 'لجنة الريف والبادية', 1, 17, 2),
(45, 'لجنة النظام والسلوك', 1, 18, 2),
(46, 'لجنة المرأة وشؤون الأسرة', 1, 20, 2),
(47, 'كتلة العدالة', 2, 1, 2),
(49, 'لجنة الاخوة الاردنية الاماراتية', 3, 1, 2),
(50, 'لجنة الاخوة الاردنية المصرية', 3, 1, 2),
(51, 'لجنة الصداقة الاردنية التركية', 4, 1, 2),
(52, 'لجنة الصداقة الاردنية السويدية', 4, 1, 2),
(53, 'لجنة الصداقة الاردنية الامريكية', 4, 1, 2),
(54, 'المكتب الدائم', 5, 1, 2),
(55, 'المكتب التنفيذي', 6, 1, 2);

-- --------------------------------------------------------

--
-- Table structure for table `device_token`
--

CREATE TABLE `device_token` (
  `device_token_id` int(11) NOT NULL,
  `device_token` varchar(200) NOT NULL,
  `device_identifier` varchar(50) NOT NULL,
  `device_name` varchar(50) NOT NULL,
  `device_model` varchar(50) NOT NULL,
  `device_isPhysical` varchar(50) NOT NULL,
  `dateTime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `device_token`
--

INSERT INTO `device_token` (`device_token_id`, `device_token`, `device_identifier`, `device_name`, `device_model`, `device_isPhysical`, `dateTime`) VALUES
(9781, 'fFvIoENDvDE:APA91bEkSsZ_DlQbhXHil1C_E6oR6OT0SirDo6HGKgWW07knGzZxuM8Hu1vC6TUm7Wcnwn7yq1i6dCX2fPHnM4uHDRbLj3QR-wJWEAoMGxMSlLIsDouE4w8BKELZ_NJf7DuZrXpO55Ik', 'f8bf9bb64453d638', 'generic_x86', 'Android SDK built for x86', 'false', '2019-09-04 08:29:02'),
(9782, 'd-AjkBLyEsc:APA91bEHIEco8M8rRVL6fxOfv2ORoqESfBIjSvxpra2uDnTX8f0uOmXbWUM_3LrelMajTmEeabUQnWhK9Uh6689RPdWJf-T31Xo4iL4BX-E0cUMlqAzR3pgNCog5ou9tfTw0o9AhUHwv', '5881efe6d38c34bd', 'generic_x86', 'Android SDK built for x86', 'false', '2019-09-04 08:52:02');

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
(231, '', '13:20:00', '', '', '2019-08-23', 0, '', '2019-08-22 13:20:34', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(232, '', '13:56:00', '', '', '2019-08-23', 0, '', '2019-08-22 13:56:21', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(233, '', '13:56:00', '', '', '2019-08-23', 0, '', '2019-08-22 13:57:35', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(234, '', '13:58:00', '', '', '2019-08-23', 0, '', '2019-08-22 13:58:17', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(235, '', '13:58:00', '', '', '2019-08-23', 0, '', '2019-08-22 13:59:05', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(236, '', '13:59:00', '', '', '2019-08-23', 0, '', '2019-08-22 13:59:29', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(237, '', '13:59:00', '', '', '2019-08-23', 0, '', '2019-08-22 13:59:47', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(238, '', '14:00:00', '', '', '2019-08-23', 0, '', '2019-08-22 14:00:03', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(239, '', '14:00:00', '', '', '2019-08-23', 0, '', '2019-08-22 14:00:46', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(240, '', '14:16:00', '', '', '2019-08-23', 0, '', '2019-08-22 14:16:13', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(241, '', '14:18:00', '', '', '2019-08-23', 0, '', '2019-08-22 14:18:49', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(242, '', '14:28:00', '', '', '2019-08-23', 0, '', '2019-08-22 14:29:02', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(243, '', '14:30:00', '', '', '2019-08-23', 0, '', '2019-08-22 14:30:58', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(244, '', '14:31:00', '', '', '2019-08-23', 0, '', '2019-08-22 14:31:32', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(245, '', '14:40:00', '', '', '2019-08-23', 0, '', '2019-08-22 14:40:44', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(246, '', '11:19:00', '', '', '2019-08-29', 0, '', '2019-08-28 11:19:43', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(247, '', '11:20:00', '', '', '2019-08-29', 0, '', '2019-08-28 11:20:14', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(248, '', '11:27:00', '', '', '2019-08-29', 0, '', '2019-08-28 11:27:40', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(249, '', '11:29:00', '', '', '2019-08-29', 0, '', '2019-08-28 11:29:47', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(250, '', '11:30:00', '', '', '2019-08-29', 0, '', '2019-08-28 11:30:37', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(251, '', '11:31:00', '', '', '2019-08-29', 0, '', '2019-08-28 11:31:44', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(252, '', '11:32:00', '', '', '2019-08-29', 0, '', '2019-08-28 11:32:30', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(253, '', '12:29:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:29:14', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(254, '', '12:29:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:30:01', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(255, '', '12:32:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:32:45', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(256, '', '12:34:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:34:41', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(257, '', '12:35:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:35:52', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(258, '', '12:37:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:37:52', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(259, '', '12:38:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:38:10', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(260, '', '12:39:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:39:31', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(261, '', '12:54:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:54:35', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(262, '', '12:55:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:55:26', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(263, '', '12:55:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:56:00', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(264, '', '12:56:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:56:23', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(265, '', '12:57:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:57:44', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(266, '', '12:58:00', '', '', '2019-08-29', 0, '', '2019-08-28 12:58:42', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(267, '', '13:02:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:02:14', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(268, '', '13:02:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:02:50', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(269, '', '13:04:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:04:42', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(270, '', '13:12:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:13:03', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(271, '', '13:13:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:13:23', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(272, '', '13:15:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:15:21', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(273, '', '13:15:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:16:03', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(274, '', '13:16:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:16:43', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(275, '', '13:16:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:16:55', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(276, '', '13:21:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:21:18', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(277, '', '13:21:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:21:34', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(278, '', '13:23:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:23:31', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(279, '', '13:28:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:28:06', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(280, '', '13:36:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:36:46', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(281, '', '13:37:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:37:12', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(282, '', '13:37:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:37:27', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(283, '', '13:45:00', '', '', '2019-08-29', 0, '', '2019-08-28 13:45:10', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(284, '', '14:02:00', '', '', '2019-08-29', 0, '', '2019-08-28 14:02:55', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(285, '', '14:04:00', '', '', '2019-08-29', 0, '', '2019-08-28 14:04:14', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(286, '', '14:04:00', '', '', '2019-08-29', 0, '', '2019-08-28 14:04:31', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(287, '', '14:06:00', '', '', '2019-08-29', 0, '', '2019-08-28 14:06:32', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(288, '', '12:59:00', '', '', '2019-08-30', 0, '', '2019-08-29 12:59:33', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(289, '', '13:01:00', '', '', '2019-08-30', 0, '', '2019-08-29 13:01:06', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(290, '', '13:01:00', '', '', '2019-08-30', 0, '', '2019-08-29 13:01:18', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(291, '', '13:06:00', '', '', '2019-08-30', 0, '', '2019-08-29 13:06:11', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(292, '', '13:08:00', '', '', '2019-08-30', 0, '', '2019-08-29 13:08:35', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(293, '', '13:09:00', '', '', '2019-08-30', 0, '', '2019-08-29 13:09:25', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(294, '', '13:09:00', '', '', '2019-08-30', 0, '', '2019-08-29 13:09:44', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(295, '', '13:11:00', '', 'wwwwwwwwwwwwww', '2019-08-30', 0, '', '2019-08-29 13:11:34', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(296, '', '13:12:00', '', 'لجنة التربة ', '2019-08-30', 0, '', '2019-08-29 13:12:27', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(297, '', '13:13:00', '', '', '2019-08-30', 0, '', '2019-08-29 13:13:17', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(298, '', '13:13:00', '', 'المكتب التنفيذي', '2019-08-30', 0, '', '2019-08-29 13:13:34', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(299, '', '13:14:00', '', 'اللجنة المالية', '2019-08-30', 0, '', '2019-08-29 13:14:36', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(300, '', '13:16:00', '', 'الشؤون الخارجية', '2019-08-30', 0, '', '2019-08-29 13:16:31', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(301, '', '13:28:00', '', 'لجنة الاقتصاد والاستثمار', '2019-08-30', 0, '', '2019-08-29 13:28:48', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(302, '', '14:21:00', '', 'الشؤون الخارجية', '2019-08-30', 0, '', '2019-08-29 14:21:54', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(303, '', '14:22:00', '', 'الادارية', '2019-08-30', 0, '', '2019-08-29 14:22:12', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(304, '', '14:26:00', '', 'التربية', '2019-08-30', 0, '', '2019-08-29 14:26:34', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(305, '', '13:05:00', '', '11-11', '2019-09-02', 0, '', '2019-09-01 13:05:49', 30566, '0000-00-00 00:00:00', -1, 2, 0),
(306, '', '13:05:00', '', 'لجنة الاخوؤة', '2019-09-02', 0, '', '2019-09-01 13:06:40', 30566, '0000-00-00 00:00:00', -1, 2, 0);

-- --------------------------------------------------------

--
-- Table structure for table `event_entity_category`
--

CREATE TABLE `event_entity_category` (
  `event_entity_category_id` int(11) NOT NULL,
  `event_entity_category_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event_entity_category`
--

INSERT INTO `event_entity_category` (`event_entity_category_id`, `event_entity_category_name`) VALUES
(1, 'لجنة دائمة'),
(2, 'كتلة'),
(3, 'لجنة اخوة'),
(4, 'لجنة صداقة'),
(5, 'المكتب دائم'),
(6, 'المكتب تنفيذي');

-- --------------------------------------------------------

--
-- Table structure for table `event_event_entity`
--

CREATE TABLE `event_event_entity` (
  `event_id` int(11) NOT NULL,
  `event_entity_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='this table to store the events with the event entities related to them';

--
-- Dumping data for table `event_event_entity`
--

INSERT INTO `event_event_entity` (`event_id`, `event_entity_id`) VALUES
(231, 10),
(232, 24),
(233, 10),
(234, 55),
(235, 10),
(236, 24),
(237, 51),
(238, 54),
(239, 13),
(240, 10),
(241, 10),
(242, 24),
(243, 24),
(244, 20),
(245, 10),
(246, 10),
(247, 24),
(248, 24),
(249, 51),
(250, 54),
(251, 17),
(252, 24),
(253, 20),
(254, 10),
(255, 10),
(256, 51),
(257, 24),
(258, 51),
(259, 10),
(260, 54),
(261, 10),
(262, 24),
(263, 20),
(264, 20),
(265, 10),
(266, 51),
(267, 24),
(268, 20),
(269, 51),
(270, 39),
(271, 40),
(272, 44),
(273, 51),
(274, 24),
(275, 20),
(276, 54),
(277, 24),
(278, 51),
(279, 20),
(280, 51),
(281, 20),
(282, 20),
(283, 24),
(284, 51),
(285, 20),
(286, 24),
(287, 51),
(288, 24),
(289, 10),
(290, 20),
(291, 10),
(292, 20),
(293, 20),
(294, 54),
(295, 55),
(296, 12),
(297, 20),
(298, 55),
(299, 38),
(300, 13),
(301, 17),
(302, 13),
(303, 39),
(304, 12),
(305, 24),
(306, 20);

-- --------------------------------------------------------

--
-- Table structure for table `halls`
--

CREATE TABLE `halls` (
  `hall_id` int(11) NOT NULL,
  `hall_name` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `halls`
--

INSERT INTO `halls` (`hall_id`, `hall_name`) VALUES
(0, ''),
(3, 'قاعة عبدالله الشريدة الطابق الاول'),
(4, 'قاعة مصطفى خليفة الطابق الثاني'),
(5, 'قاعة عبدالقادر التل الطابق الاول'),
(6, 'قاعة كامل عريقات الطابق الاول'),
(7, 'قاعة المكتب الدائم الطابق الثاني'),
(8, 'قاعة عاكف الفايز الطابق الاول'),
(9, 'قاعة التشريفات الطابق الثاني'),
(10, 'قاعة عبدالحليم النمر الطابق الاول');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `page_id` int(11) NOT NULL,
  `page_url` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`page_id`, `page_url`) VALUES
(1, 'background_add.php'),
(2, 'background_edit.php'),
(3, 'backgrounds.php'),
(4, 'committees.php'),
(6, 'events_edit_page.php');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `permission_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `page_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`permission_id`, `user_id`, `page_id`) VALUES
(1, 0, 1),
(2, 0, 2),
(3, 0, 3);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` int(11) NOT NULL,
  `session_text` text NOT NULL,
  `session_date` date NOT NULL,
  `session_time` time NOT NULL,
  `session_started` int(11) NOT NULL DEFAULT '2',
  `session_terminated` int(11) NOT NULL DEFAULT '2',
  `session_terminated_text` text NOT NULL,
  `session_insertion_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `session_insertion_user_id` int(11) NOT NULL,
  `session_edit_date` datetime NOT NULL,
  `session_edit_user_id` int(11) NOT NULL,
  `session_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `session_text`, `session_date`, `session_time`, `session_started`, `session_terminated`, `session_terminated_text`, `session_insertion_date`, `session_insertion_user_id`, `session_edit_date`, `session_edit_user_id`, `session_status`) VALUES
(12, '555                                ', '2017-07-12', '10:30:00', 0, 0, '', '2017-07-13 13:04:04', 22, '2017-07-13 12:59:55', 22, 0),
(13, 'اخر تعديل 2:00                ', '2017-07-13', '10:31:00', 0, 0, '', '2017-07-13 13:46:46', 22, '2017-07-17 08:12:35', 22, 0),
(14, 'المهندس عاطف الطراونة رئيس مجلس النواب يدعو المجلس للاجتماع لمناقشة جدول اعمال الجلسة الثالثة واستكمال ملحق جدول اعمال الجلسة الثانية والمتضمن مشروع قانون معدل لقانون استملاك الاراضي لسنة 2017 , والبدء بجدول اعمال الثالثة اعتبارا من قانون اشهار الذمة , المادة 56 , وزيارة ضريح المغفور له الملك طلال بعد الجلسة .                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                ', '2017-07-17', '16:30:00', 0, 0, 'الغيتها حر انا عاطف واعمل اي شي حابه', '2017-07-17 08:56:27', 22, '2017-07-17 11:19:54', 22, 1),
(15, 'قرر سعادة المهندس عاطف الطراونة دعوة للاختبار لمناقشة جدول اعمال الجلسة الثالثة عشر وذلك في تمام الساعة الثانية عشر قرر سعادة المهندس عاطف الطراونة دعوة للاختبار لمناقشة جدول اعمال الجلسة الثالثة عشر وذلك في تمام الساعة الثانية عشر                                                                                                                                                                                                                ', '2017-08-09', '12:30:00', 0, 0, '', '2017-07-26 10:44:04', 22, '2017-08-02 12:40:18', 22, 1),
(16, 'قرر سعادة المهندس عاطف الطراونة دعوة المجلس للاجتماع                                ', '2017-09-06', '10:00:00', 1, 0, '', '2017-09-06 10:07:30', 22, '2017-09-06 10:09:07', 22, 1);

-- --------------------------------------------------------

--
-- Table structure for table `table_live_design`
--

CREATE TABLE `table_live_design` (
  `table_live_design_id` int(11) NOT NULL,
  `table_live_design_font_size` int(11) NOT NULL,
  `table_live_design_event_entity_column_width` int(11) NOT NULL,
  `table_live_design_event_time_column_width` int(11) NOT NULL,
  `table_live_design_event_place_column_width` int(11) NOT NULL,
  `table_live_design_event_subject_column_width` int(11) NOT NULL,
  `table_live_design_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `table_live_design`
--

INSERT INTO `table_live_design` (`table_live_design_id`, `table_live_design_font_size`, `table_live_design_event_entity_column_width`, `table_live_design_event_time_column_width`, `table_live_design_event_place_column_width`, `table_live_design_event_subject_column_width`, `table_live_design_status`) VALUES
(22, 23, 3, 2, 2, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `urgents`
--

CREATE TABLE `urgents` (
  `urgent_id` int(11) NOT NULL,
  `urgent_text` text NOT NULL,
  `directorate_id` int(11) NOT NULL,
  `urgent_date_start` date NOT NULL,
  `urgent_date_end` date DEFAULT NULL,
  `urgent_time_end` time NOT NULL,
  `user_id_insert` int(11) NOT NULL,
  `urgent_insertion_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id_edit` int(11) NOT NULL,
  `urgent_edit_date` datetime NOT NULL,
  `urgent_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `urgents`
--

INSERT INTO `urgents` (`urgent_id`, `urgent_text`, `directorate_id`, `urgent_date_start`, `urgent_date_end`, `urgent_time_end`, `user_id_insert`, `urgent_insertion_date`, `user_id_edit`, `urgent_edit_date`, `urgent_status`) VALUES
(1, 'اختبار الشاشة اختبار الشاشة اختبار الشاشة ', 3, '2017-10-02', '2017-10-02', '14:50:00', 31, '2017-10-02 14:41:35', 31, '2017-10-02 02:50:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `password` varchar(100) NOT NULL DEFAULT '40bd001563085fc35165329ea1ff5c5ecbdbbeef',
  `user_type` int(11) NOT NULL DEFAULT '2' COMMENT 'this field 0 for the superadmin, 1 for the admin, 2 for the regular user',
  `name` varchar(50) NOT NULL,
  `directorate` int(11) DEFAULT '0' COMMENT 'nothing: 0, general secretary office: 1, legislative affairs: 2, general relations: 3, blocs: 4',
  `department` int(11) DEFAULT '0' COMMENT 'nothing: 0, committies:1, sessions:2'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `password`, `user_type`, `name`, `directorate`, `department`) VALUES
(0, 'a79dbae98810e4789142f2678095c76191868e7c', 0, 'superadmin', 0, 0),
(1, '356a192b7913b04c54574d18c28d46e6395428ab', 2, 'منصور', 1, 0),
(2, 'a79dbae98810e4789142f2678095c76191868e7c', 1, 'committees_user', 2, 0),
(3, '356a192b7913b04c54574d18c28d46e6395428ab', 1, 'هيثم', 3, 0),
(4, '356a192b7913b04c54574d18c28d46e6395428ab', 1, 'اسامة', 4, 0),
(31, '356a192b7913b04c54574d18c28d46e6395428ab', 2, 'علي', 3, 0),
(32, '356a192b7913b04c54574d18c28d46e6395428ab', 2, 'سليمان', 3, 0),
(41, '356a192b7913b04c54574d18c28d46e6395428ab', 2, 'نادر', 4, 0),
(351, '17ba0791499db908433b80f37c5fbc89b870084b', 2, 'فلان 1', 3, 0),
(30563, '15afd7262ebd18f6f7c1401f13249c2afd747402', 2, 'عبدالعزيز السرور', 2, 1),
(30566, '45005e5be35a4051ed56c72d03679e256508009f', 2, 'عبدالله', 2, 1),
(30629, '356a192b7913b04c54574d18c28d46e6395428ab', 2, 'محمد أبو جودة', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_committee`
--

CREATE TABLE `user_committee` (
  `user_committee_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `committee_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user_committee`
--

INSERT INTO `user_committee` (`user_committee_id`, `user_id`, `committee_id`) VALUES
(281, 11111111, 12),
(308, 12345, 12),
(341, 7, 7),
(388, 22, 9),
(389, 22, 10),
(390, 22, 11),
(391, 22, 12),
(392, 22, 13),
(393, 22, 14),
(394, 22, 15),
(395, 22, 16),
(396, 22, 17),
(397, 22, 19),
(398, 22, 31),
(399, 22, 38),
(400, 22, 39),
(401, 22, 40),
(402, 22, 41),
(403, 22, 42),
(404, 22, 43),
(405, 22, 44),
(406, 22, 45),
(407, 22, 46),
(408, 25, 9),
(409, 25, 10),
(410, 25, 11),
(411, 25, 12),
(412, 25, 13),
(413, 25, 14),
(414, 25, 15),
(415, 25, 16),
(416, 25, 17),
(417, 25, 19),
(418, 25, 31),
(419, 25, 38),
(420, 25, 39),
(421, 25, 40),
(422, 25, 41),
(423, 25, 42),
(424, 25, 43),
(425, 25, 44),
(426, 25, 45),
(427, 25, 46),
(556, 30563, 9),
(557, 30563, 10),
(558, 30563, 11),
(559, 30563, 12),
(560, 30563, 13),
(561, 30563, 14),
(562, 30563, 15),
(563, 30563, 16),
(564, 30563, 17),
(565, 30563, 19),
(566, 30563, 31),
(567, 30563, 38),
(568, 30563, 39),
(569, 30563, 40),
(570, 30563, 41),
(571, 30563, 42),
(572, 30563, 43),
(573, 30563, 44),
(574, 30563, 45),
(575, 30563, 46),
(576, 30563, 47),
(577, 30629, 9),
(578, 30629, 10),
(579, 30629, 11),
(580, 30629, 12),
(581, 30629, 13),
(582, 30629, 14),
(583, 30629, 15),
(584, 30629, 16),
(585, 30629, 17),
(586, 30629, 19),
(587, 30629, 31),
(588, 30629, 38),
(589, 30629, 39),
(590, 30629, 40),
(591, 30629, 41),
(592, 30629, 42),
(593, 30629, 43),
(594, 30629, 44),
(595, 30629, 45),
(596, 30629, 46),
(597, 30629, 47),
(598, 30566, 9),
(599, 30566, 10),
(600, 30566, 11),
(601, 30566, 12),
(602, 30566, 13),
(603, 30566, 14),
(604, 30566, 15),
(605, 30566, 16),
(606, 30566, 17),
(607, 30566, 19),
(608, 30566, 31),
(609, 30566, 38),
(610, 30566, 39),
(611, 30566, 40),
(612, 30566, 41),
(613, 30566, 42),
(614, 30566, 43),
(615, 30566, 44),
(616, 30566, 45),
(617, 30566, 46),
(618, 30566, 47);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `backgrounds`
--
ALTER TABLE `backgrounds`
  ADD PRIMARY KEY (`background_id`);

--
-- Indexes for table `committees`
--
ALTER TABLE `committees`
  ADD PRIMARY KEY (`committee_id`);

--
-- Indexes for table `device_token`
--
ALTER TABLE `device_token`
  ADD PRIMARY KEY (`device_token_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event_entity_category`
--
ALTER TABLE `event_entity_category`
  ADD PRIMARY KEY (`event_entity_category_id`);

--
-- Indexes for table `halls`
--
ALTER TABLE `halls`
  ADD PRIMARY KEY (`hall_id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`page_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`permission_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `table_live_design`
--
ALTER TABLE `table_live_design`
  ADD PRIMARY KEY (`table_live_design_id`);

--
-- Indexes for table `urgents`
--
ALTER TABLE `urgents`
  ADD PRIMARY KEY (`urgent_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_committee`
--
ALTER TABLE `user_committee`
  ADD PRIMARY KEY (`user_committee_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `backgrounds`
--
ALTER TABLE `backgrounds`
  MODIFY `background_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=528;

--
-- AUTO_INCREMENT for table `committees`
--
ALTER TABLE `committees`
  MODIFY `committee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- AUTO_INCREMENT for table `device_token`
--
ALTER TABLE `device_token`
  MODIFY `device_token_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9783;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `event_entity_category`
--
ALTER TABLE `event_entity_category`
  MODIFY `event_entity_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `halls`
--
ALTER TABLE `halls`
  MODIFY `hall_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `page_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `permission_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sessions`
--
ALTER TABLE `sessions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `table_live_design`
--
ALTER TABLE `table_live_design`
  MODIFY `table_live_design_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `urgents`
--
ALTER TABLE `urgents`
  MODIFY `urgent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30630;

--
-- AUTO_INCREMENT for table `user_committee`
--
ALTER TABLE `user_committee`
  MODIFY `user_committee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=619;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
