-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 27, 2025 at 08:25 AM
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
-- Table structure for table `policy`
--

CREATE TABLE `policy` (
  `id` int(11) NOT NULL,
  `policy_id` int(11) NOT NULL,
  `prefix_policy_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `policy_coverage` varchar(50) NOT NULL,
  `policy_coverage_collision_id` int(11) NOT NULL,
  `policy_coverage_umpd_id` int(11) NOT NULL,
  `policy_coverage_rental_id` int(11) NOT NULL,
  `policy_coverage_towing_id` int(11) NOT NULL,
  `policy_coverage_deductible_id` int(11) NOT NULL,
  `is_veh_used_business` int(11) NOT NULL,
  `is_physical_damage` int(11) NOT NULL DEFAULT 0,
  `policy_bi_id` int(11) NOT NULL,
  `policy_umd_id` int(11) NOT NULL,
  `policy_medical_id` int(11) NOT NULL,
  `policy_pd_id` int(11) NOT NULL,
  `policy_vehicle_id` int(11) NOT NULL,
  `is_roadside_assistance` int(11) NOT NULL,
  `is_driver_res` int(11) NOT NULL,
  `is_vehical_listed` int(11) NOT NULL,
  `is_applicant_sole_registered` int(11) NOT NULL,
  `is_applicant_other_veh` int(11) NOT NULL,
  `is_veh_used_business_q` int(11) NOT NULL,
  `is_veh_listed_ride` int(11) NOT NULL,
  `is_veh_listed_application_used` int(11) NOT NULL,
  `is_veh_listed_garaged` int(11) NOT NULL,
  `applicant_initials` varchar(252) NOT NULL,
  `applicant_mother_name` varchar(252) NOT NULL,
  `is_premium_payment_type` int(11) NOT NULL,
  `base_premium` int(11) NOT NULL,
  `additional_coverage_premium` int(11) NOT NULL,
  `customl_discount` int(11) NOT NULL,
  `total_fees` int(11) NOT NULL,
  `total_premium` int(11) NOT NULL,
  `management_fee` int(11) NOT NULL,
  `service_price` int(11) NOT NULL,
  `total` int(11) NOT NULL,
  `policy_status` enum('pending','success','failed','reject','emi') NOT NULL,
  `status` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `delete_datetime` datetime DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
