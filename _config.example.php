<?php

// Configuration for Drush Make Generator
// Remove '.example' from the filename to use

/*
// errors!!
error_reporting(E_ALL);
ini_set('display_errors', '1');
//*/


// Connect to database
$dbh = mysql_connect('localhost','USER','PASS');
mysql_select_db('DATABASE');
define('SQL_SEPARATOR','|');


// point release of Drupal
global $version;
$version = (isset($_GET['v'])) ? $_GET['v'] : 6;


// directory to install contrib modules
define('CONTRIB_DIR','contrib');


// path to drush. default assumes you have an alias 'drush'
// or that drush is in a known bin directory
define('PATH_TO_DRUSH','drush');


// analytics account
// swap code out in footer.php to use whatever service you wish
define('ANALYTICS_ACCOUNT','');


// Protect against pointless execs
define('CONFIG_FILE','PRESENT');

?>