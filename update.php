<?php

// This is where most of the magic happens. 
// update.php checks all projects it knows about and logs their current dev releases to the `versions` table

header("Content-type: text/plain");

include('_lib.php');

  $count = 0;
  print "begin...\r\n\r\n";

  // pull projects
  $projects = fetchContrib();
  /*
    // debug
    $psql = sprintf("SELECT * FROM `projects` WHERE `type` = 'module' AND `version` = %d AND `status` = 1 LIMIT 10; ",$version);
    $projects = mysql_query($psql);
  //*/




  while($p = mysql_fetch_assoc($projects)){
  
    $count++;
    
    // delete old versions as we create new ones
    // There's no reason to keep a record of past releases. Drupal's version control does that.
    // Furthermore, a makefile is stored as text later on to ensure it's always rendered as requested
    $cleanSQL = sprintf("DELETE FROM `versions` WHERE pid = %d; ",$p['id']);
    $cleanResult = mysql_query($cleanSQL);
    
    // get some key data out of each module's .info file
    // drush knows the current recommended versions
    
    // fetching recommended version information
    $cmd = "cd d".$version."; ".PATH_TO_DRUSH." pm-releases ".$p['unique']." | grep 'Recommended'";
    $result = trim(`$cmd`);

    // debug 
    print "\r\ncmd:\r\n   ".$cmd."\r\n\r\nresult:\r\n   ".$result."\r\n";

    // release string; this regex catches a space on each side to ensure any releases like 6.x-6.0 or 7.x-7.0 get fully captured
    preg_match('/'.$version.'\.(.*?) /',$result,$recVersion);

    // record recommended release
    $releases = explode("\n",$result);
    $sql = '';
    if (isset($recVersion[0])){
      $recommended = trim(substr($recVersion[0],4));
      $sql = sprintf("INSERT INTO `versions` (`id`,`pid`,`version`,`release`,`type`) VALUES ('',%d,'%s','%s',%d); ",$p['id'],$version,$recommended,STABLE);
      mysql_query($sql) or die(mysql_error());
    } else {
      $sql = '-- no recommended releases found; ';
      $recVersion[0] = '';
    }
    print '   '.$sql."\r\n";

    // build URL, removing space from the release string we captured just now
    $url = 'http://drupalcode.org/project/'.$p['unique'].'.git/blob_plain/refs/tags/'.trim($recVersion[0]).':/'.$p['unique'].'.info';
    print "\r\n".'url: '.$url."\r\n";

    // fetch URL    
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 0); // osuosl.org doesn't allow POST
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $projectInfo = curl_exec($ch);       
    curl_close($ch);
    
    $packageName = $dependencies = '';
    
    // parse .info file for data
    
    // THEME
    if (preg_match('/engine\s*?=/',$projectInfo)) {

      // now we parse the .info file for the goods
      print "   -- theme .info file found";
      
      // parse output of .info file for package
      preg_match('/package\s+=\s+\"?([^\"\s\n]*)\"?/',$projectInfo,$package);
      $packageName = (isset($package[1])) ? str_replace('\'','',$package[1]) : 'Other';
        
      // parse output of .info file for dependencies
      preg_match_all('/dependencies\[\]\s+=\s+(.*)/', $projectInfo, $d);
      $dependencies = serialize($d[1]);
      
      // update main module info in our tables
      $updateSQL = sprintf(
        "UPDATE `projects` SET ".
        "package = '%s', dependencies = '%s', `type` = 'theme' ".
        "WHERE id = %d; ",
        $packageName, str_replace('\'','',$dependencies), 
        $p['id']
        );
      print "\r\n\r\n   ".$updateSQL."\r\n";
      mysql_query($updateSQL) or die(mysql_error());
      
      // fetching supported releases
      $cmd = "cd d".$version."; ".PATH_TO_DRUSH." pm-releases ".$p['unique']." | grep 'Supported' | grep -v 'Recommended'";
      $result = trim(`$cmd`);
      
      print "\r\n   ".$cmd."\r\n\r\n ".$result."\r\n";
      $releases = explode("\n",$result);
      $sql = '';
      foreach($releases as $r){
        preg_match('/ '.$version.'\.(.*?) /',$r,$match);
        $sup = @trim($match[0]);
        $sup = trim(substr($sup,4));
        if ($sup != ''){
          $sql = sprintf("INSERT INTO `versions` (`id`,`pid`,`version`,`release`,`type`) VALUES ('',%d,'%s','%s',%d); ",$p['id'],$version,$sup,SUPPORTED);
          mysql_query($sql) or die(mysql_error());
        } else {
          $sql = '-- no supported releases found; ';
          $recVersion[0] = '';
        }
        print '   '.$sql."\r\n";
      }

      // fetching dev releases
      $cmd = "cd d".$version."; ".PATH_TO_DRUSH." pm-releases ".$p['unique']." | grep 'Development' | grep -v 'Recommended' | grep -v 'Supported'";
      $result = trim(`$cmd`);
      
      print "\r\n   ".$cmd."\r\n\r\n ".$result."\r\n";
      $releases = explode("\n",$result);
      $sql = '';
      foreach($releases as $r){
        preg_match('/'.$version.'\.(.*?) /',$r,$match);
        $dev = @trim($match[0]);
        $dev = trim(substr($dev,4));
        if ($dev != ''){
          $sql = sprintf("INSERT INTO `versions` (`id`,`pid`,`version`,`release`,`type`) VALUES ('',%d,'%s','%s',%d); ",$p['id'],$version,$dev,DEV);
          mysql_query($sql) or die(mysql_error());
        } else {
          $sql = '-- no dev releases found; ';
        }
        print '   '.$sql."\r\n";
      }
      print "\r\n";
      
    }
    
    // MODULE
    else if (preg_match('/name\s*?=/',$projectInfo)) {

      // now we parse the .info file for the goods
      print "   -- module .info file found";
      
      // parse output of .info file for package
      preg_match('/package\s+=\s+\"?([^\"\n]*)\"?/',$projectInfo,$package);
      $packageName = (isset($package[1])) ? str_replace('\'','',$package[1]) : 'Other';
  
      // parse output of .info file for dependencies. regex is simpler because project uniques are lowercase_with_underscores
      preg_match_all('/dependencies\[\]\s+=\s+(.*)/', $projectInfo, $d);
      $dependencies = serialize($d[1]);
      
      // update main module info in our tables
      $updateSQL = sprintf(
        "UPDATE `projects` SET ".
        "package = '%s', dependencies = '%s', `type` = 'module' ".
        "WHERE id = %d; ",
        $packageName, str_replace('\'','',$dependencies), 
        $p['id']
        );
      print "\r\n   ".$updateSQL."\r\n";
      mysql_query($updateSQL) or die(mysql_error());
      
      
      // fetching supported releases
      $cmd = "cd d".$version."; ".PATH_TO_DRUSH." pm-releases ".$p['unique']." | grep 'Supported' | grep -v 'Recommended'";
      $result = trim(`$cmd`);
      
      print "\r\n   ".$cmd."\r\n\r\n ".$result."\r\n";
      $releases = explode("\n",$result);
      $sql = '';
      foreach($releases as $r){
        preg_match('/'.$version.'\.(.*?) /',$r,$match);
        $rel = @trim($match[0]);
        $rel = substr($rel,4);
        if ($rel != ''){
          $sql = sprintf("INSERT INTO `versions` (`id`,`pid`,`version`,`release`,`type`) VALUES ('',%d,'%s','%s',%d); ",$p['id'],$version,$rel,SUPPORTED);
          mysql_query($sql) or die(mysql_error());
        } else {
          $sql = '-- no supported releases found; ';
        }
        print '   '.$sql."\r\n";
      }

      // fetching dev releases
      $cmd = "cd d".$version."; ".PATH_TO_DRUSH." pm-releases ".$p['unique']." | grep 'Development' | grep -v 'Recommended' | grep -v 'Supported'";
      $result = trim(`$cmd`);
      
      print "\r\n   ".$cmd."\r\n\r\n ".$result."\r\n";
      $releases = explode("\n",$result);
      $sql = '';
      foreach($releases as $r){
        preg_match('/'.$version.'\.(.*?) /',$r,$match);
        $rel = @trim($match[0]);
        $rel = substr($rel,4);
        if ($rel != ''){
          $sql = sprintf("INSERT INTO `versions` (`id`,`pid`,`version`,`release`,`type`) VALUES ('',%d,'%s','%s',%d); ",$p['id'],$version,$rel,DEV);
          mysql_query($sql) or die(mysql_error());
        } else {
          $sql = '-- no dev releases found; ';
        }
        print '   '.$sql."\r\n";
      }
      print "\r\n";
      
    }
    
    // BAD RESPONSE
    else {
      // Couldn't recognize file, don't do anything
      print "   ========== no idea what's going on with this one...\r\n\r\n";
    }
    
    // debug
    print '=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-'."\r\n\r\n";
  
  } // end while

  print "\r\n     ...end\r\n\r\n";
  print $count.' projects updated'."\r\n";
  
?>