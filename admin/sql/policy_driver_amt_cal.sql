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
-- Table structure for table `policy_driver_amt_cal`
--

CREATE TABLE `policy_driver_amt_cal` (
  `id` int(11) NOT NULL,
  `policy_type` varchar(252) NOT NULL,
  `driver_age_from` int(11) DEFAULT NULL,
  `driver_age_to` int(11) DEFAULT NULL,
  `driver_increase_percent` int(11) DEFAULT NULL,
  `spouse_discount_percent` int(11) DEFAULT NULL,
  `family_increase_percent` int(11) DEFAULT NULL,
  `friend_increase_percent` int(11) DEFAULT NULL,
  `more_then_one_driver_increase_percent` int(11) DEFAULT NULL,
  `status` int(12) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

insert into policy_driver_amt_cal (id, policy_type, driver_age_from, driver_age_to, driver_increase_percent, spouse_discount_percent, family_increase_percent, friend_increase_percent, more_then_one_driver_increase_percent) VALUES 
(1, 'non_owner', 16, 25, 0, 0, 0, 0, 0),
(2, 'non_owner', 25, 30, 0, 0, 0, 0, 0),
(3, 'non_owner', 30, 55, 0, 0, 0, 0, 0),
(4, 'non_owner', 35, 50, 0, 0, 0, 0, 0),
(5, 'liability', 16, 25, 12, 50, 50, 60, 65),
(6, 'liability', 25, 30, 12, 50, 40, 45, 65),
(7, 'liability', 30, 35, 12, 50, 25, 25, 65),
(8, 'liability', 35, 50, 12, 50, 25, 35, 65),
(9, 'full_coverage', 16, 25, 12, 50, 50, 60, 65),
(10, 'full_coverage', 25, 30, 12, 50, 40, 45, 65),
(11, 'full_coverage', 30, 35, 12, 50, 25, 25, 65),
(12, 'full_coverage', 35, 50, 12, 50, 25, 35, 65);

--
-- Indexes for table `policy_driver_amt_cal`
--
ALTER TABLE `policy_driver_amt_cal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `policy_driver_amt_cal`
--
ALTER TABLE `policy_driver_amt_cal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
