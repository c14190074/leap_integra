-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 24, 2023 at 03:14 AM
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
  `description` varchar(255) DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `updated_on` datetime DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `is_deleted` tinyint(1) DEFAULT 0 COMMENT '0=No; 1=Yes'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_folder`
--

INSERT INTO `tbl_folder` (`folder_id`, `folder_parent_id`, `name`, `description`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_deleted`) VALUES
(1, 2, 'Leap 2023', 'leap uk. petra 2023', '2023-01-22 13:23:47', 3, '2023-01-22 13:23:47', 3, 0),
(2, 0, 'Semester 1', 'data kuliah semester 1', '2023-01-22 13:24:29', 3, '2023-01-22 13:24:29', 3, 0),
(3, 0, 'bali 2022', 'liburan akhir tahun', '2023-01-22 13:24:49', 3, '2023-01-22 13:24:49', 3, 0),
(4, 0, 'imlek 2023', 'foto-foto imlek tahun 2023 tuban', '2023-01-22 13:36:26', 3, '2023-01-22 13:36:26', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
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

INSERT INTO `tbl_user` (`user_id`, `fullname`, `email`, `password`, `phone`, `address`, `position`, `status`, `status_email`, `secret_key`, `encryption_key`, `encryption_iv`, `created_on`, `created_by`, `updated_on`, `updated_by`, `is_deleted`) VALUES
(1, 'agung wibowo', 'agun1g@gmail.com', 'nKi9kD1gum4=', '081358118511', NULL, NULL, 1, 1, NULL, '5189754027270662', '6OVKBC5JWZFA0IUT', '2023-01-17 11:26:27', NULL, '2023-01-22 11:31:37', 3, 0),
(2, 'Agung wibowo', 'agung2@gmail.com', 'pY7u8+BPOYk=', '13123', NULL, NULL, 0, 0, NULL, '4031468449187719', 'XHCM9VR3EK5IQUNL', '2023-01-17 11:30:51', NULL, '2023-01-22 11:25:12', 3, 0),
(3, 'agung tiga', 'agung3@gmail.com', 'm6L/vmbZkqY=', '4546465', NULL, NULL, 0, 0, NULL, '6546163835169557', 'GW6TFH1JLV298CAB', '2023-01-17 11:33:31', NULL, '2023-01-22 12:43:49', 3, 0),
(4, 'Agung Empat', 'agung4@email.com', 'mDZtF/raA0k=', '54654321', NULL, NULL, 0, 0, NULL, '7662792784839380', 'MIYNP5BZXFL9HT4Q', '2023-01-22 11:59:04', 3, '2023-01-22 11:59:04', 3, 0),
(5, 'agung lima', 'agung5@email.com', 'Crh3fh4k1Vs=', '1232323', NULL, NULL, 0, 0, NULL, '9651696283021357', '8YKD5TOMANCJ3XRV', '2023-01-22 12:05:04', 3, '2023-01-22 12:05:04', 3, 0),
(6, 'agung', 'agung6@email.com', 'NVZv6CuKVg4=', '1323213', NULL, NULL, 0, 0, NULL, '6957615888663111', 'G8OFU09WA7C5PMHI', '2023-01-22 12:25:04', 3, '2023-01-22 12:25:04', 3, 0),
(7, 'agung tujuh', 'agung7@email.com', 'nLZAFmg=', '1231232', NULL, NULL, 0, 0, NULL, '8459411301161311', 'RSP9UJ0LVAIMZOYC', '2023-01-22 12:28:37', 3, '2023-01-22 12:44:34', 3, 0);

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
  MODIFY `folder_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
