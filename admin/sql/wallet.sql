-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2025 at 06:22 PM
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
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `wallet_id` int(11) NOT NULL,
  `wallet_user_id` int(11) NOT NULL,
  `transaction_type` varchar(100) NOT NULL,
  `transaction_date` datetime NOT NULL,
  `transaction_id` varchar(100) NOT NULL,
  `amount` int(11) NOT NULL,
  `debit_credit_flag` enum('credit','debit') NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `updated` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `wallet`
--

INSERT INTO `wallet` (`id`, `wallet_id`, `wallet_user_id`, `transaction_type`, `transaction_date`, `transaction_id`, `amount`, `debit_credit_flag`, `created`, `updated`) VALUES
(1, 1, 1, 'Online', '2025-05-02 00:00:00', 'Jejejejej848484', 2000, 'debit', '2025-05-03 21:14:41', '0000-00-00 00:00:00'),
(2, 2, 0, 'Deposti', '2025-05-01 00:00:00', '83838383hdhdhd', 8000, 'debit', '2025-05-03 21:36:52', '0000-00-00 00:00:00'),
(3, 3, 1, 'Dsdsasad', '2025-05-01 00:00:00', 'Fsdfdsfds', 98898, 'debit', '2025-05-03 21:45:34', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
