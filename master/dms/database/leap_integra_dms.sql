-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2023 at 06:11 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `leap_integra_dms`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_folder`
--

CREATE TABLE `tbl_folder` (
  `folder_id` int(11) NOT NULL,
  `folder_parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `is_revision` int(1) DEFAULT 0,
  `no_revision` int(11) DEFAULT 0,
  `original_id` int(1) DEFAULT 0,
  `new_file_id` int(11) DEFAULT 0,
  `nomor` varchar(255) DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `unit_kerja` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `related_document` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'folder',
  `format` varchar(255) DEFAULT NULL,
  `size` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `user_access` varchar(255) DEFAULT NULL,
  `last_viewed` datetime DEFAULT NULL,
  `last_downloaded` datetime DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '0=No; 1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_folder`
--

INSERT INTO `tbl_folder` (`folder_id`, `folder_parent_id`, `name`, `is_revision`, `no_revision`, `original_id`, `new_file_id`, `nomor`, `perihal`, `unit_kerja`, `keyword`, `related_document`, `type`, `format`, `size`, `description`, `user_access`, `last_viewed`, `last_downloaded`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_deleted`) VALUES
(1, 0, 'SMA N 1 Tuban', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Data kuliah', NULL, NULL, NULL, '2023-01-25 12:41:09', 3, '2023-01-25 12:41:09', 3, 0),
(2, 0, 'Pelindo', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-01-25 12:57:53', 1, '2023-01-26 16:26:40', 1, 1),
(3, 0, 'Project POS', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-01-25 12:58:52', 3, '2023-01-25 12:58:52', 3, 0),
(4, 0, 'Project Android - POS', 0, 0, 0, 0, '32145', NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', '[{\"user\":\"1\",\"role\":[\"view\"]}]', NULL, NULL, '2023-01-25 12:59:15', 3, '2023-02-08 11:25:07', 3, 0),
(5, 0, 'Project Android - DMS', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Project android untuk Leap', NULL, NULL, NULL, '2023-01-26 10:08:23', 3, '2023-01-26 10:08:23', 3, 0),
(6, 0, 'SMK N 1 Tuban', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Data sekolah', NULL, NULL, NULL, '2023-01-26 16:15:23', 1, '2023-01-26 16:25:11', 1, 1),
(7, 2, 'Pertemuan 1', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Diskusi fitur app', NULL, NULL, NULL, '2023-01-26 16:26:09', 1, '2023-01-26 16:26:31', 1, 1),
(8, 4, 'Minggu 1', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '01 Jan - 8 Jan 2023', NULL, NULL, NULL, '2023-01-27 17:05:38', 1, '2023-01-31 11:59:33', 1, 0),
(10, 4, 'Document 1.pdf', 0, 0, 0, 0, '310120231121', 'readme project minggu 1', '1121', '#project,#readme', NULL, 'file', 'pdf', '118.92 KB', 'penjelasan project minggu 1', NULL, NULL, NULL, '2023-01-31 11:22:11', 1, '2023-01-31 11:22:11', 1, 0),
(11, 4, 'DesignPriceLabel - Toko.docx', 0, 0, 0, 0, '31012023143', 'Design untuk label', '1143', '#label,#design', NULL, 'file', 'docx', '435.03 KB', 'prototype design', NULL, NULL, NULL, '2023-01-31 11:44:06', 1, '2023-02-02 08:48:38', 1, 1),
(12, 4, 'Minggu 2 v2', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Pertemuan 9 - 16 Jan 2023', NULL, NULL, NULL, '2023-01-31 12:01:29', 1, '2023-02-02 10:46:37', 1, 0),
(13, 4, 'FileDoc.docx', 0, 0, 0, 0, '31012023143', 'lorem ipsum', '1146', '#lorem,#free,#test', NULL, 'file', 'docx', '13.34 KB', '', NULL, NULL, NULL, '2023-02-01 11:47:04', 1, '2023-02-01 11:47:04', 1, 0),
(14, 4, 'FilePDF.pdf', 0, 0, 0, 0, '32312', 'pdf file', '1655', '', '', 'file', 'pdf', '84.9 KB', '', NULL, NULL, NULL, '2023-02-01 16:55:44', 1, '2023-02-01 16:55:44', 1, 0),
(15, 4, 'Document 2.pdf', 0, 0, 0, 0, '02022023', 'document 2', '905', '#two', '', 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-02 09:05:38', 1, '2023-02-02 09:05:38', 1, 0),
(16, 4, 'Document 3.pdf', 0, 0, 0, 0, '02022023925', 'document 3', '925', '#tiga', '[\"10\",\"15\"]', 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-02 09:26:10', 1, '2023-02-02 09:26:10', 1, 0),
(17, 8, 'Document 4.pdf', 0, 0, 0, 0, '020220231041', 'doc4', '1041', '#document', '[\"13\"]', 'file', 'pdf', '118.92 KB', 'test document', NULL, NULL, NULL, '2023-02-02 10:42:13', 1, '2023-02-02 10:42:13', 1, 0),
(18, 0, 'B. Indonesia', 0, 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Semester 1', '[{\"user\":\"2\",\"role\":[\"view\"]},{\"user\":\"3\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-02 10:47:27', 1, '2023-02-09 12:25:26', 1, 0),
(19, 18, 'FileDoc.docx', 0, 0, 0, 0, '125704022023', 'test', '1257', '#tes', '[\"15\"]', 'file', 'docx', '13.34 KB', '', '[{\"user\":\"2\",\"role\":[\"view\"]},{\"user\":\"3\",\"role\":[\"view\",\"edit\"]}]', NULL, NULL, '2023-02-04 12:59:21', 1, '2023-02-04 12:59:21', 1, 0),
(20, 18, 'Document 4.pdf', 0, 0, 0, 0, '32434', 'asd', '12', 'asd', NULL, 'file', 'pdf', '118.92 KB', '', '[{\"user\":\"3\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-04 13:15:19', 1, '2023-02-04 13:15:19', 1, 0),
(21, 18, 'Document 1.pdf', 0, 0, 0, 0, '454', 'wer', '2112', 'wew', '[\"14\"]', 'file', 'pdf', '118.92 KB', 'test', '[{\"user\":\"2\",\"role\":[\"view\",\"edit\"]},{\"user\":\"3\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-04 13:52:18', 1, '2023-02-04 13:52:18', 1, 0),
(22, 18, 'FilePDF.pdf', 0, 0, 0, 0, '34', 'fddf', '45435435', 'dss', '[\"15\"]', 'file', 'pdf', '84.9 KB', 'asdsadsa', '[{\"user\":\"3\",\"role\":[\"view\"]},{\"user\":\"2\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-04 13:53:19', 1, '2023-02-04 13:53:19', 1, 0),
(23, 18, '', NULL, NULL, NULL, 0, '', '', '', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-04 15:37:35', 1, '2023-02-04 15:37:35', 1, 0),
(24, 18, 'EF_TestResult.pdf', 1, 1, 19, 0, '125704022023', 'test', '1257', '#tes', NULL, 'file', 'pdf', '118.92 KB', 'Revisi untuk fileDoc jam 15.44', '[{\"user\":\"2\",\"role\":[\"view\"]},{\"user\":\"3\",\"role\":[\"view\",\"edit\"]}]', NULL, NULL, '2023-02-04 15:44:28', 1, '2023-02-04 15:44:28', 1, 0),
(25, 0, 'Keagamaan', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'semua materi', NULL, NULL, NULL, '2023-02-05 09:42:09', 1, '2023-02-07 12:00:32', 1, 0),
(26, 25, 'EF_TestResult.pdf', 0, NULL, NULL, 0, '213', 'test result', '2323', '#test', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-05 10:13:10', 1, '2023-02-05 10:13:10', 1, 0),
(27, 0, '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-02-05 11:56:00', 1, '2023-02-05 11:56:08', 1, 1),
(28, 25, '', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-02-05 13:11:17', 1, '2023-02-05 13:15:11', 1, 1),
(29, 0, 'EF_TestResult.pdf', 0, NULL, NULL, 0, '', '', '', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-05 13:26:02', 1, '2023-02-09 13:59:57', 1, 1),
(30, 0, 'EF_TestResult.pdf', 0, NULL, NULL, 0, '', '', '', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-05 13:26:49', 1, '2023-02-05 13:26:49', 1, 0),
(31, 0, 'EF_TestResult.pdf', 0, NULL, NULL, 0, '', '', '', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-05 13:29:16', 1, '2023-02-05 13:29:16', 1, 0),
(32, 0, 'Statistika Dasar', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-02-06 10:32:28', 1, '2023-02-07 11:57:35', 1, 0),
(33, 4, 'Penjelasan DMS.txt', 0, NULL, NULL, 0, '23232', 'dms', '23123', 'dms', NULL, 'file', 'txt', '3.74 KB', '', NULL, NULL, NULL, '2023-02-06 12:19:32', 3, '2023-02-06 12:19:32', 3, 0),
(34, 18, 'Document 3.pdf', 1, 1, 20, 0, '32434', 'asd', '12', 'asd', NULL, 'file', 'pdf', '118.92 KB', 'revisi untuk document 4', '[{\"user\":\"3\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-09 09:36:23', 1, '2023-02-09 09:36:23', 1, 0),
(35, 0, 'FileDoc.docx', 1, 1, 29, 0, '', '', '', '', NULL, 'file', 'docx', '13.34 KB', '', NULL, NULL, NULL, '2023-02-09 09:36:50', 1, '2023-02-09 09:36:50', 1, 0),
(36, 1, 'Document 1.pdf', 0, NULL, NULL, 0, '12213', 'document 1', '123', 'document', NULL, 'file', 'pdf', '118.92 KB', 'test aja', NULL, NULL, NULL, '2023-02-09 12:07:55', 3, '2023-02-09 12:07:55', 3, 0),
(37, 0, 'Alpro', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-02-09 12:14:19', 1, '2023-02-09 12:14:19', 1, 0),
(38, 37, 'FileAndroid_P1.txt', 0, NULL, NULL, 0, '3213', 'text file', '23213', '', NULL, 'file', 'txt', '0 Bytes', '', NULL, NULL, NULL, '2023-02-09 12:14:57', 1, '2023-02-09 12:14:57', 1, 0),
(39, 0, 'FileAndroid_P1.txt', 0, NULL, NULL, 0, '213', 'text file', '3434', '', NULL, 'file', 'txt', '0 Bytes', '', NULL, NULL, NULL, '2023-02-09 14:00:45', 1, '2023-02-09 14:01:09', 1, 1),
(40, 0, 'PKN', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Pendidikan Pancasila', '[{\"user\":\"2\",\"role\":[\"view\"]},{\"user\":\"3\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-11 10:47:37', 1, '2023-02-12 10:01:17', 1, 0),
(41, 40, 'Document 1.pdf', 0, NULL, NULL, 0, '123', 'doc', '1234', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-11 10:48:17', 1, '2023-02-11 11:46:22', 1, 1),
(42, 40, 'FileAndroid_P1.txt', 0, NULL, NULL, 0, '4545', 'file text', 'r455', '', NULL, 'file', 'txt', '0 Bytes', '', NULL, NULL, NULL, '2023-02-11 11:48:37', 3, '2023-02-11 11:48:37', 3, 0),
(43, 40, 'Document 1.pdf', 0, NULL, NULL, 0, '456', 'test', '456', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-11 11:52:50', 3, '2023-02-11 11:52:50', 3, 0),
(44, 40, 'Document 2.pdf', 0, NULL, NULL, 0, '123', 'doc 2', '3334', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-12 09:56:38', 3, '2023-02-12 09:56:38', 3, 0),
(45, 40, 'Document 3.pdf', 0, NULL, NULL, 0, '2132324', 'doc 3', '3455', '', NULL, 'file', 'pdf', '118.92 KB', '', '[{\"user\":\"1\",\"role\":[\"view\"]},{\"user\":\"2\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-12 09:58:25', 3, '2023-02-12 09:58:25', 3, 0),
(46, 40, 'Document 4.pdf', 0, NULL, NULL, 0, '6767', 'doc 4', '776', '', NULL, 'file', 'pdf', '118.92 KB', '', '[{\"user\":\"1\",\"role\":[\"view\"]},{\"user\":\"2\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-12 10:00:26', 3, '2023-02-12 10:00:26', 3, 0),
(47, 40, 'Document 5.pdf', 0, NULL, NULL, 0, '543434', 'doc 5', '35656', '', NULL, 'file', 'pdf', '118.92 KB', '', '[{\"user\":\"1\",\"role\":[\"view\"]},{\"user\":\"2\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-12 10:01:39', 3, '2023-02-12 10:01:39', 3, 0),
(48, 40, 'FilePDF.pdf', 0, NULL, NULL, 0, '3443657', 'pdf', '435787', '', NULL, 'file', 'pdf', '84.9 KB', '', '[{\"user\":\"1\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-12 10:09:25', 3, '2023-02-12 10:09:25', 3, 0),
(49, 37, 'Document 2.pdf', 0, NULL, NULL, 0, '343', '', '', '', NULL, 'file', 'pdf', '118.92 KB', '', '[{\"user\":\"1\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-12 10:21:45', 1, '2023-02-12 10:21:45', 1, 0),
(50, 37, 'Document 1.pdf', 0, NULL, NULL, 0, '343', '', '', '', NULL, 'file', 'pdf', '118.92 KB', '', '[{\"user\":\"1\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-12 10:21:48', 1, '2023-02-12 10:21:48', 1, 0),
(51, 37, 'Document 3.pdf', 0, NULL, NULL, 0, '567', '', '', '', NULL, 'file', 'pdf', '118.92 KB', '', '[{\"user\":\"1\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-12 10:22:09', 1, '2023-02-12 10:22:09', 1, 0),
(52, 37, 'Document 4.pdf', 0, NULL, NULL, 0, '567', '', '', '', NULL, 'file', 'pdf', '118.92 KB', '', '[{\"user\":\"1\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-12 10:22:10', 1, '2023-02-12 10:22:10', 1, 0),
(53, 0, 'Sistem Informasi', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'untuk sistem informasi', NULL, NULL, NULL, '2023-02-14 10:04:48', 4, '2023-02-14 10:04:48', 4, 0),
(54, 0, 'Revisi', 0, NULL, NULL, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', '[{\"user\":\"2\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-15 09:06:54', 1, '2023-02-15 09:10:04', 1, 0),
(55, 54, 'Document 1.pdf', 1, NULL, NULL, 62, '1223', 'file 1', '', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-15 09:07:26', 1, '2023-02-15 09:43:33', 1, 0),
(56, 54, 'FileDoc.docx', 0, NULL, NULL, 0, '123213', 'filedocx', '', '', NULL, 'file', 'docx', '13.34 KB', '', '[{\"user\":\"1\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-15 09:10:49', 2, '2023-02-15 09:10:49', 2, 0),
(57, 54, 'FileAndroid_P1.txt', 0, NULL, NULL, 0, '345656', 'filetxt', '', '', NULL, 'file', 'txt', '0 Bytes', '', NULL, NULL, NULL, '2023-02-15 09:14:42', 1, '2023-02-15 09:14:42', 1, 0),
(58, 54, 'EF_TestResult.pdf', 0, NULL, NULL, 0, '676543', 'filepdf', '', '', NULL, 'file', 'pdf', '118.92 KB', '', '[{\"user\":\"1\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-15 09:15:12', 2, '2023-02-15 09:15:12', 2, 0),
(59, 54, 'Document 2.pdf', 1, 1, 55, 62, '54656', '', NULL, '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-15 09:16:08', 1, '2023-02-15 09:43:32', 1, 0),
(60, 54, 'Document 3.pdf', 1, 1, 59, 62, '85654', '', NULL, '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-15 09:22:42', 1, '2023-02-15 09:43:31', 1, 0),
(61, 54, 'Document 4.pdf', 1, 1, 60, 62, '787875643', 'doc4', NULL, '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-15 09:32:26', 1, '2023-02-15 09:43:31', 1, 0),
(62, 54, 'Document 5.pdf', 0, 1, 61, 0, '64343', '', NULL, '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-15 09:43:30', 1, '2023-02-15 09:43:30', 1, 0),
(63, 0, 'Revisi 2', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-02-15 10:44:45', 1, '2023-02-15 10:45:10', 1, 0),
(64, 63, 'Document 1.pdf', 0, NULL, NULL, NULL, '545454', 'pdf1', '', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-15 10:45:42', 1, '2023-02-15 12:52:35', 1, 0),
(65, 63, 'Document 2.pdf', 1, 1, 64, 64, '8657454', 'pdf2', NULL, '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-15 10:46:42', 1, '2023-02-15 12:28:29', 1, 1),
(66, 63, 'Document 3.pdf', 1, 2, 65, 65, '7566343', 'pdf3', NULL, '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-15 10:47:21', 1, '2023-02-15 12:24:26', 1, 1),
(67, 63, 'Document 4.pdf', 0, NULL, NULL, NULL, '45345656', '', '', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-15 12:51:52', 1, '2023-02-15 12:51:52', 1, 0),
(68, 63, 'FilePDF.pdf', 1, 1, 64, 64, '3434343', '', NULL, '', NULL, 'file', 'pdf', '84.9 KB', '', NULL, NULL, NULL, '2023-02-15 12:52:17', 1, '2023-02-15 12:52:35', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `logs_id` int(11) NOT NULL,
  `file_target_id` int(11) DEFAULT NULL,
  `act` varchar(255) DEFAULT 'general',
  `type` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '0=No; 1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_logs`
--

INSERT INTO `tbl_logs` (`logs_id`, `file_target_id`, `act`, `type`, `description`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_deleted`) VALUES
(1, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-09 11:09:26', 1, '2023-02-09 11:09:26', 1, 0),
(2, 32, 'open', 'folder', 'membuka folder Statistika Dasar', '2023-02-09 11:09:51', 1, '2023-02-09 11:09:51', 1, 0),
(3, 29, 'open', 'file', 'melihat file EF_TestResult.pdf', '2023-02-09 11:10:12', 1, '2023-02-09 11:10:12', 1, 0),
(4, 32, 'open', 'folder', 'membuka folder Statistika Dasar', '2023-02-09 11:29:25', 1, '2023-02-09 11:29:25', 1, 0),
(5, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-09 12:06:53', 1, '2023-02-09 12:06:53', 1, 0),
(6, 1, 'open', 'folder', 'membuka folder UK Petra 2019', '2023-02-09 12:07:19', 3, '2023-02-09 12:07:19', 3, 0),
(7, 36, 'upload', 'file', 'mengunggah file baru Document 1.pdf', '2023-02-09 12:07:56', 3, '2023-02-09 12:07:56', 3, 0),
(8, 1, 'open', 'folder', 'membuka folder UK Petra 2019', '2023-02-09 12:08:53', 3, '2023-02-09 12:08:53', 3, 0),
(9, 1, 'open', 'folder', 'membuka folder UK Petra 2019', '2023-02-09 12:11:23', 3, '2023-02-09 12:11:23', 3, 0),
(10, 36, 'open', 'file', 'melihat file Document 1.pdf', '2023-02-09 12:11:25', 3, '2023-02-09 12:11:25', 3, 0),
(11, 25, 'open', 'folder', 'membuka folder Etika Keluarga Kristen', '2023-02-09 12:13:22', 1, '2023-02-09 12:13:22', 1, 0),
(12, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-09 12:13:38', 1, '2023-02-09 12:13:38', 1, 0),
(13, 13, 'open', 'file', 'melihat file FileDoc.docx', '2023-02-09 12:13:45', 1, '2023-02-09 12:13:45', 1, 0),
(14, 13, 'download', 'file', 'mengunduh file FileDoc.docx', '2023-02-09 12:13:56', 1, '2023-02-09 12:13:56', 1, 0),
(15, 37, 'create', 'folder', 'membuat folder baru dengan nama AOK', '2023-02-09 12:14:20', 1, '2023-02-09 12:14:20', 1, 0),
(16, 37, 'open', 'folder', 'membuka folder AOK', '2023-02-09 12:14:20', 1, '2023-02-09 12:14:20', 1, 0),
(17, 38, 'upload', 'file', 'mengunggah file baru FileAndroid_P1.txt', '2023-02-09 12:14:57', 1, '2023-02-09 12:14:57', 1, 0),
(18, 37, 'open', 'folder', 'membuka folder AOK', '2023-02-09 12:15:38', 1, '2023-02-09 12:15:38', 1, 0),
(19, 18, 'update', 'folder', 'mengubah attribut pada folder B. Indonesia', '2023-02-09 12:25:27', 1, '2023-02-09 12:25:27', 1, 0),
(20, 30, 'open', 'file', 'melihat file EF_TestResult.pdf', '2023-02-09 13:59:47', 1, '2023-02-09 13:59:47', 1, 0),
(21, 29, 'delete', 'file', 'menghapus file EF_TestResult.pdf', '2023-02-09 13:59:58', 1, '2023-02-09 13:59:58', 1, 0),
(22, 39, 'upload', 'file', 'mengunggah file baru FileAndroid_P1.txt', '2023-02-09 14:00:45', 1, '2023-02-09 14:00:45', 1, 0),
(23, 39, 'open', 'file', 'melihat file FileAndroid_P1.txt', '2023-02-09 14:00:58', 1, '2023-02-09 14:00:58', 1, 0),
(24, 39, 'delete', 'file', 'menghapus file FileAndroid_P1.txt', '2023-02-09 14:01:09', 1, '2023-02-09 14:01:09', 1, 0),
(25, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-11 10:10:21', 1, '2023-02-11 10:10:21', 1, 0),
(26, 18, 'open', 'folder', 'membuka folder B. Indonesia', '2023-02-11 10:11:24', 1, '2023-02-11 10:11:24', 1, 0),
(27, 40, 'create', 'folder', 'membuat folder baru dengan nama PKN', '2023-02-11 10:47:38', 1, '2023-02-11 10:47:38', 1, 0),
(28, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 10:47:39', 1, '2023-02-11 10:47:39', 1, 0),
(29, 41, 'upload', 'file', 'mengunggah file baru Document 1.pdf', '2023-02-11 10:48:18', 1, '2023-02-11 10:48:18', 1, 0),
(30, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 10:48:19', 1, '2023-02-11 10:48:19', 1, 0),
(31, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-11 10:51:36', 1, '2023-02-11 10:51:36', 1, 0),
(32, 12, 'open', 'folder', 'membuka folder Minggu 2 v2', '2023-02-11 11:18:19', 1, '2023-02-11 11:18:19', 1, 0),
(33, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:24:09', 1, '2023-02-11 11:24:09', 1, 0),
(34, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:28:32', 1, '2023-02-11 11:28:32', 1, 0),
(35, 40, 'update', 'folder', 'mengubah attribut pada folder PKN', '2023-02-11 11:28:44', 1, '2023-02-11 11:28:44', 1, 0),
(36, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:29:44', 1, '2023-02-11 11:29:44', 1, 0),
(37, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:30:23', 1, '2023-02-11 11:30:23', 1, 0),
(38, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:31:19', 1, '2023-02-11 11:31:19', 1, 0),
(39, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:32:10', 1, '2023-02-11 11:32:10', 1, 0),
(40, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:34:00', 1, '2023-02-11 11:34:00', 1, 0),
(41, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:35:33', 1, '2023-02-11 11:35:33', 1, 0),
(42, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:38:03', 1, '2023-02-11 11:38:03', 1, 0),
(43, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:42:54', 1, '2023-02-11 11:42:54', 1, 0),
(44, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:43:00', 1, '2023-02-11 11:43:00', 1, 0),
(45, 32, 'open', 'folder', 'membuka folder Statistika Dasar', '2023-02-11 11:43:54', 1, '2023-02-11 11:43:54', 1, 0),
(46, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:46:18', 1, '2023-02-11 11:46:18', 1, 0),
(47, 41, 'delete', 'file', 'menghapus file Document 1.pdf', '2023-02-11 11:46:22', 1, '2023-02-11 11:46:22', 1, 0),
(48, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:47:16', 3, '2023-02-11 11:47:16', 3, 0),
(49, 42, 'upload', 'file', 'mengunggah file baru FileAndroid_P1.txt', '2023-02-11 11:48:38', 3, '2023-02-11 11:48:38', 3, 0),
(50, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:48:39', 3, '2023-02-11 11:48:39', 3, 0),
(51, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:49:04', 1, '2023-02-11 11:49:04', 1, 0),
(52, 43, 'upload', 'file', 'mengunggah file baru Document 1.pdf', '2023-02-11 11:52:50', 3, '2023-02-11 11:52:50', 3, 0),
(53, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:52:51', 3, '2023-02-11 11:52:51', 3, 0),
(54, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-11 11:53:00', 1, '2023-02-11 11:53:00', 1, 0),
(55, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-12 09:55:02', 1, '2023-02-12 09:55:02', 1, 0),
(56, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-12 09:56:07', 3, '2023-02-12 09:56:07', 3, 0),
(57, 44, 'upload', 'file', 'mengunggah file baru Document 2.pdf', '2023-02-12 09:56:38', 3, '2023-02-12 09:56:38', 3, 0),
(58, 45, 'upload', 'file', 'mengunggah file baru Document 3.pdf', '2023-02-12 09:58:25', 3, '2023-02-12 09:58:25', 3, 0),
(59, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-12 09:58:26', 3, '2023-02-12 09:58:26', 3, 0),
(60, 46, 'upload', 'file', 'mengunggah file baru Document 4.pdf', '2023-02-12 10:00:27', 3, '2023-02-12 10:00:27', 3, 0),
(61, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-12 10:00:27', 3, '2023-02-12 10:00:27', 3, 0),
(62, 40, 'update', 'folder', 'mengubah attribut pada folder PKN', '2023-02-12 10:01:18', 1, '2023-02-12 10:01:18', 1, 0),
(63, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-12 10:01:20', 3, '2023-02-12 10:01:20', 3, 0),
(64, 47, 'upload', 'file', 'mengunggah file baru Document 5.pdf', '2023-02-12 10:01:40', 3, '2023-02-12 10:01:40', 3, 0),
(65, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-12 10:05:00', 3, '2023-02-12 10:05:00', 3, 0),
(66, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-12 10:09:02', 3, '2023-02-12 10:09:02', 3, 0),
(67, 48, 'upload', 'file', 'mengunggah file baru FilePDF.pdf', '2023-02-12 10:09:25', 3, '2023-02-12 10:09:25', 3, 0),
(68, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-12 10:11:24', 1, '2023-02-12 10:11:24', 1, 0),
(69, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:11:45', 1, '2023-02-12 10:11:45', 1, 0),
(70, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:15:53', 1, '2023-02-12 10:15:53', 1, 0),
(71, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:19:27', 1, '2023-02-12 10:19:27', 1, 0),
(72, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:21:22', 1, '2023-02-12 10:21:22', 1, 0),
(73, 49, 'upload', 'file', 'mengunggah file baru Document 2.pdf', '2023-02-12 10:21:47', 1, '2023-02-12 10:21:47', 1, 0),
(74, 50, 'upload', 'file', 'mengunggah file baru Document 1.pdf', '2023-02-12 10:21:49', 1, '2023-02-12 10:21:49', 1, 0),
(75, 51, 'upload', 'file', 'mengunggah file baru Document 3.pdf', '2023-02-12 10:22:10', 1, '2023-02-12 10:22:10', 1, 0),
(76, 52, 'upload', 'file', 'mengunggah file baru Document 4.pdf', '2023-02-12 10:22:11', 1, '2023-02-12 10:22:11', 1, 0),
(77, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:22:12', 1, '2023-02-12 10:22:12', 1, 0),
(78, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:25:58', 1, '2023-02-12 10:25:58', 1, 0),
(79, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:26:21', 1, '2023-02-12 10:26:21', 1, 0),
(80, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:27:08', 1, '2023-02-12 10:27:08', 1, 0),
(81, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:29:19', 1, '2023-02-12 10:29:19', 1, 0),
(82, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:33:47', 1, '2023-02-12 10:33:47', 1, 0),
(83, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:42:11', 1, '2023-02-12 10:42:11', 1, 0),
(84, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:43:09', 1, '2023-02-12 10:43:09', 1, 0),
(85, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:45:42', 1, '2023-02-12 10:45:42', 1, 0),
(86, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:50:20', 1, '2023-02-12 10:50:20', 1, 0),
(87, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:51:20', 1, '2023-02-12 10:51:20', 1, 0),
(88, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:54:12', 1, '2023-02-12 10:54:12', 1, 0),
(89, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 10:58:00', 1, '2023-02-12 10:58:00', 1, 0),
(90, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 11:00:24', 1, '2023-02-12 11:00:24', 1, 0),
(91, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 11:03:07', 1, '2023-02-12 11:03:07', 1, 0),
(92, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 11:45:51', 1, '2023-02-12 11:45:51', 1, 0),
(93, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 11:46:49', 1, '2023-02-12 11:46:49', 1, 0),
(94, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 11:47:34', 1, '2023-02-12 11:47:34', 1, 0),
(95, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 11:48:16', 1, '2023-02-12 11:48:16', 1, 0),
(96, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 11:49:40', 1, '2023-02-12 11:49:40', 1, 0),
(97, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 11:51:27', 1, '2023-02-12 11:51:27', 1, 0),
(98, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 11:52:26', 1, '2023-02-12 11:52:26', 1, 0),
(99, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 11:53:44', 1, '2023-02-12 11:53:44', 1, 0),
(100, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-12 11:58:55', 1, '2023-02-12 11:58:55', 1, 0),
(101, 18, 'open', 'folder', 'membuka folder B. Indonesia', '2023-02-13 12:13:54', 1, '2023-02-13 12:13:54', 1, 0),
(102, 18, 'open', 'folder', 'membuka folder B. Indonesia', '2023-02-13 12:16:46', 1, '2023-02-13 12:16:46', 1, 0),
(103, 18, 'open', 'folder', 'membuka folder B. Indonesia', '2023-02-13 12:21:26', 1, '2023-02-13 12:21:26', 1, 0),
(104, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-13 12:27:44', 1, '2023-02-13 12:27:44', 1, 0),
(105, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-13 17:07:18', 1, '2023-02-13 17:07:18', 1, 0),
(106, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-13 18:00:56', 1, '2023-02-13 18:00:56', 1, 0),
(107, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-13 18:01:30', 1, '2023-02-13 18:01:30', 1, 0),
(108, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-13 18:02:35', 1, '2023-02-13 18:02:35', 1, 0),
(109, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-13 18:03:08', 1, '2023-02-13 18:03:08', 1, 0),
(110, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-13 18:04:19', 1, '2023-02-13 18:04:19', 1, 0),
(111, 8, 'open', 'folder', 'membuka folder Minggu 1', '2023-02-13 18:05:00', 1, '2023-02-13 18:05:00', 1, 0),
(112, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-13 18:05:10', 1, '2023-02-13 18:05:10', 1, 0),
(113, 32, 'open', 'folder', 'membuka folder Statistika Dasar', '2023-02-14 08:36:04', 1, '2023-02-14 08:36:04', 1, 0),
(114, 18, 'open', 'folder', 'membuka folder B. Indonesia', '2023-02-14 09:49:12', 1, '2023-02-14 09:49:12', 1, 0),
(115, 53, 'create', 'folder', 'membuat folder baru dengan nama Sistem Informasi', '2023-02-14 10:04:48', 4, '2023-02-14 10:04:48', 4, 0),
(116, 53, 'open', 'folder', 'membuka folder Sistem Informasi', '2023-02-14 10:04:49', 4, '2023-02-14 10:04:49', 4, 0),
(117, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-14 10:13:09', 1, '2023-02-14 10:13:09', 1, 0),
(118, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-14 10:13:17', 1, '2023-02-14 10:13:17', 1, 0),
(119, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-14 10:13:23', 1, '2023-02-14 10:13:23', 1, 0),
(120, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-14 10:56:05', 1, '2023-02-14 10:56:05', 1, 0),
(121, 12, 'open', 'folder', 'membuka folder Minggu 2 v2', '2023-02-14 10:56:14', 1, '2023-02-14 10:56:14', 1, 0),
(122, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-14 11:01:57', 1, '2023-02-14 11:01:57', 1, 0),
(123, 8, 'open', 'folder', 'membuka folder Minggu 1', '2023-02-14 11:01:59', 1, '2023-02-14 11:01:59', 1, 0),
(124, 8, 'open', 'folder', 'membuka folder Minggu 1', '2023-02-14 11:02:00', 1, '2023-02-14 11:02:00', 1, 0),
(125, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-14 11:18:16', 1, '2023-02-14 11:18:16', 1, 0),
(126, 8, 'open', 'folder', 'membuka folder Minggu 1', '2023-02-14 11:18:22', 1, '2023-02-14 11:18:22', 1, 0),
(127, 8, 'open', 'folder', 'membuka folder Minggu 1', '2023-02-14 11:19:11', 1, '2023-02-14 11:19:11', 1, 0),
(128, 8, 'open', 'folder', 'membuka folder Minggu 1', '2023-02-14 11:20:35', 1, '2023-02-14 11:20:35', 1, 0),
(129, 8, 'open', 'folder', 'membuka folder Minggu 1', '2023-02-14 11:21:11', 1, '2023-02-14 11:21:11', 1, 0),
(130, 18, 'open', 'folder', 'membuka folder B. Indonesia', '2023-02-14 11:21:26', 1, '2023-02-14 11:21:26', 1, 0),
(131, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-14 11:24:01', 1, '2023-02-14 11:24:01', 1, 0),
(132, 8, 'open', 'folder', 'membuka folder Minggu 1', '2023-02-14 11:24:03', 1, '2023-02-14 11:24:03', 1, 0),
(133, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-14 11:26:27', 1, '2023-02-14 11:26:27', 1, 0),
(134, 8, 'open', 'folder', 'membuka folder Minggu 1', '2023-02-14 11:26:33', 1, '2023-02-14 11:26:33', 1, 0),
(135, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-15 09:06:36', 1, '2023-02-15 09:06:36', 1, 0),
(136, 54, 'create', 'folder', 'membuat folder baru dengan nama Revisi', '2023-02-15 09:06:54', 1, '2023-02-15 09:06:54', 1, 0),
(137, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:06:55', 1, '2023-02-15 09:06:55', 1, 0),
(138, 55, 'upload', 'file', 'mengunggah file baru Document 1.pdf', '2023-02-15 09:07:27', 1, '2023-02-15 09:07:27', 1, 0),
(139, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:07:28', 1, '2023-02-15 09:07:28', 1, 0),
(140, 54, 'update', 'folder', 'mengubah attribut pada folder Revisi', '2023-02-15 09:10:04', 1, '2023-02-15 09:10:04', 1, 0),
(141, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:10:08', 1, '2023-02-15 09:10:08', 1, 0),
(142, 56, 'upload', 'file', 'mengunggah file baru FileDoc.docx', '2023-02-15 09:10:50', 2, '2023-02-15 09:10:50', 2, 0),
(143, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:11:06', 1, '2023-02-15 09:11:06', 1, 0),
(144, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:14:20', 1, '2023-02-15 09:14:20', 1, 0),
(145, 57, 'upload', 'file', 'mengunggah file baru FileAndroid_P1.txt', '2023-02-15 09:14:42', 1, '2023-02-15 09:14:42', 1, 0),
(146, 58, 'upload', 'file', 'mengunggah file baru EF_TestResult.pdf', '2023-02-15 09:15:12', 2, '2023-02-15 09:15:12', 2, 0),
(147, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:15:13', 2, '2023-02-15 09:15:13', 2, 0),
(148, 59, 'revisi', 'file', 'melakukan revisi dengan file baru Document 2.pdf', '2023-02-15 09:16:08', 1, '2023-02-15 09:16:08', 1, 0),
(149, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:16:08', 1, '2023-02-15 09:16:08', 1, 0),
(150, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:18:32', 1, '2023-02-15 09:18:32', 1, 0),
(151, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:21:07', 1, '2023-02-15 09:21:07', 1, 0),
(152, 60, 'upload', 'file', 'mengunggah file baru Document 3.pdf', '2023-02-15 09:21:31', 1, '2023-02-15 09:21:31', 1, 0),
(153, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:22:28', 1, '2023-02-15 09:22:28', 1, 0),
(154, 60, 'revisi', 'file', 'melakukan revisi dengan file baru Document 3.pdf', '2023-02-15 09:22:43', 1, '2023-02-15 09:22:43', 1, 0),
(155, 61, 'revisi', 'file', 'melakukan revisi dengan file baru Document 4.pdf', '2023-02-15 09:32:27', 1, '2023-02-15 09:32:27', 1, 0),
(156, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:32:27', 1, '2023-02-15 09:32:27', 1, 0),
(157, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:43:17', 1, '2023-02-15 09:43:17', 1, 0),
(158, 62, 'revisi', 'file', 'melakukan revisi dengan file baru Document 5.pdf', '2023-02-15 09:43:33', 1, '2023-02-15 09:43:33', 1, 0),
(159, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 09:51:13', 1, '2023-02-15 09:51:13', 1, 0),
(160, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 10:03:57', 1, '2023-02-15 10:03:57', 1, 0),
(161, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 10:04:30', 1, '2023-02-15 10:04:30', 1, 0),
(162, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 10:06:03', 1, '2023-02-15 10:06:03', 1, 0),
(163, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 10:08:29', 1, '2023-02-15 10:08:29', 1, 0),
(164, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 10:10:48', 1, '2023-02-15 10:10:48', 1, 0),
(165, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 10:11:16', 1, '2023-02-15 10:11:16', 1, 0),
(166, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 10:12:29', 1, '2023-02-15 10:12:29', 1, 0),
(167, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 10:13:18', 1, '2023-02-15 10:13:18', 1, 0),
(168, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 10:14:33', 1, '2023-02-15 10:14:33', 1, 0),
(169, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 10:17:03', 1, '2023-02-15 10:17:03', 1, 0),
(170, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 10:35:33', 1, '2023-02-15 10:35:33', 1, 0),
(171, 54, 'open', 'folder', 'membuka folder Revisi', '2023-02-15 10:39:24', 1, '2023-02-15 10:39:24', 1, 0),
(172, 63, 'create', 'folder', 'membuat folder baru dengan nama Revisi II', '2023-02-15 10:44:45', 1, '2023-02-15 10:44:45', 1, 0),
(173, 63, 'open', 'folder', 'membuka folder Revisi II', '2023-02-15 10:44:46', 1, '2023-02-15 10:44:46', 1, 0),
(174, 63, 'update', 'folder', 'mengubah attribut pada folder Revisi 2', '2023-02-15 10:45:11', 1, '2023-02-15 10:45:11', 1, 0),
(175, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 10:45:15', 1, '2023-02-15 10:45:15', 1, 0),
(176, 64, 'upload', 'file', 'mengunggah file baru Document 1.pdf', '2023-02-15 10:45:42', 1, '2023-02-15 10:45:42', 1, 0),
(177, 65, 'revisi', 'file', 'melakukan revisi dengan file baru Document 2.pdf', '2023-02-15 10:46:43', 1, '2023-02-15 10:46:43', 1, 0),
(178, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 10:46:43', 1, '2023-02-15 10:46:43', 1, 0),
(179, 66, 'revisi', 'file', 'melakukan revisi dengan file baru Document 3.pdf', '2023-02-15 10:47:23', 1, '2023-02-15 10:47:23', 1, 0),
(180, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 10:47:23', 1, '2023-02-15 10:47:23', 1, 0),
(181, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 11:18:17', 1, '2023-02-15 11:18:17', 1, 0),
(182, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:10:15', 1, '2023-02-15 12:10:15', 1, 0),
(183, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:11:06', 1, '2023-02-15 12:11:06', 1, 0),
(184, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:16:45', 1, '2023-02-15 12:16:45', 1, 0),
(185, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:17:06', 1, '2023-02-15 12:17:06', 1, 0),
(186, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:19:47', 1, '2023-02-15 12:19:47', 1, 0),
(187, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:20:01', 1, '2023-02-15 12:20:01', 1, 0),
(188, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:21:48', 1, '2023-02-15 12:21:48', 1, 0),
(189, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:24:18', 1, '2023-02-15 12:24:18', 1, 0),
(190, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:25:53', 1, '2023-02-15 12:25:53', 1, 0),
(191, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:27:53', 1, '2023-02-15 12:27:53', 1, 0),
(192, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:28:23', 1, '2023-02-15 12:28:23', 1, 0),
(193, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:51:39', 1, '2023-02-15 12:51:39', 1, 0),
(194, 67, 'upload', 'file', 'mengunggah file baru Document 4.pdf', '2023-02-15 12:51:53', 1, '2023-02-15 12:51:53', 1, 0),
(195, 68, 'revisi', 'file', 'melakukan revisi dengan file baru FilePDF.pdf', '2023-02-15 12:52:19', 1, '2023-02-15 12:52:19', 1, 0),
(196, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-15 12:52:19', 1, '2023-02-15 12:52:19', 1, 0),
(197, 64, 'rollback', 'file', 'melakukan rollback pada file FilePDF.pdf', '2023-02-15 12:52:35', 1, '2023-02-15 12:52:35', 1, 0),
(198, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-16 08:59:40', 1, '2023-02-16 08:59:40', 1, 0),
(199, 13, 'open', 'file', 'melihat file FileDoc.docx', '2023-02-16 08:59:47', 1, '2023-02-16 08:59:47', 1, 0),
(200, 13, 'open', 'file', 'membuka file FileDoc.docx', '2023-02-17 11:47:32', 1, '2023-02-17 11:47:32', 1, 0),
(201, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-17 11:47:37', 1, '2023-02-17 11:47:37', 1, 0),
(202, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-17 11:49:55', 1, '2023-02-17 11:49:55', 1, 0),
(203, 10, 'download', 'file', 'mengunduh file Document 1.pdf', '2023-02-17 11:52:18', 1, '2023-02-17 11:52:18', 1, 0),
(204, 13, 'download', 'file', 'mengunduh file FileDoc.docx', '2023-02-17 11:52:31', 1, '2023-02-17 11:52:31', 1, 0),
(205, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-02-17 12:43:18', 1, '2023-02-17 12:43:18', 1, 0),
(206, 10, 'download', 'file', 'mengunduh file Document 1.pdf', '2023-02-17 12:45:24', 1, '2023-02-17 12:45:24', 1, 0),
(207, 63, 'open', 'folder', 'membuka folder Revisi 2', '2023-02-18 12:02:47', 1, '2023-02-18 12:02:47', 1, 0),
(208, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-18 12:03:37', 1, '2023-02-18 12:03:37', 1, 0),
(209, 40, 'open', 'folder', 'membuka folder PKN', '2023-02-18 12:05:43', 1, '2023-02-18 12:05:43', 1, 0),
(210, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-18 12:05:52', 1, '2023-02-18 12:05:52', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `is_superadmin` int(1) DEFAULT 0,
  `fullname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `position` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1 COMMENT '0=Inactive; 1=Active',
  `status_email` tinyint(1) DEFAULT 1 COMMENT '0=Inactive; 1=Active',
  `secret_key` varchar(255) DEFAULT NULL,
  `encryption_key` varchar(255) DEFAULT NULL,
  `encryption_iv` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '0=No; 1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `is_superadmin`, `fullname`, `email`, `password`, `phone`, `address`, `position`, `status`, `status_email`, `secret_key`, `encryption_key`, `encryption_iv`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_deleted`) VALUES
(1, 1, 'Jason Immanuel', 'jason@email.com', 'tsG26M+doZc=', '081356894563', NULL, NULL, 1, 1, NULL, '6143541754438333', 'MXLPR1SYD935TJVF', '2023-01-25 06:37:26', 1, '2023-01-25 06:37:26', 1, 0),
(2, 0, 'Delvo Anderson', 'delvo@email.com', 'urrnRO/83iY=', '456789874565', NULL, NULL, 1, 1, NULL, '9378434021479912', '8MD2RPBW91SZNXI7', '2023-01-25 12:39:43', 3, '2023-01-25 12:39:43', 3, 0),
(3, 0, 'jonas andreas', 'jonas@email.com', 'yYROW/X4cLI=', '081358126547', NULL, NULL, 1, 1, NULL, '3783289032730952', 'CNY0GMIWE6DUK4FR', '2023-01-25 12:40:25', 3, '2023-02-06 11:28:03', 3, 0),
(4, NULL, 'Kevin', 'kevin@email.com', 'hhnajCW4FFI=', '5465465', NULL, NULL, 1, 1, NULL, '7122781872373108', 'YZTI658FBMCNSH21', '2023-02-14 10:03:30', 1, '2023-02-14 10:03:30', 1, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_folder`
--
ALTER TABLE `tbl_folder`
  ADD PRIMARY KEY (`folder_id`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`logs_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_folder`
--
ALTER TABLE `tbl_folder`
  MODIFY `folder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=211;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
