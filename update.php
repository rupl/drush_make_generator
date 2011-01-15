<?php

header("Content-type: text/plain");

include('_lib.php');

  $count = 0;
  print "begin...\r\n\r\n";



  // Clear the database of old dev versions. There's no reason to keep a record of past releases. Drupal's VC does that.
  // This allows us to stay reasonably current in cases where the maintainer removes a dev version.
  $cleanup = sprintf("DELETE FROM `versions` WHERE timestamp < NOW(); ");
  // mysql_query($cleanup) or die(mysql_error());





  // pull projects
  $projects = fetchContrib();

  while($p = mysql_fetch_assoc($projects)){
  
    $count++;
    
    // get some key data out of each module's .info file
    // drush knows what the current recommended versions
    
    // fetching recommended version information
    $cmd = "cd d".$version."; ~/Sites/drush/drush pm-releases ".$p['unique']." | grep 'Recommended'";
    $result = trim(`$cmd`);

    // debug 
    print "\r\n   ".$cmd."\r\n\r\n   ".$result."\r\n";

    // pull stable version nubmer    
    preg_match('/ '.$version.'\.x-(\d{1}\.\d*)/',$result,$recVersion);
    $stableVersion = 'DRUPAL-'.$version.'--'.str_replace('.','-',$recVersion[1]);
    preg_match('/DRUPAL-'.$version.'--\d{1}/',$stableVersion,$shortVersion);

    // debug
    // print '   Recommended Version: '.$recVersion[0] ."| DRUPAL-".$version."--".$recVersion[1]."\r\n\r\n";
    
    // fetch the latest stable release
    $url = 'http://drupalcode.org/viewvc/drupal/contributions/modules/'.$p['unique'].'/'.$p['unique'].'.info?view=co&pathrev='.$stableVersion;
    $url2 = 'http://drupalcode.org/viewvc/drupal/contributions/modules/'.$p['unique'].'/'.$p['unique'].'.info?view=co&pathrev='.$shortVersion[0];
    print '   '.$url."\r\n";
    print '   '.$url2."\r\n\r\n";
    $moduleInfo = $packageName = $dependencies = '';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $moduleInfo = curl_exec($ch);       
    curl_close($ch);

    // See if we found the .info file;
    // Try the second URL if the first failed;
    // Contrib version numbers are picked by humans so we have to keep guessing if we want more complete auto-population :\
    $infoFound = false;
    if (strpos($moduleInfo,'; $Id') === false) {
      $moduleInfo = $packageName = $dependencies = '';  
      $ch = curl_init($url2);
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_POST, 1);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
      $moduleInfo = curl_exec($ch);       
      curl_close($ch);    
    }
    

    // now we parse the .info file for the goods
    if (strpos($moduleInfo,'; $Id') !== false) {

      // success! process .info file
      print "   -- .info file found";
      
      // output of .info file is parsed for package/dependencies    
      preg_match('/package\s+=\s+\"?([^\"\s\n]*)\"?/',$moduleInfo,$package);
      $packageName = ($package[1]) ? str_replace('\'','',$package[1]) : 'Other';
  
      // extract dependencies
      preg_match_all('/dependencies\[\]\s+=\s+(.*)/', $moduleInfo, $d);
      $dependencies = serialize($d[1]);
      
      // update main module info in our tables
      $updateSQL = sprintf(
        "UPDATE `projects` SET ".
        "package = '%s', dependencies = '%s' ".
        "WHERE id = %d; ",
        $packageName, str_replace('\'','',$dependencies), 
        $p['id']
        );
      print "\r\n\r\n   ".$updateSQL;
      mysql_query($updateSQL) or die(mysql_error());
      
      
      // fetching dev version information
      $cmd = "cd d".$version."; ~/Sites/drush/drush pm-releases ".$p['unique']." | grep 'Supported\|Development' | grep -v 'Recommended'";
      $result = trim(`$cmd`);
      
      print "\r\n   ".$cmd."\r\n\r\n ".$result."\r\n";
      $releases = explode("\n",$result);
      $sql = '';
      print "\r\n";
      foreach($releases as $r){
        preg_match('/ '.$version.'\.(.*?) /',$r,$match);
        $dev = trim($match[0]);
        $sql = sprintf("INSERT INTO `versions` (`id`,`pid`,`version`,`release`) VALUES ('',%d,'%s','%s'); ",$p['id'],$version,$dev);
        mysql_query($sql) or die(mysql_error());
        print '   '.$sql."\r\n";
      }
      print "\r\n";
      
    }
    else if (strpos($moduleInfo,'InvalidRevision:')) {
      // Requested version of Drupal doesn't support this module
      print "   ========== Not supported in Drupal ".$version."\r\n\r\n";
    }
    else {
      // Couldn't recognize file, don't do anything
      print "   ========== I have no idea what's going on with this one...\r\n";
    }
    
    // debug
    print '=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-=-'."\r\n\r\n";
  }

  print "\r\n     ...end\r\n\r\n";
  print $count.' projects updated'."\r\n";
  
?>