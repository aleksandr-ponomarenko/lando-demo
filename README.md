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
- `time (drush sql-create -y; drush si -y; drush edel -y shortcut_set; drush cset -y system.site uuid "9a85d39d-70af-4dd8-93d3-9d794cc3bfa9"; drush cim -y); time drush cr; time drush --uri=lando-demo.lndo.site uli` - execute the whole installation process and save the 'time' output. And that's okay to have purgers error there

# Reference results

## Linux, Windows Vbox, WSL2

1. Dell XPS 15 2018 (i7-8750H 64Gb)
2. HP ZBook Create G7 2020 (i7-10750H 32Gb)
3. Dell Latitude 5530 2022 (i5-1235U 24Gb)

Step (command) | 1.VBox Default | 1.VBox Mariadb:10.7 | 1. WSL Default | 2.VBox Default | 3.Ubuntu
--- | --- | --- | --- | --- | ---
**lando rebuild -y** | 0m54.472s | 0m52.658s | 1m1.019s | 0m47.213s | 1m7,173s
**composer install** | 0m39.976s | 0m33.206s | 0m34.451s | <font color="green">**0m25.438s**</font> | <font color="red">*1m15.002s*</font>
**Installation** | 0m29.459s | 0m29.420s | <font color="red">*0m51.364s*</font> | <font color="green">**0m22.902s**</font> | 0m49.798s
**drush cr** | 0m1.298s | 0m1.341s | <font color="red">*0m2.339s*</font> | <font color="green">**0m1.031s**</font> | 0m2.170s
**drush uli** | 0m0.636s | 0m0.661s | <font color="red">*0m0.933s*</font> | <font color="green">**0m0.589s**</font> | 0m0.797s

## MacBook Pro 14 2021 M1 (M1PRO 16Gb)

Step (command) | Default | NFS | Mutagen | NVF - Default | NVF - NFS | NVF - NFS+VFS | NVF - Mutagen+VFS | NVF - Mutagen
--- | --- | --- | --- | --- | --- | --- | --- | ---
**lando rebuild -y** | 0m51.765s | 0m53.667s | 1m00.070s | 0m49.028s | 0m45.311s | 0m45.893s | 0m49.446s | 0m56.399s
**composer install** | <font color="red">*6m12.243s*</font> | 3m37.019s | 0m28.856s | 4m18.588s | 2m21.539s | 2m33.923s | 0m29.812s | <font color="green">**0m25.302s**</font>
**Installation** | <font color="red">*2m3.686s*</font> | 0m52.443s | 0m17.674s | 1m15.384s | 0m43.886s | 0m36.884s | <font color="green">**0m15.371s**</font> | 0m17.122s
**drush cr** | <font color="red">*0m6.168s*</font> | 0m5.549s | 0m0.827s | 0m3.313s | 0m4.965s | 0m3.540s | 0m0.736s | <font color="green">**0m0.691s**</font>
**drush uli** | 0m4.037s | <font color="red">*0m4.318s*</font> | 0m0.458s | 0m2.317s | 0m3.637s | 0m2.438s | <font color="green">**0m0.382s**</font> | 0m0.383s

NVF = Big Sur virtualization.framework

VFS = Monterey VirtioFS accelerated directory sharing

## MacMini 2018 (i5-8500B 32GB)

Step (command) | Default | NFS | Mutagen | NVF - NFS | NVF - VFS | NVF - Mutangen+VFS | NVF - Mutagen
--- | --- | --- | --- | --- | --- | --- | ---
**lando rebuild -y** | 1m09.760s | 0m51.733s | 1m02.520s | 0m54.946s | 0m52.401s | 0m58.567s | 1m03.250s
**composer install** | <font color="red">*5m15.387s*</font> | 2m1.182s | <font color="green">**0m27.725s**</font> | 3m43.175s | 2m25.208s | 0m30.047s | 1m4.242s
**Installation** | <font color="red">*1m50.490s*</font> | 0m51.826s | <font color="green">**0m32.897s**</font> | 1m21.647s | 1m20.198s | 0m44.975s | 0m48.675s
**drush cr** | <font color="red">*0m6.203s*</font> | 0m3.996s | <font color="green">**0m1.406s**</font> | 0m5.918s | 0m4.872s | 0m1.709s | 0m2.002s
**drush uli** | 0m3.520s | 0m3.206s | <font color="green">**0m0.716s**</font> | <font color="red">*0m5.239s*</font> | 0m3.104s | 0m0.833s | 0m0.840s

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
