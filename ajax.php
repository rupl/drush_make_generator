<?php

include('_lib.php');

$ask = (isset($_REQUEST['ask'])) ? $_REQUEST['ask'] : FALSE;
$output = '';

if (isset($ask)){

  switch ($ask) {
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
