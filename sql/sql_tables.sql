CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` bigint(22) NOT NULL,
  `prefix_user_id` varchar(252) NOT NULL,
  `role` varchar(252) NOT NULL,
  `username` varchar(252) NOT NULL,
  `name` varchar(252) NOT NULL,
  `email` varchar(252) NOT NULL,
  `mobile` varchar(15) NOT NULL,
  `password` varchar(252) NOT NULL,
  `hint` varchar(252) NOT NULL,
  `profile_image` varchar(252) DEFAULT NULL,
  `status` int(12) NOT NULL DEFAULT 0,
  `deleted` int(12) NOT NULL DEFAULT 0,
  `delete_datetime` timestamp NULL DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


ALTER TABLE `users` ADD PRIMARY KEY (`id`);

ALTER TABLE `users` MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1;

COMMIT;

INSERT INTO `users` (`user_id`, `prefix_user_id`, `role`, `username`, `name`, `email`, `mobile`, `password`, `hint`, `profile_image`, `status`) VALUES
(1, 'STAFF_1', 'superadmin', 'insurance', 'Insurance SuperAdmin', 'superadmin@insurance.com', '8819945752', '$2y$10$/w2sddYGfaP8cH32IFjXXuRZKf8v6LoZEvr9XvpycKRM5gx6ndL9K', '12345678', NULL, 1)

//Added Vehicle Category column in Vehicle table.

ALTER TABLE `vehicle` ADD `vehicle_category` INT(11) NULL DEFAULT NULL AFTER `vehicle_value`;


CREATE TABLE `insurance`.`driver` (
  `id` INT(11) NOT NULL AUTO_INCREMENT, 
  `driver_id` BIGINT(22) NOT NULL, 
  `prefix_driver_id` VARCHAR(252) NOT NULL, 
  `customer_id` INT(11) NOT NULL, 
  `first_name` VARCHAR(252) NOT NULL, 
  `middle_name` VARCHAR(252) NULL, 
  `last_name` VARCHAR(252) NOT NULL, 
  `email` VARCHAR(252) NULL, 
  `mobile_no` VARCHAR(252) NULL, 
  `date_of_birth` DATE NOT NULL, 
  `state_id` INT(11) NULL, 
  `city` VARCHAR(252) NULL, 
  `zip_code` INT(52) NULL, 
  `apt_unit` INT(252) NULL, 
  `address` TEXT NULL, 
  `driver_licence_no` VARCHAR(252) NOT NULL, 
  `driver_licence_image` VARCHAR(252) NULL, 
  `date_of_issue` DATE NULL, 
  `date_of_expiry` DATE NULL, 
  `place_of_issue` VARCHAR(252) NULL, 
  `marital_status` VARCHAR(252) NOT NULL DEFAULT 'unmarried', 
  `status` INT(12) NULL DEFAULT '0', 
  `deleted` INT(12) NULL DEFAULT '0', 
  `delete_datetime` TIMESTAMP NULL, 
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  `updated` TIMESTAMP NULL, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;


CREATE TABLE `insurance`.`spouse_detail` (
  `id` INT(11) NOT NULL AUTO_INCREMENT, 
  `driver_id` INT(11) NOT NULL, 
  `first_name` VARCHAR(252) NOT NULL, 
  `last_name` VARCHAR(252) NOT NULL, 
  `email` VARCHAR(252) NULL, 
  `mobile_no` VARCHAR(252) NULL, 
  `licence_no` VARCHAR(252) NULL, 
  `state_id` INT(11) NULL, 
  `city` VARCHAR(252) NULL, 
  `zip_code` INT(52) NULL, 
  `apt_unit` INT(252) NULL, 
  `address` TEXT NULL, 
  `status` INT(12) NULL DEFAULT '0', 
  `deleted` INT(12) NULL DEFAULT '0', 
  `delete_datetime` TIMESTAMP NULL, 
  `created` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP, 
  `updated` TIMESTAMP NULL, 
  PRIMARY KEY (`id`)
) ENGINE = InnoDB;