<?php

use Cache\Drivers\FileCache;

return [


    /**
    --------------------------------------------------------------------------
      PRIMARY HANDLER
    --------------------------------------------------------------------------
     *
     * The name of the preferred handler that should be used. If for some reason
     * it is not available, the 'backupHandler will be used in its place.
     *
     * @var string
     */
    'handler' => 'file',

    /**
    --------------------------------------------------------------------------
      BACKUP HANDLER
    --------------------------------------------------------------------------
     *
     * The name of the handler that will be used in case the first one is
     * unreachable. Often, 'file' is used here since the filesystem is
     * always available, though that's not always practical for the app.
     *
     * @var string
     */
    'backupHandler' => 'dummy',

    /**
    --------------------------------------------------------------------------
      KEY PREFIX
    --------------------------------------------------------------------------
     *
     * This string is added to all cache item names to help avoid collisions
     * if you run multiple applications with the same cache engine.
     *
     * @var string
     */
    'prefix' => '',

    /**
    --------------------------------------------------------------------------
      MEMCACHED SETTINGS
    --------------------------------------------------------------------------
     *
     * Your Memcached servers can be specified below, if you are using
     * the Memcached drivers.
     *
     * @see https://Axm.com/user_guide/libraries/caching.html#memcached
     *
     * @var array<string, boolean|int|string>
     */
    'memcached' => [
        'host'   => '127.0.0.1',
        'port'   => 11211,
        'weight' => 1,
        'raw'    => false,
    ],

    /**
    --------------------------------------------------------------------------
      REDIS SETTINGS
    --------------------------------------------------------------------------
     *
     * Your Redis server can be specified below, if you are using
     * the Redis or Predis drivers.
     *
     * @var array<string, int|string|null>
     */
    'redis' => [
        'host'     => '127.0.0.1',
        'password' => null,
        'port'     => 6379,
        'timeout'  => 0,
        'database' => 0,
    ],

    /**
    --------------------------------------------------------------------------
      AVALIBLE CACHE HANDLERS
    --------------------------------------------------------------------------
     *
     * This is an array of cache engine alias' and class names. Only engines
     * that are listed here are allowed to be used.
     *
     * @var array<string, string>
     */
    'validHandlers' => [
        'dummy'     => DummyCache::class,
        'file'      => FileCache::class,
        'memcached' => MemcachedCache::class,
        'predis'    => PredisCache::class,
        'redis'     => RedisCache::class,
    ],
];
