<?php

include('_lib.php');

$token = strip_tags($_REQUEST['token']);
$pullSQL = sprintf("SELECT * FROM `makefiles` WHERE token = '%s'; ",$token);
$pullResult = mysql_query($pullSQL);

while ($m = mysql_fetch_assoc($pullResult)) {
  $version  = $m['version'];
  $core     = unserialize($m['core']);
  $modules  = unserialize($m['modules']);
  $themes   = unserialize($m['themes']);
  $libs     = unserialize($m['libs']);
  $opts     = unserialize($m['opts']);
  $share    = TRUE;
}

$makefile = makeFile($token,$version,$core,$modules,$themes,$libs,$opts);

?><!doctype html>  

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Drush Make Generator - Customized Drupal Installs</title>
	<meta name="description" content="http://drushmake.me helps you build install profiles or quickly install Drupal using drush make. Powered by Four Kitchens. ">
	<meta name="author" content="Chris Ruppel">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
	<!-- link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans" -->
	<link rel="stylesheet" href="/css/960.css" media="(min-width: 960px)">
	<link rel="stylesheet" href="/css/formalize.css" media="(min-width: 481px)">
	<link rel="stylesheet" href="/css/style.css?v=2">
	<script src="/js/libs/modernizr-1.6.min.js"></script>
</head>

<body class="container_12">
	
	<header class="grid_12">
		<h1>Drush Make Generator</h1>
		<nav>
			<ol>
				<li><a href="/">what's going on?</a></li>
				<li><a href="/index.php#generate">generate</a></li>
				<li><a href="http://drupal.org/project/drush_make">make</a></li>
			</ol>
		</nav>
	</header>
	
	<div class="grid_12" id="what">
		<h2>Your makefile is ready</h2>
		<p>We've saved it for you as well!</p>
		<p><a href="<?php print fileURL($token); ?>">Bookmark</a> or (in the future) update at any time.</p>
		<textarea name="makefile" id="makefile"><?php print $makefile; ?></textarea>
	</div>
	
	<div class="grid_12" id="deploy">
		<h2>Deploy your makefile</h2>
		<p><a href="http://drupal.org/project/drush">Drush</a> and <a href="http://drupal.org/project/drush_make">Drush Make</a> turn your makefile into a Drupal installation. Then you can get building!</p>
	</div>
	
	<footer class="grid_12">
		<p>Powered by <a href="http://fourkitchens.com">Four Kitchens</a></p>
		<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a>
	</footer>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="/js/libs/jquery-1.4.4.min.js"%3E%3C/script%3E'))</script>
	
	<!-- scripts concatenated and minified via ant build script-->
		<script src="/js/jquery.formalize.js"></script>
		<script src="/js/plugins.js"></script>
		<script src="/js/script.js"></script>
	<!-- end concatenated and minified scripts-->
	
	<!--[if lt IE 7 ]>
		<script src="/js/libs/dd_belatedpng.js"></script>
		<script> DD_belatedPNG.fix('img, .png_bg'); </script>
	<![endif]-->

  <script type="text/javascript">
  
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', 'UA-432773-12']);
    _gaq.push(['_trackPageview']);
  
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  
  </script>

</body>
</html>