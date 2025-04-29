ALTER TABLE `vehicle` ADD `veh_owner_company_name` VARCHAR(252) NULL AFTER `vehicle_category`;
ALTER TABLE `driver` ADD `family_friend` VARCHAR(252) NOT NULL DEFAULT 'none' AFTER `marital_status`;

ALTER TABLE `service_charge` ADD `agent_id` INT(11) NOT NULL AFTER `service_charge_id`;
ALTER TABLE `management_charge` ADD `admin_id` INT(11) NOT NULL AFTER `management_charge_id`;


NOT UPDATED

ALTER TABLE `customer` ADD `agent_id` INT(11) NOT NULL AFTER `prefix_customer_id`;