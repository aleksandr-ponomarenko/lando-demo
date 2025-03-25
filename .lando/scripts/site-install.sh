#!/bin/bash

cd /app/; mv /app/web/sites/default/settings.memcache.local.php /app/web/sites/default/settings.memcache.local.php.bak; time ( drush sql-create -y; drush si -y; drush edel -y shortcut_set; drush cset -y system.site uuid "9a85d39d-70af-4dd8-93d3-9d794cc3bfa9"; drush cim -y); mv /app/web/sites/default/settings.memcache.local.php.bak /app/web/sites/default/settings.memcache.local.php; time drush cr; time drush --uri=lando-demo.lndo.site uli
