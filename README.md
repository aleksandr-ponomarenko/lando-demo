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

# Reference results

## MacBook Pro 14 2021 M1 (M1PRO 16Gb)

Step (command) | Default | NFS | Mutagen | NVF - Default | NVF - NFS | NVF - NFS+VFS | NVF - Mutagen+VFS | NVF - Mutagen
--- | --- | --- | --- | --- | --- | --- | --- | ---
**lando rebuild -y** | 0m51.765s | 0m53.667s | 1m00.070s | 0m49.028s | 0m45.311s | 0m45.893s | 0m49.446s | 0m56.399s
**composer install** | 6m12.243s | 3m37.019s | 0m28.856s | 4m18.588s | 2m21.539s | 2m33.923s | 0m29.812s | 0m25.302s
**Installation** | 2m3.686s | 0m52.443s | 0m17.674s | 1m15.384s | 0m43.886s | 0m36.884s | 0m15.371s | 0m17.122s
**drush cr** | 0m6.168s | 0m5.549s | 0m0.827s | 0m3.313s | 0m4.965s | 0m3.540s | 0m0.736s | 0m0.691s
**drush uli** | 0m4.037s | 0m4.318s | 0m0.458s | 0m2.317s | 0m3.637s | 0m2.438s | 0m0.382s | 0m0.383s

## MacMini 2018 (i5-8500B 32GB)

Step (command) | Default | NFS | Mutagen | NVF - NFS | NVF - VFS | NVF - Mutangen
--- | --- | --- | --- | --- | --- | ---
**lando rebuild -y** | 1m09.760s | 0m51.733s | 1m02.520s | 0m54.946s | 0m52.401s | 0m55.570s
**composer install** | 5m15.387s | 2m1.182s | 0m27.725s | 3m43.175s | 2m25.208s | 0m26.022s
**Installation** | 1m50.490s | 0m51.826s | 0m32.897s | 1m21.647s | 1m20.198s | 0m30.093s
**drush cr** | 0m6.203s | 0m3.996s | 0m1.406s | 0m5.918s | 0m4.872s | 0m1.313s
**drush uli** | 0m3.520s | 0m3.206s | 0m0.716s | 0m5.239s | 0m3.104s | 0m0.740s

NVF = Big Sur virtualization.framework

VFS = Monterey VirtioFS accelerated directory sharing

## MacMini 2012 (i5-3210m 16GB)

Step (command) | Default | NFS | Mutagen
--- | --- | --- | ---
**lando rebuild -y** | 2m46.52s | 2m37.86s | 3m02.170s
**composer install** | 12m53.385s | 6m33.610s | 1m43.460s
**Installation** | 3m45.007s | 2m7.015s | 1m46.744s
**drush cr** | 0m10.456s | 0m9.864s | 0m4.409s
**drush uli** | 0m9.003s | 0m6.773s | 0m1.782s

NVF - Big Sur virtualization.framework not available for this hardware
