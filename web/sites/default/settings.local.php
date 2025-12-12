<?php

/**
 * @file
 * Local development override configuration feature.
 */

$databases['default']['default'] = [
  'database' => getenv('DB_NAME'),
  'username' => getenv('DB_USER'),
  'password' => getenv('DB_PASSWORD'),
  'host' => getenv('DB_HOST'),
  'port' => '3306',
  'namespace' => 'Drupal\\mysql\\Driver\\Database\\mysql',
  'driver' => 'mysql',
  'autoload' => 'core/modules/mysql/src/Driver/Database/mysql/',
];

// Set trusted hosts pattern.
$settings['trusted_host_patterns'] = [
  ''
];

$settings['state_cache'] = TRUE;

$settings['container_yamls'][] = DRUPAL_ROOT . '/sites/development.services.yml';

$settings['config_sync_directory'] = '../config';

$settings['extension_discovery_scan_tests'] = FALSE;
$settings['skip_permissions_hardening'] = TRUE;

$cache_backend = 'cache.backend.database';
if (extension_loaded('memcached')
  && file_exists($app_root . '/' . $site_path . '/settings.memcache.local.php')
) {
  include $app_root . '/' . $site_path . '/settings.memcache.local.php';
}

// $cache_backend = 'cache.backend.null';
$settings['cache']['default'] = $cache_backend;

// $settings['cache']['bins']['render'] = 'cache.backend.null';
// $settings['cache']['bins']['dynamic_page_cache'] = 'cache.backend.null';
// $settings['cache']['bins']['page'] = 'cache.backend.null';
