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
-- Table structure for table `policy_coverage_base_amt_cal`
--

CREATE TABLE `policy_coverage_base_amt_cal` (
  `id` int(11) NOT NULL,
  `policy_type` varchar(252) NOT NULL,
  `customer_age_from` int(11) DEFAULT NULL,
  `customer_age_to` int(11) DEFAULT NULL,
  `vehicle_count` int(11) DEFAULT NULL,
  `driver_count` int(11) DEFAULT NULL,
  `base_policy_amt` float NOT NULL,
  `status` int(12) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

insert into policy_coverage_base_amt_cal (id, policy_type, customer_age_from, customer_age_to, vehicle_count, driver_count, base_policy_amt) VALUES 
(1, 'non_owner', 16, 25, 1, 1, 445),
(2, 'non_owner', 25, 30, 1, 1, 395),
(3, 'non_owner', 30, 55, 1, 1, 380),
(4, 'non_owner', 35, 50, 1, 1, 380),
(5, 'liability', 16, 25, 5, 5, 640),
(6, 'liability', 25, 30, 5, 5, 640),
(7, 'liability', 30, 35, 5, 5, 620),
(8, 'liability', 35, 50, 5, 5, 470),
(9, 'full_coverage', 16, 25, 5, 5, 1310),
(10, 'full_coverage', 25, 30, 5, 5, 1260),
(11, 'full_coverage', 30, 35, 5, 5, 1220),
(12, 'full_coverage', 35, 50, 5, 5, 1110);

--
-- Indexes for table `policy_coverage_base_amt_cal`
--
ALTER TABLE `policy_coverage_base_amt_cal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `policy_coverage_base_amt_cal`
--
ALTER TABLE `policy_coverage_base_amt_cal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
