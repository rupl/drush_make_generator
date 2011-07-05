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
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(255) NOT NULL,
  `alias` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `alias` (`alias`),
  UNIQUE KEY `token` (`token`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*
 * Add column for release types, mostly to distinguish stable vs dev.
 */
ALTER TABLE  `versions` ADD  `type` INT( 1 ) NOT NULL DEFAULT '0' AFTER  `release`
