<?php

// header("Content-type: text/plain");

include('_lib.php');

/* debug
print '<pre>';
print_r($_REQUEST);
print '</pre>';
exit;
//*/


if ($_GET['token'] != '') {
  
  /*
  $pullSQL = sprintf("SELECT * FROM `makefiles` WHERE token = '%s'; ",$_GET['token']);
  $pullResult = mysql_query($storeSQL);
  
  while ($m = mysql_fetch_assoc($pullResult)) {
    $version  = $m['version'];
    $core     = unserialize($m['core']);
    $contrib  = unserialize($m['contrib']);
    $libs     = unserialize($m['libs']);
    $share    = TRUE;
  }
  */
  
} else {

  // just make this up, aliases can be added later
  $token = substr(md5(rand(0,1000000000).'drushmake'),4,12);
  
  $core = $_REQUEST['projects']['core'];
  $modules = $_REQUEST['projects']['modules'];
  $themes = $_REQUEST['projects']['themes'];
  $libs = $_REQUEST['projects']['libs'];
  $opts = $_REQUEST['projects']['opts'];
  
  $storeSQL = sprintf("INSERT INTO `makefiles` (id,token,version,core,modules,themes,libs,opts) VALUES ('','%s','%s','%s','%s','%s','%s','%s'); ",$token,$version,serialize($core),serialize($modules),serialize($themes),serialize($libs),serialize($opts));
  $storeResult = mysql_query($storeSQL);
  
  if ($storeResult) {$share = TRUE; }
  else {$share = FALSE; }

}


header("Location: ".fileURL($token));


?>