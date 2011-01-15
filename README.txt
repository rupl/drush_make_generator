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
 * External libraries (like jQuery)
 * CVS and git repositories



INSTALLATION
--------------------------------------------------
1) Import drushmake_gen.sql into a database.
2) Check the beginning of _lib.php for all config,
   including connection string and so forth

3) Install each version of drupal that you want to generate makefiles for;
   The scripts expect them to live in the top directory at /d6, /d7, etc.

4) I loaded 200 modules up, you may want more.
   I got all the data from this URL: http://drupal.org/project/usage
5) Run update.php once you're satisfied with your contrib list;
