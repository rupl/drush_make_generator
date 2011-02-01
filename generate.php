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
  
  $core = (isset($_REQUEST['projects']['core'])) ? $_REQUEST['projects']['core'] : FALSE;
  $modules = (isset($_REQUEST['projects']['modules'])) ? $_REQUEST['projects']['modules'] : FALSE;
  $themes = (isset($_REQUEST['projects']['themes'])) ? $_REQUEST['projects']['themes'] : FALSE;
  $libs = (isset($_REQUEST['projects']['libs'])) ? $_REQUEST['projects']['libs'] : FALSE;
  $opts = (isset($_REQUEST['projects']['opts'])) ? $_REQUEST['projects']['opts'] : FALSE;
  
  $storeSQL = sprintf("INSERT INTO `makefiles` (id,token,version,core,modules,themes,libs,opts) VALUES ('','%s','%s','%s','%s','%s','%s','%s'); ",$token,$version,serialize($core),serialize($modules),serialize($themes),serialize($libs),serialize($opts));
  $storeResult = mysql_query($storeSQL);
  
  if ($storeResult) {$share = TRUE; }
  else {$share = FALSE; }

}

// redirect
header("Location: ".fileURL($token));

ob_flush();

?>