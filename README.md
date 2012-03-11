DRUSH MAKE GENERATOR
====================

http://drushmake.me
-------------------

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
--------------------

1. First time installs should import drushmake_gen.sql into your database.
   drushmake_alter.sql upgrades from the previous version only
2. Copy _config.example.php to _config.php and make your changes
3. Install each version of drupal that you want to generate makefiles for.
   The scripts expect them to live in the root directory at /d6, /d7, etc.
4. I loaded about 100 modules up, you may want more.
   I got all the data from this URL: http://drupal.org/project/usage
5. Run /update.php once you're satisfied with your contrib list;
   It will fetch the current version for all your modules and get the
   site to produce accurate makefiles.


TO-DO
-----
https://github.com/rupl/drush_make_generator/issues
