-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 23, 2023 at 07:26 AM
-- Server version: 5.7.31-log
-- PHP Version: 8.2.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test101`
--

-- --------------------------------------------------------

--
-- Table structure for table `wp_crud`
--

DROP TABLE IF EXISTS `wp_crud`;
CREATE TABLE IF NOT EXISTS `wp_crud` (
  `id` bigint(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_520_ci,
  `namex` varchar(250) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `chkx` tinyint(4) NOT NULL,
  `sts` tinyint(4) NOT NULL,
  `created_at` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `wp_crud`
--

INSERT INTO `wp_crud` (`id`, `title`, `description`, `namex`, `chkx`, `sts`, `created_at`, `updated_at`) VALUES
(1, 'title_01', 'desc_101', 'asd', 0, 0, NULL, NULL),
(2, 'title_02', 'desc_102', 'fgh', 0, 0, '1684586245', '1684586245'),
(3, 'title_03', 'desc_103', 'jkl', 1, 0, '1684586253', '1684586253'),
(4, 'title_04', 'desc_104', 'zxc', 0, 1, '1684586255', '1684586255'),
(5, 'title_05', 'desc_105', 'vbn', 1, 1, '1684586257', '1684586257'),
(6, 'title_06', 'desc_106', 'qwe', 0, 0, '1684586259', '1684586259'),
(7, 'title_07', 'desc_107', 'rty', 1, 0, '1684586262', '1684586262'),
(8, 'title_08', 'desc_108', 'uio', 1, 0, '1684754140', '1684754140'),
(9, 'title_09', 'desc_109', 'qaz', 0, 1, '1684586267', '1684586267'),
(10, 'title_10', 'desc_1010', 'wsx', 0, 1, '1684586271', '1684586271'),
(11, 'title_11', 'desc_1011', 'edc', 0, 0, '1684758652', '1684817843'),
(12, 'title_12', 'desc_1012', 'rfv', 0, 1, '1684759567 ', '1684759567 '),
(13, 'title_13', 'desc_1013', 'tgb', 0, 0, '1684813675', '1684813675'),
(14, 'title_14', 'desc_1014', 'yhn', 0, 1, '1684813742', '1684817351'),
(15, 'title_15', 'desc_1015', 'yhn15', 0, 0, '1684813742', '1684817351');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
