CREATE TABLE IF NOT EXISTS `tbl_user` (
	`user_id` INT(11) NOT NULL AUTO_INCREMENT,
	`fullname` VARCHAR(255),
	`email` VARCHAR(255),
	`password` VARCHAR(255),
	`phone` VARCHAR(255),
	`address` VARCHAR(255),
	`position` VARCHAR(255),
	`status` TINYINT(1) DEFAULT 1 COMMENT '0=Inactive; 1=Active',
	`status_email` TINYINT(1) DEFAULT 1 COMMENT '0=Inactive; 1=Active',
	`secret_key` VARCHAR(255),
	`encription_key` VARCHAR(255),
	`encription_iv` VARCHAR(255),
	`created_on` DATETIME DEFAULT NULL,
	`created_by` INT(11) DEFAULT NULL,
	`updated_on` DATETIME DEFAULT NULL,
	`updated_by` INT(11) DEFAULT NULL,
	`is_deleted` TINYINT(1) DEFAULT 0 COMMENT '0=No; 1=Yes',
	PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `tbl_folder` (
	`folder_id` INT(11) NOT NULL AUTO_INCREMENT,
	`folder_parent_id` INT(11),
	`name` VARCHAR(255),
	`description` VARCHAR(255),
	`created_on` DATETIME DEFAULT NULL,
	`created_by` INT(11) DEFAULT NULL,
	`updated_on` DATETIME DEFAULT NULL,
	`updated_by` INT(11) DEFAULT NULL,
	`is_deleted` TINYINT(1) DEFAULT 0 COMMENT '0=No; 1=Yes',
	PRIMARY KEY (`folder_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `tbl_folder` ADD `user_access` VARCHAR(255) DEFAULT NULL AFTER `description`;
ALTER TABLE `tbl_folder` ADD `type` VARCHAR(255) DEFAULT 'folder' AFTER `name`;
ALTER TABLE `tbl_folder` ADD `format` VARCHAR(255) DEFAULT NULL AFTER `type`;
ALTER TABLE `tbl_user` ADD `is_superadmin` INT(1) DEFAULT 0 AFTER `user_id`;

ALTER TABLE `tbl_folder` ADD `nomor` VARCHAR(255) DEFAULT NULL AFTER `name`;
ALTER TABLE `tbl_folder` ADD `perihal` VARCHAR(255) DEFAULT NULL AFTER `nomor`;
ALTER TABLE `tbl_folder` ADD `unit_kerja` VARCHAR(255) DEFAULT NULL AFTER `perihal`;
ALTER TABLE `tbl_folder` ADD `keyword` VARCHAR(255) DEFAULT NULL AFTER `unit_kerja`;
ALTER TABLE `tbl_folder` ADD `related_document` VARCHAR(255) DEFAULT NULL AFTER `keyword`;
ALTER TABLE `tbl_folder` ADD `size` VARCHAR(255) DEFAULT NULL AFTER `format`;



CREATE TABLE IF NOT EXISTS `tbl_file` (
	`file_id` INT(11) NOT NULL AUTO_INCREMENT,
	`folder_id` INT(11),
	`nomer` VARCHAR(255),
	`perihal` VARCHAR(255),
	`unit_kerja` VARCHAR(255),
	`keyword` VARCHAR(255),
	`related_document` VARCHAR(255),
	`description` VARCHAR(255),
	`created_on` DATETIME DEFAULT NULL,
	`created_by` INT(11) DEFAULT NULL,
	`updated_on` DATETIME DEFAULT NULL,
	`updated_by` INT(11) DEFAULT NULL,
	`is_deleted` TINYINT(1) DEFAULT 0 COMMENT '0=No; 1=Yes',
	PRIMARY KEY (`file_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `tbl_file` ADD `name` VARCHAR(255) DEFAULT 0 AFTER `folder_id`;

ALTER TABLE `tbl_folder` ADD `is_revision` INT(1) DEFAULT 0 AFTER `name`;
ALTER TABLE `tbl_folder` ADD `no_revision` INT(11) DEFAULT 0 AFTER `is_revision`;
ALTER TABLE `tbl_folder` ADD `original_id` INT(1) DEFAULT 0 AFTER `no_revision`;

CREATE TABLE IF NOT EXISTS `tbl_logs` (
	`logs_id` INT(11) NOT NULL AUTO_INCREMENT,
	`file_target_id` INT(11),
	`type` VARCHAR(255),
	`description` VARCHAR(255),
	`created_on` DATETIME DEFAULT NULL,
	`created_by` INT(11) DEFAULT NULL,
	`updated_on` DATETIME DEFAULT NULL,
	`updated_by` INT(11) DEFAULT NULL,
	`is_deleted` TINYINT(1) DEFAULT 0 COMMENT '0=No; 1=Yes',
	PRIMARY KEY (`logs_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `tbl_folder` ADD `last_viewed` DATETIME DEFAULT NULL AFTER `user_access`;
ALTER TABLE `tbl_folder` ADD `last_downloaded` DATETIME DEFAULT NULL AFTER `last_viewed`;
ALTER TABLE `tbl_logs` ADD `act` VARCHAR(255) DEFAULT 'general' AFTER `file_target_id`;

ALTER TABLE `tbl_folder` ADD `new_file_id` INT(11) DEFAULT 0 AFTER `original_id`;

CREATE TABLE `tbl_user_api_login` (
  `api_login_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `clock_in` datetime DEFAULT NULL,
  `clock_out` datetime DEFAULT NULL,
  PRIMARY KEY (`api_login_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;