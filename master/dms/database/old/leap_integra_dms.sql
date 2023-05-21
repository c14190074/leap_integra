-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 07, 2023 at 02:56 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

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
(30, 0, 'EF_TestResult.pdf', 1, NULL, NULL, 87, '', '', '', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-05 13:26:49', 1, '2023-04-08 11:21:28', 1, 0),
(31, 0, 'EF_TestResult.pdf', 1, NULL, NULL, 88, '', '', '', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, NULL, NULL, '2023-02-05 13:29:16', 1, '2023-04-08 13:27:07', 1, 0),
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
(68, 63, 'FilePDF.pdf', 1, 1, 64, 64, '3434343', '', NULL, '', NULL, 'file', 'pdf', '84.9 KB', '', NULL, NULL, NULL, '2023-02-15 12:52:17', 1, '2023-02-15 12:52:35', 1, 1),
(69, 0, 'Android Folder 1', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Folder test', '[{\"user\":\"3\",\"role\":[\"view\"]},{\"user\":\"4\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-22 11:41:27', 1, '2023-02-23 10:44:57', 1, 0),
(70, 0, 'Android Folder 2', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Folder test dibuat melalui API', '[{\"user\":3,\"role\":[\"view\"]},{\"user\":4,\"role\":[\"view\"]}]', NULL, NULL, '2023-02-22 11:48:39', NULL, '2023-02-22 11:48:39', NULL, 0),
(71, 0, 'Android Folder 3', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Folder test', '[{\"user\":\"3\",\"role\":[\"view\"]},{\"user\":\"4\",\"role\":[\"view\"]}]', NULL, NULL, '2023-02-22 11:53:44', 1, '2023-02-23 10:45:11', 1, 0),
(72, 0, 'New Folder', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-03-29 10:42:31', 1, '2023-03-29 10:42:31', 1, 0),
(73, 0, 'New Folder', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-03-29 10:52:10', 1, '2023-03-29 10:52:10', 1, 0),
(74, 0, 'Folder From API', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-03-31 12:30:04', 1, '2023-03-31 12:30:04', 1, 0),
(75, 0, 'Child Folder From API', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-03-31 12:30:25', 1, '2023-03-31 12:30:25', 1, 0),
(76, 74, 'Child Folder From API 2', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-03-31 12:35:09', 1, '2023-03-31 12:35:09', 1, 0),
(77, 0, 'Folder From API 2', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, NULL, NULL, '2023-03-31 12:36:22', 1, '2023-03-31 12:36:22', 1, 0),
(78, 0, 'API untuk Folder', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', '[{\"user\":\"1\",\"role\":[\"view\"]}]', NULL, NULL, '2023-03-31 12:52:21', 2, '2023-03-31 12:52:21', 2, 0),
(79, 0, 'What is Lorem Ipsum.docx', 0, NULL, NULL, NULL, '012', 'Percobaan', NULL, NULL, '[]', 'file', 'docx', '12.83 KB', 'Lorem', NULL, NULL, NULL, '2023-04-05 13:13:49', 1, '2023-04-05 13:13:49', 1, 0),
(80, 0, 'What is Lorem Ipsum.docx', 1, NULL, NULL, 98, '', '', NULL, NULL, '[]', 'file', 'docx', '12.83 KB', '', NULL, NULL, NULL, '2023-04-05 13:14:15', 1, '2023-04-12 09:35:28', 1, 0),
(81, 0, 'Coba', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Tes', '[]', NULL, NULL, '2023-04-05 13:55:39', 1, '2023-04-05 13:55:39', 1, 0),
(82, 0, 'Folder From Android', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', '[]', NULL, NULL, '2023-04-05 13:57:05', 2, '2023-04-05 13:57:05', 2, 0),
(83, 0, 'Folder From Android 2', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', '[]', NULL, NULL, '2023-04-05 13:59:49', 2, '2023-04-05 13:59:49', 2, 0),
(84, 83, 'Lorem Ipsum Adalah.docx', 0, NULL, NULL, NULL, '32323', 'Test', NULL, NULL, '[]', 'file', 'docx', '12.85 KB', '', NULL, NULL, NULL, '2023-04-05 14:00:27', 2, '2023-04-05 14:00:27', 2, 0),
(85, 0, 'Tes Android', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Coba', '[]', NULL, NULL, '2023-04-05 19:57:08', 1, '2023-04-05 19:57:08', 1, 0),
(86, 85, 'What is Lorem Ipsum.docx', 0, NULL, NULL, NULL, '012', 'Tes', NULL, NULL, '[]', 'file', 'docx', '12.83 KB', 'Tes', NULL, NULL, NULL, '2023-04-05 19:59:07', 1, '2023-04-05 19:59:07', 1, 0),
(87, 0, 'FileDocFinal.docx', 0, 1, 30, 0, '', 'docx1', NULL, '', NULL, 'file', 'docx', '13.34 KB', '', NULL, NULL, NULL, '2023-04-08 11:21:28', 1, '2023-04-08 11:21:28', 1, 0),
(88, 0, 'FileDocTerbaru.docx', 0, 1, 31, NULL, '', '', NULL, '', NULL, 'file', 'docx', '13.34 KB', '', NULL, NULL, NULL, '2023-04-08 11:22:46', 1, '2023-04-08 13:27:07', 1, 0),
(89, 0, 'Lorem Ipsum Adalah.docx', 1, 2, 88, 88, '', '', NULL, '', NULL, 'file', 'docx', '12.85 KB', '', NULL, NULL, NULL, '2023-04-08 11:23:25', 1, '2023-04-08 13:27:06', 1, 1),
(90, 0, 'Folder 1', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'test folder 1', '[{\"user\":3,\"role\":[\"view\"]}]', NULL, NULL, '2023-04-09 09:42:24', 2, '2023-04-09 09:42:24', 2, 0),
(91, 0, 'Folder 2', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'shared from jason', '[{\"user\":\"2\",\"role\":[\"view\"]}]', NULL, NULL, '2023-04-09 09:45:58', 1, '2023-04-09 09:45:58', 1, 0),
(92, 0, 'folder 3', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', '[{\"user\":\"2\",\"role\":[\"view\"]}]', NULL, NULL, '2023-04-09 10:06:05', 1, '2023-04-09 10:06:05', 1, 0),
(93, 0, 'folder 4', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', '[{\"user\":\"2\",\"role\":[\"view\"]}]', NULL, NULL, '2023-04-09 10:39:21', 1, '2023-04-09 10:39:21', 1, 0),
(94, 0, 'folder 5', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', '[{\"user\":\"2\",\"role\":[\"view\"]}]', NULL, NULL, '2023-04-09 11:10:54', 1, '2023-04-09 11:10:54', 1, 0),
(95, 0, 'folder 6', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', '[{\"user\":\"2\",\"role\":[\"view\"]}]', NULL, NULL, '2023-04-09 12:25:39', 1, '2023-04-09 12:25:39', 1, 0),
(96, 0, 'folder 7', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', '[{\"user\":\"2\",\"role\":[\"view\"]}]', NULL, NULL, '2023-04-09 12:31:29', 1, '2023-04-14 14:28:47', 1, 1),
(97, 0, 'folder 8', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', '[{\"user\":1,\"role\":[\"view\"]}]', NULL, NULL, '2023-04-09 21:11:45', 2, '2023-04-09 21:11:45', 2, 0),
(98, 0, 'Lorem Ipsum Adalah.docx', 0, 1, 80, 0, '0123', 'Lorem Indonesia', NULL, NULL, NULL, 'file', 'docx', '12.85 KB', 'Versi Indonesia', NULL, NULL, NULL, '2023-04-12 09:35:28', 1, '2023-04-12 09:35:28', 1, 0),
(99, 97, 'EF_TestResult-1.pdf', 0, NULL, NULL, NULL, '1234', 'test 1', NULL, NULL, '[]', 'file', 'pdf', '118.92 KB', 'file test', NULL, NULL, NULL, '2023-04-14 09:39:04', 1, '2023-04-14 10:52:09', 1, 1),
(100, 97, 'EF_TestResult-1.pdf', 0, NULL, NULL, NULL, '123213', 'test file 2', NULL, NULL, '[]', 'file', 'pdf', '118.92 KB', 'test', NULL, NULL, NULL, '2023-04-14 11:02:27', 1, '2023-04-14 13:47:06', 1, 0),
(101, 0, 'folder 9', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', '[{\"user\":2,\"role\":[\"view\"]},{\"user\":4,\"role\":[\"view\"]}]', NULL, NULL, '2023-04-14 12:32:50', 1, '2023-04-14 14:01:11', 1, 1),
(102, 97, 'Laporan Progress Mingguan (06 April 2023).docx', 1, 1, 100, 100, '123213', 'test file 2', NULL, NULL, NULL, 'file', 'docx', '447.55 KB', 'test', NULL, NULL, NULL, '2023-04-14 12:34:11', 1, '2023-04-14 12:34:42', 1, 1),
(103, 97, 'RAK_08.docx', 1, 1, 100, 100, '123213', 'test file 2', NULL, NULL, NULL, 'file', 'docx', '155.61 KB', 'test', NULL, NULL, NULL, '2023-04-14 13:13:23', 1, '2023-04-14 13:30:28', 1, 1),
(104, 97, 'Lorem Ipsum Adalah.docx', 0, NULL, NULL, NULL, '56645345', 'test upload lagi', NULL, NULL, '[]', 'file', 'docx', '12.85 KB', '', NULL, NULL, NULL, '2023-04-14 13:43:51', 1, '2023-04-14 13:44:14', 1, 1),
(105, 97, 'Lorem Ipsum Adalah.docx', 0, NULL, NULL, NULL, '43434', 'test kesekian Kali nya', NULL, NULL, '[]', 'file', 'docx', '12.85 KB', '', NULL, NULL, NULL, '2023-04-14 13:46:04', 1, '2023-04-14 13:46:15', 1, 1),
(106, 97, 'RAK_08.docx', 1, 1, 100, 100, '123213', 'test file 2', NULL, NULL, NULL, 'file', 'docx', '155.61 KB', 'test', NULL, NULL, NULL, '2023-04-14 13:46:35', 1, '2023-04-14 13:47:06', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_form`
--

CREATE TABLE `tbl_form` (
  `form_id` int(11) NOT NULL,
  `form` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '0=No; 1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_form`
--

INSERT INTO `tbl_form` (`form_id`, `form`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_deleted`) VALUES
(1, 'Sakit', '2023-04-27 09:30:54', 1, '2023-04-27 09:30:54', 1, 0),
(2, 'Peminjaman', '2023-04-27 09:31:54', 1, '2023-04-27 09:31:54', 1, 0),
(3, 'Izin', '2023-04-27 09:32:54', 1, '2023-04-27 09:32:54', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_jenis_peminjaman`
--

CREATE TABLE `tbl_jenis_peminjaman` (
  `jenis_peminjaman_id` int(11) NOT NULL,
  `jenis_peminjaman` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '0=No; 1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_jenis_peminjaman`
--

INSERT INTO `tbl_jenis_peminjaman` (`jenis_peminjaman_id`, `jenis_peminjaman`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_deleted`) VALUES
(1, 'Office365', '2023-04-27 09:30:54', 1, '2023-04-27 09:30:54', 1, 0),
(2, 'Ruangan', '2023-04-27 09:31:54', 1, '2023-04-27 09:31:54', 1, 0),
(3, 'Proyektor', '2023-04-27 09:32:54', 1, '2023-04-27 09:32:54', 1, 0);

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
(210, 37, 'open', 'folder', 'membuka folder Alpro', '2023-02-18 12:05:52', 1, '2023-02-18 12:05:52', 1, 0),
(211, 71, 'open', 'folder', 'membuka folder Android Folder 3', '2023-02-22 11:54:57', 1, '2023-02-22 11:54:57', 1, 0),
(212, 69, 'update', 'folder', 'mengubah attribut pada folder Android Folder 1', '2023-02-23 10:44:58', 1, '2023-02-23 10:44:58', 1, 0),
(213, 71, 'update', 'folder', 'mengubah attribut pada folder Android Folder 3', '2023-02-23 10:45:12', 1, '2023-02-23 10:45:12', 1, 0),
(214, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-03-30 11:05:50', 1, '2023-03-30 11:05:50', 1, 0),
(215, 18, 'open', 'folder', 'membuka folder B. Indonesia', '2023-03-30 11:06:16', 1, '2023-03-30 11:06:16', 1, 0),
(216, 32, 'open', 'folder', 'membuka folder Statistika Dasar', '2023-03-30 11:06:20', 1, '2023-03-30 11:06:20', 1, 0),
(217, 37, 'open', 'folder', 'membuka folder Alpro', '2023-03-30 11:06:23', 1, '2023-03-30 11:06:23', 1, 0),
(218, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-03-31 10:54:20', 1, '2023-03-31 10:54:20', 1, 0),
(219, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-03-31 11:25:01', 1, '2023-03-31 11:25:01', 1, 0),
(220, 8, 'open', 'folder', 'membuka folder Minggu 1', '2023-03-31 11:25:06', 1, '2023-03-31 11:25:06', 1, 0),
(221, 25, 'open', 'folder', 'membuka folder Keagamaan', '2023-03-31 11:38:18', 1, '2023-03-31 11:38:18', 1, 0),
(222, 75, 'open', 'folder', 'membuka folder Child Folder From API', '2023-03-31 12:35:43', 1, '2023-03-31 12:35:43', 1, 0),
(223, 74, 'open', 'folder', 'membuka folder Folder From API', '2023-03-31 12:35:48', 1, '2023-03-31 12:35:48', 1, 0),
(224, 78, 'create', 'folder', 'membuat folder baru dengan nama API untuk Folder', '2023-03-31 12:52:38', 2, '2023-03-31 12:52:38', 2, 0),
(225, 78, 'open', 'folder', 'membuka folder API untuk Folder', '2023-03-31 12:52:39', 2, '2023-03-31 12:52:39', 2, 0),
(226, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-04-04 09:16:03', 1, '2023-04-04 09:16:03', 1, 0),
(227, 18, 'open', 'folder', 'membuka folder B. Indonesia', '2023-04-04 09:16:21', 1, '2023-04-04 09:16:21', 1, 0),
(228, 25, 'open', 'folder', 'membuka folder Keagamaan', '2023-04-04 09:16:32', 1, '2023-04-04 09:16:32', 1, 0),
(229, 83, 'open', 'folder', 'membuka folder Folder From Android 2', '2023-04-05 14:00:52', 2, '2023-04-05 14:00:52', 2, 0),
(230, 87, 'revisi', 'file', 'melakukan revisi dengan file baru FileDocFinal.docx', '2023-04-08 11:21:28', 1, '2023-04-08 11:21:28', 1, 0),
(231, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-04-08 11:21:50', 1, '2023-04-08 11:21:50', 1, 0),
(232, 4, 'open', 'folder', 'membuka folder Project Android - POS', '2023-04-08 11:22:22', 1, '2023-04-08 11:22:22', 1, 0),
(233, 88, 'revisi', 'file', 'melakukan revisi dengan file baru FileDocTerbaru.docx', '2023-04-08 11:22:47', 1, '2023-04-08 11:22:47', 1, 0),
(234, 89, 'revisi', 'file', 'melakukan revisi dengan file baru Lorem Ipsum Adalah.docx', '2023-04-08 11:23:26', 1, '2023-04-08 11:23:26', 1, 0),
(235, 91, 'create', 'folder', 'membuat folder baru dengan nama Folder 2', '2023-04-09 09:46:09', 1, '2023-04-09 09:46:09', 1, 0),
(236, 91, 'open', 'folder', 'membuka folder Folder 2', '2023-04-09 09:46:09', 1, '2023-04-09 09:46:09', 1, 0),
(237, 91, 'open', 'folder', 'membuka folder Folder 2', '2023-04-09 10:02:53', 1, '2023-04-09 10:02:53', 1, 0),
(238, 92, 'create', 'folder', 'membuat folder baru dengan nama folder 3', '2023-04-09 10:06:09', 1, '2023-04-09 10:06:09', 1, 0),
(239, 92, 'open', 'folder', 'membuka folder folder 3', '2023-04-09 10:06:09', 1, '2023-04-09 10:06:09', 1, 0),
(240, 93, 'create', 'folder', 'membuat folder baru dengan nama folder 4', '2023-04-09 10:39:25', 1, '2023-04-09 10:39:25', 1, 0),
(241, 93, 'open', 'folder', 'membuka folder folder 4', '2023-04-09 10:39:26', 1, '2023-04-09 10:39:26', 1, 0),
(242, 94, 'create', 'folder', 'membuat folder baru dengan nama folder 5', '2023-04-09 11:10:58', 1, '2023-04-09 11:10:58', 1, 0),
(243, 94, 'open', 'folder', 'membuka folder folder 5', '2023-04-09 11:10:58', 1, '2023-04-09 11:10:58', 1, 0),
(244, 94, 'open', 'folder', 'membuka folder folder 5', '2023-04-09 11:50:04', 1, '2023-04-09 11:50:04', 1, 0),
(245, 94, 'open', 'folder', 'membuka folder folder 5', '2023-04-09 12:25:26', 1, '2023-04-09 12:25:26', 1, 0),
(246, 95, 'create', 'folder', 'membuat folder baru dengan nama folder 6', '2023-04-09 12:25:55', 1, '2023-04-09 12:25:55', 1, 0),
(247, 95, 'open', 'folder', 'membuka folder folder 6', '2023-04-09 12:25:55', 1, '2023-04-09 12:25:55', 1, 0),
(248, 96, 'create', 'folder', 'membuat folder baru dengan nama folder 7', '2023-04-09 12:31:40', 1, '2023-04-09 12:31:40', 1, 0),
(249, 96, 'open', 'folder', 'membuka folder folder 7', '2023-04-09 12:31:41', 1, '2023-04-09 12:31:41', 1, 0),
(250, 98, 'revisi', 'file', 'melakukan revisi dengan file baru Lorem Ipsum Adalah.docx', '2023-04-12 09:35:28', 1, '2023-04-12 09:35:28', 1, 0),
(251, 97, 'open', 'folder', 'membuka folder folder 8', '2023-04-14 09:39:12', 1, '2023-04-14 09:39:12', 1, 0),
(252, 97, 'open', 'folder', 'membuka folder folder 8', '2023-04-14 10:58:41', 1, '2023-04-14 10:58:41', 1, 0),
(253, 97, 'open', 'folder', 'membuka folder folder 8', '2023-04-14 12:33:52', 1, '2023-04-14 12:33:52', 1, 0),
(254, 102, 'revisi', 'file', 'melakukan revisi dengan file baru Laporan Progress Mingguan (06 April 2023).docx', '2023-04-14 12:34:11', 1, '2023-04-14 12:34:11', 1, 0),
(255, 97, 'open', 'folder', 'membuka folder folder 8', '2023-04-14 12:34:11', 1, '2023-04-14 12:34:11', 1, 0),
(256, 100, 'rollback', 'file', 'melakukan rollback pada file Laporan Progress Mingguan (06 April 2023).docx', '2023-04-14 12:34:42', 1, '2023-04-14 12:34:42', 1, 0),
(257, 97, 'open', 'folder', 'membuka folder folder 8', '2023-04-14 13:12:34', 1, '2023-04-14 13:12:34', 1, 0),
(258, 103, 'revisi', 'file', 'melakukan revisi dengan file baru RAK_08.docx', '2023-04-14 13:13:23', 1, '2023-04-14 13:13:23', 1, 0),
(259, 97, 'open', 'folder', 'membuka folder folder 8', '2023-04-14 13:13:24', 1, '2023-04-14 13:13:24', 1, 0),
(260, 97, 'open', 'folder', 'membuka folder folder 8', '2023-04-14 13:46:23', 1, '2023-04-14 13:46:23', 1, 0),
(261, 106, 'revisi', 'file', 'melakukan revisi dengan file baru RAK_08.docx', '2023-04-14 13:46:35', 1, '2023-04-14 13:46:35', 1, 0),
(262, 79, 'open', 'file', 'membuka file What is Lorem Ipsum.docx', '2023-04-27 09:15:59', 1, '2023-04-27 09:15:59', 1, 0),
(263, 79, 'open', 'file', 'membuka file What is Lorem Ipsum.docx', '2023-04-27 09:16:00', 1, '2023-04-27 09:16:00', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_permohonan`
--

CREATE TABLE `tbl_permohonan` (
  `permohonan_id` int(11) NOT NULL,
  `form_id` int(11) DEFAULT NULL,
  `jenis_peminjaman_id` int(11) DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `nrp` varchar(255) DEFAULT NULL,
  `nama` varchar(255) DEFAULT NULL,
  `universitas` varchar(255) DEFAULT NULL,
  `keterangan` varchar(255) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `is_open_for_notif` int(1) DEFAULT NULL,
  `response_by` int(11) DEFAULT NULL,
  `alasan` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '0=No; 1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_permohonan`
--

INSERT INTO `tbl_permohonan` (`permohonan_id`, `form_id`, `jenis_peminjaman_id`, `perihal`, `nrp`, `nama`, `universitas`, `keterangan`, `date_start`, `date_end`, `status`, `is_open_for_notif`, `response_by`, `alasan`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_deleted`) VALUES
(1, 2, 1, 'Peminjaman Office 365', 'c14190074', 'Agung', 'UKP', 'Peminjaman untuk presentasi LEAP', '2023-05-07 00:00:00', '2023-04-30 10:40:57', 'draft', 0, NULL, '', '2023-04-30 10:40:57', 1, '2023-04-30 10:40:57', 1, 0),
(2, 1, 0, 'izin cuti kerja', 'c14190074', 'agung', 'ukp', 'sakit perut', '2023-05-02 00:00:00', '2023-04-30 10:46:45', 'draft', 0, NULL, '', '2023-04-30 10:46:45', 1, '2023-04-30 10:46:45', 1, 0),
(3, 3, 0, 'pulang kampung', 'c14190074', 'agung', 'ukp', 'izin pulang mudik', '2023-05-09 00:00:00', '2023-04-30 11:05:54', 'draft', 0, NULL, '', '2023-04-30 11:05:54', 1, '2023-04-30 11:05:54', 1, 0),
(4, 1, 0, 'Sakit', 'C14190001', 'Mikael', 'Universitas Kristen Petra', 'Sakit Perut', '2023-05-03 00:00:00', '2023-05-02 16:13:56', 'draft', 0, NULL, '', '2023-05-02 16:13:56', 2, '2023-05-02 16:13:56', 2, 0),
(5, 2, 1, 'Pinjam', 'C14190002', 'Budi', 'Universitas Kristen Petra', 'Acara Perpisahan', '2023-05-04 00:00:00', '2023-05-02 16:26:16', 'draft', 0, NULL, '', '2023-05-02 16:26:16', 2, '2023-05-02 16:26:16', 2, 0),
(6, 3, 0, 'Izin', 'C14190010', 'Judika', 'Universitas Kristen Petra', 'Acara Keluarga', '2023-05-08 00:00:00', '2023-05-04 10:31:58', 'approved', 0, NULL, '', '2023-05-04 10:31:58', 5, '2023-05-04 10:32:25', 5, 0),
(7, 2, 1, 'Pinjam Ruangan', 'C14190099', 'Vincent', 'Universitas Kristen Petra', 'Meeting', '2023-05-08 00:00:00', '2023-05-04 10:34:45', 'rejected', 0, NULL, '', '2023-05-04 10:34:45', 5, '2023-05-04 10:35:26', 5, 0),
(8, 3, 0, 'Izin', 'C14190075', 'Rudi', 'Universitas Kristen Petra', 'Acara Keluarga', '2023-05-08 00:00:00', '2023-05-04 11:01:17', 'approved', 0, NULL, '', '2023-05-04 11:01:17', 5, '2023-05-04 11:07:00', 5, 0),
(9, 1, 0, 'Sakit', 'C14190008', 'Jovin', 'Universitas Kristen Petra', 'Sakit', '2023-05-05 00:00:00', '2023-05-04 15:51:55', 'draft', 0, NULL, '', '2023-05-04 15:51:55', 5, '2023-05-04 15:51:55', 5, 0);

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
(2, 1, 'Delvo Anderson', 'delvo@email.com', 'urrnRO/83iY=', '081342334534', NULL, NULL, 1, 1, NULL, '9378434021479912', '8MD2RPBW91SZNXI7', '2023-01-25 12:39:43', 3, '2023-01-25 12:39:43', 3, 0),
(3, 0, 'Jonas Andreas', 'jonas@email.com', 'yYROW/X4cLI=', '081358126547', NULL, NULL, 1, 1, NULL, '3783289032730952', 'CNY0GMIWE6DUK4FR', '2023-01-25 12:40:25', 3, '2023-02-06 11:28:03', 3, 0),
(4, 0, 'Kevin Adrian', 'kevin@email.com', 'hhnajCW4FFI=', '081323453557', NULL, NULL, 1, 1, NULL, '7122781872373108', 'YZTI658FBMCNSH21', '2023-02-14 10:03:30', 1, '2023-02-14 10:03:30', 1, 0),
(5, 0, 'Client', 'client@email.com', 'upKBqrMXxY4=', '081234567899', NULL, NULL, 1, 1, NULL, '2486660393868088', 'RNMGXFK8EQ4D21O3', '2023-05-04 10:10:26', 1, '2023-05-04 10:10:26', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_api_login`
--

CREATE TABLE `tbl_user_api_login` (
  `api_login_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `clock_in` datetime DEFAULT NULL,
  `clock_out` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_user_api_login`
--

INSERT INTO `tbl_user_api_login` (`api_login_id`, `user_id`, `clock_in`, `clock_out`) VALUES
(1, 1, '2023-02-22 09:30:54', '2023-02-22 09:31:43'),
(2, 1, '2023-02-22 09:31:44', '2023-02-22 09:33:21'),
(3, 1, '2023-02-22 09:36:10', '2023-02-22 11:35:37'),
(4, 1, '2023-02-22 11:35:37', '2023-03-29 10:19:17'),
(5, 1, '2023-03-29 10:19:17', '2023-03-29 10:19:58'),
(6, 1, '2023-03-29 10:19:58', '2023-03-29 10:23:44'),
(7, 1, '2023-03-29 10:23:44', '2023-03-29 10:36:29'),
(8, 1, '2023-03-29 10:36:29', '2023-03-29 10:37:08'),
(9, 1, '2023-03-29 10:42:09', '2023-03-29 10:52:04'),
(10, 1, '2023-03-29 10:52:04', '2023-03-29 11:44:42'),
(11, 2, '2023-03-29 11:20:11', '2023-03-29 13:04:22'),
(12, 1, '2023-03-29 11:44:42', '2023-03-29 13:11:15'),
(13, 2, '2023-03-29 13:04:22', '2023-03-31 12:50:58'),
(14, 1, '2023-03-29 13:11:15', '2023-03-30 10:51:08'),
(15, 1, '2023-03-30 10:51:08', '2023-03-30 11:01:22'),
(16, 1, '2023-03-30 11:01:22', '2023-03-30 11:41:14'),
(17, 1, '2023-03-30 11:41:14', '2023-03-30 14:05:33'),
(18, 1, '2023-03-30 14:05:33', '2023-03-30 14:29:09'),
(19, 1, '2023-03-30 14:29:09', '2023-03-30 15:25:26'),
(20, 1, '2023-03-30 15:25:26', '2023-03-31 10:06:24'),
(21, 1, '2023-03-31 10:06:24', '2023-03-31 10:59:53'),
(22, 1, '2023-03-31 10:59:53', '2023-03-31 11:01:10'),
(23, 1, '2023-03-31 11:01:10', '2023-03-31 11:23:46'),
(24, 1, '2023-03-31 11:23:46', '2023-03-31 12:19:04'),
(25, 1, '2023-03-31 12:19:04', '2023-03-31 12:19:31'),
(26, 1, '2023-03-31 12:19:31', '2023-03-31 12:52:44'),
(27, 2, '2023-03-31 12:50:58', '2023-04-05 13:56:44'),
(28, 1, '2023-03-31 12:52:45', '2023-03-31 15:28:39'),
(29, 1, '2023-03-31 15:28:39', '2023-04-01 10:34:18'),
(30, 1, '2023-04-01 10:34:18', '2023-04-02 10:23:58'),
(31, 1, '2023-04-02 10:23:58', '2023-04-02 21:46:05'),
(32, 1, '2023-04-02 21:46:05', '2023-04-02 21:47:49'),
(33, 1, '2023-04-02 21:47:49', '2023-04-02 22:15:47'),
(34, 1, '2023-04-02 22:15:47', '2023-04-04 09:00:56'),
(35, 1, '2023-04-04 09:00:56', '2023-04-04 10:42:30'),
(36, 1, '2023-04-04 10:42:30', '2023-04-04 10:45:32'),
(37, 1, '2023-04-04 10:45:32', '2023-04-04 10:47:36'),
(38, 1, '2023-04-04 10:47:36', '2023-04-04 11:23:43'),
(39, 1, '2023-04-04 11:23:43', '2023-04-04 11:24:50'),
(40, 1, '2023-04-04 11:24:51', '2023-04-04 13:16:58'),
(41, 1, '2023-04-04 13:16:58', '2023-04-04 13:38:12'),
(42, 1, '2023-04-04 13:38:12', '2023-04-04 13:39:57'),
(43, 1, '2023-04-04 13:39:57', '2023-04-05 09:56:42'),
(44, 1, '2023-04-05 09:56:42', '2023-04-05 11:36:17'),
(45, 1, '2023-04-05 11:36:17', '2023-04-05 11:37:59'),
(46, 1, '2023-04-05 11:37:59', '2023-04-05 12:56:45'),
(47, 1, '2023-04-05 12:56:45', '2023-04-05 13:22:51'),
(48, 1, '2023-04-05 13:22:51', '2023-04-05 13:48:51'),
(49, 1, '2023-04-05 13:48:51', '2023-04-05 14:03:19'),
(50, 2, '2023-04-05 13:56:44', '2023-04-05 13:59:26'),
(51, 2, '2023-04-05 13:59:26', '2023-04-08 09:44:40'),
(52, 1, '2023-04-05 14:03:19', '2023-04-05 19:29:33'),
(53, 1, '2023-04-05 19:29:33', '2023-04-05 19:30:42'),
(54, 1, '2023-04-05 19:30:42', '2023-04-05 19:42:02'),
(55, 1, '2023-04-05 19:42:02', '2023-04-05 19:53:02'),
(56, 1, '2023-04-05 19:53:02', '2023-04-05 19:56:15'),
(57, 1, '2023-04-05 19:56:15', '2023-04-07 09:46:04'),
(58, 1, '2023-04-07 09:46:04', '2023-04-07 11:26:55'),
(59, 1, '2023-04-07 11:26:55', '2023-04-07 11:34:45'),
(60, 1, '2023-04-07 11:34:45', '2023-04-07 12:07:57'),
(61, 1, '2023-04-07 12:07:57', '2023-04-07 12:08:28'),
(62, 1, '2023-04-07 12:08:28', '2023-04-07 12:10:14'),
(63, 1, '2023-04-07 12:10:14', '2023-04-08 09:45:56'),
(64, 2, '2023-04-08 09:44:40', '2023-04-09 09:41:55'),
(65, 1, '2023-04-08 09:45:56', '2023-04-08 11:53:01'),
(66, 1, '2023-04-08 11:53:01', '2023-04-08 11:57:47'),
(67, 1, '2023-04-08 11:57:47', '2023-04-08 11:58:18'),
(68, 1, '2023-04-08 11:58:18', '2023-04-08 12:02:52'),
(69, 1, '2023-04-08 12:02:52', '2023-04-08 13:23:27'),
(70, 1, '2023-04-08 13:23:27', '2023-04-08 13:26:50'),
(71, 1, '2023-04-08 13:26:50', '2023-04-11 09:30:52'),
(72, 4, '2023-04-09 09:41:30', NULL),
(73, 2, '2023-04-09 09:41:55', '2023-05-02 16:00:35'),
(74, 1, '2023-04-11 09:30:52', '2023-04-11 15:20:09'),
(75, 1, '2023-04-11 15:20:09', '2023-04-11 15:23:14'),
(76, 1, '2023-04-11 15:23:14', '2023-04-12 08:46:24'),
(77, 1, '2023-04-12 08:46:24', '2023-04-12 13:41:15'),
(78, 1, '2023-04-12 13:41:15', '2023-04-12 13:49:53'),
(79, 1, '2023-04-12 13:49:53', '2023-04-14 09:37:03'),
(80, 1, '2023-04-14 09:37:03', '2023-04-24 19:27:08'),
(81, 1, '2023-04-24 19:27:08', '2023-04-26 09:08:03'),
(82, 1, '2023-04-26 09:08:03', '2023-04-26 10:08:11'),
(83, 1, '2023-04-26 10:08:11', '2023-04-26 10:33:47'),
(84, 1, '2023-04-26 10:33:48', '2023-04-26 13:21:49'),
(85, 1, '2023-04-26 13:21:49', '2023-04-26 15:00:27'),
(86, 1, '2023-04-26 15:00:27', '2023-04-27 08:37:50'),
(87, 1, '2023-04-27 08:37:50', '2023-04-27 08:40:00'),
(88, 1, '2023-04-27 08:40:00', '2023-04-28 09:49:52'),
(89, 1, '2023-04-28 09:49:52', '2023-04-28 10:14:12'),
(90, 1, '2023-04-28 10:14:13', '2023-04-28 11:43:51'),
(91, 1, '2023-04-28 11:43:51', '2023-05-02 11:08:37'),
(92, 1, '2023-05-02 11:08:37', '2023-05-02 11:17:12'),
(93, 1, '2023-05-02 11:17:12', '2023-05-02 13:27:05'),
(94, 1, '2023-05-02 13:27:05', '2023-05-02 15:34:04'),
(95, 1, '2023-05-02 15:34:04', '2023-05-02 15:37:56'),
(96, 1, '2023-05-02 15:37:56', '2023-05-07 19:56:13'),
(97, 2, '2023-05-02 16:00:35', '2023-05-02 16:00:59'),
(98, 2, '2023-05-02 16:00:59', '2023-05-02 16:24:56'),
(99, 2, '2023-05-02 16:24:57', '2023-05-03 08:56:37'),
(100, 2, '2023-05-03 08:56:37', '2023-05-04 08:43:16'),
(101, 2, '2023-05-04 08:43:16', '2023-05-04 09:51:43'),
(102, 2, '2023-05-04 09:51:43', '2023-05-04 09:53:12'),
(103, 2, '2023-05-04 09:53:12', '2023-05-04 09:53:18'),
(104, 2, '2023-05-04 09:53:18', '2023-05-04 09:53:20'),
(105, 2, '2023-05-04 09:53:20', '2023-05-04 09:53:22'),
(106, 2, '2023-05-04 09:53:22', '2023-05-04 09:53:51'),
(107, 2, '2023-05-04 09:53:51', '2023-05-04 09:53:51'),
(108, 2, '2023-05-04 09:53:51', '2023-05-04 09:53:51'),
(109, 2, '2023-05-04 09:53:52', '2023-05-04 09:53:52'),
(110, 2, '2023-05-04 09:53:52', '2023-05-04 09:56:30'),
(111, 2, '2023-05-04 09:56:30', '2023-05-04 09:56:35'),
(112, 2, '2023-05-04 09:56:35', '2023-05-04 10:00:08'),
(113, 2, '2023-05-04 10:00:08', '2023-05-04 10:02:34'),
(114, 2, '2023-05-04 10:02:34', '2023-05-04 10:18:47'),
(115, 5, '2023-05-04 10:16:59', '2023-05-04 10:30:25'),
(116, 2, '2023-05-04 10:18:47', '2023-05-04 10:29:34'),
(117, 2, '2023-05-04 10:29:34', '2023-05-04 10:32:15'),
(118, 5, '2023-05-04 10:30:25', '2023-05-04 10:32:43'),
(119, 2, '2023-05-04 10:32:15', '2023-05-04 10:35:16'),
(120, 5, '2023-05-04 10:32:43', '2023-05-04 10:35:49'),
(121, 2, '2023-05-04 10:35:16', '2023-05-04 10:36:07'),
(122, 5, '2023-05-04 10:35:49', '2023-05-04 10:45:44'),
(123, 2, '2023-05-04 10:36:07', '2023-05-04 10:46:13'),
(124, 5, '2023-05-04 10:45:44', '2023-05-04 10:47:42'),
(125, 2, '2023-05-04 10:46:13', '2023-05-04 10:47:30'),
(126, 2, '2023-05-04 10:47:30', '2023-05-04 10:50:23'),
(127, 5, '2023-05-04 10:47:42', '2023-05-04 10:51:14'),
(128, 2, '2023-05-04 10:50:23', '2023-05-04 10:55:55'),
(129, 5, '2023-05-04 10:51:14', '2023-05-04 10:53:00'),
(130, 5, '2023-05-04 10:53:00', '2023-05-04 10:57:40'),
(131, 2, '2023-05-04 10:55:55', '2023-05-04 11:03:41'),
(132, 5, '2023-05-04 10:57:40', '2023-05-04 15:43:26'),
(133, 2, '2023-05-04 11:03:41', '2023-05-04 11:27:38'),
(134, 2, '2023-05-04 11:27:38', NULL),
(135, 5, '2023-05-04 15:43:26', '2023-05-04 15:43:26'),
(136, 5, '2023-05-04 15:43:27', '2023-05-04 15:45:03'),
(137, 5, '2023-05-04 15:45:03', '2023-05-04 15:50:53'),
(138, 5, '2023-05-04 15:50:53', '2023-05-04 16:24:34'),
(139, 5, '2023-05-04 16:24:34', NULL),
(140, 1, '2023-05-07 19:56:13', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_folder`
--
ALTER TABLE `tbl_folder`
  ADD PRIMARY KEY (`folder_id`);

--
-- Indexes for table `tbl_form`
--
ALTER TABLE `tbl_form`
  ADD PRIMARY KEY (`form_id`);

--
-- Indexes for table `tbl_jenis_peminjaman`
--
ALTER TABLE `tbl_jenis_peminjaman`
  ADD PRIMARY KEY (`jenis_peminjaman_id`);

--
-- Indexes for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  ADD PRIMARY KEY (`logs_id`);

--
-- Indexes for table `tbl_permohonan`
--
ALTER TABLE `tbl_permohonan`
  ADD PRIMARY KEY (`permohonan_id`);

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `tbl_user_api_login`
--
ALTER TABLE `tbl_user_api_login`
  ADD PRIMARY KEY (`api_login_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_folder`
--
ALTER TABLE `tbl_folder`
  MODIFY `folder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- AUTO_INCREMENT for table `tbl_form`
--
ALTER TABLE `tbl_form`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_jenis_peminjaman`
--
ALTER TABLE `tbl_jenis_peminjaman`
  MODIFY `jenis_peminjaman_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_logs`
--
ALTER TABLE `tbl_logs`
  MODIFY `logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `tbl_permohonan`
--
ALTER TABLE `tbl_permohonan`
  MODIFY `permohonan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_user_api_login`
--
ALTER TABLE `tbl_user_api_login`
  MODIFY `api_login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=141;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
