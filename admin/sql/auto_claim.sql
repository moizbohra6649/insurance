-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2025 at 05:27 AM
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
-- Table structure for table `auto_claim`
--

CREATE TABLE `auto_claim` (
  `claim_id` int(11) NOT NULL,
  `submitter_name` varchar(255) DEFAULT NULL,
  `submitter_home_phone` varchar(20) DEFAULT NULL,
  `submitter_cell_phone` varchar(20) DEFAULT NULL,
  `sms_consent` tinyint(1) DEFAULT 0,
  `policyholder_number` varchar(50) DEFAULT NULL,
  `policyholder_name` varchar(255) DEFAULT NULL,
  `policyholder_address` varchar(255) DEFAULT NULL,
  `policyholder_city` varchar(100) DEFAULT NULL,
  `policyholder_state` varchar(50) DEFAULT NULL,
  `policyholder_zip` varchar(10) DEFAULT NULL,
  `policyholder_home_phone` varchar(20) DEFAULT NULL,
  `policyholder_cell_phone` varchar(20) DEFAULT NULL,
  `vehicle_year` int(11) DEFAULT NULL,
  `vehicle_make` varchar(100) DEFAULT NULL,
  `vehicle_model` varchar(100) DEFAULT NULL,
  `driver_name` varchar(255) DEFAULT NULL,
  `driver_address` varchar(255) DEFAULT NULL,
  `driver_city` varchar(100) DEFAULT NULL,
  `driver_state` varchar(50) DEFAULT NULL,
  `driver_zip` varchar(10) DEFAULT NULL,
  `driver_home_phone` varchar(20) DEFAULT NULL,
  `driver_business_phone` varchar(20) DEFAULT NULL,
  `driver_cell_phone` varchar(20) DEFAULT NULL,
  `accident_date` date DEFAULT NULL,
  `accident_time` time DEFAULT NULL,
  `accident_location` varchar(255) DEFAULT NULL,
  `accident_description` text DEFAULT NULL,
  `owner_permission` tinyint(1) DEFAULT 0,
  `vehicle_drivable` tinyint(1) DEFAULT 0,
  `vehicle_stolen` tinyint(1) DEFAULT 0,
  `stolen_recovered` tinyint(1) DEFAULT 0,
  `police_reported` tinyint(1) DEFAULT 0,
  `police_report_number` varchar(50) DEFAULT NULL,
  `accident_images_path` text DEFAULT NULL,
  `accident_videos_path` text DEFAULT NULL,
  `fir_copy_path` varchar(255) DEFAULT NULL,
  `property_owner_name` varchar(255) DEFAULT NULL,
  `property_owner_address` varchar(255) DEFAULT NULL,
  `property_owner_city` varchar(100) DEFAULT NULL,
  `property_owner_cell_phone` varchar(20) DEFAULT NULL,
  `property1_images_path` text DEFAULT NULL,
  `property1_state` varchar(50) DEFAULT NULL,
  `property1_zip` varchar(10) DEFAULT NULL,
  `property1_home_phone` varchar(20) DEFAULT NULL,
  `property1_business_phone` varchar(20) DEFAULT NULL,
  `property1_cell_phone_owner` varchar(20) DEFAULT NULL,
  `property1_damages_list` text DEFAULT NULL,
  `property1_any_damage` tinyint(1) DEFAULT 0,
  `property1_insurance_company` varchar(255) DEFAULT NULL,
  `property1_other_policy_number` varchar(50) DEFAULT NULL,
  `injuries_exist` tinyint(1) DEFAULT 0,
  `injured1_name` varchar(255) DEFAULT NULL,
  `injured1_address` varchar(255) DEFAULT NULL,
  `injured1_city` varchar(100) DEFAULT NULL,
  `injured1_state` varchar(50) DEFAULT NULL,
  `injured1_zip` varchar(10) DEFAULT NULL,
  `injured1_home_phone` varchar(20) DEFAULT NULL,
  `injured1_business_phone` varchar(20) DEFAULT NULL,
  `injured1_cell_phone` varchar(20) DEFAULT NULL,
  `injured1_injury_details` text DEFAULT NULL,
  `witnesses_exist` tinyint(1) DEFAULT 0,
  `witness1_name` varchar(255) DEFAULT NULL,
  `witness1_address` varchar(255) DEFAULT NULL,
  `witness1_city` varchar(100) DEFAULT NULL,
  `witness1_state` varchar(50) DEFAULT NULL,
  `witness1_zip` varchar(10) DEFAULT NULL,
  `witness1_home_phone` varchar(20) DEFAULT NULL,
  `witness1_business_phone` varchar(20) DEFAULT NULL,
  `witness1_cell_phone` varchar(20) DEFAULT NULL,
  `other_occupants_exist` tinyint(1) DEFAULT 0,
  `occupant1_name` varchar(255) DEFAULT NULL,
  `occupant1_address` varchar(255) DEFAULT NULL,
  `occupant1_city` varchar(100) DEFAULT NULL,
  `occupant1_state` varchar(50) DEFAULT NULL,
  `occupant1_zip` varchar(10) DEFAULT NULL,
  `occupant1_home_phone` varchar(20) DEFAULT NULL,
  `occupant1_business_phone` varchar(20) DEFAULT NULL,
  `occupant1_cell_phone` varchar(20) DEFAULT NULL,
  `submitted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `auto_claim`
--

INSERT INTO `auto_claim` (`claim_id`, `submitter_name`, `submitter_home_phone`, `submitter_cell_phone`, `sms_consent`, `policyholder_number`, `policyholder_name`, `policyholder_address`, `policyholder_city`, `policyholder_state`, `policyholder_zip`, `policyholder_home_phone`, `policyholder_cell_phone`, `vehicle_year`, `vehicle_make`, `vehicle_model`, `driver_name`, `driver_address`, `driver_city`, `driver_state`, `driver_zip`, `driver_home_phone`, `driver_business_phone`, `driver_cell_phone`, `accident_date`, `accident_time`, `accident_location`, `accident_description`, `owner_permission`, `vehicle_drivable`, `vehicle_stolen`, `stolen_recovered`, `police_reported`, `police_report_number`, `accident_images_path`, `accident_videos_path`, `fir_copy_path`, `property_owner_name`, `property_owner_address`, `property_owner_city`, `property_owner_cell_phone`, `property1_images_path`, `property1_state`, `property1_zip`, `property1_home_phone`, `property1_business_phone`, `property1_cell_phone_owner`, `property1_damages_list`, `property1_any_damage`, `property1_insurance_company`, `property1_other_policy_number`, `injuries_exist`, `injured1_name`, `injured1_address`, `injured1_city`, `injured1_state`, `injured1_zip`, `injured1_home_phone`, `injured1_business_phone`, `injured1_cell_phone`, `injured1_injury_details`, `witnesses_exist`, `witness1_name`, `witness1_address`, `witness1_city`, `witness1_state`, `witness1_zip`, `witness1_home_phone`, `witness1_business_phone`, `witness1_cell_phone`, `other_occupants_exist`, `occupant1_name`, `occupant1_address`, `occupant1_city`, `occupant1_state`, `occupant1_zip`, `occupant1_home_phone`, `occupant1_business_phone`, `occupant1_cell_phone`, `submitted_at`) VALUES
(1, 'Shubham', 'Bilodiua', '8989898989898', 1, '564646565', 'SHy', 'Dfsdgfdg', 'Fdgfdgfdg', 'Andra Pradesh', 'Fgfdg', '645654654', '5645654654654', 23, '232', 'Dfsdf', 'Dfsdfdsfdsf', 'Sdfsdfsdf', 'Dsfsdfsdf', 'Andra Pradesh', '342344', '654545435', '34345e45435435', '345435435435', '2025-04-29', '15:18:00', 'Sdfsdf', 'Sdfsdfsdfsdfsdfsdferwerewr', 1, 1, 1, 1, 1, 'Fsdfsew434234324', 'accident_images_0_1748283886.jpg', 'accident_videos_0_1748283886.png', 'fir_copy_1748283886.png', 'Fsdfsf', 'Sdfsdfsd', 'Fsdfsdfsdff', '33423432423423', 'property1_images_0_1748283886.jpg', 'Pondicherry', '34234324', '34234324324234', '423432432', '', 'TTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTTT', 1, 'Ffdsfsdffsdfsf', '423432432', 0, '', '', '', '', '', '', '', '', '', 0, 'Dasdasdsad', 'Cdsdfdsdsadsa', 'Sdsadasdasdas', 'Pondicherry', '34234234', '342343242343', '3423432432', '423432443', 0, 'Shubham bilodiya', 'Sanchar nagar', 'Indore', 'Andra Pradesh', '452001', '3434343434', '34343434', '34343434', '2025-05-26 18:24:46'),
(2, '', '', '', 1, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '', '', '0000-00-00', '00:00:00', '', '', 1, 1, 1, 1, 1, '', 'accident_images_0_1748284702.', 'accident_videos_0_1748284702.', '', '', '', '', '', 'property1_images_0_1748284702.', '', '', '', '', '', '', 1, '', '', 0, '', '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', 0, '', '', '', '', '', '', '', '', '2025-05-26 18:38:22');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `auto_claim`
--
ALTER TABLE `auto_claim`
  ADD PRIMARY KEY (`claim_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `auto_claim`
--
ALTER TABLE `auto_claim`
  MODIFY `claim_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
