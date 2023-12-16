<?php

$settings['memcache']['servers'] = ['memcached:11211' => 'default'];
$settings['memcache']['bins'] = ['default' => 'default'];
$settings['memcache']['key_prefix'] = '';
$cache_backend = class_exists('Memcached', FALSE) ? 'cache.backend.memcache' : 'cache.backend.database';
