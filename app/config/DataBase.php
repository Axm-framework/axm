<?php

return [

    /**
    --------------------------------------------------------------------------
      DEFAULT DATABASE CONNECTION NAME
    --------------------------------------------------------------------------
     *
     * Here you may specify which of the database connections below you wish
     * to use as your default connection for all database work. Of course
     * you may use many connections at once using the Database library.
     *
     */
    'default' => env('DB_CONNECTION', 'mysql'),

    /**
    --------------------------------------------------------------------------
      DATABASE CONNECTIONS
    --------------------------------------------------------------------------
     *
     * Here are each of the database connections setup for your application.
     * Of course, examples of configuring each database platform that is
     * supported by eloquent is shown below to make development simple.
     *
     * 
     * All database work in eloquent is done through the PHP PDO facilities
     * so make sure you have the driver for your particular database of
     * choice installed on your machine before you begin development.
     *
     */

    'connections' => [
        # for connection to driver mysql
        'mysql' => [
            'driver' => 'mysql',
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '3306'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'unix_socket' => env('DB_SOCKET', ''),
            'charset' => 'utf8mb4',
            'collation' => 'utf8mb4_unicode_ci',
            'prefix' => '',
            'prefix_indexes' => true,
            'strict' => true,
            'engine' => null,
            'options' => extension_loaded('pdo_mysql') ? array_filter([
                PDO::MYSQL_ATTR_SSL_CA => env('MYSQL_ATTR_SSL_CA'),
            ]) : [],
        ],

        # for connection to driver pgsql
        'pgsql' => [
            'driver' => 'pgsql',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', '127.0.0.1'),
            'port' => env('DB_PORT', '5432'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
            'schema' => 'public',
            'sslmode' => 'prefer',
        ],

        # for connection to driver sqlsrv
        'sqlsrv' => [
            'driver' => 'sqlsrv',
            'url' => env('DB_URL'),
            'host' => env('DB_HOST', 'localhost'),
            'port' => env('DB_PORT', '1433'),
            'database' => env('DB_DATABASE', 'forge'),
            'username' => env('DB_USERNAME', 'forge'),
            'password' => env('DB_PASSWORD', ''),
            'charset' => env('DB_CHARSET', 'utf8'),
            'prefix' => '',
            'prefix_indexes' => true,
        ],

    ],

    'migrations' => 'migrations',
];
