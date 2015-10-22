-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 17, 2015 at 06:51 AM
-- Server version: 5.6.20
-- PHP Version: 5.5.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `masum`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
`admin_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `level` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `name`, `email`, `password`, `level`) VALUES
(1, 'Mr. Admin', 'a@a.com', 'a', '1');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE IF NOT EXISTS `attendance` (
`attendance_id` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1' COMMENT '0 undefined , 1 present , 2  absent',
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `status`, `student_id`, `class_id`, `date`) VALUES
(1, 1, 1, 1, '2015-05-20'),
(2, 1, 3, 1, '2015-05-20'),
(3, 2, 2, 1, '2015-05-20'),
(4, 1, 4, 1, '2015-05-20');

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE IF NOT EXISTS `class` (
`class_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `name_numeric` longtext COLLATE utf8_unicode_ci NOT NULL,
  `teacher_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `name`, `name_numeric`, `teacher_id`) VALUES
(1, 'CSE 115(summer 14)', 'CSE 115(summer 14)', 1),
(3, 'CSE 135(summer 14)', 'CSE 135(summer 14)', 1),
(4, 'CSE 225(summer 14)', 'CSE 225(summer 14)', 1),
(5, 'soc-101(summer 14)', 'soc-101(summer 14)', 4);

-- --------------------------------------------------------

--
-- Table structure for table `exam`
--

CREATE TABLE IF NOT EXISTS `exam` (
`exam_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `date` longtext COLLATE utf8_unicode_ci NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=14 ;

--
-- Dumping data for table `exam`
--

INSERT INTO `exam` (`exam_id`, `name`, `date`, `comment`) VALUES
(1, 'quiz-1', '03/04/2015', ''),
(2, 'mid-1', '04/22/2015', ''),
(3, 'final', '04/30/2015', ''),
(4, 'quiz-2', '05/11/2015', ''),
(5, 'mid-2', '05/15/2015', ''),
(6, 'quiz-3', '05/15/2015', ''),
(7, 'quiz-4', '05/15/2015', ''),
(8, 'attendance', '05/15/2015', ''),
(9, 'assignment-1', '05/15/2015', ''),
(10, 'assignment-2', '05/15/2015', ''),
(11, 'assignment-3', '05/15/2015', ''),
(12, 'assignment-4', '05/15/2015', ''),
(13, 'assignment-5', '05/15/2015', '');

-- --------------------------------------------------------

--
-- Table structure for table `file`
--

CREATE TABLE IF NOT EXISTS `file` (
`f_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `f_name` varchar(400) NOT NULL,
  `f_dir` text NOT NULL,
  `f_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE IF NOT EXISTS `grade` (
`grade_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `grade_point` longtext COLLATE utf8_unicode_ci NOT NULL,
  `mark_from` int(11) NOT NULL,
  `mark_upto` int(11) NOT NULL,
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`grade_id`, `name`, `grade_point`, `mark_from`, `mark_upto`, `comment`) VALUES
(1, 'A', '4', 93, 100, ''),
(2, 'A-', '3.7', 90, 92, ''),
(3, 'B+', '3.7', 87, 89, ''),
(4, 'B', '3', 83, 86, ''),
(5, 'B-', '2.7', 80, 82, ''),
(6, 'C+', '2.3', 77, 79, ''),
(7, 'C', '2', 73, 76, ''),
(8, 'C-', '1.7', 70, 72, ''),
(10, 'D+', '1.3', 67, 69, ''),
(11, 'D', '1', 60, 66, ''),
(12, 'F', '0', 0, 59, '');

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
`phrase_id` int(11) NOT NULL,
  `phrase` longtext COLLATE utf8_unicode_ci NOT NULL,
  `english` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=248 ;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`phrase_id`, `phrase`, `english`) VALUES
(1, 'login', 'login'),
(2, 'account_type', 'account type'),
(3, 'admin', 'admin'),
(4, 'teacher', 'teacher'),
(5, 'student', 'student'),
(6, 'parent', 'parent'),
(7, 'email', 'email'),
(8, 'password', 'password'),
(9, 'forgot_password ?', 'forgot password ?'),
(10, 'reset_password', 'reset password'),
(11, 'reset', 'reset'),
(12, 'admin_dashboard', 'Admin Dashboard'),
(13, 'account', 'account'),
(14, 'profile', 'profile'),
(15, 'change_password', 'change password'),
(16, 'logout', 'logout'),
(17, 'panel', 'panel'),
(18, 'dashboard_help', 'dashboard help'),
(19, 'dashboard', 'dashboard'),
(20, 'student_help', 'student help'),
(21, 'teacher_help', 'teacher help'),
(22, 'subject_help', 'subject help'),
(23, 'subject', 'subject'),
(24, 'class_help', 'class help'),
(25, 'class', 'class'),
(26, 'exam_help', 'exam help'),
(27, 'exam', 'exam'),
(28, 'marks_help', 'marks help'),
(29, 'marks-attendance', 'marks-attendance'),
(30, 'grade_help', 'grade help'),
(31, 'exam-grade', 'exam-grade'),
(32, 'class_routine_help', 'class routine help'),
(33, 'class_routine', 'class routine'),
(34, 'invoice_help', 'invoice help'),
(35, 'payment', 'payment'),
(36, 'book_help', 'book help'),
(37, 'library', 'library'),
(38, 'transport_help', 'transport help'),
(39, 'transport', 'transport'),
(40, 'dormitory_help', 'dormitory help'),
(41, 'dormitory', 'dormitory'),
(42, 'noticeboard_help', 'noticeboard help'),
(43, 'noticeboard-event', 'noticeboard-event'),
(44, 'bed_ward_help', 'bed ward help'),
(45, 'settings', 'settings'),
(46, 'system_settings', 'system settings'),
(47, 'manage_language', 'manage language'),
(48, 'backup_restore', 'backup restore'),
(49, 'profile_help', 'profile help'),
(50, 'manage_student', 'manage student'),
(51, 'manage_teacher', 'Manage Teacher'),
(52, 'noticeboard', 'noticeboard'),
(53, 'language', 'language'),
(54, 'backup', 'backup'),
(55, 'calendar_schedule', 'calendar schedule'),
(56, 'select_a_class', 'select a class'),
(57, 'student_list', 'student list'),
(58, 'add_student', 'add student'),
(59, 'roll', 'roll'),
(60, 'photo', 'photo'),
(61, 'student_name', 'student name'),
(62, 'address', 'address'),
(63, 'options', 'options'),
(64, 'marksheet', 'marksheet'),
(65, 'id_card', 'id card'),
(66, 'edit', 'edit'),
(67, 'delete', 'delete'),
(68, 'personal_profile', 'personal profile'),
(69, 'academic_result', 'academic result'),
(70, 'name', 'name'),
(71, 'birthday', 'birthday'),
(72, 'sex', 'sex'),
(73, 'male', 'male'),
(74, 'female', 'female'),
(75, 'religion', 'religion'),
(76, 'blood_group', 'blood group'),
(77, 'phone', 'phone'),
(78, 'father_name', 'father name'),
(79, 'mother_name', 'mother name'),
(80, 'edit_student', 'edit student'),
(81, 'teacher_list', 'teacher list'),
(82, 'add_teacher', 'add teacher'),
(83, 'teacher_name', 'teacher name'),
(84, 'edit_teacher', 'edit teacher'),
(85, 'manage_parent', 'manage parent'),
(86, 'parent_list', 'parent list'),
(87, 'parent_name', 'parent name'),
(88, 'relation_with_student', 'relation with student'),
(89, 'parent_email', 'parent email'),
(90, 'parent_phone', 'parent phone'),
(91, 'parrent_address', 'parrent address'),
(92, 'parrent_occupation', 'parrent occupation'),
(93, 'add', 'add'),
(94, 'parent_of', 'parent of'),
(95, 'profession', 'profession'),
(96, 'edit_parent', 'edit parent'),
(97, 'add_parent', 'add parent'),
(98, 'manage_subject', 'manage subject'),
(99, 'subject_list', 'subject list'),
(100, 'add_subject', 'add subject'),
(101, 'subject_name', 'subject name'),
(102, 'edit_subject', 'edit subject'),
(103, 'manage_class', 'manage class'),
(104, 'class_list', 'class list'),
(105, 'add_class', 'add class'),
(106, 'class_name', 'class name'),
(107, 'numeric_name', 'numeric name'),
(108, 'name_numeric', 'name numeric'),
(109, 'edit_class', 'edit class'),
(110, 'manage_exam', 'manage exam'),
(111, 'exam_list', 'exam list'),
(112, 'add_exam', 'add exam'),
(113, 'exam_name', 'exam name'),
(114, 'date', 'date'),
(115, 'comment', 'comment'),
(116, 'edit_exam', 'edit exam'),
(117, 'manage_exam_marks', 'manage exam marks'),
(118, 'manage_marks', 'manage marks'),
(119, 'select_exam', 'select exam'),
(120, 'select_class', 'select class'),
(121, 'select_subject', 'select subject'),
(122, 'select_an_exam', 'select an exam'),
(123, 'mark_obtained', 'mark obtained'),
(124, 'attendance', 'attendance'),
(125, 'manage_grade', 'manage grade'),
(126, 'grade_list', 'grade list'),
(127, 'add_grade', 'add grade'),
(128, 'grade_name', 'grade name'),
(129, 'grade_point', 'grade point'),
(130, 'mark_from', 'mark from'),
(131, 'mark_upto', 'mark upto'),
(132, 'edit_grade', 'edit grade'),
(133, 'manage_class_routine', 'manage class routine'),
(134, 'class_routine_list', 'class routine list'),
(135, 'add_class_routine', 'add class routine'),
(136, 'day', 'day'),
(137, 'starting_time', 'starting time'),
(138, 'ending_time', 'ending time'),
(139, 'edit_class_routine', 'edit class routine'),
(140, 'manage_invoice/payment', 'manage invoice/payment'),
(141, 'invoice/payment_list', 'invoice/payment list'),
(142, 'add_invoice/payment', 'add invoice/payment'),
(143, 'title', 'title'),
(144, 'description', 'description'),
(145, 'amount', 'amount'),
(146, 'status', 'status'),
(147, 'view_invoice', 'view invoice'),
(148, 'paid', 'paid'),
(149, 'unpaid', 'unpaid'),
(150, 'add_invoice', 'add invoice'),
(151, 'payment_to', 'payment to'),
(152, 'bill_to', 'bill to'),
(153, 'invoice_title', 'invoice title'),
(154, 'invoice_id', 'invoice id'),
(155, 'edit_invoice', 'edit invoice'),
(156, 'manage_library_books', 'manage library books'),
(157, 'book_list', 'book list'),
(158, 'add_book', 'add book'),
(159, 'book_name', 'book name'),
(160, 'author', 'author'),
(161, 'price', 'price'),
(162, 'available', 'available'),
(163, 'unavailable', 'unavailable'),
(164, 'edit_book', 'edit book'),
(165, 'manage_transport', 'manage transport'),
(166, 'transport_list', 'transport list'),
(167, 'add_transport', 'add transport'),
(168, 'route_name', 'route name'),
(169, 'number_of_vehicle', 'number of vehicle'),
(170, 'route_fare', 'route fare'),
(171, 'edit_transport', 'edit transport'),
(172, 'manage_dormitory', 'manage dormitory'),
(173, 'dormitory_list', 'dormitory list'),
(174, 'add_dormitory', 'add dormitory'),
(175, 'dormitory_name', 'dormitory name'),
(176, 'number_of_room', 'number of room'),
(177, 'manage_noticeboard', 'manage noticeboard'),
(178, 'noticeboard_list', 'noticeboard list'),
(179, 'add_noticeboard', 'add noticeboard'),
(180, 'notice', 'notice'),
(181, 'add_notice', 'add notice'),
(182, 'edit_noticeboard', 'edit noticeboard'),
(183, 'system_name', 'system name'),
(184, 'save', 'save'),
(185, 'system_title', 'system title'),
(186, 'paypal_email', 'paypal email'),
(187, 'currency', 'currency'),
(188, 'phrase_list', 'phrase list'),
(189, 'add_phrase', 'add phrase'),
(190, 'add_language', 'add language'),
(191, 'phrase', 'phrase'),
(192, 'manage_backup_restore', 'manage backup restore'),
(193, 'restore', 'restore'),
(194, 'mark', 'mark'),
(195, 'grade', 'grade'),
(196, 'invoice', 'invoice'),
(197, 'book', 'book'),
(198, 'all', 'all'),
(199, 'upload_&_restore_from_backup', 'upload & restore from backup'),
(200, 'manage_profile', 'manage profile'),
(201, 'update_profile', 'update profile'),
(202, 'new_password', 'new password'),
(203, 'confirm_new_password', 'confirm new password'),
(204, 'update_password', 'update password'),
(205, 'teacher_dashboard', 'teacher dashboard'),
(206, 'backup_restore_help', 'backup restore help'),
(207, 'student_dashboard', 'student dashboard'),
(208, 'parent_dashboard', 'parent dashboard'),
(209, 'view_marks', 'view marks'),
(210, 'delete_language', 'delete language'),
(211, 'settings_updated', 'settings updated'),
(212, 'update_phrase', 'update phrase'),
(213, 'login_failed', 'login failed'),
(214, 'live_chat', 'live chat'),
(215, 'client 1', 'client 1'),
(216, 'buyer', 'buyer'),
(217, 'purchase_code', 'purchase code'),
(218, 'system_email', 'system email'),
(219, 'option', 'option'),
(220, 'edit_phrase', 'edit phrase'),
(221, 'marks', ''),
(222, 'message', ''),
(223, 'manage_message', ''),
(224, '0', ''),
(225, '0', ''),
(226, 'notice_updated', ''),
(227, 'payment_cancelled', ''),
(228, '0', ''),
(229, '0', ''),
(230, 'payment_successfull', ''),
(231, 'admit_student', ''),
(232, 'student_information', ''),
(233, 'student_marksheet', ''),
(234, 'daily_attendance', ''),
(235, 'exam_grades', ''),
(236, 'general_settings', ''),
(237, 'language_settings', ''),
(238, 'edit_profile', ''),
(239, 'event_schedule', ''),
(240, 'cancel', ''),
(241, 'addmission_form', ''),
(242, 'value_required', ''),
(243, 'select', ''),
(244, 'gender', ''),
(245, 'add_new_student', ''),
(246, 'language_list', ''),
(247, 'text_align', '');

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

CREATE TABLE IF NOT EXISTS `mark` (
`mark_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `mark_obtained` int(11) NOT NULL DEFAULT '0',
  `mark_total` int(11) NOT NULL DEFAULT '100',
  `attendance` int(11) NOT NULL DEFAULT '0',
  `comment` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`mark_id`, `student_id`, `subject_id`, `class_id`, `exam_id`, `mark_obtained`, `mark_total`, `attendance`, `comment`) VALUES
(1, 1, 1, 1, 1, 7, 10, 0, ''),
(2, 3, 1, 1, 1, 9, 10, 0, ''),
(3, 2, 1, 1, 1, 10, 10, 0, ''),
(4, 4, 1, 1, 1, 4, 10, 0, ''),
(5, 1, 1, 1, 4, 9, 10, 0, ''),
(6, 3, 1, 1, 4, 3, 10, 0, ''),
(7, 2, 1, 1, 4, 7, 10, 0, ''),
(8, 4, 1, 1, 4, 10, 10, 0, ''),
(9, 1, 1, 1, 6, 9, 10, 0, ''),
(10, 3, 1, 1, 6, 6, 10, 0, ''),
(11, 2, 1, 1, 6, 8, 10, 0, ''),
(12, 4, 1, 1, 6, 5, 10, 0, ''),
(13, 1, 1, 1, 7, 10, 10, 0, ''),
(14, 3, 1, 1, 7, 5, 10, 0, ''),
(15, 2, 1, 1, 7, 10, 10, 0, ''),
(16, 4, 1, 1, 7, 8, 10, 0, ''),
(17, 1, 1, 1, 3, 44, 45, 0, ''),
(18, 3, 1, 1, 3, 35, 45, 0, ''),
(19, 2, 1, 1, 3, 33, 45, 0, ''),
(20, 4, 1, 1, 3, 39, 45, 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
`m_id` int(11) NOT NULL,
  `m_from` text NOT NULL,
  `m_to` text NOT NULL,
  `m_title` varchar(500) NOT NULL,
  `m_msg` text NOT NULL,
  `m_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `m_read` int(11) NOT NULL DEFAULT '1' COMMENT '0=read,1=not read'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`m_id`, `m_from`, `m_to`, `m_title`, `m_msg`, `m_date`, `m_read`) VALUES
(2, 'tarif@tarif.com', 'a@a.com', 'eid mubarak(reply)', '{"msg":[{"from":"a@a.com","said":"happy grettings of eid"},{"from":"tarif@tarif.com","said":"thank you,eid mubarak too"}]}', '2015-04-23 16:50:40', 0),
(4, 'tarif@tarif.com', 'plabon@plabon.com', 'quiz-1', '{"msg":[{"from":"tarif@tarif.com","said":"quiz-1 will be on sunday(11\\/11\\/11)"}]}', '2015-05-23 16:51:55', 1),
(5, 'tarif@tarif.com', 'sdf', 'quiz-1', '{"msg":[{"from":"tarif@tarif.com","said":"quiz-1 will be on sunday(11\\/11\\/11)"}]}', '2015-05-23 16:51:55', 1),
(6, 'tarif@tarif.com', 'masum@masum.com', 'quiz-1', '{"msg":[{"from":"tarif@tarif.com","said":"quiz-1 will be on sunday(11\\/11\\/11)"}]}', '2015-05-23 16:51:55', 1),
(8, 'tarif@tarif.com', 'plabon@plabon.com', 'mid-1', '{"msg":[{"from":"tarif@tarif.com","said":"there will be mid-1 on sunday(11\\/11\\/11)"}]}', '2015-05-23 16:58:29', 1),
(9, 'tarif@tarif.com', 'sdf', 'mid-1', '{"msg":[{"from":"tarif@tarif.com","said":"there will be mid-1 on sunday(11\\/11\\/11)"}]}', '2015-05-23 16:58:29', 1),
(10, 'tarif@tarif.com', 'masum@masum.com', 'mid-1', '{"msg":[{"from":"tarif@tarif.com","said":"there will be mid-1 on sunday(11\\/11\\/11)"}]}', '2015-05-23 16:58:29', 1);

-- --------------------------------------------------------

--
-- Table structure for table `noticeboard`
--

CREATE TABLE IF NOT EXISTS `noticeboard` (
`notice_id` int(11) NOT NULL,
  `notice_title` longtext COLLATE utf8_unicode_ci NOT NULL,
  `notice` longtext COLLATE utf8_unicode_ci NOT NULL,
  `create_timestamp` int(11) NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `noticeboard`
--

INSERT INTO `noticeboard` (`notice_id`, `notice_title`, `notice`, `create_timestamp`) VALUES
(1, 'class cancel', 'today 115 class cancelled due to present circumstances', 1425337200);

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE IF NOT EXISTS `parent` (
`parent_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `student_email` text COLLATE utf8_unicode_ci,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `name`, `email`, `password`, `student_email`, `phone`, `address`) VALUES
(1, 'khan', 'khan@khan.com', '1234', 'sam@jam.com', '1234', 'asdasdasda');

-- --------------------------------------------------------

--
-- Table structure for table `percentage`
--

CREATE TABLE IF NOT EXISTS `percentage` (
`percent_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `value` int(11) NOT NULL DEFAULT '0',
  `full_mark` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `percentage`
--

INSERT INTO `percentage` (`percent_id`, `class_id`, `exam_id`, `value`, `full_mark`) VALUES
(1, 1, 1, 5, 10),
(2, 1, 4, 5, 10),
(3, 1, 6, 5, 10),
(4, 1, 7, 5, 10),
(5, 1, 3, 80, 45),
(6, 1, 8, 20, 10);

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
`settings_id` int(11) NOT NULL,
  `type` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settings_id`, `type`, `description`) VALUES
(1, 'system_name', 'North South University'),
(2, 'system_title', 'Grading System'),
(3, 'address', 'Dhaka, Bangladesh'),
(4, 'phone', '+8012654159'),
(5, 'paypal_email', 'payment@school.com'),
(6, 'currency', 'usd'),
(7, 'system_email', 'grade@nsu.com'),
(8, 'buyer', 'plabon@plabon.com'),
(9, 'purchase_code', '0'),
(11, 'language', 'english'),
(12, 'text_align', 'left-to-right');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
`student_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL,
  `roll` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `name`, `sex`, `address`, `phone`, `email`, `password`, `roll`) VALUES
(1, 'Rizvi', 'male', 'sdfsfsf', '42424342', 's@s.com', 's', '1120368042'),
(2, 'sdfsdg', 'male', 'sfsedf', 'sdfe', 'sdf', 'sdf', '12'),
(3, 'plabon', 'male', 'kfvjhsjkfgkjd fsdgjkhd fkgj kfgjhk kfghkf', '54353453453', 'plabon@plabon.com', 's', '1120367042'),
(4, 'masum', 'male', 'tyhtyjtjt tyuturtyu tyutyu ytuty tyutut tyutyutyuty', '12345', 'masum@masum.com', 's', '2'),
(5, 'mrs plabon', 'female', 'jmgjk', '75878', 'mp@mp.com', 's', '3'),
(6, 'masum', 'male', 'a', '1', '01/18/2015', '073', '0'),
(7, 'a', 'male', 'a', '1', '', '', '1'),
(8, 'b', 'male', 'b', '', '', '', '2'),
(9, 'a', 'male', 'a', '1', 'student115@student115.com', '115', '1'),
(10, 'b', '', '', '', '', '', '2'),
(11, 'student327', 'male', 'hr', '2', 'student327@student327.com', '327', '327'),
(12, 'ali abdullah khan', 'male', 'mohammadpur', '01677408411', 'abdullah017196@gmail.com', '123456', '1120368042');

-- --------------------------------------------------------

--
-- Table structure for table `student_and_course`
--

CREATE TABLE IF NOT EXISTS `student_and_course` (
`s_c_id` int(11) NOT NULL,
  `c_id` int(11) NOT NULL,
  `s_id` int(11) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `student_and_course`
--

INSERT INTO `student_and_course` (`s_c_id`, `c_id`, `s_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 1, 2),
(5, 1, 4),
(6, 3, 1),
(7, 3, 3),
(9, 3, 2);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE IF NOT EXISTS `teacher` (
`teacher_id` int(11) NOT NULL,
  `name` longtext COLLATE utf8_unicode_ci NOT NULL,
  `sex` longtext COLLATE utf8_unicode_ci NOT NULL,
  `address` longtext COLLATE utf8_unicode_ci NOT NULL,
  `phone` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` longtext COLLATE utf8_unicode_ci NOT NULL,
  `password` longtext COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=5 ;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `name`, `sex`, `address`, `phone`, `email`, `password`) VALUES
(1, 'Tarif Riad Rahman', 'male', 'fsdfsdfsd', '242342342342323', 'tarif@tarif.com', 'trr'),
(2, 'Sazzad Hossain', 'male', 'gbf2effre', '11', 'sazzad@sazzad.com', 'szz'),
(3, 'Abdul  Hakim', 'male', 'buet', '1', 'amk@amk.com', 'amk'),
(4, 'sam', 'male', 'asdasdsad', '1234', 'sam@sam.com', '1234');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
 ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
 ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `class`
--
ALTER TABLE `class`
 ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `exam`
--
ALTER TABLE `exam`
 ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `file`
--
ALTER TABLE `file`
 ADD PRIMARY KEY (`f_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
 ADD PRIMARY KEY (`grade_id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
 ADD PRIMARY KEY (`phrase_id`);

--
-- Indexes for table `mark`
--
ALTER TABLE `mark`
 ADD PRIMARY KEY (`mark_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
 ADD PRIMARY KEY (`m_id`);

--
-- Indexes for table `noticeboard`
--
ALTER TABLE `noticeboard`
 ADD PRIMARY KEY (`notice_id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
 ADD PRIMARY KEY (`parent_id`);

--
-- Indexes for table `percentage`
--
ALTER TABLE `percentage`
 ADD PRIMARY KEY (`percent_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
 ADD PRIMARY KEY (`settings_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
 ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `student_and_course`
--
ALTER TABLE `student_and_course`
 ADD PRIMARY KEY (`s_c_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
 ADD PRIMARY KEY (`teacher_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `exam`
--
ALTER TABLE `exam`
MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `file`
--
ALTER TABLE `file`
MODIFY `f_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
MODIFY `phrase_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=248;
--
-- AUTO_INCREMENT for table `mark`
--
ALTER TABLE `mark`
MODIFY `mark_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=21;
--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
MODIFY `m_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `noticeboard`
--
ALTER TABLE `noticeboard`
MODIFY `notice_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `percentage`
--
ALTER TABLE `percentage`
MODIFY `percent_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
MODIFY `settings_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `student_and_course`
--
ALTER TABLE `student_and_course`
MODIFY `s_c_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
