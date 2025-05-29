-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2025 at 10:43 PM
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
-- Table structure for table `user_page_permissions`
--

CREATE TABLE `user_page_permissions` (
  `id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `page_name` varchar(256) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `updated` datetime DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_page_permissions`
--

INSERT INTO `user_page_permissions` (`id`, `staff_id`, `page_name`, `status`, `updated`, `created`) VALUES
(4, 2, 'vendor_add', 1, NULL, '2025-05-30 02:12:45'),
(5, 2, 'vendor_edit', 1, NULL, '2025-05-30 02:12:45'),
(6, 2, 'vehicle_view', 1, NULL, '2025-05-30 02:12:45');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_page_permissions`
--
ALTER TABLE `user_page_permissions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_page_permissions`
--
ALTER TABLE `user_page_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
