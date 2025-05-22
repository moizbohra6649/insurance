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


insert into policy_calculation (id, policy_type, customer_age_from, customer_age_to, vehicle_year_from, vehicle_year_to, addup_increase_percent, vehicle_make_origin, origin_increase_percent, spouse_discount_percent, family_increase_percent, friend_increase_percent, vehicle_count, driver_count, more_then_one_driver_increase_percent, base_policy_amt ) VALUES 
(1, 'non_owner', 16, 25, 0, 0, 0, 'south_korean', 20, 0, 0, 0, 1, 1, 0, 445),
(2, 'non_owner', 25, 30, 0, 0, 0, 'south_korean', 20, 0, 0, 0, 1, 1, 0, 395),
(3, 'non_owner', 30, 55, 0, 0, 0, 'south_korean', 20, 0, 0, 0, 1, 1, 0, 380),
(4, 'non_owner', 35, 50, 0, 0, 0, 'south_korean', 20, 0, 0, 0, 1, 1, 0, 380),
(5, 'liability', 16, 25, 1990, 2009, 12, 'south_korean', 20, 50, 50, 60, 5, 5, 65, 640),
(6, 'liability', 16, 25, 2010, 2014, 60, 'south_korean', 20, 50, 50, 60, 5, 5, 65, 640),
(7, 'liability', 16, 25, 2015, 2020, 30, 'south_korean', 20, 50, 50, 60, 5, 5, 65, 640),
(8, 'liability', 16, 25, 2021, 2025, 40, 'south_korean', 20, 50, 50, 60, 5, 5, 65, 640),
(9, 'liability', 25, 30, 1990, 2009, 12, 'south_korean', 20, 50, 40, 45, 5, 5, 65, 640),
(10, 'liability', 25, 30, 2010, 2014, 60, 'south_korean', 20, 50, 40, 45, 5, 5, 65, 640),
(11, 'liability', 25, 30, 2015, 2020, 30, 'south_korean', 20, 50, 40, 45, 5, 5, 65, 640),
(12, 'liability', 25, 30, 2021, 2025, 40, 'south_korean', 20, 50, 40, 45, 5, 5, 65, 640),
(13, 'liability', 30, 35, 1990, 2009, 12, 'south_korean', 20, 50, 25, 25, 5, 5, 65, 620),
(14, 'liability', 30, 35, 2010, 2014, 60, 'south_korean', 20, 50, 25, 25, 5, 5, 65, 620),
(15, 'liability', 30, 35, 2015, 2020, 30, 'south_korean', 20, 50, 25, 25, 5, 5, 65, 620),
(16, 'liability', 30, 35, 2021, 2025, 40, 'south_korean', 20, 50, 25, 25, 5, 5, 65, 620),
(17, 'liability', 35, 50, 1990, 2009, 12, 'south_korean', 20, 50, 25, 35, 5, 5, 65, 470),
(18, 'liability', 35, 50, 2010, 2014, 60, 'south_korean', 20, 50, 25, 35, 5, 5, 65, 470),
(19, 'liability', 35, 50, 2015, 2020, 30, 'south_korean', 20, 50, 25, 35, 5, 5, 65, 470),
(20, 'liability', 35, 50, 2021, 2025, 40, 'south_korean', 20, 50, 25, 35, 5, 5, 65, 470),
(21, 'full_coverage', 16, 25, 1990, 2009, 12, 'south_korean', 20, 50, 50, 60, 5, 5, 65, 1310),
(22, 'full_coverage', 16, 25, 2010, 2014, 60, 'south_korean', 20, 50, 50, 60, 5, 5, 65, 1310),
(23, 'full_coverage', 16, 25, 2015, 2020, 30, 'south_korean', 20, 50, 50, 60, 5, 5, 65, 1310),
(24, 'full_coverage', 16, 25, 2021, 2025, 40, 'south_korean', 20, 50, 50, 60, 5, 5, 65, 1310),
(25, 'full_coverage', 25, 30, 1990, 2009, 12, 'south_korean', 20, 50, 40, 45, 5, 5, 65, 1260),
(26, 'full_coverage', 25, 30, 2010, 2014, 60, 'south_korean', 20, 50, 40, 45, 5, 5, 65, 1260),
(27, 'full_coverage', 25, 30, 2015, 2020, 30, 'south_korean', 20, 50, 40, 45, 5, 5, 65, 1260),
(28, 'full_coverage', 25, 30, 2021, 2025, 40, 'south_korean', 20, 50, 40, 45, 5, 5, 65, 1260),
(29, 'full_coverage', 30, 35, 1990, 2009, 12, 'south_korean', 20, 50, 25, 25, 5, 5, 65, 1220),
(30, 'full_coverage', 30, 35, 2010, 2014, 60, 'south_korean', 20, 50, 25, 25, 5, 5, 65, 1220),
(31, 'full_coverage', 30, 35, 2015, 2020, 30, 'south_korean', 20, 50, 25, 25, 5, 5, 65, 1220),
(32, 'full_coverage', 30, 35, 2021, 2025, 40, 'south_korean', 20, 50, 25, 25, 5, 5, 65, 1220),
(33, 'full_coverage', 35, 50, 1990, 2009, 12, 'south_korean', 20, 50, 25, 35, 5, 5, 65, 1110),
(34, 'full_coverage', 35, 50, 2010, 2014, 60, 'south_korean', 20, 50, 25, 35, 5, 5, 65, 1110),
(35, 'full_coverage', 35, 50, 2015, 2020, 30, 'south_korean', 20, 50, 25, 35, 5, 5, 65, 1110),
(36, 'full_coverage', 35, 50, 2021, 2025, 40, 'south_korean', 20, 50, 25, 35, 5, 5, 65, 1110);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
