# Local environment test build

The main goal here to have a build, to measure performance for different approaches: Linux, Windows WSL2, Windows VBox,

## Test pattern:
### Preparations:
- `lando stop; lando destroy` - just in case
- `rm -rf vendor/ web/core web/libraries web/modules/contrib/` - remove composer installed stuff
### Rebuild:
- `time lando rebuild -y` - save the result of time output
### Installation:
- `lando ssh` - go inside container
- `export COMPOSER_PROCESS_TIMEOUT=900; time composer install` - composer install should be standalone
- `time (drush sql-create -y; drush si -y; drush edel -y shortcut_set; drush cset -y system.site uuid "9a85d39d-70af-4dd8-93d3-9d794cc3bfa9"; drush cim -y); time drush cr; time drush --uri=drupal9.lndo.site uli` - execute the whole installation process and save the 'time' output. And that's okay to have purgers error there

## Reference results

### MacBook Pro 14 2021 M1 (M1PRO 16Gb)

Step (command) | MBPM1(M) | MBPM1(VFS)
--- | --- | ---
**lando rebuild -y** | 1m07.100s | 1m02.160s
**composer install** | 0m39.284s | 1m56.359s
**Installation** | 0m20.600s | 0m30.914s
**drush cr** | 0m0.941s | 0m2.192s
**drush uli** | 0m0.438s | 0m1.431s

### MacMini 2012 (i5-3210m 16GB)

Step (command) | MM2012(M) | MM2012(NFS) | MM2012
--- | --- | --- | ---
**lando rebuild -y** | 3m02.170s | 2m37.86s | 2m46.52s
**composer install** | 1m43.460s | 6m33.610s | 12m53.385s
**Installation** | 1m46.744s | 2m7.015s | 3m45.007s
**drush cr** | 0m4.409s | 0m9.864s | 0m10.456s
**drush uli** | 0m1.782s | 0m6.773s | 0m9.003s

NVF - Big Sur virtualization.framework not available for this hardware

M = Mutagen

### MacMini 2018 (i5-8500B 32GB)

Step (command) | MM2018 | MM2018(NFS) | MM2018(M) | MM2018(NVF+NFS) | MM2018(NVF+VFS) | MM2018(NVF+M)
--- | --- | --- | --- | --- | --- | ---
**lando rebuild -y** | 1m09.760s | 0m51.733s | 1m02.520s | 0m54.946s | 0m52.401s | 0m55.570s
**composer install** | 5m15.387s | 2m1.182s | 0m27.725s | 3m43.175s | 2m25.208s | 0m26.022s
**Installation** | 1m50.490s | 0m51.826s | 0m32.897s | 1m21.647s | 1m20.198s | 0m30.093s
**drush cr** | 0m6.203s | 0m3.996s | 0m1.406s | 0m5.918s | 0m4.872s | 0m1.313s
**drush uli** | 0m3.520s | 0m3.206s | 0m0.716s | 0m5.239s | 0m3.104s | 0m0.740s

NVF = Big Sur virtualization.framework

VFS = Monterey VirtioFS accelerated directory sharing

M = Mutagen
