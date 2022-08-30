# Local environment test build

The main goal here to have a build, to measure performance for different approaches: Linux, Windows WSL2, Windows VBox,

## Test pattern:
### Preparations:
- `lando stop; lando destroy` - just in case
- `rm -rf vendor/ web/core web/libraries  web/modules/contrib/` - remove composer installed stuff
### Rebuild:
- `time lando rebuild -y` - save the result of time output
### Installation:
- `lando ssh` - go inside container
- `export COMPOSER_PROCESS_TIMEOUT=900; time composer install` - composer install should be standalone
- `time (drush sql-create -y; drush si -y; drush edel -y shortcut_set; drush cset -y system.site uuid "9a85d39d-70af-4dd8-93d3-9d794cc3bfa9"; drush cim -y); time drush cr; time drush --uri=drupal9.lndo.site uli` - execute the whole installation process and save the 'time' output. And that's okay to have purgers error there

## Reference results

Step (command) | Mac M1 Mutagen | Mac M1 VirtioFS | Mac mini 2012 Mutagen | Mac mini 2012 nfs | Mac mini 2012
--- | --- | --- | --- | --- | ---
**lando rebuild -y** | 1m07.100s | 1m02.160s | 3m02.170s | 2m37.86s | 2m46.52s
**composer install** | 0m39.284s | 1m56.359s | 1m43.460s | 6m33.610s | 12m53.385s
**Installation** | 0m20.600s | 0m30.914s | 1m46.744s | 2m7.015s | 3m45.007s
**drush cr** | 0m0.941s | 0m2.192s | 0m4.409s | 0m9.864s | 0m10.456s
**drush uli** | 0m0.438s | 0m1.431s | 0m1.782s | 0m6.773s | 0m9.003s
