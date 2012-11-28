
# This is a fix for InnoDB in MySQL >= 4.1.x
# It "suspends judgement" for fkey relationships until are tables are set.
SET FOREIGN_KEY_CHECKS = 0;

#-----------------------------------------------------------------------------
#-- client
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `client`;


CREATE TABLE `client`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`location_id` INTEGER,
	`client_identification` VARCHAR(50),
	`client_name` VARCHAR(50),
	`address` VARCHAR(50),
	`address_2` VARCHAR(50),
	`city` VARCHAR(50),
	`state` VARCHAR(50),
	`zip` VARCHAR(50),
	`attn` VARCHAR(50),
	`email` VARCHAR(50),
	`phone` VARCHAR(50),
	`ext` VARCHAR(50),
	`category` VARCHAR(50),
	`notes` VARCHAR(50),
	`all_devices` INTEGER,
	`freq_approved` INTEGER default 0,
	`freq_locked` INTEGER default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`frequency` MEDIUMBLOB,
	`frequency_annual` MEDIUMBLOB,
	`frequency_semi` MEDIUMBLOB,
	`frequency_quarterly` MEDIUMBLOB,
	`frequency_sterilizer` MEDIUMBLOB,
	`frequency_tg` MEDIUMBLOB,
	`frequency_ert` MEDIUMBLOB,
	`frequency_rae` MEDIUMBLOB,
	`frequency_medgas` MEDIUMBLOB,
	`frequency_imaging` MEDIUMBLOB,
	`frequency_neptune` MEDIUMBLOB,
	`anesthesia` VARCHAR(50),
	`medgas` VARCHAR(50),
	`require_coords_update` INTEGER default 1,
	`addressType` INTEGER default 1,
	`secondary_address` VARCHAR(50) default 'null' NOT NULL,
	`secondary_address_2` VARCHAR(50) default 'null' NOT NULL,
	`secondary_city` VARCHAR(50) default 'null' NOT NULL,
	`secondary_state` VARCHAR(50) default 'null' NOT NULL,
	`secondary_zip` VARCHAR(50) default 'null' NOT NULL,
	`secondary_attn` VARCHAR(50) default 'null' NOT NULL,
	PRIMARY KEY (`id`),
	KEY `client_Fl_1`(`location_id`),
	CONSTRAINT `client_FK_1`
		FOREIGN KEY (`location_id`)
		REFERENCES `location` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- cordinates
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `cordinates`;


CREATE TABLE `cordinates`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`client_id` INTEGER,
	`lat` DOUBLE,
	`lon` DOUBLE,
	`found` INTEGER default 0,
	PRIMARY KEY (`id`),
	KEY `clientid_indx`(`client_id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- device
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `device`;


CREATE TABLE `device`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`specification_id` INTEGER,
	`client_id` INTEGER,
	`serial_number` VARCHAR(50),
	`location` VARCHAR(50),
	`frequency` VARCHAR(50),
	`status` VARCHAR(50),
	`identification` VARCHAR(50),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`comments` VARCHAR(300),
	`last_pm_date` VARCHAR(50),
	PRIMARY KEY (`id`),
	UNIQUE KEY `my_index` (`specification_id`, `serial_number`),
	CONSTRAINT `device_FK_1`
		FOREIGN KEY (`specification_id`)
		REFERENCES `specification` (`id`),
	INDEX `device_FI_2` (`client_id`),
	CONSTRAINT `device_FK_2`
		FOREIGN KEY (`client_id`)
		REFERENCES `client` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- device_checkup
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `device_checkup`;


CREATE TABLE `device_checkup`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`device_id` INTEGER,
	`client_id` INTEGER,
	`device_identification` VARCHAR(50),
	`row_indicator` VARCHAR(50),
	`device_tech_id` VARCHAR(50),
	`pass_fail_code` VARCHAR(50),
	`rec_number` VARCHAR(50),
	`row_purpose` VARCHAR(50),
	`physical_inspection` VARCHAR(50),
	`room` VARCHAR(50),
	`time` VARCHAR(50),
	`date` VARCHAR(50),
	`pass_fail` VARCHAR(50),
	PRIMARY KEY (`id`),
	INDEX `device_checkup_FI_1` (`client_id`),
	CONSTRAINT `device_checkup_FK_1`
		FOREIGN KEY (`client_id`)
		REFERENCES `client` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- device_test_data
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `device_test_data`;


CREATE TABLE `device_test_data`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`device_checkup_id` INTEGER,
	`name` VARCHAR(100),
	`type` VARCHAR(50),
	`value` VARCHAR(50),
	`passFail` VARCHAR(50),
	`unit` VARCHAR(50),
	PRIMARY KEY (`id`),
	KEY `device_test_data_FI_1`(`device_checkup_id`),
	CONSTRAINT `device_test_data_FK_1`
		FOREIGN KEY (`device_checkup_id`)
		REFERENCES `device_checkup` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- devices_failed
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `devices_failed`;


CREATE TABLE `devices_failed`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`device_id` INTEGER,
	`report_id` INTEGER,
	`client_id` VARCHAR(50),
	`status` VARCHAR(50),
	PRIMARY KEY (`id`),
	KEY `devices_failed_FI_1`(`device_id`),
	CONSTRAINT `devices_failed_FK_1`
		FOREIGN KEY (`device_id`)
		REFERENCES `device` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- devices_files
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `devices_files`;


CREATE TABLE `devices_files`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`filename` VARCHAR(250),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- distances
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `distances`;


CREATE TABLE `distances`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`client_id_1` INTEGER,
	`client_id_2` INTEGER,
	`travel_time_hours` INTEGER,
	`travel_time_mins` INTEGER,
	`travel_distance` INTEGER,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `client1_indx`(`client_id_1`),
	KEY `client2_indx`(`client_id_2`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- dropdown
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `dropdown`;


CREATE TABLE `dropdown`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`menu` VARCHAR(50) default '<null>' NOT NULL,
	`value` VARCHAR(50) default '<null>' NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- final_device_report
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `final_device_report`;


CREATE TABLE `final_device_report`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`client_id` VARCHAR(50),
	`date` VARCHAR(50),
	`pass_fail` VARCHAR(250),
	`total_failed` INTEGER,
	`total_passed` INTEGER,
	`total_bp` INTEGER,
	`total_trace` INTEGER,
	`total_missed` INTEGER,
	`total_outlets` INTEGER,
	`contact` VARCHAR(50),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- job_status
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `job_status`;


CREATE TABLE `job_status`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`status_name` VARCHAR(50) default '<null>' NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`workorder_type_id` INTEGER,
	PRIMARY KEY (`id`),
	UNIQUE KEY `job_status_status_name_unique` (`status_name`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- job_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `job_type`;


CREATE TABLE `job_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type_name` VARCHAR(50) default '<null>',
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `job_type_type_name_unique` (`type_name`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- location
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `location`;


CREATE TABLE `location`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`latitude` VARCHAR(50) default '<null>' NOT NULL,
	`longitude` VARCHAR(50) default '<null>' NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- qualifications
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `qualifications`;


CREATE TABLE `qualifications`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_id` INTEGER,
	`device_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `qualifications_FI_1`(`user_id`),
	KEY `qualifications_FI_2`(`device_id`),
	CONSTRAINT `qualifications_FK_1`
		FOREIGN KEY (`user_id`)
		REFERENCES `user` (`id`),
	CONSTRAINT `qualifications_FK_2`
		FOREIGN KEY (`device_id`)
		REFERENCES `device` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- specification
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `specification`;


CREATE TABLE `specification`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`device_name` VARCHAR(50),
	`manufacturer` VARCHAR(50),
	`model_number` VARCHAR(50),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- tech_distances
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `tech_distances`;


CREATE TABLE `tech_distances`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`tech_id` INTEGER,
	`client_id` INTEGER,
	`travel_time_hours` INTEGER,
	`travel_time_mins` INTEGER,
	`travel_distance` FLOAT,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- unprocessed_devices
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `unprocessed_devices`;


CREATE TABLE `unprocessed_devices`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`filename` VARCHAR(250),
	`device_id` VARCHAR(50),
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `un_filename` (`filename`, `device_id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- user
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user`;


CREATE TABLE `user`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`user_name` VARCHAR(50),
	`first_name` VARCHAR(50),
	`last_name` VARCHAR(50),
	`email` VARCHAR(50),
	`phone` VARCHAR(50),
	`address` VARCHAR(50),
	`address_2` VARCHAR(50),
	`city` VARCHAR(50),
	`state` VARCHAR(50),
	`zip` VARCHAR(50),
	`password` VARCHAR(64),
	`start_time` VARCHAR(50),
	`end_time` VARCHAR(50),
	`location_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`user_type_id` INTEGER,
	`weight` INTEGER,
	`admin` INTEGER default 0,
	PRIMARY KEY (`id`),
	KEY `user_user_name_index`(`user_name`),
	INDEX `user_FI_1` (`user_type_id`),
	CONSTRAINT `user_FK_1`
		FOREIGN KEY (`user_type_id`)
		REFERENCES `user_type` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- user_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `user_type`;


CREATE TABLE `user_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type_name` VARCHAR(50) default '<null>' NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `idxUserTypeName` (`type_name`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- workorder
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `workorder`;


CREATE TABLE `workorder`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`device_id` INTEGER,
	`client_id` INTEGER,
	`tech` INTEGER,
	`office` INTEGER,
	`assigned_by` INTEGER,
	`page_number` VARCHAR(50),
	`travel_time` VARCHAR(50),
	`onsite_time` VARCHAR(50),
	`zip` VARCHAR(50),
	`date_recieved` VARCHAR(50),
	`date_completed` VARCHAR(50),
	`invoice` VARCHAR(50),
	`reason` VARCHAR(50),
	`action_taken` VARCHAR(50),
	`remarks` VARCHAR(150),
	`job_date` VARCHAR(50),
	`job_start` VARCHAR(50),
	`job_end` VARCHAR(50),
	`exact_time` INTEGER,
	`sale_tax` DOUBLE default 0,
	`zone_charge` DOUBLE default 0,
	`shipping_handling` DOUBLE default 0,
	`total` DOUBLE default 0,
	`service_travel` DOUBLE default 0,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	`job_status_id` INTEGER,
	`job_type_id` INTEGER,
	`workorder_type_id` INTEGER,
	`caller` VARCHAR(75),
	`job_scheduled_date` VARCHAR(50),
	PRIMARY KEY (`id`),
	KEY `workorder_FI_1`(`device_id`),
	KEY `workorder_FI_2`(`client_id`),
	CONSTRAINT `workorder_FK_1`
		FOREIGN KEY (`device_id`)
		REFERENCES `device` (`id`),
	CONSTRAINT `workorder_FK_2`
		FOREIGN KEY (`client_id`)
		REFERENCES `client` (`id`),
	INDEX `workorder_FI_3` (`job_status_id`),
	CONSTRAINT `workorder_FK_3`
		FOREIGN KEY (`job_status_id`)
		REFERENCES `job_status` (`id`),
	INDEX `workorder_FI_4` (`job_type_id`),
	CONSTRAINT `workorder_FK_4`
		FOREIGN KEY (`job_type_id`)
		REFERENCES `job_type` (`id`),
	INDEX `workorder_FI_5` (`workorder_type_id`),
	CONSTRAINT `workorder_FK_5`
		FOREIGN KEY (`workorder_type_id`)
		REFERENCES `workorder_type` (`id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- workorder_tech
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `workorder_tech`;


CREATE TABLE `workorder_tech`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`workorder_id` INTEGER,
	`user_id` INTEGER,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	KEY `workorder_tech_FI_1`(`workorder_id`),
	KEY `workorder_tech_FI_2`(`user_id`)
)Type=MyISAM;

#-----------------------------------------------------------------------------
#-- workorder_type
#-----------------------------------------------------------------------------

DROP TABLE IF EXISTS `workorder_type`;


CREATE TABLE `workorder_type`
(
	`id` INTEGER  NOT NULL AUTO_INCREMENT,
	`type_name` VARCHAR(50) default '<null>' NOT NULL,
	`created_at` DATETIME,
	`updated_at` DATETIME,
	PRIMARY KEY (`id`),
	UNIQUE KEY `workorder_type_type_name_unique` (`type_name`)
)Type=MyISAM;

# This restores the fkey checks, after having unset them earlier
SET FOREIGN_KEY_CHECKS = 1;
