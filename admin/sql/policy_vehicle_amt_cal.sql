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
-- Table structure for table `policy_vehicle_amt_cal`
--

CREATE TABLE `policy_vehicle_amt_cal` (
  `id` int(11) NOT NULL,
  `policy_type` varchar(252) NOT NULL,
  `vehicle_year_from` int(11) DEFAULT NULL,
  `vehicle_year_to` int(11) DEFAULT NULL,
  `addup_increase_percent` int(11) DEFAULT NULL,
  `vehicle_make_origin` varchar(252) DEFAULT NULL,
  `origin_increase_percent` int(11) DEFAULT NULL,
  `status` int(12) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

insert into policy_vehicle_amt_cal (id, policy_type, vehicle_year_from, vehicle_year_to, addup_increase_percent, vehicle_make_origin, origin_increase_percent) VALUES 
(1, 'liability', 1990, 2009, 12, 'south_korean', 20),
(2, 'liability', 2010, 2014, 60, 'south_korean', 20),
(3, 'liability', 2015, 2020, 30, 'south_korean', 20),
(4, 'liability', 2021, 2025, 40, 'south_korean', 20),
(5, 'full_coverage', 1990, 2009, 12, 'south_korean', 20),
(6, 'full_coverage', 2010, 2014, 60, 'south_korean', 20),
(7, 'full_coverage', 2015, 2020, 30, 'south_korean', 20),
(8, 'full_coverage', 2021, 2025, 40, 'south_korean', 20);

--
-- Indexes for table `policy_vehicle_amt_cal`
--
ALTER TABLE `policy_vehicle_amt_cal`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `policy_vehicle_amt_cal`
--
ALTER TABLE `policy_vehicle_amt_cal`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
