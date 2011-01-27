DRUSH MAKE GENERATOR
http://drushmake.me
--------------------------------------------------

This tool is a GUI for drush make.

It produces makefiles which are then deployed,
producing a Drupal installation which is populated
with all of the code you need to actually build a
website, including:
 
 * Drupal core or distributions
 * Modules
 * Themes
 * External libraries
 * CVS and git repositories



INSTALLATION / SETUP
--------------------------------------------------
1) Import drushmake_gen.sql into a database.

2) _config.php for all config

3) Install each version of drupal that you want to generate makefiles for;
   The scripts expect them to live in the top directory at /d6, /d7, etc.

4) I loaded 100 modules up, you may want more.
   I got all the data from this URL: http://drupal.org/project/usage

5) Run /update.php once you're satisfied with your contrib list;
   It will fetch the current version for all your modules and get the
   site to produce accurate makefiles.


TO-DO
--------------------------------------------------
+ URL input for libraries, Features and CVS/git
+ Edit previously generated makefiles
+ Suggested makefiles for beginning Drupalers (social, portfolio, e-commerce)
+ [hejrocker] Include patches along with contributed modules (http://drupalcode.org/viewvc/drupal/contributions/profiles/nodestream/nodestream.make?revision=1.1.2.41&view=markup)
++ Place patched modules in separate directory?
+ Output options: makefile, zip, ?