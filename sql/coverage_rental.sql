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
-- Table structure for table `coverage_rental`
--

CREATE TABLE `coverage_rental` (
  `id` int(11) NOT NULL,
  `coverage_rental_id` bigint(22) NOT NULL,
  `prefix_coverage_rental_id` varchar(252) NOT NULL,
  `minimum_amount` varchar(50) NOT NULL,
  `maximum_amount` varchar(50) NOT NULL,
  `status` int(12) NOT NULL DEFAULT 0,
  `deleted` int(12) NOT NULL DEFAULT 0,
  `delete_datetime` timestamp NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `coverage_rental`
--

INSERT INTO `coverage_rental` (`id`, `coverage_rental_id`, `prefix_coverage_rental_id`, `minimum_amount`, `maximum_amount`, `status`, `deleted`, `delete_datetime`, `created`, `updated`) VALUES
(4, 1, 'COVERAGE_RENTAL_1', '1', '1111', 1, 0, NULL, '2025-04-11 17:15:02', NULL),
(5, 2, 'COVERAGE_RENTAL_2', '5', '55', 1, 0, NULL, '2025-04-11 17:18:08', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `coverage_rental`
--
ALTER TABLE `coverage_rental`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `coverage_rental`
--
ALTER TABLE `coverage_rental`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
