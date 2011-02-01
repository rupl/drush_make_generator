/*
  NULL allowed for the version field
*/
ALTER TABLE  `projects` CHANGE  `version`  `version` VARCHAR( 255 );

/*
  Each release can have a URL. This is for libraries and other non-contrib projects.
*/
ALTER TABLE  `versions` ADD  `url` TEXT NULL AFTER  `release`;
