-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 31, 2023 at 04:11 AM
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
-- Table structure for table `tbl_file`
--

CREATE TABLE `tbl_file` (
  `file_id` int(11) NOT NULL,
  `folder_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT '0',
  `nomer` varchar(255) DEFAULT NULL,
  `perihal` varchar(255) DEFAULT NULL,
  `unit_kerja` varchar(255) DEFAULT NULL,
  `keyword` varchar(255) DEFAULT NULL,
  `related_document` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '0=No; 1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_file`
--

INSERT INTO `tbl_file` (`file_id`, `folder_id`, `name`, `nomer`, `perihal`, `unit_kerja`, `keyword`, `related_document`, `description`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_deleted`) VALUES
(1, NULL, 'EF_TestResult.pdf', '270120231701', 'Hasil Test EF', '1701', '#hasil,#test', 'Single Document', 'Format pdf', '2023-01-27 17:01:44', 1, '2023-01-27 17:01:44', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_folder`
--

CREATE TABLE `tbl_folder` (
  `folder_id` int(11) NOT NULL,
  `folder_parent_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT 'folder',
  `format` varchar(255) DEFAULT NULL,
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

INSERT INTO `tbl_folder` (`folder_id`, `folder_parent_id`, `name`, `type`, `format`, `description`, `user_access`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_deleted`) VALUES
(1, 0, 'UK Petra 2019', 'folder', NULL, 'Data kuliah', NULL, '2023-01-25 12:41:09', 3, '2023-01-25 12:41:09', 3, 0),
(2, 0, 'Pelindo', 'folder', NULL, '', NULL, '2023-01-25 12:57:53', 1, '2023-01-26 16:26:40', 1, 1),
(3, 0, 'Project POS', 'folder', NULL, '', NULL, '2023-01-25 12:58:52', 3, '2023-01-25 12:58:52', 3, 0),
(4, 0, 'Project Android - POS', 'folder', NULL, '', '[\"1\"]', '2023-01-25 12:59:15', 3, '2023-01-26 10:56:27', 3, 0),
(5, 0, 'Project Android - DMS', 'folder', NULL, 'Project android untuk Leap', '[\"1\",\"2\"]', '2023-01-26 10:08:23', 3, '2023-01-26 10:08:23', 3, 0),
(6, 0, 'SMK N 1 Tuban', 'folder', NULL, 'Data sekolah', NULL, '2023-01-26 16:15:23', 1, '2023-01-26 16:25:11', 1, 1),
(7, 2, 'Pertemuan 1', 'folder', NULL, 'Diskusi fitur app', NULL, '2023-01-26 16:26:09', 1, '2023-01-26 16:26:31', 1, 1),
(8, 4, 'Minggu 1', 'folder', NULL, '01 Jan - 8 Jan 2023', NULL, '2023-01-27 17:05:38', 1, '2023-01-27 17:05:38', 1, 0);

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
-- Indexes for table `tbl_file`
--
ALTER TABLE `tbl_file`
  ADD PRIMARY KEY (`file_id`);

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
-- AUTO_INCREMENT for table `tbl_file`
--
ALTER TABLE `tbl_file`
  MODIFY `file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_folder`
--
ALTER TABLE `tbl_folder`
  MODIFY `folder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
