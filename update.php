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
    $psql = sprintf("SELECT * FROM `projects` WHERE `type` = 'module' AND `status` = 1 LIMIT 10; ");
    $projects = mysql_query($psql);
  //*/




  while($p = mysql_fetch_assoc($projects)){
  
    $count++;
    
    // delete old versions
    // There's no reason to keep a record of past releases. Drupal's version control does that.
    $cleanSQL = sprintf("DELETE FROM `versions` WHERE pid = %d; ",$p['id']);
    $cleanResult = mysql_query($cleanSQL);
    
    // get some key data out of each module's .info file
    // drush knows the current recommended versions
    
    // fetching recommended version information
    $cmd = "cd d".$version."; ".PATH_TO_DRUSH." pm-releases ".$p['unique']." | grep 'Recommended'";
    $result = trim(`$cmd`);

    // debug 
    print "\r\ncmd:\r\n   ".$cmd."\r\n\r\nresult:\r\n   ".$result."\r\n";

    // release string; this catches a space on each side to ensure any releases like 6.x-6.0 or 7.x-7.0 get fully captured
    preg_match('/ '.$version.'\.x-(\d{1}\.\d*(-[a-zA-Z0-9]*)? )/',$result,$recVersion);

    // GIT WITH THE PROGRAMME
    
    // build URL, removing space from the release string we captured just now
    $url = 'http://drupalcode.org/project/'.$p['unique'].'.git/blob_plain/refs/tags/'.trim($recVersion[0]).':/'.$p['unique'].'.info';
    print "\r\n".'url: '.$url."\r\n\r\n";

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
      $packageName = ($package[1]) ? str_replace('\'','',$package[1]) : 'Other';
        
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
      print "\r\n\r\n   ".$updateSQL;
      mysql_query($updateSQL) or die(mysql_error());
      
      
      // fetching dev version information
      $cmd = "cd d".$version."; ".PATH_TO_DRUSH." pm-releases ".$p['unique']." | grep 'Supported\|Development' | grep -v 'Recommended'";
      $result = trim(`$cmd`);
      
      print "\r\n   ".$cmd."\r\n\r\n ".$result."\r\n";
      $releases = explode("\n",$result);
      $sql = '';
      print "\r\n";
      foreach($releases as $r){
        preg_match('/ '.$version.'\.(.*?) /',$r,$match);
        $dev = @trim($match[0]);
        if ($dev != ''){
          $sql = sprintf("INSERT INTO `versions` (`id`,`pid`,`version`,`release`) VALUES ('',%d,'%s','%s'); ",$p['id'],$version,$dev);
          mysql_query($sql) or die(mysql_error());
        } else {
          $sql = '-- no dev version found; ';
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
      $packageName = ($package[1]) ? str_replace('\'','',$package[1]) : 'Other';
  
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
      print "\r\n\r\n   ".$updateSQL;
      mysql_query($updateSQL) or die(mysql_error());
      
      
      // fetching dev version information
      $cmd = "cd d".$version."; ".PATH_TO_DRUSH." pm-releases ".$p['unique']." | grep 'Supported\|Development' | grep -v 'Recommended'";
      $result = trim(`$cmd`);
      
      print "\r\n   ".$cmd."\r\n\r\n ".$result."\r\n";
      $releases = explode("\n",$result);
      $sql = '';
      print "\r\n";
      foreach($releases as $r){
        preg_match('/ '.$version.'\.(.*?) /',$r,$match);
        $dev = trim($match[0]);
        if ($dev != ''){
          $sql = sprintf("INSERT INTO `versions` (`id`,`pid`,`version`,`release`) VALUES ('',%d,'%s','%s'); ",$p['id'],$version,$dev);
          mysql_query($sql) or die(mysql_error());
        } else {
          $sql = '-- no dev version found; ';
        }
        print '   '.$sql."\r\n";
      }
      print "\r\n";
      
    }

    /*
    // BAD REQUEST - CVS, haven't found git equivalent
    else if (strpos($projectInfo,'InvalidRevision:')) {
      // Requested version of Drupal doesn't support this module
      print "   ========== Not supported in Drupal ".$version."\r\n\r\n";
    }
    //*/
    
    // BAD RESPONSE
    else {
      // Couldn't recognize file, don't do anything
      print "   ========== I have no idea what's going on with this one...\r\n\r\n";
    }
    
    // debug
    print '=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-'."\r\n\r\n";
  
  } // end while

  print "\r\n     ...end\r\n\r\n";
  print $count.' projects updated'."\r\n";
  
?>