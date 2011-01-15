<?php

// header("Content-type: text/plain");

include('_lib.php');

/* debug
print_r($_REQUEST);
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
  $contrib = $_REQUEST['projects']['contrib'];
  $libs = $_REQUEST['projects']['libs'];
  
  $storeSQL = sprintf("INSERT INTO `makefiles` (id,token,version,core,contrib,libs) VALUES ('','%s','%s','%s','%s','%s'); ",$token,$version,serialize($core),serialize($contrib),serialize($libs));
  $storeResult = mysql_query($storeSQL);
  
  if ($storeResult) {$share = TRUE; }
  else {$share = FALSE; }

}


header("Location: ".fileURL($token));


?>