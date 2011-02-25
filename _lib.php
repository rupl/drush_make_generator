<?php


include_once('_config.php');

// Die if we can't find config
if (CONFIG_FILE != 'PRESENT') {
  print "<h2>Drush Make Generator could not find _config.php</h2><ul><li>Copy _config.example.php to _config.php</li><li>Alter the settings to work with your web host and database</li></ul>";
  exit;
}




/**
 * Fetches all contrib projects as a raw DB object
 */
function fetchContrib() {
  global $version;
  $projectsSQL = sprintf("SELECT * FROM  `projects` WHERE `type` = 'module' OR `type` = 'theme' AND `version` = '%s' AND `url` = '' AND `status` = 1; ",$version);
  $projects = mysql_query($projectsSQL);
  
  return $projects;
}


/**
 * Fetches module projects as a raw DB object
 */
function fetchModules() {
  global $version;
  $projectsSQL = sprintf("SELECT * FROM  `projects` WHERE `type` = 'module' AND `version` = '%s' AND `url` = '' AND `status` = 1; ",$version);
  $projects = mysql_query($projectsSQL);
  
  return $projects;
}


/**
 * Fetches theme projects as a raw DB object
 */
function fetchThemes() {
  global $version;
  $projectsSQL = sprintf("SELECT * FROM  `projects` WHERE `type` = 'theme' AND `version` = '%s' AND `url` = '' AND `status` = 1; ",$version);
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
  					<input id="'. $c['unique'] .'-stable" type="radio" name="makefile[core]" value="'. $c['unique'] .'" /> <span class="title">'.$c['title'].'</span>
  					<!-- span class="dev"><input id="'. $c['unique'] .'-dev" type="radio" name="makefile[core]" value="'. $c['unique'] .'dev" /> Use dev branch</span -->
  				</label>'."\r\n";
  endwhile;
  
  $output .= "\t".'</fieldset>'."\r\n";

  return $output;
}


/**
 * Outputs fieldsets for all the contrib modules, grouped by package name (same groups as /admin/build/modules)
 */
function formModules(){
  global $version;
  $output = '';
  
  $groupsSQL = sprintf("SELECT DISTINCT package as groupName FROM `projects` WHERE `type` = 'module' AND `package` <> '' AND `version` = '%s' AND `status` = 1 ORDER BY package ASC; ",$version);
  $groups = mysql_query($groupsSQL);
  
  while ($group = mysql_fetch_assoc($groups)) {
  
    $sql = sprintf(
      "SELECT p.`id`,`unique`,`title`,GROUP_CONCAT(v.release ORDER BY v.release DESC SEPARATOR '%s') as `releases` ".
      "FROM `projects` AS p ".
      "LEFT JOIN `versions` AS v ON p.id = v.pid ".
      "WHERE p.package = '%s' AND p.version = '%s' AND `status` = 1 AND p.type = 'module' ".
      "GROUP BY p.unique ".
      "ORDER BY p.unique ASC; ",
      SQL_SEPARATOR,
      $group['groupName'],$version
      );
//    $output .= $sql;
    $projects = mysql_query($sql);

    $groupSafe = str_replace(' ','_',strtolower($group['groupName']));

		$output .= "\r\n\t\t\t\t".'<h4>'.$group['groupName'].'</h4>';

    while($p = mysql_fetch_assoc($projects)):
      if (isset($p['releases'])){
        $releases = explode(SQL_SEPARATOR,$p['releases']);
      } else {
        $releases = FALSE;
      }
    	
    	$output .= '
    				<label for="'. $p['unique'] .'-stable">
    					<input id="'. $p['unique'] .'-stable" type="checkbox" name="makefile[modules]['. $p['unique'] .']" value="stable" /> <span class="title">'.$p['title'].'</span>
    					<select id="'. $p['unique'].'" name="makefile[modules]['. $p['unique'] .']" disabled="disabled">
    					 <option value="stable">Recommended</option>';
              if ($releases){
      				  foreach($releases as $r){
      				    $output .=' <option value="'. $r .'">Use '. $r .'</option>';
      				  }
      				}
    				  $output .= '</select>';
    	$output .= "\r\n\t\t\t\t".'</label>'."\r\n\t\t\t\t";
      
    endwhile;
    
  }

  $output .= '<div class="modules downloads">';
  $output .= formDownload('modules',array('url'=>'#url','unique'=>'module'));
  $output .= '</div>';
  $output .= formDownload('add');

  return $output;
}


/**
 * Outputs fieldsets for all the contrib themes alphabetically
 */
function formThemes(){
  global $version;
  $output = '';
  
  $sql = sprintf(
    "SELECT p.`id`,`unique`,`title`,GROUP_CONCAT(v.release ORDER BY v.release DESC SEPARATOR '%s') as `releases` ".
    "FROM `projects` AS p ".
    "LEFT JOIN `versions` AS v ON p.id = v.pid ".
    "WHERE p.version = '%s' AND `status` = 1 AND p.type = 'theme' ".
    "GROUP BY p.unique ".
    "ORDER BY p.unique ASC; ",
    SQL_SEPARATOR,
    $version
    );
  // $output .= $sql;
  $projects = mysql_query($sql);

  while($p = mysql_fetch_assoc($projects)):
    $releases = explode(SQL_SEPARATOR,$p['releases']);
    
  	$output .= '
  				<label for="'. $p['unique'] .'-stable">
  					<input id="'. $p['unique'] .'-stable" type="checkbox" name="makefile[themes]['. $p['unique'] .']" value="stable" /> <span class="title">'.$p['title'].'</span>
  					<select id="'. $p['unique'].'" name="makefile[themes]['. $p['unique'] .']" disabled="disabled">
  					 <option value="stable">Recommended</option>';
  				  foreach($releases as $r){
  				    $output .=' <option value="'. $r .'">Use '. $r .'</option>';
  				  }
  				  $output .= '</select>';
  	$output .= "\r\n\t\t\t\t".'</label>'."\r\n\t\t\t\t";
    
  endwhile;
  
  $output .= '<div class="themes downloads">';
  $output .= formDownload('themes',array('url'=>'#url','unique'=>'theme'));
  $output .= '</div>';
  $output .= formDownload('add');

  return $output;
}


/**
 * Outputs all the external libraries;
 * Includes a widget to add more
 */
function formLibs(){
  global $version;
  $output = '';
  
  $sql = sprintf(
    "SELECT p.`id`,`unique`,`title`,GROUP_CONCAT(CONCAT(v.release,'~~~',v.url) ORDER BY v.release DESC SEPARATOR '%s') as `releases` ".
    "FROM `projects` AS p ".
    "LEFT JOIN `versions` AS v ON p.id = v.pid ".
    "WHERE `status` = 1 AND p.type = 'lib' ".
    "GROUP BY p.unique ".
    "ORDER BY p.unique ASC; ",
    SQL_SEPARATOR,
    $version
    );
  $projects = mysql_query($sql);

  while($p = mysql_fetch_assoc($projects)):
    $releases = explode(SQL_SEPARATOR,$p['releases']);
    
    $latest = explode('~~~',$releases[0]);
  	$output .= '
  				<label for="'. $p['unique'] .'-stable">
  					<input id="'. $p['unique'] .'-stable" type="checkbox" name="makefile[libs]['. $p['unique'] .']" value="'.$latest[1].'" /> <span class="title">'.$p['title'].'</span>
  					<select id="'. $p['unique'].'" name="makefile[libs]['. $p['unique'] .']" disabled="disabled">
  					 <option value="'.$latest[1].'">Latest ('.$latest[0].')</option>';
  				  
  				  array_shift($releases);
  				  
  				  foreach($releases as $r){
  				    $info = explode('~~~',$r);
  				    $output .=' <option value="'. $info[1] .'">Use '. $info[0] .'</option>';
  				  }
  				  $output .= '</select>';
  	$output .= "\r\n\t\t\t\t".'</label>'."\r\n\t\t\t\t";
    
  endwhile;
  
  $output .= '<div class="libraries downloads">';
  $output .= formDownload('libraries',array('url'=>'#url','unique'=>'library'));
  $output .= '</div>';
  $output .= formDownload('add');
    
  return $output;
}




/**
 * Outputs a single form element for a download. Either empty or populated.
 */
function formDownload($type='libraries',$download=array()){
  $output = '';
  
  if (empty($download['unique'])) {$download['unique'] = '[project]'; }
  if (empty($download['url'])) {$download['url'] = '#url'; }

  switch ($type) {
  
    case 'libraries':
      $output .= '<div class="download label">';
        $output .= '<input type="text" class="unique" name="makefile[libs][|THIS|][unique]" value="'.$download['unique'].'" /> ';
        $output .= '<select name="makefile[libs][|THIS|][type]" class="type"><option value="file">www</option><option value="git">git</option></select>';
        $output .= '<input type="text" class="url" name="makefile[libs][|THIS|][url]" value="'.$download['url'].'" />';
        $output .= '<input type="hidden" class="url" name="makefile[libs][|THIS|][maketype]" value="libraries" />';
        $output .= '<a class="remove">remove</a>';
      $output .= '</div>';
      break;

    case 'modules':
      $output .= '<div class="download label">';
        $output .= '<input type="text" class="unique" name="makefile[modules][|THIS|][unique]" value="'.$download['unique'].'" /> ';
        $output .= '<select name="makefile[modules][|THIS|][type]" class="type"><option value="drupal">d.o</option><option value="file">www</option><option value="git">git</option></select>';
        $output .= '<input type="text" class="url" name="makefile[modules][|THIS|][url]" value="'.$download['url'].'" disabled="disabled" />';
        $output .= '<input type="hidden" class="url" name="makefile[includes][|THIS|][maketype]" value="module" />'; // module, not "modules"
        $output .= '<a class="remove">remove</a>';
      $output .= '</div>';
      break;
    
    case 'themes':
      $output .= '<div class="download label">';
        $output .= '<input type="text" class="unique" name="makefile[themes][|THIS|][unique]" value="'.$download['unique'].'" /> ';
        $output .= '<select name="makefile[themes][|THIS|][type]" class="type"><option value="drupal">d.o</option><option value="file">www</option><option value="git">git</option></select>';
        $output .= '<input type="text" class="url" name="makefile[themes][|THIS|][url]" value="'.$download['url'].'" disabled="disabled" />';
        $output .= '<input type="hidden" class="url" name="makefile[includes][|THIS|][maketype]" value="theme" />'; // theme, not "themes"
        $output .= '<a class="remove">remove</a>';
      $output .= '</div>';
      break;
    
    case 'includes':
      $output .= '<div class="download label">';
        $output .= '<input type="text" class="unique" name="makefile[includes][|THIS|][unique]" value="'.$download['unique'].'" /> ';
        $output .= '<select name="makefile[includes][|THIS|][type]" class="type"><option value="drupal">d.o</option><option value="file">www</option><option value="git">git</option></select>';
        $output .= '<input type="text" class="url" name="makefile[includes][|THIS|][url]" value="'.$download['url'].'" disabled="disabled" />';
        $output .= '<input type="hidden" class="url" name="makefile[includes][|THIS|][maketype]" value="includes" />';
        $output .= '<a class="remove">remove</a>';
      $output .= '</div>';
      break;
    
    case 'add':
      $output .= '<a class="another">Add Another</a>';
      break;
    
    default:
      break;
  }

  return $output;
}


/**
 * fetch makefile and output
 */
function generateMakefile($token){
  $makefile = '';

  $clean = sanitize('token',$token);

  $sql = sprintf("SELECT * FROM `makefiles` WHERE token = '%s' LIMIT 1; ",$clean);
  $result = mysql_query($sql);
  
  if ($m = mysql_fetch_assoc($result)){
      $version  = $m['version'];
      $core     = unserialize($m['core']);
      $modules  = unserialize($m['modules']);
      $themes   = unserialize($m['themes']);
      $libs     = unserialize($m['libs']);
      $opts     = unserialize($m['opts']);
      $share    = TRUE;
      
      $makefile = makeFile($clean,$version,$core,$modules,$themes,$libs,$opts);
      return $makefile;
  } else {
    return FALSE;
  }

}



/**
 * makefile template
 */
function makefile($token,$version,$core,$modules,$themes,$libs,$opts){

  $makefile = '; $Id$
;
; ----------------
; Generated makefile from http://drushmake.me
; Permanent URL: http://drushmake.me/file.php?token='.$token.'
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
; Every makefile needs to declare its Drush Make API version. This version of
; drush make uses API version `2`.
  
api = 2
  
; Core project
; ------------
; In order for your makefile to generate a full Drupal site, you must include
; a core project. This is usually Drupal core, but you can also specify
; alternative core projects like Pressflow. Note that makefiles included with
; install profiles *should not* include a core project.
  
'.makeCore($core,$opts).'
  
  
; Modules
; --------
'.makeModules($modules,$opts).'
  

; Themes
; --------
'.makeThemes($themes,$opts).'
  
  
; Libraries
; ---------
'.makeLibs($libs,$opts).'


'; // end of makefile
  
  
  return $makefile;

}


/**
 * Makes core request for makefile
 */
function makeCore($core='drupal',$opts) {
  global $version;
  $output = '';
  
  switch($core.$version):

    case 'openatrium6':
    case 'openatrium':
      $output .= '; Use Open Atrium instead of Drupal core:'."\r\n";
      $output .= 'projects[openatrium][type] = "core"'."\r\n";
      $output .= 'projects[openatrium][download][type] = "get"'."\r\n";
      $output .= 'projects[openatrium][download][url] = "http://openatrium.com/sites/openatrium.com/files/atrium_releases/atrium-1-0-beta9.tgz"'."\r\n";
      break;

    case 'pressflow7':
    case 'pressflow6':
    case 'pressflow':
      $output .= '; Use Pressflow instead of Drupal core:'."\r\n";
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
 * Makes module requests for the makefile
 */
function makeModules($modules=array(),$opts=array()){
  global $version;
  $v = $version;  
  $subdir = ($opts['contrib_dir']) ? $opts['contrib_dir'] : '';
  $output = '';

  // loop away
  if ($modules){
    foreach($modules as $k => $v){
      $loop = '';

      if (strpos($k,'|') !== FALSE) {
        $output .= makeDownload('projects',$k,$v,$opts);
      }
      else {
        if ($v == 'stable'){$loop .= 'projects[] = '.$k; }
        elseif($v) {$loop .= 'projects['.$k.'] = '.$v; }
        else {}
    
        $loop .= "\r\n";
          
        if ($subdir && $v == 'stable'){$loop = ''; }
        if ($subdir && $v) {$loop .= 'projects['.$k.'][subdir] = '.$subdir."\r\n"; }
        
        $output .= $loop;        
      }
    }
  }
  
  return $output;
}


/**
 * Makes theme requests for the makefile
 */
function makeThemes($themes=array(),$opts=array()){
  global $version;
  $v = $version;  
  $output = '';

  // loop away
  if ($themes):
    foreach($themes as $k => $v){
      $loop = '';

      // unset the directory because the _downloadXXX functions are not yet smart enough to ignore contrib_dir for themes/libraries
      unset($opts['contrib_dir']);

      if (strpos($k,'|') !== FALSE) {
        $output .= makeDownload('projects',$k,$v,$opts);
      }
      else {
        if ($v == 'stable'){$loop .= 'projects[] = '.$k; }
        else {$loop .= 'projects['.$k.'] = '.$v; }
        
        $loop .= "\r\n";
        
        $output .= $loop;
      }
    }
  endif;
  
  return $output;
}


/**
 * Makes library requests for the makefile
 */
function makeLibs($libs=array(),$opts=array()){
  $output = $loop = '';
  
  // print '<pre>'.print_r($libs,TRUE).'</pre>';
  
  // loop away
  if ($libs):
    foreach($libs as $k => $v){
      $loop = '';
      
      if (strpos($k,'|') !== FALSE) {
        $loop .= makeDownload('libraries',$k,$v,$opts);
        $output .= $loop;
      }
      else {        
        $loop .=
          'libraries['.$k.'][download][type] = "file"'."\r\n".
          'libraries['.$k.'][download][url] = "'.$v.'"'."\r\n";      
  
        $output .= $loop;
      }
    }
  endif;
  
  if (!$loop){
    $output .= "; Adding a module such as jquery_update will never add the related library automatically.\r\n; https://github.com/rupl/drush_make_generator/issues/closed#issue/1 \r\n";
  }
  
  return $output;
}


/**
 * Delegates downloads
 */
function makeDownload($type,$unique,$data,$opts) {
  $output = '';
  switch ($data['type']) {
    case 'file':
      $output = _downloadFile($type,$unique,$data,$opts);
      break;
    
    case 'git':
      $output = _downloadGit($type,$unique,$data,$opts);
      break;

    case 'drupal':
      $output = _downloadDrupal($type,$unique,$data,$opts);
      break;

    // SCREW CVS VIVA LA GIT!!

    default:
      break;
  
  }
  return $output;
}



/**
 * Makes a single http request within the makefile, only called by makeDownload()
 */
function _downloadFile($type='',$unique,$data=array(),$opts=array()) {
  $output = '';
  $unique = str_replace('|','',$unique);
  $output .=
    $type.'['.$unique.'][download][type] = "file"'."\r\n".
    $type.'['.$unique.'][download][url] = "'.$data['url'].'"'."\r\n";

  return $output;
}


/**
 * Makes a single git request within the makefile, only called by makeDownload()
 */
function _downloadGit($type='',$unique,$data=array(),$opts=array()) {
  $output = '';
  $unique = str_replace('|','',$unique);
  $output .=
    $type.'['.$unique.'][download][type] = "git"'."\r\n".
    $type.'['.$unique.'][download][url] = "'.$data['url'].'"'."\r\n";

  return $output;
}


/**
 * Makes a single Drupal request within the makefile, only called by makeDownload()
 */
function _downloadDrupal($type='',$unique,$data=array(),$opts=array()) {
  $output = '';
  $unique = str_replace('|','',$unique);

  if ($unique && $opts['contrib_dir']) {$output .= 'projects['.$unique.'][subdir] = '.$opts['contrib_dir']; }
  elseif($unique) {$output .= 'projects[] = '.$unique; }
  else {$output .= '; ERROR: _downloadDrupal could not properly build a request for "'.$unique.'"'; }

  $output .= "\r\n";

  return $output;
}


/**
 * Makes a single CVS request for the makefile, only called by makeDownload()
 */
function _downloadCvs($type='',$unique,$data=array(),$opts=array()) {
  $output = '';
  $unique = str_replace('|','',$unique);
  $output .=
    'projects['.$unique.'][type] = '.$data['maketype']."\r\n".
    'projects['.$unique.'][download][type] = "cvs"'."\r\n".
    'projects['.$unique.'][download][url] = "'.$unique.'"'."\r\n";

  return $output;
}





/**
 * Sanitizes input
 */
function sanitize($type='token',$data){
  switch ($type) {
    case 'token':
      // only accept 12 chars made of a-f and 0-9
      $clean = (isset($data) && preg_match('/^[a-f0-9]{12}/',$data)) ? $data : FALSE;
      break;
    
    default:
      $clean = FALSE;
      break;
  }
  
  return $clean;
}


/**
 * Generate URL requests for a token. For easy switching later.
 */
function fileURL($token=''){

  // http://drushmake.me/a/short-url

  return '/file.php?token='.$token;

}



