<?

    header("Content-type: text/plain");
    $unique = ($_GET['contrib']) ? $_GET['contrib'] : 'cck';

    // get each module's package name from this URL
    // also grab dependencies for future mayhem
    $url = 'http://drupalcode.org/viewvc/drupal/contributions/modules/'.$unique.'/'.$unique.'.info?view=co';
    $moduleInfo = $packageName = $dependencies = '';

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HEADER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    $moduleInfo = curl_exec($ch);       
    curl_close($ch);

    // output of .info file is parsed for package/dependencies    
    print $moduleInfo;
    print "\r\n\r\n--- Package ---\r\n\r\n";
    preg_match('/package\s+=\s+\"?([^\"]*)\"?/',$moduleInfo,$p);
    print $p[1];

    // extract dependencies
    print "\r\n\r\n--- Dependencies ---\r\n\r\n";
    preg_match_all('/dependencies\[\]\s+=\s+(.*)/', $moduleInfo, $dependencies);

    // debug    
    foreach($dependencies[1] as $d){
      print $d."\r\n";
    }
    
    // store
    print "\r\n". serialize($dependencies[1]);

?>