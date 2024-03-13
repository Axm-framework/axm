<?php

return [

	/**
	 * -----------------------------------------------------------------
		-------------------------------------------------------------
								APP PATH
		-------------------------------------------------------------
	*-----------------------------------------------------------------*/


	/**
	---------------------------------------------------------------
	 APP PATH
	---------------------------------------------------------------
	* The root path of the application.
	*/
	'appPath' => APP_PATH,

	/**
	---------------------------------------------------------------
	 CONFIG PATH
	---------------------------------------------------------------
	* The path to the configuration files directory within the app.
	*/
	'configPath' => APP_PATH . DIRECTORY_SEPARATOR . 'Config',

	/**
	---------------------------------------------------------------
	 CONTROLLERS PATH
	---------------------------------------------------------------
	* The path to the controllers directory within the app.
	*/
	'controllersPath' => APP_PATH . DIRECTORY_SEPARATOR . 'Controllers',

	/**
	---------------------------------------------------------------
	 HELPERS PATH
	---------------------------------------------------------------
	* The path to the helpers directory within the app.
	*/
	'helpersPath' => APP_PATH . DIRECTORY_SEPARATOR . 'Helpers',

	/**
	---------------------------------------------------------------
	 MIDDLEWARES PATH
	---------------------------------------------------------------
	* The path to the middlewares directory within the app.
	*/
	'middlewaresPath' => APP_PATH . DIRECTORY_SEPARATOR . 'Middlewares',

	/**
	---------------------------------------------------------------
	 MODELS PATH
	---------------------------------------------------------------
	* The path to the models directory within the app.
	*/
	'modelsPath' => APP_PATH . DIRECTORY_SEPARATOR . 'Models',

	/**
	---------------------------------------------------------------
	 DATABASE PATH
	---------------------------------------------------------------
	* The path to database directory within the app.
	*/
	'databasePath' => APP_PATH . DIRECTORY_SEPARATOR . 'Database',

	/**
	---------------------------------------------------------------
	 FACTORIES PATH
	---------------------------------------------------------------
	* The path to factories directory within the app.
	*/
	'factoriesPath' => APP_PATH . DIRECTORY_SEPARATOR . 'Database'
		. DIRECTORY_SEPARATOR . 'Factories',

	/**
	---------------------------------------------------------------
	 MIGRATIONS PATH
	---------------------------------------------------------------
	* The path to migrations directory within the app.
	*/
	'migrationsPath' => APP_PATH . DIRECTORY_SEPARATOR . 'Database'
		. DIRECTORY_SEPARATOR . 'Migrations',

	/**
	---------------------------------------------------------------
	 SCHEMA PATH
	---------------------------------------------------------------
	* The path to schema directory within the app.
	*/
	'schemaPath' => APP_PATH . DIRECTORY_SEPARATOR . 'Database'
		. DIRECTORY_SEPARATOR . 'Schema',

	/**
	---------------------------------------------------------------
	 SEEDS PATH
	---------------------------------------------------------------
	* The path to seeds directory within the app.
	*/
	'seedsPath' => APP_PATH . DIRECTORY_SEPARATOR . 'Database'
		. DIRECTORY_SEPARATOR . 'Seeds',

	/**
	---------------------------------------------------------------
	 RAXM PATH
	---------------------------------------------------------------
	* The path to the "Raxm" directory within the app.
	*/
	'raxmPath' => APP_PATH . DIRECTORY_SEPARATOR . 'Raxm',

	/**
	---------------------------------------------------------------
	 PROVIDERS PATH
	---------------------------------------------------------------
	* The path to the Providers.
	*/
	'providersPath' => APP_PATH . DIRECTORY_SEPARATOR . 'Providers',

	/**
	---------------------------------------------------------------
	 COMMANDS PATH
	---------------------------------------------------------------
	* The path to the commands.
	*/
	'commandsPath' => APP_PATH . DIRECTORY_SEPARATOR . 'Commands',


	/**
	 * -----------------------------------------------------------------
		-------------------------------------------------------------
								ROOT PATH
		-------------------------------------------------------------
	*------------------------------------------------------------------*/


	/**
	---------------------------------------------------------------
	 RESOURCES PATH
	---------------------------------------------------------------
	* The path to the resources directory within the root.
	*/
	'resourcesPath' => ROOT_PATH . DIRECTORY_SEPARATOR . 'resources',

	/**
	---------------------------------------------------------------
	 VIEWS PATH
	---------------------------------------------------------------
	* The path to the views directory.
	*/
	'viewsPath' => APP_PATH . DIRECTORY_SEPARATOR . 'resources'
		. DIRECTORY_SEPARATOR . 'views',

	/**
	---------------------------------------------------------------
	 LAYOUTS PATH
	---------------------------------------------------------------
	* The path to the layouts directory.
	*/
	'layoutsPath' => APP_PATH . DIRECTORY_SEPARATOR . 'resources'
		. DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'layouts',

	/**
	---------------------------------------------------------------
	 PARTIALS PATH
	---------------------------------------------------------------
	* The path to the partials directory.
	*/
	'partialsPath' => APP_PATH . DIRECTORY_SEPARATOR . 'resources'
		. DIRECTORY_SEPARATOR . 'views' . DIRECTORY_SEPARATOR . 'partials',

	/**
	---------------------------------------------------------------
	 ASSETS PATH
	---------------------------------------------------------------
	* The path to assets directory.
	*/
	'assetsPath' => APP_PATH . DIRECTORY_SEPARATOR . 'resources'
		. DIRECTORY_SEPARATOR . 'assets',

	/**
	---------------------------------------------------------------
	 LANGUAGES PATH
	---------------------------------------------------------------
	* The path to the languages directory.
	*/
	'langPath' => ROOT_PATH . DIRECTORY_SEPARATOR . 'resources'
		. DIRECTORY_SEPARATOR . 'lang',

	/**
	---------------------------------------------------------------
	 VIEW OF ERRORS
	---------------------------------------------------------------
	* The path to the view of errors.
	*/
	'viewsErrorsPath' => ROOT_PATH . DIRECTORY_SEPARATOR . 'resources'
		. DIRECTORY_SEPARATOR . 'views'
		. DIRECTORY_SEPARATOR . 'errors',

	/**
	---------------------------------------------------------------
	 ROUTES PATH
	---------------------------------------------------------------
	* The path to the routes directory within the root.
	*/
	'routesPath' => APP_PATH . DIRECTORY_SEPARATOR . 'routes',

	/**
	---------------------------------------------------------------
	 STORAGE PATH
	---------------------------------------------------------------
	* The path to the storage directory within the root.
	*/
	'storagePath' => ROOT_PATH . DIRECTORY_SEPARATOR . 'storage',

	/**
	---------------------------------------------------------------
	 VENDOR PATH
	---------------------------------------------------------------
	* The path to the vendor directory within the root.
	*/
	'vendorPath' => VENDOR_PATH . DIRECTORY_SEPARATOR . 'vendor',


	/**
	 * ----------------------------------------------------------------
		------------------------------------------------------------
								STORAGE PATH
		------------------------------------------------------------ 
	*-----------------------------------------------------------------*/


	/**
	---------------------------------------------------------------
	 UPLOAD PATH
	---------------------------------------------------------------
	* The path to the logs directory within the root.
	*/
	'uploadPath' => STORAGE_PATH . DIRECTORY_SEPARATOR . 'app'
		. DIRECTORY_SEPARATOR . 'public',

	/**
	---------------------------------------------------------------
	 LOGS PATH
	---------------------------------------------------------------
	* The path to the logs directory within the root.
	*/
	'logsPath' => STORAGE_PATH . DIRECTORY_SEPARATOR . 'logs',

	/**
	---------------------------------------------------------------
	 CACHE SESSIONS PATH
	---------------------------------------------------------------
	* The path to the sessions directory within the root.
	*/
	'cacheSessionsPath' => STORAGE_PATH . DIRECTORY_SEPARATOR .
		'framework' . DIRECTORY_SEPARATOR . 'sessions',

	/**
	---------------------------------------------------------------
	 CACHE VIEW PATH
	---------------------------------------------------------------
	* The path to the logs directory within the root.
	*/
	'cacheViewPath' => STORAGE_PATH . DIRECTORY_SEPARATOR . 'framework'
		. DIRECTORY_SEPARATOR . 'views',

	/**
	---------------------------------------------------------------
	 CACHE DATA PATH
	---------------------------------------------------------------
	* The path to the cache data directory within the root.
	*/
	'cacheDataPath' => STORAGE_PATH . DIRECTORY_SEPARATOR . 'framework'
		. DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR . 'data',

	/**
	---------------------------------------------------------------
	 CACHE TESTING PATH
	---------------------------------------------------------------
	* The path to the cache testing directory within the root.
	*/
	'cacheTestingPath' => STORAGE_PATH . DIRECTORY_SEPARATOR . 'framework'
		. DIRECTORY_SEPARATOR . 'testing',


	/**
	 * ---------------------------------------------------------------
		-----------------------------------------------------------
								SYSTEM PATH
		----------------------------------------------------------- 
	*---------------------------------------------------------------*/


	/**
	---------------------------------------------------------------
	 AXM PATH
	---------------------------------------------------------------
	* The path to the vendor directory within the root.
	*/
	'axmPath' => VENDOR_PATH . DIRECTORY_SEPARATOR . 'axm',

	/**
	---------------------------------------------------------------
	 AXM FRAMEWORK PATH
	---------------------------------------------------------------
	* The path to the vendor directory within the root.
	*/
	'frameworkPath' => VENDOR_PATH . DIRECTORY_SEPARATOR . 'axm'
		. DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'src',

	/**
	---------------------------------------------------------------
	 AXM HELPERS
	---------------------------------------------------------------
	* The path to the helpers directory framework.
	*/
	'helpersAxmPath' => AXM_PATH . DIRECTORY_SEPARATOR . 'libraries'
		. DIRECTORY_SEPARATOR . 'Helpers',

	/**
	---------------------------------------------------------------
	 CONSOLE PATH
	---------------------------------------------------------------
	* The path to the console.
	*/
	'consolePath' => AXM_PATH . DIRECTORY_SEPARATOR . 'libraries'
		. DIRECTORY_SEPARATOR . 'Console',

	/**
	---------------------------------------------------------------
	 CONSOLE TEMPLATES
	---------------------------------------------------------------
	* The path to the console tamplate.
	*/
	'consoleTemplatePath' => AXM_PATH . DIRECTORY_SEPARATOR . 'libraries'
		. DIRECTORY_SEPARATOR . 'Console' . DIRECTORY_SEPARATOR . 'Commands'
		. DIRECTORY_SEPARATOR . 'Generators' . DIRECTORY_SEPARATOR
		. 'Template',
];
