<?php

/**
 * @file
 * Local development override configuration feature.
 */

$databases['default']['default'] = array (
  'database' => 'drupal',
  'username' => 'drupal',
  'password' => 'drupal',
  'prefix' => '',
  'host' => 'database',
  'port' => '3306',
  'namespace' => 'Drupal\\mysql\\Driver\\Database\\mysql',
  'driver' => 'mysql',
  'autoload' => 'core/modules/mysql/src/Driver/Database/mysql/',
);

$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';

$settings['config_sync_directory'] = '../config';

$settings['extension_discovery_scan_tests'] = FALSE;
$settings['skip_permissions_hardening'] = TRUE;

$settings['memcache']['servers'] = ['memcached:11211' => 'default'];
$settings['memcache']['bins'] = ['default' => 'default'];
$settings['memcache']['key_prefix'] = '';

// $cache_backend = 'cache.backend.database';
$cache_backend = class_exists('Memcache', FALSE) ? 'cache.backend.memcache' : 'cache.backend.database';
// $cache_backend = 'cache.backend.null';
$settings['cache']['default'] = $cache_backend;
//$settings['cache']['bins']['discovery'] = 'cache.backend.database';

$settings['cache']['bins']['render'] = 'cache.backend.null';
$settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
$settings['cache']['bins']['page'] = 'cache.backend.null';
