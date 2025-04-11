-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 11, 2025 at 07:21 PM
-- Server version: 10.4.32-MariaDB
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
-- Table structure for table `coverage_collision`
--

CREATE TABLE `coverage_collision` (
  `id` int(11) NOT NULL,
  `coverage_collision_id` bigint(22) NOT NULL,
  `prefix_coverage_collision_id` varchar(252) NOT NULL,
  `minimum_amount` varchar(50) NOT NULL,
  `maximum_amount` varchar(50) NOT NULL,
  `status` int(12) NOT NULL DEFAULT 0,
  `deleted` int(12) NOT NULL DEFAULT 0,
  `delete_datetime` timestamp NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `coverage_collision`
--

INSERT INTO `coverage_collision` (`id`, `coverage_collision_id`, `prefix_coverage_collision_id`, `minimum_amount`, `maximum_amount`, `status`, `deleted`, `delete_datetime`, `created`, `updated`) VALUES
(5, 1, 'COVERAGE_COLLISION_1', '1', '5000', 1, 0, NULL, '2025-04-11 15:05:40', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coverage_collision`
--
ALTER TABLE `coverage_collision`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coverage_collision`
--
ALTER TABLE `coverage_collision`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
