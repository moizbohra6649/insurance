-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 18, 2025 at 06:19 PM
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
-- Table structure for table `driver`
--

CREATE TABLE `driver` (
  `id` int(11) NOT NULL,
  `driver_id` bigint(22) NOT NULL,
  `prefix_driver_id` varchar(252) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `first_name` varchar(252) NOT NULL,
  `middle_name` varchar(252) DEFAULT NULL,
  `last_name` varchar(252) NOT NULL,
  `email` varchar(252) DEFAULT NULL,
  `mobile_no` varchar(252) DEFAULT NULL,
  `date_of_birth` date NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city` varchar(252) DEFAULT NULL,
  `zip_code` varchar(52) DEFAULT NULL,
  `apt_unit` varchar(252) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `driver_licence_no` varchar(252) NOT NULL,
  `driver_licence_image` varchar(252) DEFAULT NULL,
  `date_of_issue` date DEFAULT NULL,
  `date_of_expiry` date DEFAULT NULL,
  `place_of_issue` varchar(252) DEFAULT NULL,
  `marital_status` varchar(252) NOT NULL DEFAULT 'unmarried',
  `family_friend` varchar(252) NOT NULL DEFAULT 'none',
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
-- Indexes for table `driver`
--
ALTER TABLE `driver`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driver`
--
ALTER TABLE `driver`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
