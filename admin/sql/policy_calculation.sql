-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 05, 2025 at 09:29 PM
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
-- Table structure for table `policy_calculation`
--

CREATE TABLE `policy_calculation` (
  `id` int(11) NOT NULL,
  `policy_type` varchar(252) NOT NULL,
  `customer_age_from` int(11) DEFAULT NULL,
  `customer_age_to` int(11) DEFAULT NULL,
  `vehicle_year_from` int(11) DEFAULT NULL,
  `vehicle_year_to` int(11) DEFAULT NULL,
  `addup_increase_percent` int(11) DEFAULT NULL,
  `vehicle_make_origin` varchar(252) DEFAULT NULL,
  `origin_increase_percent` int(11) DEFAULT NULL,
  `spouse_discount_percent` int(11) DEFAULT NULL,
  `family_increase_percent` int(11) DEFAULT NULL,
  `friend_increase_percent` int(11) DEFAULT NULL,
  `vehicle_count` int(11) DEFAULT NULL,
  `driver_count` int(11) DEFAULT NULL,
  `more_then_one_driver_increase_percent` int(11) DEFAULT NULL,
  `base_policy_amt` float NOT NULL,
  `status` int(12) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `policy_calculation`
--
ALTER TABLE `policy_calculation`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `policy_calculation`
--
ALTER TABLE `policy_calculation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
