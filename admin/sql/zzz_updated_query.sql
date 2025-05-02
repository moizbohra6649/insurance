ALTER TABLE `vehicle` ADD `veh_owner_company_name` VARCHAR(252) NULL AFTER `vehicle_category`;
ALTER TABLE `driver` ADD `family_friend` VARCHAR(252) NOT NULL DEFAULT 'none' AFTER `marital_status`;

ALTER TABLE `service_charge` ADD `agent_id` INT(11) NOT NULL AFTER `service_charge_id`;
ALTER TABLE `management_charge` ADD `admin_id` INT(11) NOT NULL AFTER `management_charge_id`;

ALTER TABLE `customer` ADD `agent_id` INT(11) NOT NULL AFTER `prefix_customer_id`;

ALTER TABLE `make` ADD `make_origin` VARCHAR(252) NULL AFTER `make_name`;

ALTER TABLE `vendor` ADD `entry_type` VARCHAR(252) NOT NULL DEFAULT 'manually' COMMENT 'manually = if superadmin add this vendor\r\nrequested = Vendor can request as a vendor register by fronend.' AFTER `business_license`;

ALTER TABLE `agent` ADD `entry_type` VARCHAR(252) NOT NULL DEFAULT 'manually' COMMENT 'manually = if superadmin add this agent\r\nrequested = Vendor can request as a agent register by fronend.' AFTER `profile_image`;