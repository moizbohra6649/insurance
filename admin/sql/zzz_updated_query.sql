ALTER TABLE `vehicle` ADD `veh_owner_company_name` VARCHAR(252) NULL AFTER `vehicle_category`;
ALTER TABLE `driver` ADD `family_friend` VARCHAR(252) NOT NULL DEFAULT 'none' AFTER `marital_status`;