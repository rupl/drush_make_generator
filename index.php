<?

include('_lib.php');

?><!doctype html>  

<!--[if lt IE 7 ]> <html lang="en" class="no-js ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="no-js ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="no-js ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="no-js ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html lang="en" class="no-js"> <!--<![endif]-->
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	
	<title>Drush Make Generator ❤ a UI to Customize Drupal Installs</title>
	<meta name="description" content="http://drushmake.me helps you build install profiles or quickly install Drupal using drush make. Powered by Four Kitchens. ">
	<meta name="author" content="Chris Ruppel">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" href="/favicon.ico">
	<link rel="apple-touch-icon" href="/apple-touch-icon.png">
	
	<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Droid+Sans">
	<link rel="stylesheet" href="css/960.css" media="(min-width: 960px)">
	<link rel="stylesheet" href="css/formalize.css" media="(min-width: 481px)">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/libs/modernizr-1.6.min.js"></script>
</head>

<body class="container_12">
	
	<header class="grid_12">
		<h1>Drush Make Generator</h1>
		<nav>
			<ol>
				<li><a href="/">what's going on?</a></li>
				<li><a href="/#generate">generate</a></li>
				<li><a href="http://drupal.org/project/drush_make">make</a></li>
			</ol>
		</nav>
	</header>
	
	<div class="grid_6" id="what">
		<h2>What is a makefile?</h2>
		<p>A makefile is a <strong>macro for installing Drupal</strong>. It contains a list of files that can be fetched using the power of <strong title="Grayskull">drush</strong>, the command line tool for administering Drupal.</p>
		<p>Using this generator you can specify different Drupal core <strong>distributions</strong>, <strong>modules</strong>, <strong>themes</strong>, and external <strong>libraries</strong> like jQuery or WYSIWYG editors.</p>
		<p>The end result is a small text file containing the DNA for a specific Drupal setup &mdash; <strong>YOUR perfect setup</strong>!</p>
	</div>

	<div class="grid_6" id="need">
		<h2>You need Drush Make if...</h2>
		<ul>
			<li>You're tired of <strong>installing Drupal modules over and over</strong>.</li>
			<li>You find yourself wishing you could <strong>start with every module you need</strong> already installed.</li>
			<li>You <strong>build a specific type of site regularly</strong>, such as communities, a blog, or an ecommerce website.</li>
		</ul>
		<a href="#generate" class="ready">LET ME TRY IT!!</a>
	</div>
	
	<div class="grid_12" id="generate">
		<h2>Customize your makefile</h2>
		<form id="generateForm" action="/generate.php" method="post">
		  
      <?php print formVersion($version); ?>
		  
		  <div id="generator">
        <?php print formMakefile($version); ?>
      </div>
      
			<button type="submit">Generate makefile</button>
		</form>
	</div>
	
	<div class="grid_12" id="deploy">
		<h2>Deploy your makefile</h2>
		<p><a href="http://drupal.org/project/drush">Drush</a> and <a href="http://drupal.org/project/drush_make">Drush Make</a> turn your makefile into a Drupal installation. Then you can get building!</p>
	</div>
	
  <?php include('footer.php'); ?>

  <a href="http://github.com/rupl/drush_make_generator" id="fork"><img src="https://a248.e.akamai.net/assets.github.com/img/c641758e06304bc53ae7f633269018169e7e5851/687474703a2f2f73332e616d617a6f6e6177732e636f6d2f6769746875622f726962626f6e732f666f726b6d655f6c6566745f77686974655f6666666666662e706e67" alt="Fork drush_make generator on GitHub"></a>
</body>
</html>
