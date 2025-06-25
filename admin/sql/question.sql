-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 05:42 PM
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
-- Table structure for table `question`
--

CREATE TABLE `question` (
  `id` int(11) NOT NULL,
  `question_id` bigint(22) NOT NULL,
  `prefix_question_id` varchar(252) NOT NULL,
  `question` varchar(252) NOT NULL,
  `status` int(12) NOT NULL DEFAULT 0,
  `deleted` int(12) NOT NULL DEFAULT 0,
  `delete_datetime` timestamp NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Indexes for table `question`
--
ALTER TABLE `question`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

Insert into `question` (`id`, `question_id`, `prefix_question_id`, `question`, `status`) VALUES
(1, 1, 'QUESTION_1', 'Does any driver have any driving restrictions?', 1),
(2, 2, 'QUESTION_2', 'Are any vehicles listed on this application titled under salvage or flood?', 1),
(3, 3, 'QUESTION_3', 'Does the applicant own any other vehicles not listed on application?', 1),
(4, 4, 'QUESTION_4', 'Is the applicant the sole registered owner of the vehicle?', 1),
(5, 5, 'QUESTION_5', 'Are any vehicles operated by any for commercial business use?', 1),
(6, 6, 'QUESTION_6', 'Are any vehicles listed used for ride share at any time?', 1),
(7, 7, 'QUESTION_7', 'Are any vehicles listed on this application used for regular frequent trips beyond 50 miles radius of the given address?', 1),
(8, 8, 'QUESTION_8', 'Are any vehicle listed on this application garaged outside of IL for more than 2 months of the year?', 1);

--
-- AUTO_INCREMENT for table `question`
--
ALTER TABLE `question`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
