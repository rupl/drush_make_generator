<?php

include('_lib.php');

// collect variables and validate if necessary
$ask = (isset($_REQUEST['ask'])) ? $_REQUEST['ask'] : FALSE;
$v = (isset($_REQUEST['v']) && is_numeric($_REQUEST['v'])) ? $_REQUEST['v'] : $version;
$output = '';

if ($ask){

  switch ($ask) {
    case 'all':
      $output = formMakefile($v);
      break;
      
    case 'libraries':
      $output = formDownload('libraries',array('unique'=>'library'));
      break;
    
    case 'themes':
      $output = formDownload('themes',array('unique'=>'theme'));
      break;
      
    case 'modules':
      $output = formDownload('modules',array('unique'=>'module'));
      break;
      
    case 'includes':
      $output = formDownload('includes',array('unique'=>'include'));
      break;
      
    default:
      $output = 'ERROR :/';
      break;
  }

  print $output;

}
