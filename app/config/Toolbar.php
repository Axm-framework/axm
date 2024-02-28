<?php

/**
 * Debug Toolbar
 *
 * The Debug Toolbar provides a way to see information about the performance
 * and state of your application during that page display. 
 */
return
    [
        /**
         --------------------------------------------------------------------------
          TOOLBAR COLLECTORS
         --------------------------------------------------------------------------
         *
         * List of toolbar collectors that will be called when Debug Toolbar
         * fires up and collects data from.
         * @var string[]
         */
        'collectors' => [
            Axm\Debug\Toolbar\Collectors\TBTimers::class,
            Axm\Debug\Toolbar\Collectors\TBDatabase::class,
            Axm\Debug\Toolbar\Collectors\TBLogs::class,
            Axm\Debug\Toolbar\Collectors\TBViews::class,
            // Axm\Debug\Toolbar\Collectors\TBCache::class,
            Axm\Debug\Toolbar\Collectors\TBFiles::class,
            Axm\Debug\Toolbar\Collectors\TBRoutes::class,
            Axm\Debug\Toolbar\Collectors\TBEvents::class,
        ],

        /**
         --------------------------------------------------------------------------
          COLLECT VAR DATA
         --------------------------------------------------------------------------
         *
         * If set to false var data from the views will not be colleted. Usefull to
         * avoid high memory usage when there are lots of data passed to the view.
         *
         * @var bool
         */
        'collectVarData' => true,

        /**
         --------------------------------------------------------------------------
          MAX HISTORY
         --------------------------------------------------------------------------
         *
         * `$maxHistory` sets a limit on the number of past requests that are stored,
         * helping to conserve file space used to store them. You can set it to
         * 0 (zero) to not have any history stored, or -1 for unlimited history.
         *
         * @var int
         */
        'maxHistory' => 20,

        /**
         --------------------------------------------------------------------------
          TOOLBAR VIEWS PATH
         --------------------------------------------------------------------------
         *
         * The full path to the the views that are used by the toolbar.
         * This MUST have a trailing slash.
         *
         * @var string
         */
        'viewsPath' => AXM_PATH . DIRECTORY_SEPARATOR . 'debug' . DIRECTORY_SEPARATOR
            . 'src' . DIRECTORY_SEPARATOR . 'Debug' . DIRECTORY_SEPARATOR . 'Toolbar'
            . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR,

        /**
         --------------------------------------------------------------------------
          TOOLBAR VIEWS PATH
         --------------------------------------------------------------------------
         *
         * If the Database Collector is enabled, it will log every query that the
         * the system generates so they can be displayed on the toolbar's timeline
         * and in the query log. This can lead to memory issues in some instances
         * with hundreds of queries.
         *
         * `$maxQueries` defines the maximum amount of queries that will be stored.
         *
         * @var int
         */
        'maxQueries' => 100,
    ];
