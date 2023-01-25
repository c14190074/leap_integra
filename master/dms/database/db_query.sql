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