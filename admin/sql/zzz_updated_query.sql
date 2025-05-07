ALTER TABLE `vehicle` ADD `veh_owner_company_name` VARCHAR(252) NULL AFTER `vehicle_category`;
ALTER TABLE `driver` ADD `family_friend` VARCHAR(252) NOT NULL DEFAULT 'none' AFTER `marital_status`;

ALTER TABLE `service_charge` ADD `agent_id` INT(11) NOT NULL AFTER `service_charge_id`;
ALTER TABLE `management_charge` ADD `admin_id` INT(11) NOT NULL AFTER `management_charge_id`;

ALTER TABLE `customer` ADD `agent_id` INT(11) NOT NULL AFTER `prefix_customer_id`;

ALTER TABLE `make` ADD `make_origin` VARCHAR(252) NULL AFTER `make_name`;

ALTER TABLE `vendor` ADD `entry_type` VARCHAR(252) NOT NULL DEFAULT 'manually' COMMENT 'manually = if superadmin add this vendor\r\nrequested = Vendor can request as a vendor register by fronend.' AFTER `business_license`;

ALTER TABLE `agent` ADD `entry_type` VARCHAR(252) NOT NULL DEFAULT 'manually' COMMENT 'manually = if superadmin add this agent\r\nrequested = Vendor can request as a agent register by fronend.' AFTER `profile_image`;
-- for wallet effect
ALTER TABLE agent 
ADD total_earning BIGINT(20) NOT NULL DEFAULT 0,
ADD wallet_amount BIGINT(20) NOT NULL DEFAULT 0;


----------------------------------------------- Moiz Bohra

insert into policy_calculation (policy_type, customer_age_from, customer_age_to, vehicle_year_from, vehicle_year_to, addup_increase_percent, vehicle_make_origin, origin_increase_percent, spouse_discount_percent, family_increase_percent, friend_increase_percent, vehicle_count, driver_count, more_then_one_driver_increase_percent, base_policy_amt ) VALUES 
('non_owner', 16, 25, 0, 0, 0, '3', 20, 0, 0, 0, 1, 1, 0, 445),
('non_owner', 25, 30, 0, 0, 0, '3', 20, 0, 0, 0, 1, 1, 0, 395),
('non_owner', 30, 55, 0, 0, 0, '3', 20, 0, 0, 0, 1, 1, 0, 380),
('non_owner', 35, 50, 0, 0, 0, '3', 20, 0, 0, 0, 1, 1, 0, 380),

('liability', 16, 25, 1990, 2009, 12, '3', 20, 50, 50, 60, 5, 5, 65, 640),
('liability', 16, 25, 2010, 2014, 60, '3', 20, 50, 50, 60, 5, 5, 65, 640),
('liability', 16, 25, 2015, 2020, 30, '3', 20, 50, 50, 60, 5, 5, 65, 640),
('liability', 16, 25, 2021, 2025, 40, '3', 20, 50, 50, 60, 5, 5, 65, 640),

('liability', 25, 30, 1990, 2009, 12, '3', 20, 50, 40, 45, 5, 5, 65, 640),
('liability', 25, 30, 2010, 2014, 60, '3', 20, 50, 40, 45, 5, 5, 65, 640),
('liability', 25, 30, 2015, 2020, 30, '3', 20, 50, 40, 45, 5, 5, 65, 640),
('liability', 25, 30, 2021, 2025, 40, '3', 20, 50, 40, 45, 5, 5, 65, 640),

('liability', 30, 35, 1990, 2009, 12, '3', 20, 50, 25, 25, 5, 5, 65, 620),
('liability', 30, 35, 2010, 2014, 60, '3', 20, 50, 25, 25, 5, 5, 65, 620),
('liability', 30, 35, 2015, 2020, 30, '3', 20, 50, 25, 25, 5, 5, 65, 620),
('liability', 30, 35, 2021, 2025, 40, '3', 20, 50, 25, 25, 5, 5, 65, 620),

('liability', 35, 50, 1990, 2009, 12, '3', 20, 50, 25, 35, 5, 5, 65, 470),
('liability', 35, 50, 2010, 2014, 60, '3', 20, 50, 25, 35, 5, 5, 65, 470),
('liability', 35, 50, 2015, 2020, 30, '3', 20, 50, 25, 35, 5, 5, 65, 470),
('liability', 35, 50, 2021, 2025, 40, '3', 20, 50, 25, 35, 5, 5, 65, 470),


('full_coverage', 16, 25, 1990, 2009, 12, '3', 20, 50, 50, 60, 5, 5, 65, 1310),
('full_coverage', 16, 25, 2010, 2014, 60, '3', 20, 50, 50, 60, 5, 5, 65, 1310),
('full_coverage', 16, 25, 2015, 2020, 30, '3', 20, 50, 50, 60, 5, 5, 65, 1310),
('full_coverage', 16, 25, 2021, 2025, 40, '3', 20, 50, 50, 60, 5, 5, 65, 1310),

('full_coverage', 25, 30, 1990, 2009, 12, '3', 20, 50, 40, 45, 5, 5, 65, 1260),
('full_coverage', 25, 30, 2010, 2014, 60, '3', 20, 50, 40, 45, 5, 5, 65, 1260),
('full_coverage', 25, 30, 2015, 2020, 30, '3', 20, 50, 40, 45, 5, 5, 65, 1260),
('full_coverage', 25, 30, 2021, 2025, 40, '3', 20, 50, 40, 45, 5, 5, 65, 1260),

('full_coverage', 30, 35, 1990, 2009, 12, '3', 20, 50, 25, 25, 5, 5, 65, 1220),
('full_coverage', 30, 35, 2010, 2014, 60, '3', 20, 50, 25, 25, 5, 5, 65, 1220),
('full_coverage', 30, 35, 2015, 2020, 30, '3', 20, 50, 25, 25, 5, 5, 65, 1220),
('full_coverage', 30, 35, 2021, 2025, 40, '3', 20, 50, 25, 25, 5, 5, 65, 1220),

('full_coverage', 35, 50, 1990, 2009, 12, '3', 20, 50, 25, 35, 5, 5, 65, 1110),
('full_coverage', 35, 50, 2010, 2014, 60, '3', 20, 50, 25, 35, 5, 5, 65, 1110),
('full_coverage', 35, 50, 2015, 2020, 30, '3', 20, 50, 25, 35, 5, 5, 65, 1110),
('full_coverage', 35, 50, 2021, 2025, 40, '3', 20, 50, 25, 35, 5, 5, 65, 1110),


/* Some Cases
More than 1 driver then extra 65% increase in other drivers.
Add this details also in policy vehicle related table with all details.


*/