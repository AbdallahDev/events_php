-- phpMyAdmin SQL Dump
-- version 4.7.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 04, 2018 at 11:19 AM
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
-- Database: `events`
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
(527, '../imgs/backgrounds/الشاشة.png', 0),
(528, '../imgs/backgrounds/loooogoooooooo-11.gif', 0),
(529, '../imgs/backgrounds/loooogoooooooo-13.gif', 1);

-- --------------------------------------------------------

--
-- Table structure for table `committees`
--

CREATE TABLE `committees` (
  `committee_id` int(11) NOT NULL,
  `committee_name` varchar(100) NOT NULL,
  `directorate_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `committees`
--

INSERT INTO `committees` (`committee_id`, `committee_name`, `directorate_id`) VALUES
(2, '', 2),
(3, '', 3),
(4, '', 4),
(9, 'لجنة العمل والتنمية الاجتماعية والسكان', 2),
(10, 'اللجنة القانونية', 2),
(11, 'لجنة الخدمات العامة والنقل', 2),
(12, 'لجنة التربية والتعليم والثقافة', 2),
(13, 'لجنة الشؤون الخارجية', 2),
(14, 'لجنة النزاهة والشفافية وتقصي الحقائق', 2),
(15, 'لجنة الصحة والبيئة', 2),
(16, 'لجنة الشباب والرياضة', 2),
(17, 'لجنة الاقتصاد والاستثمار', 2),
(19, 'لجنة السياحة والاثار', 2),
(20, 'لجنة الاخوة الاردنية السعودية', 3),
(21, 'لجنة الاخورة الاردنية الجزائرية', 3),
(22, 'لجنة الاخوة الاردنية القطرية', 3),
(23, 'لجنة الاخوة البرلمانية الاردنية اللبنانية', 3),
(24, 'كتلة الوفاء والعهد', 4),
(28, 'كتلة التجديد', 4),
(31, 'لجنة الطاقة والثروة المعدنية', 2),
(38, 'اللجنة المالية', 2),
(39, 'اللجنة الادارية', 2),
(40, 'لجنة التوجيه الوطني والاعلام', 2),
(41, 'لجنة الزراعة والمياه', 2),
(42, 'لجنة الحريات العامة وحقوق الانسان', 2),
(43, 'لجنة فلسطين', 2),
(44, 'لجنة الريف والبادية', 2),
(45, 'لجنة النظام والسلوك', 2),
(46, 'لجنة المرأة وشؤون الأسرة', 2),
(47, 'كتلة العدالة', 2);

-- --------------------------------------------------------

--
-- Table structure for table `device_token`
--

CREATE TABLE `device_token` (
  `device_token_id` int(11) NOT NULL,
  `device_token` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `committee_id` int(11) NOT NULL,
  `event_entity_name` varchar(150) NOT NULL,
  `time` time NOT NULL,
  `subject` text NOT NULL,
  `event_date` date NOT NULL,
  `hall_id` int(11) NOT NULL,
  `event_place` varchar(150) NOT NULL,
  `event_insertion_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `user_id_insert` int(11) NOT NULL,
  `event_edit_date` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user_id_edit` int(11) NOT NULL DEFAULT '-1',
  `directorate_id` int(11) NOT NULL,
  `event_status` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `committee_id`, `event_entity_name`, `time`, `subject`, `event_date`, `hall_id`, `event_place`, `event_insertion_date`, `user_id_insert`, `event_edit_date`, `user_id_edit`, `directorate_id`, `event_status`) VALUES
(177, 17, '', '11:00:00', 'زيارة إلى صندوق استثمار أموال الضمان الاجتماعي للاطلاع على آليات عمله وخطته الاستثمارية', '2017-09-14', 0, 'صندوق استثمار أموال الضمان الاجتماعي', '2017-09-14 11:29:12', 30629, '2017-09-14 11:29:22', 30629, 2, 1),
(180, 16, '', '14:00:00', 'لقاء وفداً طلابياً من جامعة عمان العربية للاطلاع على آلية عمل اللجنة', '2017-09-17', 0, '', '2017-09-16 13:27:03', 30566, '2017-09-16 23:20:09', 30566, 2, 1),
(181, 16, '', '14:00:00', 'زيارة إلى وزارة التخطيط والتعاون الدولي.', '2017-09-18', 0, 'وزارة التخطيط والتعاون الدولي', '2017-09-18 10:27:09', 30629, '2017-09-18 12:45:54', 30566, 2, 1),
(196, 44, '', '11:00:00', 'مناقشة مطالب مربي الثروة الحيوانية في البادية الأردنية.', '2017-09-26', 0, 'عاكف الفايز          الطابق الأول', '2017-09-24 12:38:37', 30629, '2017-09-26 09:53:06', 30566, 2, 1),
(197, 2, 'لجنة الأخوة البرلمانية الأردنية - المصرية', '11:30:00', 'انتخاب رئيس ومقرر للجنة.', '2017-09-26', 4, '', '2017-09-24 12:40:26', 30629, '2017-09-26 08:37:14', 30629, 2, 1),
(198, 43, '', '12:00:00', '<br /><br /><br />\nلقاء مع لجنة فلسطين - نقابة الصحفيين.', '2017-09-27', 4, '', '2017-09-26 11:36:28', 30629, '2017-09-27 08:51:39', 30629, 2, 1),
(199, 42, '', '11:00:00', 'زيارة إلى مركز اصلاح وتأهيل سواقة لبحث أسباب الأحداث والإضراب الذي حدث مؤخراً في المركز.<br /><br />\nملاحظة:<br /><br />\nالانطلاق من أمام مجلس النواب الساعة 9:00 صباحاً.', '2017-09-27', 0, 'مركز اصلاح وتاهيل السواقة', '2017-09-26 12:22:59', 30629, '2017-09-26 12:41:26', 30629, 2, 1),
(200, 2, 'لجنة الأخوة البرلمانية الأردنية – الجزائرية', '11:00:00', 'انتخاب رئيس ومقرر للجنة.', '2017-09-27', 4, '', '2017-09-26 12:40:52', 30629, '0000-00-00 00:00:00', -1, 2, 1),
(201, 11, '', '11:00:00', 'زيارة إلى مطار الملكة علياء الدولي للاطلاع على واقع العمل في المطار.<br />\r\nملاحظة:<br />\r\nالانطلاق من أمام مجلس النواب الساعة 10:00 صباحاً.', '2017-10-01', 0, 'مطار الملكة علياء الدولي', '2017-09-27 10:11:46', 30629, '0000-00-00 00:00:00', -1, 2, 1),
(202, 2, 'لجنة الأخوة البرلمانية الأردنية – السودانية', '11:00:00', 'انتخاب رئيس ومقرر للجنة.', '2017-10-03', 4, '', '2017-09-27 12:11:56', 30629, '2017-10-02 15:45:07', 30629, 2, 1),
(203, 2, 'كتلة الوفاق النيابية', '10:30:00', 'زيارة إلى محافظة البلقاء والالتقاء بعطوفة محافظ السلط ومجلس المحافظة وعطوفة رئيس بلدية السلط وزيارة مؤسسة اعمار السلط ومدرسة السلط الثانوية للبنين.<br /><br />\nملاحظة:<br /><br />\nالانطلاق من مجلس النواب الساعة 10:00 صباحاً.', '2017-10-02', 0, 'محافظة البلقاء', '2017-09-28 11:54:53', 30629, '2017-09-28 11:55:17', 30629, 2, 1),
(204, 9, '', '11:00:00', 'مناقشة موضوع شمول المعينين على نظام شراء الخدمات في مؤسسة الإذاعة والتلفزيون بالضمان الاجتماعي.', '2017-10-02', 6, '', '2017-09-28 15:38:14', 30629, '2017-10-01 15:24:25', 30629, 2, 1),
(209, 2, 'كتلة وطن النيابية', '12:30:00', 'لقاء مع دولة رئيس الوزراء الدكتور هاني الملقي لبحث آخر المستجدات.', '2017-10-02', 4, '', '2017-10-01 14:14:13', 30629, '0000-00-00 00:00:00', -1, 2, 1),
(210, 42, '', '13:00:00', 'لقاء مع وفد من طلبة جامعة ميدل بيري الامريكية.', '2017-10-03', 4, '', '2017-10-01 15:16:48', 30629, '2017-10-02 15:45:14', 30629, 2, 1),
(212, 2, 'لجنة الشؤون الخارجية', '10:00:00', 'الالتقاء مع سعادة سفير جورجيا. ', '2017-10-04', 0, 'قاعة التشريفات الطابق الثاني', '2017-10-02 20:02:54', 30629, '2017-10-04 10:00:38', 30566, 2, 1),
(213, 13, '', '11:30:00', 'الالتقاء مع وفد من نواب ولاية ساوث كارولاينا الامريكية.<br /><br />\n', '2017-10-04', 0, 'قاعة عبدالحليم النمر الطابق الأول', '2017-10-02 20:03:52', 30629, '2017-10-04 09:38:40', 30629, 2, 1),
(214, 46, '', '12:00:00', 'لقاء مع الجمعيات الخيرية من محافظة المفرق والبادية الشمالية.', '2017-10-04', 4, '', '2017-10-03 09:43:00', 30629, '2017-10-04 09:38:54', 30629, 2, 1),
(215, 2, 'لجنة الأخوة البرلمانية الأردنية - العراقية', '11:00:00', 'لقاء مع سعادة سفير جمهورية العراق.', '2017-10-15', 0, '', '2017-10-04 15:04:42', 30629, '0000-00-00 00:00:00', -1, 2, 1),
(216, 39, '', '13:00:00', 'الاطلاع على قرار لجنة دراسة واقع حال الاشخاص المشترى خدماتهم على حساب شراء الخدمات.', '2017-10-09', 4, '', '2017-10-05 13:15:50', 30629, '2017-10-08 15:57:20', 30629, 2, 1),
(217, 43, '', '13:00:00', 'الساعة 1:00 زيارة للجامعة الهاشمية وذلك لتكريم رئيس الجامعة وزملائه لمواقفهم الداعمة للقضية الفلسطينية وتدريس مادة القضية الفلسطينية. <br /><br /><br />\n<br />\nملاحظة: الانطلاق من مجلس النواب الساعة 12:00 ظهراً.', '2017-10-09', 0, 'الجامعة الهاشمية', '2017-10-08 15:30:00', 30629, '2017-10-09 09:01:35', 30629, 2, 1),
(218, 13, '', '11:00:00', 'لقاء مع سعادة السفير التشيلي.	<br /><br />\n', '2017-10-11', 9, '', '2017-10-08 15:35:59', 30629, '2017-10-10 16:06:51', 30629, 2, 1),
(219, 15, '', '11:30:00', 'اجتماع مع لجنة موظفي وزارة الصحة للاستماع لمطالبهم.<br /><br /><br />\n', '2017-10-10', 6, '', '2017-10-08 15:40:38', 30629, '2017-10-10 07:30:15', 30629, 2, 1),
(220, 15, '', '13:00:00', 'اجتماع مع عدد من الاطباء للحديث عن الأمراض الاستقلابية.', '2017-10-10', 6, '', '2017-10-08 15:41:31', 30629, '2017-10-10 07:35:22', 30629, 2, 1),
(221, 13, '', '13:30:00', 'لقاء مع وفد من كبار مساعدي أعضاء مجلس الشيوخ الأمريكي.<br /><br /><br />\n', '2017-10-10', 0, 'قاعة عبدالحليم النمر الطابق الأول', '2017-10-08 15:43:20', 30629, '2017-10-10 07:30:54', 30629, 2, 1),
(222, 2, 'كتلة الوفاق النيابية', '10:00:00', 'لقاء مع دولة رئيس الوزراء د. هاني الملقي لبحث آخر المستجدات.<br />\r\n', '2017-10-10', 4, '', '2017-10-08 15:45:08', 30629, '0000-00-00 00:00:00', -1, 2, 1),
(223, 2, 'لجنة الأخوة البرلمانية الأردنية - المصرية', '11:00:00', 'لقاء مع سعادة سفير جمهورية مصر العربية.', '2017-10-17', 10, '', '2017-10-08 16:10:45', 30629, '2017-10-17 09:06:28', 30629, 2, 1),
(225, 42, '', '10:00:00', 'اجتماع  مع معالي وزير الداخلية لبحث اسباب الاحداث التي حصلت مؤخراً في لواء الرمثا وأمور تهم اللجنة.', '2017-10-11', 6, '', '2017-10-10 11:50:56', 30629, '2017-10-10 16:06:34', 30629, 2, 1),
(226, 31, '', '11:00:00', 'بحث موضوع تزايد حالات العبث الكهربائي واستجرار الطاقة بشكل غير قانوني.<br /><br />\n', '2017-10-11', 3, '', '2017-10-10 14:25:22', 30629, '2017-10-10 16:07:05', 30629, 2, 1),
(227, 2, 'ملتقى البرلمانيات', '11:00:00', 'لقاء مع وفد من المعهد الديمقراطي الوطني.', '2017-10-10', 4, '', '2017-10-10 14:30:05', 30629, '0000-00-00 00:00:00', -1, 2, 1),
(228, 2, '', '11:30:00', 'يلتقي سعادة النائب الأول لرئيس مجلس النواب السيد خميس عطية مع ملتقى الشباب العربي.', '2017-10-11', 8, '', '2017-10-10 15:47:28', 30629, '0000-00-00 00:00:00', -1, 2, 1),
(229, 2, '', '12:30:00', 'يعقد مجلس النواب بالتعاون مع برنامج الأمم المتحدة الانمائي (UNDP) فعالية برلمانية بعنوان \"دور مجلس النواب في تحقيق أهداف التنمية المستدامة\".', '2017-10-11', 0, 'قاعة عبد الحليم النمر الطابق الأول', '2017-10-10 16:09:00', 30629, '0000-00-00 00:00:00', -1, 2, 1),
(230, 2, 'ملتقى البرلمانيات', '11:00:00', 'لقاء مع وفد من المعهد الديمقراطي الوطني.', '2017-10-11', 4, '', '2017-10-11 09:31:32', 30629, '0000-00-00 00:00:00', -1, 2, 1),
(231, 14, '', '12:00:00', 'بحث موضوع الصيدلانية لما الحمود.', '2017-10-12', 4, '', '2017-10-11 11:20:45', 30629, '0000-00-00 00:00:00', -1, 2, 1),
(232, 2, 'لجنة الاخوة البرلمانية الاردنية - السودانية', '11:00:00', 'لقاء مع سعادة سفير جمهورية السودان', '2017-10-18', 0, 'قاعة عبد الحليم النمرالطابق الاول', '2017-10-16 10:51:50', 30566, '2017-10-17 09:02:15', 30629, 2, 1),
(233, 2, 'كتلة العدالة', '11:00:00', 'مناقشة امور تهم الكتلة', '2017-10-16', 4, '', '2017-10-16 10:53:41', 30566, '0000-00-00 00:00:00', -1, 2, 1),
(234, 47, '', '00:00:00', 'لقاء مع دولة رئيس الوزراء لبحث اخر المستجدات', '2017-10-17', 4, '', '2017-10-16 11:42:49', 30629, '2017-10-17 09:05:00', 30629, 2, 1),
(236, 43, '', '01:30:00', 'لقاء مع جمعية العون الطبي الفلسطيني', '2017-10-17', 6, '', '2017-10-17 09:00:33', 30629, '2017-10-17 13:06:19', 30629, 2, 1),
(238, 42, '', '12:00:00', 'زياة الى مديرية الامن العام للوقوف على آخر المستجدات التي تهم جهاز الامن العام.<br />\n* ملاحظة: الانطلاق من مجلس النواب الساعة 11:15صباحا.', '2017-10-22', 0, 'مديرية الامن العام', '2017-10-19 09:04:23', 30563, '2017-10-21 21:10:50', 30629, 2, 1),
(239, 43, '', '14:30:00', 'زيارة إلى مقر مطرانية عمان للروم الارثوذكس في الصويفية للاطلاع على التطورات الراهنة المتعلقة بشؤون البطريركية المقدسية وما تعانيه من هجمات اعلامية مغرضة وانتهاكات اسرائيلية.', '2017-10-22', 0, 'مقر مطرانية عمان للروم الارثوذكس - الصويفية', '2017-10-21 20:42:39', 30629, '0000-00-00 00:00:00', -1, 2, 1),
(240, 17, '', '10:00:00', 'لمناقشة موضوع البيئة الاستثمارية في المناطق التنموية الحرة.', '2017-10-24', 4, '', '2017-10-22 10:07:25', 30563, '2017-10-24 09:01:00', 30629, 2, 1),
(241, 2, '', '10:00:00', 'لقاء مع معالي وزير الخارجية وشؤون المغتربين لبحث اخر المستجدات السياسية.', '2017-12-10', 4, '', '2017-10-22 19:02:24', 30629, '2017-12-10 18:18:24', 30566, 2, 1),
(242, 2, 'كتلة التجديد النيابية', '12:00:00', 'لقاء مع دولة رئيس الوزراء لبحث اخر المستجدات.', '2017-10-24', 4, '', '2017-10-23 09:27:03', 30563, '2017-10-24 08:54:08', 30629, 2, 1),
(243, 43, '', '01:00:00', 'لقاء مع معالي وزير الصحة لبحث موضوع الاطباء من ابناء قطاع غزة .', '2017-10-24', 5, '', '2017-10-24 08:21:55', 30629, '2017-10-24 09:00:37', 30629, 2, 1),
(244, 2, '', '23:00:00', 'لقاء نائب رئيس اللجنة الادارية مع مجموعة من الشباب الاردني ضمن مشروع الحوارات الشبابية البرلمانية بهدف تعزيز ادماج الشباب الاردني في العمل البرلماني.', '2017-12-10', 4, '', '2017-10-25 10:23:53', 30629, '2017-12-10 18:18:48', 30566, 2, 1),
(245, 2, 'المكتب الدائم', '12:00:00', 'يجتمع المكتب الدائم لمجلس النواب.', '2017-12-10', 0, 'قاعة المكتب الدائم الطابق الثاني', '2017-10-25 13:51:56', 30629, '2017-12-10 18:18:34', 30566, 2, 1),
(248, 39, '', '11:00:00', 'اجتماع اللجنة التحضيرية لمؤتمر \"البطالة في الاردن.. اسبابها وكيفية الحد منها\".', '2017-01-01', 6, '', '2017-10-31 14:19:07', 30629, '2017-10-31 15:05:58', 30629, 2, 1),
(250, 16, '', '23:00:00', 'اجتماع اللجنة التحضيرية لمؤتمر \"البطالة في الاردن.. اسبابها وكيفية الحد منها\".', '2017-12-10', 6, '', '2017-10-31 15:07:30', 30629, '2017-12-10 18:18:52', 30566, 2, 1),
(251, 2, 'كتلة الوفاق النيابية', '11:00:00', 'للتباحث حول انتخابات المكتب الدائم واللجان النيابية', '2017-12-10', 4, '', '2017-10-31 15:10:39', 30629, '2017-12-10 18:18:29', 30566, 2, 1),
(252, 2, '***', '12:30:00', 'لقاء سعادة المهندس عاطف الطراونة رئيس مجلس النواب مع اصحاب المعالي والسعادة رؤساء الكتل النيابية.', '2017-11-01', 7, '', '2017-11-01 09:27:09', 30629, '2017-11-01 09:35:29', 30629, 2, 1),
(253, 2, '', '17:00:00', 'مشاركة اللجنة بالمهرجان الذي سيقام بمناسبة مرور مئة عام على وعد بلفور المشؤوم.', '2017-12-07', 0, 'قاعة اليرموك - مخيم أربد', '2017-11-01 16:16:45', 30629, '2017-12-07 21:47:07', 30566, 2, 1),
(254, 44, '', '22:00:00', 'لقاء مع رئيس اللجنة العربية الدائمة لحقوق الانسان في جامعة الدول العربية الدكتور أمجد شموط لمناقشة أمور تهم اللجنة. ', '2017-12-10', 3, '', '2017-11-05 12:36:29', 30629, '2017-12-10 18:18:43', 30566, 2, 1),
(255, 2, '', '11:00:00', 'زيارة الى مؤسسة الاذاعة والتلفزيون للاطلاع على آلية عمل المؤسسة.', '2017-11-06', 0, 'مؤسسة الاذاعة والتلفزيون.', '2017-11-05 15:33:29', 30629, '2017-11-06 13:04:53', 30566, 2, 0),
(257, 16, '', '17:00:00', 'زيارة النادي العربي في محافظة أربد للوقوف على أبرز المشاكل التي تواجه النادي وأندية الشمال بشكل عام.', '2017-12-10', 0, 'نادي العربي / محافظة أربد', '2017-11-06 12:38:34', 30629, '2017-12-10 18:18:38', 30566, 2, 1),
(261, 2, 'test', '22:15:00', 'test', '2017-11-06', 0, 'test', '2017-11-06 20:16:21', 30566, '2017-11-06 20:16:44', 30566, 2, 0);

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
(22, 20, 3, 2, 2, 11, 1);

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
(2, 'a1290948a8a0aec144e60de3f65c05f275685d7f', 1, 'عواد الغويري', 2, 0),
(3, '356a192b7913b04c54574d18c28d46e6395428ab', 1, 'هيثم', 3, 0),
(4, '356a192b7913b04c54574d18c28d46e6395428ab', 1, 'اسامة', 4, 0),
(31, '356a192b7913b04c54574d18c28d46e6395428ab', 2, 'علي', 3, 0),
(32, '356a192b7913b04c54574d18c28d46e6395428ab', 2, 'سليمان', 3, 0),
(41, '356a192b7913b04c54574d18c28d46e6395428ab', 2, 'نادر', 4, 0),
(351, '17ba0791499db908433b80f37c5fbc89b870084b', 2, 'فلان 1', 3, 0),
(30563, '15afd7262ebd18f6f7c1401f13249c2afd747402', 2, 'عبدالعزيز السرور', 2, 1),
(30566, '45005e5be35a4051ed56c72d03679e256508009f', 1, 'عبدالله', 2, 0),
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
(553, 30566, 16),
(554, 30566, 17),
(555, 30566, 44),
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
(597, 30629, 47);

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
  MODIFY `background_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=530;

--
-- AUTO_INCREMENT for table `committees`
--
ALTER TABLE `committees`
  MODIFY `committee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `device_token`
--
ALTER TABLE `device_token`
  MODIFY `device_token_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=262;

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
  MODIFY `user_committee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=598;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
