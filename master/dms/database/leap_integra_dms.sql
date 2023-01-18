-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2023 at 02:45 AM
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
(1, 'agung wibowo', 'agun1g@gmail.com', 'nKi9kD1gum4=', '081358118511', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2023-01-17 11:26:27', NULL, '2023-01-17 11:26:27', NULL, 0),
(2, 'Agung wibowo', 'agung2@gmail.com', 'pY7u8+BPOYk=', '13123', NULL, NULL, 0, 0, NULL, NULL, NULL, '2023-01-17 11:30:51', NULL, '2023-01-17 11:30:51', NULL, 0),
(3, 'Agung Wibowo', 'agung3@gmail.com', 'm6L/vmbZkqY=', '4546465', NULL, NULL, 0, 0, NULL, '6546163835169557', 'GW6TFH1JLV298CAB', '2023-01-17 11:33:31', NULL, '2023-01-17 11:33:31', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
