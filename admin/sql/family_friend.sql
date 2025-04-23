-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 06:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `insurance`
--

-- --------------------------------------------------------

--
-- Table structure for table `family_friend_detail`
--

CREATE TABLE `family_friend_detail` (
  `id` int(11) NOT NULL,
  `driver_id` int(11) NOT NULL,
  `first_name` varchar(252) NOT NULL,
  `last_name` varchar(252) NOT NULL,
  `email` varchar(252) DEFAULT NULL,
  `mobile_no` varchar(252) DEFAULT NULL,
  `licence_no` varchar(252) DEFAULT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city` varchar(252) DEFAULT NULL,
  `zip_code` varchar(52) DEFAULT NULL,
  `apt_unit` varchar(252) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `status` int(12) DEFAULT 0,
  `deleted` int(12) DEFAULT 0,
  `delete_datetime` timestamp NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `family_friend_detail`
--
ALTER TABLE `family_friend_detail`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `family_friend_detail`
--
ALTER TABLE `family_friend_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
