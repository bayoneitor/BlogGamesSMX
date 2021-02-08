
CREATE TABLE `users` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`idUsers` TINYTEXT NOT NULL,
	`uidUsers` VARCHAR(100) NOT NULL,
	`emailUsers` VARCHAR(200) NOT NULL,
	`pwdUsers` VARCHAR(100) NOT NULL,
	`Verified` TINYINT(4) NOT NULL,
	`Token` VARCHAR(100) NOT NULL,
	`CreatedAt` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
	`LastAccess` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	`UserType` CHAR(50) NOT NULL DEFAULT 'Default',
	`Blocked` INT(11) NOT NULL DEFAULT '0',
	`BlockedReason` TEXT NOT NULL,
	PRIMARY KEY (`id`),
	UNIQUE INDEX `emailUsers` (`emailUsers`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=5
;


CREATE TABLE `comments_post` (
	`id_commentary` INT(11) NOT NULL AUTO_INCREMENT,
	`post_id` INT(11) NOT NULL,
	`user_commentary` VARCHAR(50) NOT NULL,
	`commentary` TEXT NOT NULL,
	`date_comment` TEXT NOT NULL,
	PRIMARY KEY (`id_commentary`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3
;

CREATE TABLE `post` (
	`id_post` INT(11) NOT NULL AUTO_INCREMENT,
	`author_post` VARCHAR(50) NULL DEFAULT NULL,
	`date_post` DATE NOT NULL,
	`category_post` VARCHAR(50) NULL DEFAULT NULL,
	`title_post` VARCHAR(150) NULL DEFAULT NULL,
	`image_post` TEXT NULL,
	`description_post` TEXT NULL,
	`content_post` LONGTEXT NULL,
	PRIMARY KEY (`id_post`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=19
;

CREATE TABLE `pwdreset` (
	`pwdResetId` INT(11) NOT NULL AUTO_INCREMENT,
	`pwdResetEmail` TEXT NOT NULL,
	`pwdResetSelector` TEXT NOT NULL,
	`pwdResetToken` LONGTEXT NOT NULL,
	`pwdResetExpires` TEXT NOT NULL,
	`pwdUsesOnce` INT(11) NOT NULL DEFAULT '0',
	PRIMARY KEY (`pwdResetId`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
AUTO_INCREMENT=3
;

