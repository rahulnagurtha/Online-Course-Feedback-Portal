-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2015 at 07:43 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `devsquare`
--

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE IF NOT EXISTS `courses` (
  `courseid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique course id',
  `code` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `instructor` int(11) NOT NULL COMMENT 'professor userid',
  PRIMARY KEY (`courseid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=37 ;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`courseid`, `code`, `name`, `instructor`) VALUES
(30, 'CS202', 'Discrete Mathematics', 114),
(31, 'CS201', 'Data Structures', 112),
(32, 'MA201', 'Mathematics', 118),
(33, 'CS210', 'Data Structures Lab', 115),
(34, 'CS241', 'system lab', 117),
(35, 'CS221', 'Digital Design', 113),
(36, 'HSS210', 'Psychology', 116);

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `response_id` int(11) NOT NULL AUTO_INCREMENT,
  `question_id` int(11) NOT NULL,
  `answer` varchar(50) NOT NULL,
  `comment` varchar(1000) NOT NULL,
  `courseid` varchar(20) NOT NULL,
  PRIMARY KEY (`response_id`),
  KEY `courseid` (`courseid`),
  KEY `question_id` (`question_id`),
  KEY `courseid_2` (`courseid`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=339 ;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`response_id`, `question_id`, `answer`, `comment`, `courseid`) VALUES
(101, 90, 'six', 'emptyyy', '32'),
(102, 95, 'five', 'emptyyy', '32'),
(103, 100, 'four', 'emptyyy', '32'),
(104, 105, 'three', 'emptyyy', '32'),
(105, 110, 'two', 'emptyyy', '32'),
(106, 115, 'emptyyy', 'yes', '32'),
(107, 120, 'emptyyy', 'hello', '32'),
(108, 91, 'five', 'emptyyy', '33'),
(109, 94, 'three', 'emptyyy', '33'),
(110, 99, 'five', 'emptyyy', '33'),
(111, 104, 'two', 'emptyyy', '33'),
(112, 109, 'five', 'emptyyy', '33'),
(113, 114, 'emptyyy', 'yes', '33'),
(114, 119, 'emptyyy', 'yes', '33'),
(122, 81, 'four', 'emptyyy', '35'),
(123, 82, 'six', 'emptyyy', '35'),
(124, 83, 'one', 'emptyyy', '35'),
(125, 84, 'one', 'emptyyy', '35'),
(126, 85, 'one', 'emptyyy', '35'),
(127, 86, 'emptyyy', 'yes', '35'),
(128, 87, 'emptyyy', 'ffff', '35'),
(143, 90, 'two', 'emptyyy', '32'),
(144, 95, 'two', 'emptyyy', '32'),
(145, 100, 'two', 'emptyyy', '32'),
(146, 105, 'two', 'emptyyy', '32'),
(147, 110, 'two', 'emptyyy', '32'),
(148, 115, 'emptyyy', 'eee', '32'),
(149, 120, 'emptyyy', 'eeee', '32'),
(150, 91, 'four', 'emptyyy', '33'),
(151, 94, 'four', 'emptyyy', '33'),
(152, 99, 'four', 'emptyyy', '33'),
(153, 104, 'four', 'emptyyy', '33'),
(154, 109, 'four', 'emptyyy', '33'),
(155, 114, 'emptyyy', 'rrrrr', '33'),
(156, 119, 'emptyyy', 'rrrrr', '33'),
(164, 81, 'two', 'emptyyy', '35'),
(165, 82, 'two', 'emptyyy', '35'),
(166, 83, 'two', 'emptyyy', '35'),
(167, 84, 'two', 'emptyyy', '35'),
(168, 85, 'two', 'emptyyy', '35'),
(169, 86, 'emptyyy', 'uuuu', '35'),
(170, 87, 'emptyyy', 'uuuu', '35'),
(178, 90, 'five', 'emptyyy', '32'),
(179, 95, 'three', 'emptyyy', '32'),
(180, 100, 'three', 'emptyyy', '32'),
(181, 105, 'two', 'emptyyy', '32'),
(182, 110, 'one', 'emptyyy', '32'),
(183, 115, 'emptyyy', 'aaaa', '32'),
(184, 120, 'emptyyy', 'aaaa', '32'),
(185, 91, 'six', 'emptyyy', '33'),
(186, 94, 'six', 'emptyyy', '33'),
(187, 99, 'six', 'emptyyy', '33'),
(188, 104, 'six', 'emptyyy', '33'),
(189, 109, 'six', 'emptyyy', '33'),
(190, 114, 'emptyyy', 'qqqq', '33'),
(191, 119, 'emptyyy', 'qqq', '33'),
(206, 81, 'five', 'emptyyy', '35'),
(207, 82, 'one', 'emptyyy', '35'),
(208, 83, 'four', 'emptyyy', '35'),
(209, 84, 'two', 'emptyyy', '35'),
(210, 85, 'four', 'emptyyy', '35'),
(211, 86, 'emptyyy', 'ww', '35'),
(212, 87, 'emptyyy', 'www', '35'),
(227, 90, 'five', 'emptyyy', '32'),
(228, 95, 'two', 'emptyyy', '32'),
(229, 100, 'five', 'emptyyy', '32'),
(230, 105, 'two', 'emptyyy', '32'),
(231, 110, 'five', 'emptyyy', '32'),
(232, 115, 'emptyyy', 'a', '32'),
(233, 120, 'emptyyy', 'a', '32'),
(234, 91, 'five', 'emptyyy', '33'),
(235, 94, 'two', 'emptyyy', '33'),
(236, 99, 'five', 'emptyyy', '33'),
(237, 104, 'four', 'emptyyy', '33'),
(238, 109, 'three', 'emptyyy', '33'),
(239, 114, 'emptyyy', 'a', '33'),
(240, 119, 'emptyyy', 'a', '33'),
(248, 81, 'three', 'emptyyy', '35'),
(249, 82, 'three', 'emptyyy', '35'),
(250, 83, 'three', 'emptyyy', '35'),
(251, 84, 'three', 'emptyyy', '35'),
(252, 85, 'three', 'emptyyy', '35'),
(253, 86, 'emptyyy', 'bb', '35'),
(254, 87, 'emptyyy', 'bbbbbbbbbbb', '35'),
(269, 90, 'five', 'emptyyy', '32'),
(270, 95, 'three', 'emptyyy', '32'),
(271, 100, 'four', 'emptyyy', '32'),
(272, 105, 'three', 'emptyyy', '32'),
(273, 110, 'four', 'emptyyy', '32'),
(274, 115, 'emptyyy', 'e', '32'),
(275, 120, 'emptyyy', 'w', '32'),
(276, 91, 'two', 'emptyyy', '33'),
(277, 94, 'two', 'emptyyy', '33'),
(278, 99, 'two', 'emptyyy', '33'),
(279, 104, 'two', 'emptyyy', '33'),
(280, 109, 'two', 'emptyyy', '33'),
(281, 114, 'emptyyy', 'uuu', '33'),
(282, 119, 'emptyyy', 'uu', '33'),
(290, 81, 'five', 'emptyyy', '35'),
(291, 82, 'four', 'emptyyy', '35'),
(292, 83, 'three', 'emptyyy', '35'),
(293, 84, 'three', 'emptyyy', '35'),
(294, 85, 'three', 'emptyyy', '35'),
(295, 86, 'emptyyy', 'www', '35'),
(296, 87, 'emptyyy', 'www', '35'),
(311, 90, 'five', 'emptyyy', '32'),
(312, 95, 'four', 'emptyyy', '32'),
(313, 100, 'three', 'emptyyy', '32'),
(314, 105, 'three', 'emptyyy', '32'),
(315, 110, 'four', 'emptyyy', '32'),
(316, 115, 'emptyyy', 'rrr', '32'),
(317, 120, 'emptyyy', 'rrrr', '32'),
(318, 91, 'two', 'emptyyy', '33'),
(319, 94, 'one', 'emptyyy', '33'),
(320, 99, 'one', 'emptyyy', '33'),
(321, 104, 'one', 'emptyyy', '33'),
(322, 109, 'one', 'emptyyy', '33'),
(323, 114, 'emptyyy', 'ffff', '33'),
(324, 119, 'emptyyy', 'ffff', '33'),
(332, 81, 'one', 'emptyyy', '35'),
(333, 82, 'one', 'emptyyy', '35'),
(334, 83, 'one', 'emptyyy', '35'),
(335, 84, 'one', 'emptyyy', '35'),
(336, 85, 'one', 'emptyyy', '35'),
(337, 86, 'emptyyy', 'hhh', '35'),
(338, 87, 'emptyyy', 'hhh', '35');

-- --------------------------------------------------------

--
-- Table structure for table `profs`
--

CREATE TABLE IF NOT EXISTS `profs` (
  `userid` int(11) NOT NULL COMMENT 'prof user id',
  `username` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'prof name',
  `email` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `profs`
--

INSERT INTO `profs` (`userid`, `username`, `name`, `email`) VALUES
(112, 'saswata', 'saswata', 'saswata@iitg.ernet.in'),
(113, 'Hemangee', 'Hemangee', 'hemangee@iitg.ernet.in'),
(114, 'sajith', 'Sajith', 'sajith@iitg.ernet.in'),
(115, 'Arnab', 'Arnab Sarkar', 'arnab@iitg.ernet.in'),
(116, 'Ashish', 'Ashish Anand', 'ashish@iitg.ernet.in'),
(117, 'santosh', 'Santosh Biswas', 'biswas@iitg.ernet.in'),
(118, 'pratyush', 'pratyush', 'pratyush@iitg.ernet.in');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `courseid` int(20) NOT NULL,
  `question` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `q_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`q_id`),
  KEY `courseid` (`courseid`),
  KEY `courseid_2` (`courseid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=124 ;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`courseid`, `question`, `type`, `q_id`) VALUES
(45, 'hellodsf djkfds', 'Preference', 12),
(771, 'what is you name?', 'Preference', 14),
(771, 'kjklj', 'Preference', 17),
(35, 'Overall the instructor was excellent', 'radio', 81),
(35, 'Prpfessor was regular.', 'radio', 82),
(35, 'The course was highly enjoyable.', 'radio', 83),
(35, 'Tutors were excellent', 'radio', 84),
(35, 'References were excellent.', 'radio', 85),
(35, 'Complaints.', 'comment', 86),
(35, 'How often course feedback sholud be taken.', 'comment', 87),
(30, 'Overall the instructor was excellent', 'radio', 88),
(31, 'Overall the instructor was excellent', 'radio', 89),
(32, 'Overall the instructor was excellent', 'radio', 90),
(33, 'Overall the instructor was excellent', 'radio', 91),
(34, 'Overall the instructor was excellent', 'radio', 92),
(34, 'Prpfessor was regular.', 'radio', 93),
(33, 'Prpfessor was regular.', 'radio', 94),
(32, 'Prpfessor was regular.', 'radio', 95),
(31, 'Prpfessor was regular.', 'radio', 96),
(30, 'Prpfessor was regular.', 'radio', 97),
(34, 'The course was highly enjoyable.', 'radio', 98),
(33, 'The course was highly enjoyable.', 'radio', 99),
(32, 'The course was highly enjoyable.', 'radio', 100),
(31, 'The course was highly enjoyable.', 'radio', 101),
(30, 'The course was highly enjoyable.', 'radio', 102),
(34, 'Tutors were excellent', 'radio', 103),
(33, 'Tutors were excellent', 'radio', 104),
(32, 'Tutors were excellent', 'radio', 105),
(31, 'Tutors were excellent', 'radio', 106),
(30, 'Tutors were excellent', 'radio', 107),
(34, 'References were excellent.', 'radio', 108),
(33, 'References were excellent.', 'radio', 109),
(32, 'References were excellent.', 'radio', 110),
(31, 'References were excellent.', 'radio', 111),
(30, 'References were excellent.', 'radio', 112),
(34, 'Complaints.', 'comment', 113),
(33, 'Complaints.', 'comment', 114),
(32, 'Complaints.', 'comment', 115),
(31, 'Complaints.', 'comment', 116),
(30, 'Complaints.', 'comment', 117),
(34, 'How often course feedback sholud be taken.', 'comment', 118),
(33, 'How often course feedback sholud be taken.', 'comment', 119),
(32, 'How often course feedback sholud be taken.', 'comment', 120),
(31, 'How often course feedback sholud be taken.', 'comment', 121),
(30, 'How often course feedback sholud be taken.', 'comment', 122),
(31, 'what do you think of my teaching?', 'open', 123);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE IF NOT EXISTS `students` (
  `userid` int(11) NOT NULL COMMENT 'students userid',
  `username` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(1000) COLLATE utf8_unicode_ci NOT NULL COMMENT 'student email id',
  PRIMARY KEY (`userid`),
  UNIQUE KEY `userid` (`userid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`userid`, `username`, `name`, `class`, `email`) VALUES
(61, 'midhul', 'midhul', 'btech 13', 'midhul@iitg.ernet.in'),
(83, 'a', 'a', 'btech 13', 'a'),
(84, 'b', 'b', 'btech 13', 'b'),
(85, 'c', 'c', 'btech 13', 'c'),
(86, 'd', 'd', 'btech 13', 'd'),
(87, 'e', 'e', 'btech 13', 'e'),
(88, 'new', 'f', 'btech 13', 'f'),
(92, 'rahul2013', 'rahul nagurtha', 'btech 13', 'rahul2013@iitg.ernet.in'),
(95, 'histesh', 'hitesh vamshi', 'btech 13', 'b.vamshi@iitg.ernet.in'),
(100, 'g', 'g', 'btech 13', 'a'),
(101, 'h', 'h', 'btech 13', 'h'),
(102, 'i', 'I', 'btech 13', 'i'),
(103, 'j', 'j', 'btech 13', 'j'),
(104, 'j', 'j', 'btech 13', 'j'),
(105, 'k', 'k', 'btech 13', 'k'),
(106, 'l', 'l', 'btech 13', 'l'),
(107, 'm', 'm', 'btech 13', 'm'),
(108, 'n', 'n', 'btech 13', 'n'),
(109, 'o', 'o', 'btech 13', 'o'),
(110, 'p', 'p', 'btech 13', 'p'),
(111, 'q', 'q', 'btech 13', 'q'),
(138, 'midhul', 'hkhkjh', 'jfsdhkj', 'khkh'),
(139, 'fskhdj', 'midhul varma', 'sdfjsff', 'jfdhkjf'),
(140, 'jhkh', 'hkjhkj kjhhj', 'hhkhj ', 'hjkhk'),
(141, 'jkdfhs', 'gbkbkjbkj', 'hkjhkj', 'lkjlkj'),
(142, 'jhkjdfhk', 'kjhhkjhkj', 'hhkhj ', 'kjhkjkj'),
(143, 'fsdf', 'gbkbkjbkj', 'gdfg', 'df');

-- --------------------------------------------------------

--
-- Table structure for table `student_course`
--

CREATE TABLE IF NOT EXISTS `student_course` (
  `student` int(11) NOT NULL COMMENT 'student user id',
  `course` int(11) NOT NULL COMMENT 'course id',
  `done` tinyint(1) NOT NULL COMMENT 'feedback alr given or not',
  PRIMARY KEY (`student`,`course`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_course`
--

INSERT INTO `student_course` (`student`, `course`, `done`) VALUES
(61, 30, 0),
(61, 31, 0),
(61, 32, 0),
(61, 33, 0),
(61, 34, 0),
(61, 35, 0),
(61, 36, 0),
(83, 30, 0),
(83, 31, 0),
(83, 32, 0),
(83, 33, 0),
(83, 34, 0),
(83, 35, 0),
(83, 36, 0),
(84, 30, 0),
(84, 31, 0),
(84, 32, 0),
(84, 33, 0),
(84, 34, 0),
(84, 35, 0),
(84, 36, 0),
(85, 30, 0),
(85, 31, 0),
(85, 32, 0),
(85, 33, 0),
(85, 34, 0),
(85, 35, 0),
(85, 36, 0),
(86, 30, 0),
(86, 31, 0),
(86, 32, 0),
(86, 33, 0),
(86, 34, 0),
(86, 35, 0),
(86, 36, 0),
(87, 30, 0),
(87, 31, 0),
(87, 32, 0),
(87, 33, 0),
(87, 34, 0),
(87, 35, 0),
(87, 36, 0),
(88, 30, 0),
(88, 31, 0),
(88, 32, 0),
(88, 33, 0),
(88, 34, 0),
(88, 35, 0),
(88, 36, 0),
(89, 31, 0),
(89, 32, 0),
(89, 33, 0),
(89, 34, 0),
(89, 35, 0),
(89, 36, 0),
(92, 30, 0),
(92, 31, 0),
(92, 32, 0),
(92, 33, 0),
(92, 34, 0),
(92, 35, 0),
(92, 36, 0),
(95, 30, 0),
(95, 31, 0),
(95, 32, 0),
(95, 33, 0),
(95, 34, 0),
(95, 35, 0),
(95, 36, 0),
(100, 30, 0),
(100, 31, 0),
(100, 32, 1),
(100, 33, 1),
(100, 34, 0),
(100, 35, 1),
(100, 36, 0),
(101, 30, 0),
(101, 31, 0),
(101, 32, 1),
(101, 33, 1),
(101, 34, 0),
(101, 35, 1),
(101, 36, 0),
(102, 30, 0),
(102, 31, 0),
(102, 32, 0),
(102, 33, 0),
(102, 34, 0),
(102, 35, 0),
(102, 36, 0),
(103, 30, 0),
(103, 31, 0),
(103, 32, 0),
(103, 33, 0),
(103, 34, 0),
(103, 35, 0),
(103, 36, 0),
(104, 30, 0),
(104, 31, 0),
(104, 32, 0),
(104, 33, 0),
(104, 34, 0),
(104, 35, 0),
(104, 36, 0),
(105, 30, 0),
(105, 31, 0),
(105, 32, 1),
(105, 33, 1),
(105, 34, 0),
(105, 35, 1),
(105, 36, 0),
(106, 30, 0),
(106, 31, 0),
(106, 32, 1),
(106, 33, 1),
(106, 34, 0),
(106, 35, 1),
(106, 36, 0),
(107, 30, 0),
(107, 31, 0),
(107, 32, 1),
(107, 33, 1),
(107, 34, 0),
(107, 35, 1),
(107, 36, 0),
(108, 30, 0),
(108, 31, 0),
(108, 32, 0),
(108, 33, 0),
(108, 34, 0),
(108, 35, 0),
(108, 36, 0),
(109, 30, 0),
(109, 31, 0),
(109, 32, 1),
(109, 33, 1),
(109, 34, 0),
(109, 35, 1),
(109, 36, 0),
(110, 30, 0),
(110, 31, 0),
(110, 32, 0),
(110, 33, 0),
(110, 34, 0),
(110, 35, 0),
(110, 36, 0),
(111, 30, 0),
(111, 31, 0),
(111, 32, 0),
(111, 33, 0),
(111, 34, 0),
(111, 35, 0),
(111, 36, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `userid` int(11) NOT NULL AUTO_INCREMENT COMMENT 'unique userid',
  `username` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(1000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`userid`),
  KEY `username` (`username`(255)),
  KEY `username_2` (`username`(255))
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=144 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `username`, `password`, `type`) VALUES
(19, 'admin', '$2y$10$b0qsgyWof0VAvEe/ZjAW1uCDEvRo5kwZ6WtJgfm1vNKsYVOthUBdm', 'admin'),
(61, 'midhul', '$2y$10$GJnDqrHgl/KNRemhw08XQeePbhLLkyMzjnTdeCdD2z0T6EAlMNdrK', 'student'),
(83, 'a', '$2y$10$67AGgsNnhX4saBvm5DX89eV.767IcE2De3FbM7FLeoDqNPaZmWrpO', 'student'),
(84, 'b', '$2y$10$eCnBk2S5bBidH0osDA1/SuWL19ma7HJfO520.BajCPyebrd5uISuu', 'student'),
(85, 'c', '$2y$10$WCYvg3G2LMeEE17EFOT65O2lL4ajXr0PlfEGzGbZ55bhwG/7Cu1Dq', 'student'),
(86, 'd', '$2y$10$yK4k/UTrOXDnnYnrtQspQuF0FwXBcqWKc2LBafcQl05MrZVpemw9a', 'student'),
(87, 'e', '$2y$10$OT.IC.gBfBp1EBkGNt0gNuVMHuNLBVycXwVIwgRbBM7tMR6vrih72', 'student'),
(88, 'new', '$2y$10$2XHNseKi.phWAGk7TS6dguwuDGwV95MmYzZPTzkTZasxGLkktZAji', 'student'),
(92, 'rahul2013', '$2y$10$WkpeJPdM4SmpsKl/.apinuUBAxsDgtvVLg3hrEcD2DzPZ.ZPV7Ctq', 'student'),
(95, 'histesh', '$2y$10$iN8YWW68p.1ZYf3NSjVXUeofYVEY9b4bggKClQuDfoVe.yfmBloXa', 'student'),
(100, 'g', '$2y$10$CAe7qgdBPmgm/SIXJV1Ageh/HCP6aI9ZWyrDzrynMuaHuYKkVcklW', 'student'),
(101, 'h', '$2y$10$KGz//aBAPnet4LAX/iQyUutMlFQEleKOtEzjEOogsbKaFB/ydjS4y', 'student'),
(102, 'i', '$2y$10$6D5WbhtQQACs.Kabfv3N/ey.wrabEjDPihEaB4WPy7aJVg3goUtE6', 'student'),
(103, 'j', '$2y$10$4VoL0CzpzdqJ0SwrFr2PheBZBam6z5MYm12okAhnqq0BzdgzWGnbS', 'student'),
(104, 'j', '$2y$10$qKnrqDV5EH92OITovawbh.M1H0jKm8vRWPHYgdwGfVMAeEeFK5NxO', 'student'),
(105, 'k', '$2y$10$X3YCNIndq2Zv7TyWcXLb3eQbRx6cALT/nvlNbsPFvJyJflNpnX2UC', 'student'),
(106, 'l', '$2y$10$7NGXrQNPrwmQyuEsiaONnuXRRy06Vbn5dwTFYtWghdFmuc1IASbAW', 'student'),
(107, 'm', '$2y$10$LpV.KuiSyfcPSbhhzwBJweoTU6AxkyifdCK9kwFpgVqeaChBo8uz6', 'student'),
(108, 'n', '$2y$10$umxhxKWkeMwty89tYchlDOjRKd0ij.YZ9b5OR4ZSX9csen98ELxyi', 'student'),
(109, 'o', '$2y$10$s7FrVQzxBfrhUy3ftx56Fu8l9H3mw97PE4CJkLU1k6Fo7FcQwm5ca', 'student'),
(110, 'p', '$2y$10$J/z523DtdEt.w14cyLCnOOB2LyxKb8O0AWuiHugmUN4gzv0k5mAoO', 'student'),
(111, 'q', '$2y$10$L5Bj6qIuXj/LobPvlaeUa.DbdhPG5RR1eDn50F27VNcGU2EyF59ra', 'student'),
(112, 'saswata', '$2y$10$E7T2ykNakQJmsWh1x4ZKwOB51ey0.hcc2IiY24g9dHIkB1v55YHzW', 'prof'),
(113, 'Hemangee', '$2y$10$I6MzQfowvMB7Y3D6VTGWoew9xR5p8p/j5GDTlat6N8XgIJjIR5XuK', 'prof'),
(114, 'sajith', '$2y$10$tO/Kj2x2jKNHStT7bz6Y6ODNwgqat0X8bUoByRmWhzmKAOnhjgCSa', 'prof'),
(115, 'Arnab', '$2y$10$VMcAYSV44UU.UAjGGL9M3e1cmuDLZ018/LjhvJGRYRHmnhkMB.m8K', 'prof'),
(116, 'Ashish', '$2y$10$xyLm1W0NcGZm/6VLvEI64OLqKNLFOVoiogubzj/.kjDHHnK0J4ti2', 'prof'),
(117, 'santosh', '$2y$10$Md38V8NvEyrjbftZovHua.JJ/2aK.c9cGKm/67uNxsWTsQavFRnWe', 'prof'),
(118, 'pratyush', '$2y$10$zFNY25R2JltpyhsB98VsC.EX7TCAgz4FncR/K0Pr7/8TMqqlbgTTK', 'prof'),
(119, 'rahul', '$2y$10$mlPohR96NHxgspoMEnYbHutAb0Vwkxe8YyqvHgnfme6skHU0lrZeG', 'student'),
(120, 'hitesh', '$2y$10$9YPjujWmKqQRcAA3fgYYjusaAL97IdPqxMeR.d9KiKVPbWJwd/mie', 'student'),
(121, 'midhul', '$2y$10$03XC50KPLcXXU/JSrBctbeghisnhvkeIJicr5P624pae7kUY8O2OS', 'student'),
(122, 'ankit', '$2y$10$tnE5NuDJ2ZPbEPBixSzX1.9PmSRv5A7hch3Iwxjwy0qhVeyBee./C', 'student'),
(123, 'kunal', '$2y$10$SKeva/izoUkHoDGxAjbhF.B72EytqyY1XIKHpEcdmhOlVUHwBooAC', 'student'),
(124, 'mrinal', '$2y$10$1I5nWrjyKpiHZXJLnfY4quxpCkrB5cPEqB.eZh.HZ/ava0cjo2SIS', 'student'),
(125, 'rahul', '$2y$10$d9KkavSrQZwFbEh9crh7He589nYgl.FZlWHNAsg8HuypLgog0oKYK', 'student'),
(126, 'hitesh', '$2y$10$2HH0ZoN/zMFVXyI5Iad/IO3hYEqmMaf24ij1wT.ktR0egf6Fh178W', 'student'),
(127, 'midhul', '$2y$10$mJYuRm6iVq6hPxbil112ROg02oozPV2pL9EQypu/PAGys4OrkYTHm', 'student'),
(128, 'ankit', '$2y$10$HuWfHSMN8RnzOAtlyXqIwuU8X./88AwYkCicsHKdun7KoiYn699sO', 'student'),
(129, 'kunal', '$2y$10$MfYtdf.iFWKzZbDj4S07kOg2Gx/0vsn.ZUTuO0OA2i5FHWO3pA3Ay', 'student'),
(130, 'mrinal', '$2y$10$M/AnERJ/Gg.tBR.81PhGnurOfh5Z3H2pzTV9zZbadwgqrp0aHB5Bu', 'student'),
(138, 'midhul', '$2y$10$nJkqaBDJKkOOnHOrMxGmq.xu2YQQjyyFZJdva.B5Mwmd2MuYtEKFK', 'student'),
(139, 'fskhdj', '$2y$10$KlY0q5SPdgTXRgNBCg23iOIYnJ/C96M9HePqwErhXwjFRNcQbfCxa', 'student'),
(140, 'jhkh', '$2y$10$M2QIwr3LAT4Vr2na6EvN5.rOUSGLOVs/XaZqVYrPS5WzPbF3D803m', 'student'),
(141, 'jkdfhs', '$2y$10$/.6CXU8yspPASAk8maDLmOQLQ.FOXxNKk6mSgvUpHnG2NndEw/Rey', 'student'),
(142, 'jhkjdfhk', '$2y$10$INIziYkV8vlgVDOrwu.5TehI.HLJw1kHHzyMcJpTM.sZ7n43cNnFe', 'student'),
(143, 'fsdf', '$2y$10$Ut8ymDaWkAUHJbvhYvugA.qt6EGX3RCgloE0WyEYJeTuaMY178Tte', 'student');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
