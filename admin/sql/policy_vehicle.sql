-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 02, 2025 at 12:10 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `policy_vehicle`
--

CREATE TABLE `policy_vehicle` (
  `id` int(11) NOT NULL,
  `policy_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `vehicle` VARCHAR(252) NULL,
  `vehicle_year_id` int(11) NULL,
  `vehicle_year` VARCHAR(252) NULL,
  `vehicle_make_id` int(11) NULL,
  `vehicle_make_name` VARCHAR(252) NULL,
  `vehicle_make_origin` VARCHAR(252) NULL,
  `vehicle_model_id` int(11) NULL,
  `vehicle_model_name` VARCHAR(252) NULL,
  `vehicle_no` VARCHAR(252) NULL,
  `calculation_id` int(11) NULL,
  `amount` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `policy_vehicle`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `policy_vehicle`
--
ALTER TABLE `policy_vehicle`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `policy_vehicle`
--
ALTER TABLE `policy_vehicle`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
