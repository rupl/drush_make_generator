<?php

//*
// errors!!
error_reporting(E_STRICT);
ini_set('display_errors', '1');
//*/

// Connect to database
$dbh = mysql_connect('localhost','root','thr0waway');
mysql_select_db('drushmake_gen');
define('SQL_SEPARATOR','|');

// point release of Drupal
global $version;
$version = ($_GET['v']) ? $_GET['v'] : 6;

// directory to install contrib modules
define('CONTRIB_DIR','contrib');



/**
 * Fetches contrib projects as a raw DB object
 */
function fetchContrib() {
  global $version;
  $projectsSQL = sprintf("SELECT * FROM  `projects` WHERE `type` = 'contrib' AND `version` = '%s' AND `url` = '' AND `status` = 1; ",$version);
  $projects = mysql_query($projectsSQL);
  
  return $projects;
}




/**
 * Outputs a fieldset with all the options for Drupal core
 */
function formCores(){
  global $version;
  $output = '';
  
  $coresSQL = sprintf("SELECT  *,`unique` AS coreName FROM  `projects` WHERE `type` = 'core' AND `version` = '%s' AND `status` = 1 ORDER BY `unique` ASC; ",$version);
  $cores = mysql_query($coresSQL);
  
	$output .= '<fieldset class="fs-core">
			<legend>Pick a Core, Any Core</legend>';

  while($c = mysql_fetch_assoc($cores)):
  	$output .= '
  				<label for="'. $c['unique'] .'-stable">
  					<input id="'. $c['unique'] .'-stable" type="radio" name="projects[core]" value="'. $c['unique'] .'" /> <span class="title">'.$c['title'].'</span>
  					<!-- span class="dev"><input id="'. $c['unique'] .'-dev" type="radio" name="projects[core]" value="'. $c['unique'] .'dev" /> Use dev branch</span -->
  				</label>';
  endwhile;
  
  $output .= '</fieldset>';

  return $output;
}



/**
 * Outputs fieldsets for all the contrib modules, grouped by package name (same groups as /admin/build/modules)
 */
function formProjects(){
  global $version;
  $output = '';
  
  $groupsSQL = sprintf("SELECT DISTINCT package as groupName FROM `projects` WHERE `type` = 'contrib' AND `package` <> '' AND `version` = '%s' AND `status` = 1 ORDER BY package ASC; ",$version);
  $groups = mysql_query($groupsSQL);
  
  while ($group = mysql_fetch_assoc($groups)) {
  
    $sql = sprintf(
      "SELECT p.`id`,`unique`,`title`,GROUP_CONCAT(v.release ORDER BY v.release DESC SEPARATOR '%s') as `releases` ".
      "FROM `projects` AS p ".
      "LEFT JOIN `versions` AS v ON p.id = v.pid ".
      "WHERE p.package = '%s' AND p.version = '%s' AND `status` = 1 ".
      "GROUP BY p.unique ".
      "ORDER BY p.unique ASC; ",
      SQL_SEPARATOR,
      $group['groupName'],$version
      );
//    $output .= $sql;
    $projects = mysql_query($sql);

    $groupSafe = str_replace(' ','_',strtolower($group['groupName']));

		$output .= '<fieldset class="fs-'.$groupSafe.'">
				<legend>'.$group['groupName'].'</legend>';

    while($p = mysql_fetch_assoc($projects)):
      $releases = explode(SQL_SEPARATOR,$p['releases']);
    	$output .= '
    				<label for="'. $p['unique'] .'-stable">
    					<input id="'. $p['unique'] .'-stable" type="radio" name="projects[contrib]['. $p['unique'] .']" value="stable" /> <span class="title">'.$p['title'].'</span>';
    				  foreach($releases as $r){
    				    $output .=' <span class="dev"><input id="'. $p['unique'].'_'.$r .'" type="radio" name="projects[contrib]['. $p['unique'] .']" value="'. $r .'" /> Use '. $r .'</span>';
    				  }
    	$output .= '</label>';
      /*
      // drop-down approach, not fully baked but this code renders correctly
    	$output .= '
    				<label for="'. $p['unique'] .'-stable">
    					<input id="'. $p['unique'] .'-stable" type="radio" name="projects[contrib]['. $p['unique'] .']" value="stable" /> <span class="title">'.$p['title'].'</span>
    					<br />
    					<select id="'. $p['unique'].'" name="projects[contrib]['. $p['unique'] .']">
    					 <option value="stable">Recommended</option>';
    				  foreach($releases as $r){
    				    $output .=' <option value="'. $r .'">Use '. $r .'</option>';
    				  }
    				  $output .= '</select>';
    	$output .= '</label>';
      */
    endwhile;
    
    $output .= '</fieldset>';
  }

  return $output;
}



/**
 * Makes core request for makefile
 */
function makeCore($core='drupal') {
  global $version;
  $output = '';
  
  // we can branch Pressflow 6/7 later. Cases left below as a reminder.
  if ($core == 'pressflow'){$version = '';}

  switch($core.$version):
  
    case 'pressflow7':
    case 'pressflow6':
    case 'pressflow':
      $output .= '; Use pressflow instead of Drupal core:'."\r\n";
      $output .= 'projects[pressflow][type] = "core"'."\r\n";
      $output .= 'projects[pressflow][download][type] = "get"'."\r\n";
      $output .= 'projects[pressflow][download][url] = "http://files.pressflow.org/pressflow-6-current.tar.gz"'."\r\n";
      break;
    
    case 'drupal7':
      $output .= '; CVS checkout of Drupal 7.x. Requires the `core` property to be set to 7.x.'."\r\n";
      $output .= 'projects[drupal][type] = "core"'."\r\n";
      $output .= 'projects[drupal][download][type] = "cvs"'."\r\n";
      $output .= 'projects[drupal][download][root] = ":pserver:anonymous:anonymous@cvs.drupal.org:/cvs/drupal"'."\r\n";
      $output .= 'projects[drupal][download][revision] = "HEAD"'."\r\n";
      $output .= 'projects[drupal][download][module] = "drupal"'."\r\n";
      break;
    
    case 'drupal6':
      $output .= '; CVS checkout of Drupal 6.x core:'."\r\n";
      $output .= 'projects[drupal][type] = "core"'."\r\n";
      $output .= 'projects[drupal][download][type] = "cvs"'."\r\n";
      $output .= 'projects[drupal][download][root] = ":pserver:anonymous:anonymous@cvs.drupal.org:/cvs/drupal"'."\r\n";
      $output .= 'projects[drupal][download][revision] = "DRUPAL-6"'."\r\n";
      $output .= 'projects[drupal][download][module] = "drupal"'."\r\n";
      break;

    default:
      // thought about sliding this under the 'drupal6' case but a proper error seems better
      $output .= '; No drupal core was selected'."\r\n";
      
  endswitch;

  return $output;

}



/**
 * Makes project requests for the makefile
 */
function makeContrib($contrib='',$subdir=CONTRIB_DIR){
  global $version;
  $v = $version;
  $output = '';


  /*
; Each project that you would like to include in the makefile should be
; declared under the `projects` key. The simplest declaration of a project
; looks like this:
  
; To include the most recent views module:
  
  projects[] = views	
  
; This will, by default, retrieve the latest recommended version of the project
; using its update XML feed on Drupal.org. If any of those defaults are not
; desirable for a project, you will want to use the keyed syntax combined with
; some options.
  
; If you want to retrieve a specific version of a project:
  
  projects[cck] = 2.6
  
; Or an alternative, extended syntax:
  
  projects[ctools][version] = 1.3
  
; Check out the latest version of a project from CVS. Note that when using a
; repository as your project source, you must explictly declare the project
; type so that drush_make knows where to put your project.
  
  projects[data][type] = module
  projects[data][download][type] = cvs
  projects[data][download][module] = contributions/modules/data
  projects[data][download][revision] = DRUPAL-6--1
  
; Clone a project from github.
  
  projects[tao][type] = theme
  projects[tao][download][type] = git
  projects[tao][download][url] = git://github.com/developmentseed/tao.git
  
; If you want to install a module into a sub-directory, you can use the
; `subdir` attribute.
  
  projects[admin_menu][subdir] = custom
  */


  /* debug
  $output .= print_r($contrib,true);
  //*/

  // loop away
  foreach($contrib as $k => $v){
    $loop = '';
    
    if ($v == 'stable'){$loop .= 'projects[] = '.$k; }
    else {$loop .= 'projects['.$k.'] = '.$v; }

    $loop .= "\r\n";
      
    if ($subdir && $v == 'stable'){$loop = ''; }
    if ($subdir) {$loop .= 'projects['.$k.'][subdir] = '.$subdir."\r\n\r\n"; }
    
    $output .= $loop;
  }
  
  return $output;
}



/**
 * generate makefile - tha biznass
 */
function makeFile($version,$core,$contrib,$libs){

  $makefile = '; $Id$
;
; ----------------
; Generated makefile from http://drushmake.me
; Permanent URL: http://drushmake.me/file/'.$token.'
; ----------------
;
; This is a working makefile - try it! Any line starting with a `;` is a comment.
  
; Core version
; ------------
; Each makefile should begin by declaring the core version of Drupal that all
; projects should be compatible with.
  
core = '.$version.'.x
  
; API version
; ------------
; Every makefile needs to declare it\'s Drush Make API version. This version of
; drush make uses API version `2`.
  
api = 2
  
; Core project
; ------------
; In order for your makefile to generate a full Drupal site, you must include
; a core project. This is usually Drupal core, but you can also specify
; alternative core projects like Pressflow. Note that makefiles included with
; install profiles *should not* include a core project.
  
'.makeCore($core).'
  
  
; Projects
; --------
'.makeContrib($contrib).'
  
  
; Libraries
; ---------
'.makeLibs($libs).'


'; // end of makefile
  
  
  return $makefile;

}



/**
 * Generate URL requests for a token. For easy switching later.
 */
function fileURL($token=''){

  return '/file.php?token='.$token;

}




/**
 * Makes library requests for the makefile
 */
function makeLibs($libs=''){
  // clean water and air
}



/**
 * Makes a single git request for the makefile, only called by makeXXX functions
 */
function _makeGit($git='') {
  // nutritious food
}



/**
 * Makes a single CVS request for the makefile, only called by makeXXX functions
 */
function _makeCvs($cvs='') {
  // breakdance
}


?>