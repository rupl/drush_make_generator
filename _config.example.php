<?php

// Configuration for Drush Make Generator
// Remove '.example' from the filename to use

/*
// errors!!
error_reporting(E_ALL);
ini_set('display_errors', '1');
//*/

// Protect against pointless execs
define('CONFIG_FILE','PRESENT');

// Connect to database
$dbh = mysql_connect('localhost','USER','PASS');
mysql_select_db('DATABASE');
define('SQL_SEPARATOR','|');


// major release of Drupal
global $version;
$version = (isset($_GET['v'])) ? $_GET['v'] : 6;


// path to drush. default assumes you have an alias 'drush'
// or that drush is in a known bin directory
define('PATH_TO_DRUSH','drush');


// analytics account
// swap code out in footer.php to use whatever service you wish
define('ANALYTICS_ACCOUNT','');


// release flags
// defined numerically so we can sort them logically
define('STABLE',9);
define('SUPPORTED',5);
define('DEV',0);


/**
 * MAKEFILE OPTIONS
 * 
 */

// directory to install contrib modules
define('CONTRIB_DIR','');

// default shorturl value
define('SHORTURL_DEFAULT','short-url');


?>