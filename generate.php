<?php

ob_start();

include('_lib.php');

/* debug
print '<pre>';
print_r($_REQUEST);
print '</pre>';
exit;
//*/

// new or old makefile?
if (isset($_REQUEST['token']) && sanitize('token',$_REQUEST['token'])) {
  // old; pass on through
  $token = $_REQUEST['token'];
} else {

  // new; random string, aliases can be added later
  $token = substr(md5(rand(0,1000000000).'drushmake'),4,12);

  // get rid of any unused URL widgets
  if (isset($_REQUEST['makefile']['modules']['|THIS|'])) {unset($_REQUEST['makefile']['modules']['|THIS|']); }
  if (isset($_REQUEST['makefile']['themes']['|THIS|'])) {unset($_REQUEST['makefile']['themes']['|THIS|']); }
  if (isset($_REQUEST['makefile']['libs']['|THIS|'])) {unset($_REQUEST['makefile']['libs']['|THIS|']); }
  
  // escape and flatten data
  $version = (isset($_REQUEST['makefile']['version']))    ? mysql_real_escape_string($_REQUEST['makefile']['version'])              : $version;
  $core = (isset($_REQUEST['makefile']['core']))          ? mysql_real_escape_string(serialize($_REQUEST['makefile']['core']))      : FALSE;
  $modules = (isset($_REQUEST['makefile']['modules']))    ? mysql_real_escape_string(serialize($_REQUEST['makefile']['modules']))   : FALSE;
  $themes = (isset($_REQUEST['makefile']['themes']))      ? mysql_real_escape_string(serialize($_REQUEST['makefile']['themes']))    : FALSE;
  $libs = (isset($_REQUEST['makefile']['libs']))          ? mysql_real_escape_string(serialize($_REQUEST['makefile']['libs']))      : FALSE;
  $opts = (isset($_REQUEST['makefile']['opts']))          ? mysql_real_escape_string(serialize($_REQUEST['makefile']['opts']))      : FALSE;
  //$includes = (isset($_REQUEST['makefile']['includes']))? serialize(rmvThis($_REQUEST['makefile']['includes']))  : FALSE;


  /* debug
  print '<pre>'."\r\n";
  print $token." -token\r\n";
  print $version." -version\r\n";
  print $core."\r\n";
  print $modules."\r\n";
  print $themes."\r\n";
  print $libs."\r\n";
  print $opts."\r\n";
  print '</pre>'."\r\n";
  exit;
  //*/


  // store in db
  $storeSQL = sprintf("INSERT INTO `makefiles` (token,version,core,modules,themes,libs,opts) VALUES ('%s','%s','%s','%s','%s','%s','%s'); ",$token,$version,$core,$modules,$themes,$libs,$opts);
  $storeResult = mysql_query($storeSQL) or die(mysql_error());

  // sharing.. later
  if ($storeResult) {$share = TRUE; }
  else {$share = FALSE; }

}

// redirect
header("Location: ".fileURL($token));

ob_flush();

?>