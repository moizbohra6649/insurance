-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2025 at 04:56 PM
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
-- Table structure for table `policy_bi`
--

CREATE TABLE `policy_bi` (
  `id` int(11) NOT NULL,
  `policy_bi_id` bigint(22) NOT NULL,
  `prefix_policy_bi_id` varchar(252) NOT NULL,
  `minimum_amount` varchar(50) NOT NULL,
  `maximum_amount` varchar(50) NOT NULL,
  `status` int(12) NOT NULL DEFAULT 0,
  `deleted` int(12) NOT NULL DEFAULT 0,
  `delete_datetime` timestamp NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `policy_bi`
--

INSERT INTO `policy_bi` (`id`, `policy_bi_id`, `prefix_policy_bi_id`, `minimum_amount`, `maximum_amount`, `status`, `deleted`, `delete_datetime`, `created`, `updated`) VALUES
(1, 1, 'POLICY_BI_1', '1', '1000', 1, 0, NULL, '2025-04-09 19:27:08', '2025-04-10 14:03:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `policy_bi`
--
ALTER TABLE `policy_bi`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `policy_bi`
--
ALTER TABLE `policy_bi`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
