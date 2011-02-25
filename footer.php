	<footer class="grid_12 vcard">
		<p class="github">Source code on <a href="https://github.com/rupl/drush_make_generator" title="drush_make_generator on github">github</a></p>
		<a rel="license" href="http://creativecommons.org/licenses/by-nc-sa/3.0/"><img alt="Creative Commons License" style="border-width:0" src="http://i.creativecommons.org/l/by-nc-sa/3.0/88x31.png" /></a>
		<a class="fn org url" href="http://fourkitchens.com" title="Four Kitchens">Powered by Four Kitchens</a>
	</footer>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.4.4/jquery.min.js"></script>
	<script>!window.jQuery && document.write(unescape('%3Cscript src="/js/libs/jquery-1.4.2.min.js"%3E%3C/script%3E'))</script>
	
	<!-- scripts concatenated and minified via ant build script-->
		<script src="/js/jquery.formalize.js"></script>
		<script src="/js/plugins.js"></script>
		<script src="/js/script.js"></script>
	<!-- end concatenated and minified scripts-->
	
	<!--[if lt IE 7 ]>
		<script src="/js/libs/dd_belatedpng.js"></script>
		<script> DD_belatedPNG.fix('img, .png_bg'); </script>
	<![endif]-->


<?php if (ANALYTICS_ACCOUNT != ''): ?>
  <script type="text/javascript">
  
    var _gaq = _gaq || [];
    _gaq.push(['_setAccount', '<?php print ANALYTICS_ACCOUNT; ?>']);
    _gaq.push(['_trackPageview']);
  
    (function() {
      var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
      ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
      var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
    })();
  
  </script>
<?php endif; ?>