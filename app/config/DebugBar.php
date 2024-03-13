<?php

return [

    /**
     --------------------------------------------------------------------------
      STORAGE SETTINGS
     --------------------------------------------------------------------------
     *
     * debugBar stores data for session/ajax requests.
     * You can disable this, so the debugbar stores data in headers/session,
     * but this can cause problems with large data collectors.
     * By default, file storage (in the storage folder) is used. Redis and PDO
     * can also be used. For PDO, run the package migrations first.
     * 
     **/
    'storage' => [
        'enabled' => true,
        'driver' => 'file',                                    // redis, file, pdo, socket, custom
        'path' => STORAGE_PATH . DIRECTORY_SEPARATOR .
            'framework' . DIRECTORY_SEPARATOR . 'debugbar'
            . DIRECTORY_SEPARATOR,                              // For file driver
        'connection' => null,                                  // Leave null for default connection (Redis/PDO)
        'provider' => '',                                   // Instance of StorageInterface for custom driver
        'hostname' => '127.0.0.1',                         // Hostname to use with the "socket" driver
        'port' => 2304,                               // Port to use with the "socket" driver
    ],

    /**
     --------------------------------------------------------------------------
      COLLECTORS
     --------------------------------------------------------------------------
     *
     * List of DebugBar collectors that will be called when Debug DebugBar
     * fires up and collects data from.
     * @var string[]
     */
    'collectors' => [
        'PhpInfoCollector',
        'MessagesCollector',
        'RequestDataCollector',
        'TimeDataCollector',
        'MemoryCollector',
        'ExceptionsCollector',
        'ViewCollector',
        'ConfigCollector',
        'LocalizationCollector',
        'RoutesCollector',
        'FilesCollector',
    ],

    /**
     --------------------------------------------------------------------------
      DEBUGBAR EDITOR
     --------------------------------------------------------------------------
     *
     * Choose your preferred editor to use when clicking file name.
     *
     * Supported: "phpstorm", "vscode", "vscode-insiders", "vscode-remote",
     *            "vscode-insiders-remote", "vscodium", "textmate", "emacs",
     *            "sublime", "atom", "nova", "macvim", "idea", "netbeans",
     *            "xdebug", "espresso"
     */
    'editor' => env('DEBUGBAR_EDITOR', 'vscode'),

    /**
     --------------------------------------------------------------------------
      REMOTE PATH MAPPING
     --------------------------------------------------------------------------
     *
     * If you are using a remote dev server, like Laravel Homestead, Docker, or
     * even a remote VPS, it will be necessary to specify your path mapping.
     *
     * Leaving one, or both of these, empty or null will not trigger the remote
     * URL changes and Debugbar will treat your editor links as local files.
     *
     * "remote_sites_path" is an absolute base path for your sites or projects
     * in Homestead, Vagrant, Docker, or another remote development server.
     *
     * Example value: "/home/vagrant/Code"
     *
     * "local_sites_path" is an absolute base path for your sites or projects
     * on your local computer where your IDE or code editor is running on.
     *
     * Example values: "/Users/<name>/Code", "C:\Users\<name>\Documents\Code"
     **/
    'remote_sites_path' => env('DEBUGBAR_REMOTE_SITES_PATH', ''),
    'local_sites_path' => env('DEBUGBAR_LOCAL_SITES_PATH', ''),

    /**
     --------------------------------------------------------------------------
      BACKTRACE LIMIT
     --------------------------------------------------------------------------
     *
     * By default, the DebugBar limits the number of frames returned by the 
     * 'debug_backtrace()' function. If you need larger stacktraces, you can 
     * increase this number. Setting it to 0 will result in no limit.
     */
    'debug_backtrace_limit' => 50,
];
