/*
 * NULL allowed for the version field
 */
ALTER TABLE  `projects` CHANGE  `version`  `version` VARCHAR( 255 );

/*
 * Each release can have a URL. This is for libraries and other non-contrib projects.
 */
ALTER TABLE  `versions` ADD  `url` TEXT NULL AFTER  `release`;

/*
 * Add table for short URLs
 */
CREATE TABLE `aliases` (
  `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
  `makefile` INT NOT NULL ,
  `alias` VARCHAR( 255 ) NOT NULL ,
  UNIQUE (`alias`)
) ENGINE = MYISAM ;

/*
 * Add column for release types, mostly to distinguish stable vs dev.
 */
ALTER TABLE  `versions` ADD  `type` INT( 1 ) NOT NULL DEFAULT '0' AFTER  `release`
