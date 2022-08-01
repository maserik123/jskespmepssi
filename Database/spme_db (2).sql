-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 01, 2022 at 05:55 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.0.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `spme_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `accreditation_document`
--

CREATE TABLE `accreditation_document` (
  `accreditation_document_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  `remarks` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `accreditation_members`
--

CREATE TABLE `accreditation_members` (
  `accreditation_members_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `level` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `assessment_schedule`
--

CREATE TABLE `assessment_schedule` (
  `assessment_schedule_id` int(11) NOT NULL,
  `prodi_id` int(11) NOT NULL,
  `period` int(11) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `team_total` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assessment_schedule`
--

INSERT INTO `assessment_schedule` (`assessment_schedule_id`, `prodi_id`, `period`, `start`, `end`, `team_total`, `create_date`) VALUES
(3, 1, 2022, '2022-08-01', '2022-08-30', 0, '2022-08-01 15:54:01');

-- --------------------------------------------------------

--
-- Table structure for table `configuration_banner`
--

CREATE TABLE `configuration_banner` (
  `configuration_banner_id` int(11) NOT NULL,
  `configuration_banner_picture_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `configuration_banner_picture`
--

CREATE TABLE `configuration_banner_picture` (
  `configuration_banner_picture_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `image` text NOT NULL,
  `description` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `configuration_video`
--

CREATE TABLE `configuration_video` (
  `configuration_video_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `url` text NOT NULL,
  `api_key` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `menu_id` int(11) NOT NULL,
  `menu_title` text NOT NULL,
  `controller_name` text NOT NULL,
  `menu_logo_id` text NOT NULL,
  `menu_description` text NOT NULL,
  `menu_hierarki` int(15) NOT NULL,
  `user_id` int(15) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_title`, `controller_name`, `menu_logo_id`, `menu_description`, `menu_hierarki`, `user_id`, `create_date`) VALUES
(1, 'Konfigurasi', 'configuration', '1', 'Menu akreditasi digunakan untuk merecord data akreditasi pada website SPME', 2, 1, '2022-07-23 10:36:27'),
(2, 'Manajemen Pengguna', 'user', '2', 'Menu users digunakan untuk mengedit data pengguna', 3, 1, '2022-07-23 10:36:29'),
(3, 'Penjadwalan Asesmen', 'assessment', '3', 'Menu assessment untuk melakukan penjadwalan asesment', 4, 1, '2022-07-23 15:08:56'),
(5, 'Dokumen Akreditasi', 'accreditation', '4', '-', 5, 3, '2022-07-24 23:45:33'),
(6, 'Dokumen Pendukung', 'supportDocuments', '6', 'Untuk menampung dokumen pendukung 3A dan 3B', 6, 1, '2022-07-24 23:55:16'),
(7, 'Tim Akreditasi', 'accreditationTeam', '7', 'Untuk menampung data tim akreditasi', 7, 1, '2022-07-24 22:02:10');

-- --------------------------------------------------------

--
-- Table structure for table `menu_logo`
--

CREATE TABLE `menu_logo` (
  `menu_logo_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `script` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `menu_logo`
--

INSERT INTO `menu_logo` (`menu_logo_id`, `title`, `script`, `create_date`) VALUES
(1, 'fa-adjust', 'fa-adjust', '2022-07-20 15:51:54'),
(2, 'fa-anchor', 'fa-anchor', '2022-07-20 15:51:54'),
(3, 'fa-archive', 'fa-archive', '2022-07-20 15:51:54'),
(4, 'fa-area-chart', 'fa-area-chart', '2022-07-20 15:51:54'),
(5, 'fa-arrows', 'fa-arrows', '2022-07-20 15:51:54'),
(6, 'fa-arrows-h', 'fa-arrows-h', '2022-07-20 15:51:54'),
(7, 'fa-arrows-v', 'fa-arrows-v', '2022-07-20 15:51:54'),
(8, 'fa-asterisk', 'fa-asterisk', '2022-07-20 15:51:54'),
(9, 'fa-at', 'fa-at', '2022-07-20 15:51:54'),
(10, 'fa-automobile', 'fa-automobile ', '2022-07-20 15:51:54'),
(11, 'fa-ban', 'fa-ban', '2022-07-20 15:51:54'),
(12, 'fa-bank ', 'fa-bank ', '2022-07-20 15:51:54'),
(13, 'fa-bar-chart', 'fa-bar-chart', '2022-07-20 15:51:54'),
(14, 'fa-bar-chart-o ', 'fa-bar-chart-o ', '2022-07-20 15:51:54'),
(15, 'fa-barcode', 'fa-barcode', '2022-07-20 15:51:54'),
(16, 'fa-bars', 'fa-bars', '2022-07-20 15:51:54'),
(17, 'fa-beer', 'fa-beer', '2022-07-20 15:51:54'),
(18, 'fa-bell', 'fa-bell', '2022-07-20 15:51:54'),
(19, 'fa-bell-o', 'fa-bell-o', '2022-07-20 15:51:54'),
(20, 'fa-bell-slash', 'fa-bell-slash', '2022-07-20 15:51:54'),
(21, 'fa-bell-slash-o', 'fa-bell-slash-o', '2022-07-20 15:51:54'),
(22, 'fa-bicycle', 'fa-bicycle', '2022-07-20 15:51:54'),
(23, 'fa-binoculars', 'fa-binoculars', '2022-07-20 15:51:54'),
(24, 'fa-birthday-cake', 'fa-birthday-cake', '2022-07-20 15:51:54'),
(25, 'fa-bolt', 'fa-bolt', '2022-07-20 15:51:54'),
(26, 'fa-bomb', 'fa-bomb', '2022-07-20 15:51:54'),
(27, 'fa-book', 'fa-book', '2022-07-20 15:51:54'),
(28, 'fa-bookmark', 'fa-bookmark', '2022-07-20 15:51:54'),
(29, 'fa-bookmark-o', 'fa-bookmark-o', '2022-07-20 15:51:54'),
(30, 'fa-briefcase', 'fa-briefcase', '2022-07-20 15:51:54'),
(31, 'fa-bug', 'fa-bug', '2022-07-20 15:51:54'),
(32, 'fa-building', 'fa-building', '2022-07-20 15:51:54'),
(33, 'fa-building-o', 'fa-building-o', '2022-07-20 15:51:54'),
(34, 'fa-bullhorn', 'fa-bullhorn', '2022-07-20 15:51:54'),
(35, 'fa-bullseye', 'fa-bullseye', '2022-07-20 15:51:54'),
(36, 'fa-bus', 'fa-bus', '2022-07-20 15:51:54'),
(37, 'fa-cab ', 'fa-cab ', '2022-07-20 15:51:54'),
(38, 'fa-calculator', 'fa-calculator', '2022-07-20 15:51:54'),
(39, 'fa-calendar', 'fa-calendar', '2022-07-20 15:51:54'),
(40, 'fa-calendar-o', 'fa-calendar-o', '2022-07-20 15:51:54'),
(41, 'fa-camera', 'fa-camera', '2022-07-20 15:51:54'),
(42, 'fa-camera-retro', 'fa-camera-retro', '2022-07-20 15:51:54'),
(43, 'fa-car', 'fa-car', '2022-07-20 15:51:54'),
(44, 'fa-caret-square-o-down', 'fa-caret-square-o-down', '2022-07-20 15:51:54'),
(45, 'fa-caret-square-o-left', 'fa-caret-square-o-left', '2022-07-20 15:51:54'),
(46, 'fa-caret-square-o-right', 'fa-caret-square-o-right', '2022-07-20 15:51:54'),
(47, 'fa-caret-square-o-up', 'fa-caret-square-o-up', '2022-07-20 15:51:54'),
(48, 'fa-cc', 'fa-cc', '2022-07-20 15:51:54'),
(49, 'fa-certificate', 'fa-certificate', '2022-07-20 15:51:54'),
(50, 'fa-check', 'fa-check', '2022-07-20 15:51:54'),
(51, 'fa-check-circle', 'fa-check-circle', '2022-07-20 15:51:54'),
(52, 'fa-check-circle-o', 'fa-check-circle-o', '2022-07-20 15:51:54'),
(53, 'fa-check-square', 'fa-check-square', '2022-07-20 15:51:54'),
(54, 'fa-check-square-o', 'fa-check-square-o', '2022-07-20 15:51:54'),
(55, 'fa-child', 'fa-child', '2022-07-20 15:51:54'),
(56, 'fa-circle', 'fa-circle', '2022-07-20 15:51:54'),
(57, 'fa-circle-o', 'fa-circle-o', '2022-07-20 15:51:54'),
(58, 'fa-circle-o-notch', 'fa-circle-o-notch', '2022-07-20 15:51:54'),
(59, 'fa-circle-thin', 'fa-circle-thin', '2022-07-20 15:51:54'),
(60, 'fa-clock-o', 'fa-clock-o', '2022-07-20 15:51:54'),
(61, 'fa-close ', 'fa-close ', '2022-07-20 15:51:54'),
(62, 'fa-cloud', 'fa-cloud', '2022-07-20 15:51:54'),
(63, 'fa-cloud-download', 'fa-cloud-download', '2022-07-20 15:51:54'),
(64, 'fa-cloud-upload', 'fa-cloud-upload', '2022-07-20 15:51:54'),
(65, 'fa-code', 'fa-code', '2022-07-20 15:51:54'),
(66, 'fa-code-fork', 'fa-code-fork', '2022-07-20 15:51:54'),
(67, 'fa-coffee', 'fa-coffee', '2022-07-20 15:51:54'),
(68, 'fa-cog', 'fa-cog', '2022-07-20 15:51:54'),
(69, 'fa-cogs', 'fa-cogs', '2022-07-20 15:51:54'),
(70, 'fa-comment', 'fa-comment', '2022-07-20 15:51:54'),
(71, 'fa-comment-o', 'fa-comment-o', '2022-07-20 15:51:54'),
(72, 'fa-comments', 'fa-comments', '2022-07-20 15:51:54'),
(73, 'fa-comments-o', 'fa-comments-o', '2022-07-20 15:51:54'),
(74, 'fa-compass', 'fa-compass', '2022-07-20 15:51:54'),
(75, 'fa-copyright', 'fa-copyright', '2022-07-20 15:51:54'),
(76, 'fa-credit-card', 'fa-credit-card', '2022-07-20 15:51:54'),
(77, 'fa-crop', 'fa-crop', '2022-07-20 15:51:54'),
(78, 'fa-crosshairs', 'fa-crosshairs', '2022-07-20 15:51:54'),
(79, 'fa-cube', 'fa-cube', '2022-07-20 15:51:54'),
(80, 'fa-cubes', 'fa-cubes', '2022-07-20 15:51:54'),
(81, 'fa-cutlery', 'fa-cutlery', '2022-07-20 15:51:54'),
(82, 'fa-dashboard ', 'fa-dashboard ', '2022-07-20 15:51:54'),
(83, 'fa-database', 'fa-database', '2022-07-20 15:51:54'),
(84, 'fa-desktop', 'fa-desktop', '2022-07-20 15:51:54'),
(85, 'fa-dot-circle-o', 'fa-dot-circle-o', '2022-07-20 15:51:54'),
(86, 'fa-download', 'fa-download', '2022-07-20 15:51:54'),
(87, 'fa-edit ', 'fa-edit ', '2022-07-20 15:51:54'),
(88, 'fa-ellipsis-h', 'fa-ellipsis-h', '2022-07-20 15:51:54'),
(89, 'fa-ellipsis-v', 'fa-ellipsis-v', '2022-07-20 15:51:54'),
(90, 'fa-envelope', 'fa-envelope', '2022-07-20 15:51:54'),
(91, 'fa-envelope-o', 'fa-envelope-o', '2022-07-20 15:51:54'),
(92, 'fa-envelope-square', 'fa-envelope-square', '2022-07-20 15:51:54'),
(93, 'fa-eraser', 'fa-eraser', '2022-07-20 15:51:54'),
(94, 'fa-exchange', 'fa-exchange', '2022-07-20 15:51:54'),
(95, 'fa-exclamation', 'fa-exclamation', '2022-07-20 15:51:54'),
(96, 'fa-exclamation-circle', 'fa-exclamation-circle', '2022-07-20 15:51:54'),
(97, 'fa-exclamation-triangle', 'fa-exclamation-triangle', '2022-07-20 15:51:54'),
(98, 'fa-external-link', 'fa-external-link', '2022-07-20 15:51:54'),
(99, 'fa-external-link-square', 'fa-external-link-square', '2022-07-20 15:51:54'),
(100, 'fa-eye', 'fa-eye', '2022-07-20 15:51:54'),
(101, 'fa-eye-slash', 'fa-eye-slash', '2022-07-20 15:51:54'),
(102, 'fa-eyedropper', 'fa-eyedropper', '2022-07-20 15:51:54'),
(103, 'fa-fax', 'fa-fax', '2022-07-20 15:51:54'),
(104, 'fa-female', 'fa-female', '2022-07-20 15:51:54'),
(105, 'fa-fighter-jet', 'fa-fighter-jet', '2022-07-20 15:51:54'),
(106, 'fa-file-archive-o', 'fa-file-archive-o', '2022-07-20 15:51:54'),
(107, 'fa-file-audio-o', 'fa-file-audio-o', '2022-07-20 15:51:54'),
(108, 'fa-file-code-o', 'fa-file-code-o', '2022-07-20 15:51:54'),
(109, 'fa-file-excel-o', 'fa-file-excel-o', '2022-07-20 15:51:54'),
(110, 'fa-file-image-o', 'fa-file-image-o', '2022-07-20 15:51:54'),
(111, 'fa-file-movie-o ', 'fa-file-movie-o ', '2022-07-20 15:51:54'),
(112, 'fa-file-pdf-o', 'fa-file-pdf-o', '2022-07-20 15:51:54'),
(113, 'fa-file-photo-o ', 'fa-file-photo-o ', '2022-07-20 15:51:54'),
(114, 'fa-file-picture-o ', 'fa-file-picture-o ', '2022-07-20 15:51:54'),
(115, 'fa-file-powerpoint-o', 'fa-file-powerpoint-o', '2022-07-20 15:51:54'),
(116, 'fa-file-sound-o ', 'fa-file-sound-o ', '2022-07-20 15:51:54'),
(117, 'fa-file-video-o', 'fa-file-video-o', '2022-07-20 15:51:54'),
(118, 'fa-file-word-o', 'fa-file-word-o', '2022-07-20 15:51:54'),
(119, 'fa-file-zip-o ', 'fa-file-zip-o ', '2022-07-20 15:51:54'),
(120, 'fa-film', 'fa-film', '2022-07-20 15:51:54'),
(121, 'fa-filter', 'fa-filter', '2022-07-20 15:51:54'),
(122, 'fa-fire', 'fa-fire', '2022-07-20 15:51:54'),
(123, 'fa-fire-extinguisher', 'fa-fire-extinguisher', '2022-07-20 15:51:54'),
(124, 'fa-flag', 'fa-flag', '2022-07-20 15:51:54'),
(125, 'fa-flag-checkered', 'fa-flag-checkered', '2022-07-20 15:51:54'),
(126, 'fa-flag-o', 'fa-flag-o', '2022-07-20 15:51:54'),
(127, 'fa-flash ', 'fa-flash ', '2022-07-20 15:51:54'),
(128, 'fa-flask', 'fa-flask', '2022-07-20 15:51:54'),
(129, 'fa-folder', 'fa-folder', '2022-07-20 15:51:54'),
(130, 'fa-folder-o', 'fa-folder-o', '2022-07-20 15:51:54'),
(131, 'fa-folder-open', 'fa-folder-open', '2022-07-20 15:51:54'),
(132, 'fa-folder-open-o', 'fa-folder-open-o', '2022-07-20 15:51:54'),
(133, 'fa-frown-o', 'fa-frown-o', '2022-07-20 15:51:54'),
(134, 'fa-futbol-o', 'fa-futbol-o', '2022-07-20 15:51:54'),
(135, 'fa-gamepad', 'fa-gamepad', '2022-07-20 15:51:54'),
(136, 'fa-gavel', 'fa-gavel', '2022-07-20 15:51:54'),
(137, 'fa-gear ', 'fa-gear ', '2022-07-20 15:51:54'),
(138, 'fa-gears ', 'fa-gears ', '2022-07-20 15:51:54'),
(139, 'fa-gift', 'fa-gift', '2022-07-20 15:51:54'),
(140, 'fa-glass', 'fa-glass', '2022-07-20 15:51:54'),
(141, 'fa-globe', 'fa-globe', '2022-07-20 15:51:54'),
(142, 'fa-graduation-cap', 'fa-graduation-cap', '2022-07-20 15:51:54'),
(143, 'fa-group ', 'fa-group ', '2022-07-20 15:51:54'),
(144, 'fa-hdd-o', 'fa-hdd-o', '2022-07-20 15:51:54'),
(145, 'fa-headphones', 'fa-headphones', '2022-07-20 15:51:54'),
(146, 'fa-heart', 'fa-heart', '2022-07-20 15:51:54'),
(147, 'fa-heart-o', 'fa-heart-o', '2022-07-20 15:51:54'),
(148, 'fa-history', 'fa-history', '2022-07-20 15:51:54'),
(149, 'fa-home', 'fa-home', '2022-07-20 15:51:54'),
(150, 'fa-image ', 'fa-image ', '2022-07-20 15:51:54'),
(151, 'fa-inbox', 'fa-inbox', '2022-07-20 15:51:54'),
(152, 'fa-info', 'fa-info', '2022-07-20 15:51:54'),
(153, 'fa-info-circle', 'fa-info-circle', '2022-07-20 15:51:54'),
(154, 'fa-institution ', 'fa-institution ', '2022-07-20 15:51:54'),
(155, 'fa-key', 'fa-key', '2022-07-20 15:51:54'),
(156, 'fa-keyboard-o', 'fa-keyboard-o', '2022-07-20 15:51:54'),
(157, 'fa-language', 'fa-language', '2022-07-20 15:51:54'),
(158, 'fa-laptop', 'fa-laptop', '2022-07-20 15:51:54'),
(159, 'fa-leaf', 'fa-leaf', '2022-07-20 15:51:54'),
(160, 'fa-legal ', 'fa-legal ', '2022-07-20 15:51:54'),
(161, 'fa-lemon-o', 'fa-lemon-o', '2022-07-20 15:51:54'),
(162, 'fa-level-down', 'fa-level-down', '2022-07-20 15:51:54'),
(163, 'fa-level-up', 'fa-level-up', '2022-07-20 15:51:54'),
(164, 'fa-life-bouy ', 'fa-life-bouy ', '2022-07-20 15:51:54'),
(165, 'fa-life-buoy ', 'fa-life-buoy ', '2022-07-20 15:51:54'),
(166, 'fa-life-ring', 'fa-life-ring', '2022-07-20 15:51:54'),
(167, 'fa-life-saver ', 'fa-life-saver ', '2022-07-20 15:51:54'),
(168, 'fa-lightbulb-o', 'fa-lightbulb-o', '2022-07-20 15:51:54'),
(169, 'fa-line-chart', 'fa-line-chart', '2022-07-20 15:51:54'),
(170, 'fa-location-arrow', 'fa-location-arrow', '2022-07-20 15:51:54'),
(171, 'fa-lock', 'fa-lock', '2022-07-20 15:51:54'),
(172, 'fa-magic', 'fa-magic', '2022-07-20 15:51:54'),
(173, 'fa-magnet', 'fa-magnet', '2022-07-20 15:51:54'),
(174, 'fa-mail-forward ', 'fa-mail-forward ', '2022-07-20 15:51:54'),
(175, 'fa-mail-reply ', 'fa-mail-reply ', '2022-07-20 15:51:54'),
(176, 'fa-mail-reply-all ', 'fa-mail-reply-all ', '2022-07-20 15:51:54'),
(177, 'fa-male', 'fa-male', '2022-07-20 15:51:54'),
(178, 'fa-map-marker', 'fa-map-marker', '2022-07-20 15:51:54'),
(179, 'fa-meh-o', 'fa-meh-o', '2022-07-20 15:51:54'),
(180, 'fa-microphone', 'fa-microphone', '2022-07-20 15:51:54'),
(181, 'fa-microphone-slash', 'fa-microphone-slash', '2022-07-20 15:51:54'),
(182, 'fa-minus', 'fa-minus', '2022-07-20 15:51:54'),
(183, 'fa-minus-circle', 'fa-minus-circle', '2022-07-20 15:51:54'),
(184, 'fa-minus-square', 'fa-minus-square', '2022-07-20 15:51:54'),
(185, 'fa-minus-square-o', 'fa-minus-square-o', '2022-07-20 15:51:54'),
(186, 'fa-mobile', 'fa-mobile', '2022-07-20 15:51:54'),
(187, 'fa-mobile-phone ', 'fa-mobile-phone ', '2022-07-20 15:51:54'),
(188, 'fa-money', 'fa-money', '2022-07-20 15:51:54'),
(189, 'fa-moon-o', 'fa-moon-o', '2022-07-20 15:51:54'),
(190, 'fa-mortar-board ', 'fa-mortar-board ', '2022-07-20 15:51:54'),
(191, 'fa-music', 'fa-music', '2022-07-20 15:51:54'),
(192, 'fa-navicon ', 'fa-navicon ', '2022-07-20 15:51:54'),
(193, 'fa-newspaper-o', 'fa-newspaper-o', '2022-07-20 15:51:54'),
(194, 'fa-paint-brush', 'fa-paint-brush', '2022-07-20 15:51:54'),
(195, 'fa-paper-plane', 'fa-paper-plane', '2022-07-20 15:51:54'),
(196, 'fa-paper-plane-o', 'fa-paper-plane-o', '2022-07-20 15:51:54'),
(197, 'fa-paw', 'fa-paw', '2022-07-20 15:51:54'),
(198, 'fa-pencil', 'fa-pencil', '2022-07-20 15:51:54'),
(199, 'fa-pencil-square', 'fa-pencil-square', '2022-07-20 15:51:54'),
(200, 'fa-pencil-square-o', 'fa-pencil-square-o', '2022-07-20 15:51:54'),
(201, 'fa-phone', 'fa-phone', '2022-07-20 15:51:54'),
(202, 'fa-phone-square', 'fa-phone-square', '2022-07-20 15:51:54'),
(203, 'fa-photo ', 'fa-photo ', '2022-07-20 15:51:54'),
(204, 'fa-picture-o', 'fa-picture-o', '2022-07-20 15:51:54'),
(205, 'fa-pie-chart', 'fa-pie-chart', '2022-07-20 15:51:54'),
(206, 'fa-plane', 'fa-plane', '2022-07-20 15:51:54'),
(207, 'fa-plug', 'fa-plug', '2022-07-20 15:51:54'),
(208, 'fa-plus', 'fa-plus', '2022-07-20 15:51:54'),
(209, 'fa-plus-circle', 'fa-plus-circle', '2022-07-20 15:51:54'),
(210, 'fa-plus-square', 'fa-plus-square', '2022-07-20 15:51:54'),
(211, 'fa-plus-square-o', 'fa-plus-square-o', '2022-07-20 15:51:54'),
(212, 'fa-power-off', 'fa-power-off', '2022-07-20 15:51:54'),
(213, 'fa-print', 'fa-print', '2022-07-20 15:51:54'),
(214, 'fa-puzzle-piece', 'fa-puzzle-piece', '2022-07-20 15:51:54'),
(215, 'fa-qrcode', 'fa-qrcode', '2022-07-20 15:51:54'),
(216, 'fa-question', 'fa-question', '2022-07-20 15:51:54'),
(217, 'fa-question-circle', 'fa-question-circle', '2022-07-20 15:51:54'),
(218, 'fa-quote-left', 'fa-quote-left', '2022-07-20 15:51:54'),
(219, 'fa-quote-right', 'fa-quote-right', '2022-07-20 15:51:54'),
(220, 'fa-random', 'fa-random', '2022-07-20 15:51:54'),
(221, 'fa-recycle', 'fa-recycle', '2022-07-20 15:51:54'),
(222, 'fa-refresh', 'fa-refresh', '2022-07-20 15:51:54'),
(223, 'fa-remove ', 'fa-remove ', '2022-07-20 15:51:54'),
(224, 'fa-reorder ', 'fa-reorder ', '2022-07-20 15:51:54'),
(225, 'fa-reply', 'fa-reply', '2022-07-20 15:51:54'),
(226, 'fa-reply-all', 'fa-reply-all', '2022-07-20 15:51:54'),
(227, 'fa-retweet', 'fa-retweet', '2022-07-20 15:51:54'),
(228, 'fa-road', 'fa-road', '2022-07-20 15:51:54'),
(229, 'fa-rocket', 'fa-rocket', '2022-07-20 15:51:54'),
(230, 'fa-rss', 'fa-rss', '2022-07-20 15:51:54'),
(231, 'fa-rss-square', 'fa-rss-square', '2022-07-20 15:51:54'),
(232, 'fa-search', 'fa-search', '2022-07-20 15:51:54'),
(233, 'fa-search-minus', 'fa-search-minus', '2022-07-20 15:51:54'),
(234, 'fa-search-plus', 'fa-search-plus', '2022-07-20 15:51:54'),
(235, 'fa-send ', 'fa-send ', '2022-07-20 15:51:54'),
(236, 'fa-send-o ', 'fa-send-o ', '2022-07-20 15:51:54'),
(237, 'fa-share', 'fa-share', '2022-07-20 15:51:54'),
(238, 'fa-share-alt', 'fa-share-alt', '2022-07-20 15:51:54'),
(239, 'fa-share-alt-square', 'fa-share-alt-square', '2022-07-20 15:51:54'),
(240, 'fa-share-square', 'fa-share-square', '2022-07-20 15:51:54'),
(241, 'fa-share-square-o', 'fa-share-square-o', '2022-07-20 15:51:54'),
(242, 'fa-shield', 'fa-shield', '2022-07-20 15:51:54'),
(243, 'fa-shopping-cart', 'fa-shopping-cart', '2022-07-20 15:51:54'),
(244, 'fa-sign-in', 'fa-sign-in', '2022-07-20 15:51:54'),
(245, 'fa-sign-out', 'fa-sign-out', '2022-07-20 15:51:54'),
(246, 'fa-signal', 'fa-signal', '2022-07-20 15:51:54'),
(247, 'fa-sitemap', 'fa-sitemap', '2022-07-20 15:51:54'),
(248, 'fa-sliders', 'fa-sliders', '2022-07-20 15:51:54'),
(249, 'fa-smile-o', 'fa-smile-o', '2022-07-20 15:51:54'),
(250, 'fa-soccer-ball-o ', 'fa-soccer-ball-o ', '2022-07-20 15:51:54'),
(251, 'fa-sort', 'fa-sort', '2022-07-20 15:51:54'),
(252, 'fa-sort-alpha-asc', 'fa-sort-alpha-asc', '2022-07-20 15:51:54'),
(253, 'fa-sort-alpha-desc', 'fa-sort-alpha-desc', '2022-07-20 15:51:54'),
(254, 'fa-sort-amount-asc', 'fa-sort-amount-asc', '2022-07-20 15:51:54'),
(255, 'fa-sort-amount-desc', 'fa-sort-amount-desc', '2022-07-20 15:51:54'),
(256, 'fa-sort-asc', 'fa-sort-asc', '2022-07-20 15:51:54'),
(257, 'fa-sort-desc', 'fa-sort-desc', '2022-07-20 15:51:54'),
(258, 'fa-sort-down ', 'fa-sort-down ', '2022-07-20 15:51:54'),
(259, 'fa-sort-numeric-asc', 'fa-sort-numeric-asc', '2022-07-20 15:51:54'),
(260, 'fa-sort-numeric-desc', 'fa-sort-numeric-desc', '2022-07-20 15:51:54'),
(261, 'fa-sort-up ', 'fa-sort-up ', '2022-07-20 15:51:54'),
(262, 'fa-space-shuttle', 'fa-space-shuttle', '2022-07-20 15:51:54'),
(263, 'fa-spinner', 'fa-spinner', '2022-07-20 15:51:54'),
(264, 'fa-spoon', 'fa-spoon', '2022-07-20 15:51:54'),
(265, 'fa-square', 'fa-square', '2022-07-20 15:51:54'),
(266, 'fa-square-o', 'fa-square-o', '2022-07-20 15:51:54'),
(267, 'fa-star', 'fa-star', '2022-07-20 15:51:54'),
(268, 'fa-star-half', 'fa-star-half', '2022-07-20 15:51:54'),
(269, 'fa-star-half-empty ', 'fa-star-half-empty ', '2022-07-20 15:51:54'),
(270, 'fa-star-half-full ', 'fa-star-half-full ', '2022-07-20 15:51:54'),
(271, 'fa-star-half-o', 'fa-star-half-o', '2022-07-20 15:51:54'),
(272, 'fa-star-o', 'fa-star-o', '2022-07-20 15:51:54'),
(273, 'fa-suitcase', 'fa-suitcase', '2022-07-20 15:51:54'),
(274, 'fa-sun-o', 'fa-sun-o', '2022-07-20 15:51:54'),
(275, 'fa-support ', 'fa-support ', '2022-07-20 15:51:54'),
(276, 'fa-tablet', 'fa-tablet', '2022-07-20 15:51:54'),
(277, 'fa-tachometer', 'fa-tachometer', '2022-07-20 15:51:54'),
(278, 'fa-tag', 'fa-tag', '2022-07-20 15:51:54'),
(279, 'fa-tags', 'fa-tags', '2022-07-20 15:51:54'),
(280, 'fa-tasks', 'fa-tasks', '2022-07-20 15:51:54'),
(281, 'fa-taxi', 'fa-taxi', '2022-07-20 15:51:54'),
(282, 'fa-terminal', 'fa-terminal', '2022-07-20 15:51:54'),
(283, 'fa-thumb-tack', 'fa-thumb-tack', '2022-07-20 15:51:54'),
(284, 'fa-thumbs-down', 'fa-thumbs-down', '2022-07-20 15:51:54'),
(285, 'fa-thumbs-o-down', 'fa-thumbs-o-down', '2022-07-20 15:51:54'),
(286, 'fa-thumbs-o-up', 'fa-thumbs-o-up', '2022-07-20 15:51:54'),
(287, 'fa-thumbs-up', 'fa-thumbs-up', '2022-07-20 15:51:54'),
(288, 'fa-ticket', 'fa-ticket', '2022-07-20 15:51:54'),
(289, 'fa-times', 'fa-times', '2022-07-20 15:51:54'),
(290, 'fa-times-circle', 'fa-times-circle', '2022-07-20 15:51:54'),
(291, 'fa-times-circle-o', 'fa-times-circle-o', '2022-07-20 15:51:54'),
(292, 'fa-tint', 'fa-tint', '2022-07-20 15:51:54'),
(293, 'fa-toggle-down ', 'fa-toggle-down ', '2022-07-20 15:51:54'),
(294, 'fa-toggle-left ', 'fa-toggle-left ', '2022-07-20 15:51:54'),
(295, 'fa-toggle-off', 'fa-toggle-off', '2022-07-20 15:51:54'),
(296, 'fa-toggle-on', 'fa-toggle-on', '2022-07-20 15:51:54'),
(297, 'fa-toggle-right ', 'fa-toggle-right ', '2022-07-20 15:51:54'),
(298, 'fa-toggle-up ', 'fa-toggle-up ', '2022-07-20 15:51:54'),
(299, 'fa-trash', 'fa-trash', '2022-07-20 15:51:54'),
(300, 'fa-trash-o', 'fa-trash-o', '2022-07-20 15:51:54'),
(301, 'fa-tree', 'fa-tree', '2022-07-20 15:51:54'),
(302, 'fa-trophy', 'fa-trophy', '2022-07-20 15:51:54'),
(303, 'fa-truck', 'fa-truck', '2022-07-20 15:51:54'),
(304, 'fa-tty', 'fa-tty', '2022-07-20 15:51:54'),
(305, 'fa-umbrella', 'fa-umbrella', '2022-07-20 15:51:54'),
(306, 'fa-university', 'fa-university', '2022-07-20 15:51:54'),
(307, 'fa-unlock', 'fa-unlock', '2022-07-20 15:51:54'),
(308, 'fa-unlock-alt', 'fa-unlock-alt', '2022-07-20 15:51:54'),
(309, 'fa-unsorted ', 'fa-unsorted ', '2022-07-20 15:51:54'),
(310, 'fa-upload', 'fa-upload', '2022-07-20 15:51:54'),
(311, 'fa-user', 'fa-user', '2022-07-20 15:51:54'),
(312, 'fa-users', 'fa-users', '2022-07-20 15:51:54'),
(313, 'fa-video-camera', 'fa-video-camera', '2022-07-20 15:51:54'),
(314, 'fa-volume-down', 'fa-volume-down', '2022-07-20 15:51:54'),
(315, 'fa-volume-off', 'fa-volume-off', '2022-07-20 15:51:54'),
(316, 'fa-volume-up', 'fa-volume-up', '2022-07-20 15:51:54'),
(317, 'fa-warning ', 'fa-warning ', '2022-07-20 15:51:54'),
(318, 'fa-wheelchair', 'fa-wheelchair', '2022-07-20 15:51:54'),
(319, 'fa-wifi', 'fa-wifi', '2022-07-20 15:51:54'),
(320, 'fa-wrench', 'fa-wrench', '2022-07-20 15:51:54');

-- --------------------------------------------------------

--
-- Table structure for table `program_study`
--

CREATE TABLE `program_study` (
  `program_study_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `abbreviation` text NOT NULL,
  `accreditation` text NOT NULL,
  `year` int(11) NOT NULL,
  `user_id_for_kaprodi` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_study`
--

INSERT INTO `program_study` (`program_study_id`, `title`, `abbreviation`, `accreditation`, `year`, `user_id_for_kaprodi`, `create_date`) VALUES
(1, 'Sistem Informasi', 'SI', 'B', 2022, 5, '2022-08-01 12:31:12');

-- --------------------------------------------------------

--
-- Table structure for table `program_study_lecturer`
--

CREATE TABLE `program_study_lecturer` (
  `program_study_lecturer_id` int(11) NOT NULL,
  `userid` int(11) NOT NULL,
  `program_study_id` int(11) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program_study_lecturer`
--

INSERT INTO `program_study_lecturer` (`program_study_lecturer_id`, `userid`, `program_study_id`, `create_date`) VALUES
(10, 5, 1, '2022-08-01 15:27:57');

-- --------------------------------------------------------

--
-- Table structure for table `support_criteria`
--

CREATE TABLE `support_criteria` (
  `support_criteria_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `support_criteria`
--

INSERT INTO `support_criteria` (`support_criteria_id`, `title`, `description`, `create_date`) VALUES
(1, 'CRITERIA 1', '-', '2022-07-20 00:54:30'),
(2, 'CRITERIA 2', '-', '2022-07-20 00:54:30');

-- --------------------------------------------------------

--
-- Table structure for table `support_documents`
--

CREATE TABLE `support_documents` (
  `support_documents_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `remarks` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `support_documents`
--

INSERT INTO `support_documents` (`support_documents_id`, `title`, `remarks`, `create_date`) VALUES
(1, 'LKPS Documents', 'Document for adding the LKPS docs', '2022-07-20 00:42:49'),
(2, 'LED Documents', 'LED Documents to add the LED Docs', '2022-07-20 00:43:15');

-- --------------------------------------------------------

--
-- Table structure for table `support_master`
--

CREATE TABLE `support_master` (
  `support_master_id` int(11) NOT NULL,
  `support_criteria_id` int(11) NOT NULL,
  `support_standard_id` int(11) NOT NULL,
  `support_documents_id` int(11) NOT NULL,
  `number` int(11) NOT NULL,
  `title` text NOT NULL,
  `link` text NOT NULL,
  `remarks` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `support_standard`
--

CREATE TABLE `support_standard` (
  `support_standard_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `remarks` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `support_standard`
--

INSERT INTO `support_standard` (`support_standard_id`, `title`, `remarks`, `create_date`) VALUES
(1, '1. Standard I', 'Kemahasiswaan dan Lulusan', '2022-07-20 00:52:30'),
(2, '2. Standar II', 'Kemahasiswaan dan Lulusan', '2022-07-20 00:53:17'),
(3, '3. Standar III', 'Kemahasiswaan dan Lulusan', '2022-07-20 00:53:17');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `userid` int(11) NOT NULL,
  `full_name` varchar(115) NOT NULL,
  `nick_name` varchar(115) NOT NULL,
  `initial` text NOT NULL,
  `NIP` text NOT NULL,
  `email` varchar(115) NOT NULL,
  `address` text NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `picture` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`userid`, `full_name`, `nick_name`, `initial`, `NIP`, `email`, `address`, `phone_number`, `picture`, `create_date`) VALUES
(4, 'Fitra Arrafiq', 'Fitra', 'FAR', '20017861', 'fitraarrafiq@gmail.com', 'medan pekanbaru', '082233445566', '', '2022-07-26 22:18:55'),
(5, 'Benget Manahan Siregar', 'Benget', 'BMS', '20088334', 'benget@globalnet.lcl', 'Serapung', '09334455666', '', '2022-07-30 04:45:48'),
(6, 'Samsul Rizal', 'Sam', 'SRZ', '23344551', 'samsul@kerinci.lcl', 'medan', '08233445566', '', '2022-07-30 04:46:02');

-- --------------------------------------------------------

--
-- Table structure for table `user_log`
--

CREATE TABLE `user_log` (
  `user_log_id` int(11) NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `jenis_aksi` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL,
  `tanggal` date NOT NULL,
  `userid` int(11) NOT NULL,
  `keterangan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user_login`
--

CREATE TABLE `user_login` (
  `user_login_id` int(11) NOT NULL,
  `oauth_provider` varchar(15) NOT NULL,
  `oauth_uid` varchar(50) NOT NULL,
  `userid` int(11) NOT NULL,
  `username` varchar(115) NOT NULL,
  `password` varchar(115) NOT NULL,
  `link` varchar(255) NOT NULL,
  `user_role_id` int(11) NOT NULL,
  `block_status` varchar(15) NOT NULL,
  `access_status` varchar(15) NOT NULL,
  `online_status` varchar(12) DEFAULT NULL,
  `time_online` timestamp NULL DEFAULT NULL,
  `time_offline` timestamp NULL DEFAULT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_login`
--

INSERT INTO `user_login` (`user_login_id`, `oauth_provider`, `oauth_uid`, `userid`, `username`, `password`, `link`, `user_role_id`, `block_status`, `access_status`, `online_status`, `time_online`, `time_offline`, `create_date`) VALUES
(4, '', '', 4, 'administrator', 'ad248d72422d9efc5bde0620401bd1d9', '', 7, '0', '', 'online', '2022-08-01 12:16:35', NULL, '2022-08-01 12:16:35'),
(5, '', '', 5, 'user1', 'secret', '', 8, '0', '', NULL, NULL, NULL, '2022-07-30 04:40:24');

-- --------------------------------------------------------

--
-- Table structure for table `user_role`
--

CREATE TABLE `user_role` (
  `user_role_id` int(11) NOT NULL,
  `role` text NOT NULL,
  `description` text NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_role`
--

INSERT INTO `user_role` (`user_role_id`, `role`, `description`, `create_date`) VALUES
(7, 'sys_manager', 'System Manager', '2022-07-24 11:26:40'),
(8, 'Kaprodi', 'Kaprodi bertugas memimpin program study', '2022-07-26 22:15:32'),
(9, 'Dosen', 'Dosen Bertugas sebagai tenaga pengajar', '2022-07-30 04:35:05');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accreditation_document`
--
ALTER TABLE `accreditation_document`
  ADD PRIMARY KEY (`accreditation_document_id`);

--
-- Indexes for table `accreditation_members`
--
ALTER TABLE `accreditation_members`
  ADD PRIMARY KEY (`accreditation_members_id`);

--
-- Indexes for table `assessment_schedule`
--
ALTER TABLE `assessment_schedule`
  ADD PRIMARY KEY (`assessment_schedule_id`);

--
-- Indexes for table `configuration_banner`
--
ALTER TABLE `configuration_banner`
  ADD PRIMARY KEY (`configuration_banner_id`);

--
-- Indexes for table `configuration_banner_picture`
--
ALTER TABLE `configuration_banner_picture`
  ADD PRIMARY KEY (`configuration_banner_picture_id`);

--
-- Indexes for table `configuration_video`
--
ALTER TABLE `configuration_video`
  ADD PRIMARY KEY (`configuration_video_id`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- Indexes for table `menu_logo`
--
ALTER TABLE `menu_logo`
  ADD PRIMARY KEY (`menu_logo_id`);

--
-- Indexes for table `program_study`
--
ALTER TABLE `program_study`
  ADD PRIMARY KEY (`program_study_id`);

--
-- Indexes for table `program_study_lecturer`
--
ALTER TABLE `program_study_lecturer`
  ADD PRIMARY KEY (`program_study_lecturer_id`);

--
-- Indexes for table `support_criteria`
--
ALTER TABLE `support_criteria`
  ADD PRIMARY KEY (`support_criteria_id`);

--
-- Indexes for table `support_documents`
--
ALTER TABLE `support_documents`
  ADD PRIMARY KEY (`support_documents_id`);

--
-- Indexes for table `support_master`
--
ALTER TABLE `support_master`
  ADD PRIMARY KEY (`support_master_id`);

--
-- Indexes for table `support_standard`
--
ALTER TABLE `support_standard`
  ADD PRIMARY KEY (`support_standard_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`userid`);

--
-- Indexes for table `user_log`
--
ALTER TABLE `user_log`
  ADD PRIMARY KEY (`user_log_id`);

--
-- Indexes for table `user_login`
--
ALTER TABLE `user_login`
  ADD PRIMARY KEY (`user_login_id`);

--
-- Indexes for table `user_role`
--
ALTER TABLE `user_role`
  ADD PRIMARY KEY (`user_role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accreditation_document`
--
ALTER TABLE `accreditation_document`
  MODIFY `accreditation_document_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `accreditation_members`
--
ALTER TABLE `accreditation_members`
  MODIFY `accreditation_members_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `assessment_schedule`
--
ALTER TABLE `assessment_schedule`
  MODIFY `assessment_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `configuration_banner`
--
ALTER TABLE `configuration_banner`
  MODIFY `configuration_banner_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `configuration_banner_picture`
--
ALTER TABLE `configuration_banner_picture`
  MODIFY `configuration_banner_picture_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `configuration_video`
--
ALTER TABLE `configuration_video`
  MODIFY `configuration_video_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `menu_logo`
--
ALTER TABLE `menu_logo`
  MODIFY `menu_logo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=321;

--
-- AUTO_INCREMENT for table `program_study`
--
ALTER TABLE `program_study`
  MODIFY `program_study_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `program_study_lecturer`
--
ALTER TABLE `program_study_lecturer`
  MODIFY `program_study_lecturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `support_criteria`
--
ALTER TABLE `support_criteria`
  MODIFY `support_criteria_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `support_documents`
--
ALTER TABLE `support_documents`
  MODIFY `support_documents_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `support_master`
--
ALTER TABLE `support_master`
  MODIFY `support_master_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `support_standard`
--
ALTER TABLE `support_standard`
  MODIFY `support_standard_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_log`
--
ALTER TABLE `user_log`
  MODIFY `user_log_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_login`
--
ALTER TABLE `user_login`
  MODIFY `user_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_role`
--
ALTER TABLE `user_role`
  MODIFY `user_role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
