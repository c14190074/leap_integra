-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2023 at 10:16 AM
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
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '0=No; 1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_folder`
--

INSERT INTO `tbl_folder` (`folder_id`, `folder_parent_id`, `name`, `is_revision`, `no_revision`, `original_id`, `nomor`, `perihal`, `unit_kerja`, `keyword`, `related_document`, `type`, `format`, `size`, `description`, `user_access`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_deleted`) VALUES
(1, 0, 'UK Petra 2019', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Data kuliah', NULL, '2023-01-25 12:41:09', 3, '2023-01-25 12:41:09', 3, 0),
(2, 0, 'Pelindo', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, '2023-01-25 12:57:53', 1, '2023-01-26 16:26:40', 1, 1),
(3, 0, 'Project POS', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, '2023-01-25 12:58:52', 3, '2023-01-25 12:58:52', 3, 0),
(4, 0, 'Project Android - POS', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '', NULL, '2023-01-25 12:59:15', 3, '2023-01-26 10:56:27', 3, 0),
(5, 0, 'Project Android - DMS', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Project android untuk Leap', NULL, '2023-01-26 10:08:23', 3, '2023-01-26 10:08:23', 3, 0),
(6, 0, 'SMK N 1 Tuban', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Data sekolah', NULL, '2023-01-26 16:15:23', 1, '2023-01-26 16:25:11', 1, 1),
(7, 2, 'Pertemuan 1', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Diskusi fitur app', NULL, '2023-01-26 16:26:09', 1, '2023-01-26 16:26:31', 1, 1),
(8, 4, 'Minggu 1', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, '01 Jan - 8 Jan 2023', NULL, '2023-01-27 17:05:38', 1, '2023-01-31 11:59:33', 1, 0),
(10, 4, 'Document 1.pdf', 0, 0, 0, '310120231121', 'readme project minggu 1', '1121', '#project,#readme', NULL, 'file', 'pdf', '118.92 KB', 'penjelasan project minggu 1', NULL, '2023-01-31 11:22:11', 1, '2023-01-31 11:22:11', 1, 0),
(11, 4, 'DesignPriceLabel - Toko.docx', 0, 0, 0, '31012023143', 'Design untuk label', '1143', '#label,#design', NULL, 'file', 'docx', '435.03 KB', 'prototype design', NULL, '2023-01-31 11:44:06', 1, '2023-02-02 08:48:38', 1, 1),
(12, 4, 'Minggu 2 v2', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Pertemuan 9 - 16 Jan 2023', NULL, '2023-01-31 12:01:29', 1, '2023-02-02 10:46:37', 1, 0),
(13, 4, 'FileDoc.docx', 0, 0, 0, '31012023143', 'lorem ipsum', '1146', '#lorem,#free,#test', NULL, 'file', 'docx', '13.34 KB', '', NULL, '2023-02-01 11:47:04', 1, '2023-02-01 11:47:04', 1, 0),
(14, 4, 'FilePDF.pdf', 0, 0, 0, '32312', 'pdf file', '1655', '', '', 'file', 'pdf', '84.9 KB', '', NULL, '2023-02-01 16:55:44', 1, '2023-02-01 16:55:44', 1, 0),
(15, 4, 'Document 2.pdf', 0, 0, 0, '02022023', 'document 2', '905', '#two', '', 'file', 'pdf', '118.92 KB', '', NULL, '2023-02-02 09:05:38', 1, '2023-02-02 09:05:38', 1, 0),
(16, 4, 'Document 3.pdf', 0, 0, 0, '02022023925', 'document 3', '925', '#tiga', '[\"10\",\"15\"]', 'file', 'pdf', '118.92 KB', '', NULL, '2023-02-02 09:26:10', 1, '2023-02-02 09:26:10', 1, 0),
(17, 8, 'Document 4.pdf', 0, 0, 0, '020220231041', 'doc4', '1041', '#document', '[\"13\"]', 'file', 'pdf', '118.92 KB', 'test document', NULL, '2023-02-02 10:42:13', 1, '2023-02-02 10:42:13', 1, 0),
(18, 0, 'Project B. Indo', 0, 0, 0, NULL, NULL, NULL, NULL, NULL, 'folder', NULL, NULL, 'Semester 1', '[{\"user\":\"2\",\"role\":[\"view\"]},{\"user\":\"3\",\"role\":[\"view\"]}]', '2023-02-02 10:47:27', 1, '2023-02-04 13:14:26', 1, 0),
(19, 18, 'FileDoc.docx', 0, 0, 0, '125704022023', 'test', '1257', '#tes', '[\"15\"]', 'file', 'docx', '13.34 KB', '', '[{\"user\":\"2\",\"role\":[\"view\"]},{\"user\":\"3\",\"role\":[\"view\",\"edit\"]}]', '2023-02-04 12:59:21', 1, '2023-02-04 12:59:21', 1, 0),
(20, 18, 'Document 4.pdf', 0, 0, 0, '32434', 'asd', '12', 'asd', NULL, 'file', 'pdf', '118.92 KB', '', '[{\"user\":\"3\",\"role\":[\"view\"]}]', '2023-02-04 13:15:19', 1, '2023-02-04 13:15:19', 1, 0),
(21, 18, 'Document 1.pdf', 0, 0, 0, '454', 'wer', '2112', 'wew', '[\"14\"]', 'file', 'pdf', '118.92 KB', 'test', '[{\"user\":\"2\",\"role\":[\"view\",\"edit\"]},{\"user\":\"3\",\"role\":[\"view\"]}]', '2023-02-04 13:52:18', 1, '2023-02-04 13:52:18', 1, 0),
(22, 18, 'FilePDF.pdf', 0, 0, 0, '34', 'fddf', '45435435', 'dss', '[\"15\"]', 'file', 'pdf', '84.9 KB', 'asdsadsa', '[{\"user\":\"3\",\"role\":[\"view\"]},{\"user\":\"2\",\"role\":[\"view\"]}]', '2023-02-04 13:53:19', 1, '2023-02-04 13:53:19', 1, 0),
(23, 18, '', NULL, NULL, NULL, '', '', '', '', NULL, 'file', 'pdf', '118.92 KB', '', NULL, '2023-02-04 15:37:35', 1, '2023-02-04 15:37:35', 1, 0),
(24, 18, 'EF_TestResult.pdf', 1, 1, 19, '125704022023', 'test', '1257', '#tes', NULL, 'file', 'pdf', '118.92 KB', 'Revisi untuk fileDoc jam 15.44', '[{\"user\":\"2\",\"role\":[\"view\"]},{\"user\":\"3\",\"role\":[\"view\",\"edit\"]}]', '2023-02-04 15:44:28', 1, '2023-02-04 15:44:28', 1, 0);

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
(1, 1, 'Agung Wibowo', 'agung@email.com', 'tsG26M+doZc=', '081356894563', NULL, NULL, 1, 1, NULL, '6143541754438333', 'MXLPR1SYD935TJVF', '2023-01-25 06:37:26', 1, '2023-01-25 06:37:26', 1, 0),
(2, 0, 'Delvo Anderson', 'delvo@email.com', 'urrnRO/83iY=', '456789874565', NULL, NULL, 1, 1, NULL, '9378434021479912', '8MD2RPBW91SZNXI7', '2023-01-25 12:39:43', 3, '2023-01-25 12:39:43', 3, 0),
(3, 0, 'jonas', 'jonas@email.com', 'yYROW/X4cLI=', '456987123654', NULL, NULL, 1, 1, NULL, '3783289032730952', 'CNY0GMIWE6DUK4FR', '2023-01-25 12:40:25', 3, '2023-01-25 12:40:25', 3, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_folder`
--
ALTER TABLE `tbl_folder`
  ADD PRIMARY KEY (`folder_id`);

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
  MODIFY `folder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
