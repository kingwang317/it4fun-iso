ALTER TABLE  `fuel_users` ADD  `company` VARCHAR( 50 ) NULL AFTER  `last_name`
ALTER TABLE  `fuel_users` ADD  `verify_admin` ENUM(  'YES',  'NO' ) NOT NULL DEFAULT  'NO' AFTER  `company`
