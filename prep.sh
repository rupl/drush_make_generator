#!/bin/sh
#
# prep.sh - automates a few necessary tasks.
#
# if you're unfamiliar with the command line, just run
# this file to prep your Drupal site for installation
# by entering "./prep.sh" into the command line

# make the 'files' directory; set permissions
mkdir sites/default/files;
chmod 777 sites/default/files;

# copy the settings file; set permissions
cp sites/default/default.settings.php sites/default/settings.php;
chmod 777 sites/default/settings.php;
