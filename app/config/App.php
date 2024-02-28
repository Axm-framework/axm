<?php

return [

    /**
    --------------------------------------------------------------------------
      MAINTENANCE MODE
    --------------------------------------------------------------------------
     *
     * Indicates whether the site is in maintenance mode, displaying a 
     * maintenance view.
     * @var bool 
     */
    'maintenance' => env('APP_DOWN', false),

    /**
    --------------------------------------------------------------------------
     ENVIRONMENT
    --------------------------------------------------------------------------
     *
     * Indicates whether the site is in debug mode. Debug mode is enabled in the 
     * 'debug'environment and disabled in the 'production' environment.
     * @var bool 
     */
    'debug' => (env('APP_ENVIRONMENT', 'production') == 'debug') ? true : false,

    /**
    --------------------------------------------------------------------------
      USER CLASS
    --------------------------------------------------------------------------
     *
     * This variable stores the user model class. It simplifies authentication
     * and route access control.
     * @var string
     */
    'userClass' => 'App\\Models\\User',

    /**
    --------------------------------------------------------------------------
      USER SESSION KEY
    --------------------------------------------------------------------------
     *
     * Identifies the name (key) used for the user session, e.g., 
     * $_SESSION['uid'].
     * It is used for authentication and route access control.
     * @var string
     */
    'userId' => 'uid',

    /**
    --------------------------------------------------------------------------
     WEBSITE INFORMATION
    --------------------------------------------------------------------------
     *
     * This variable holds information about the application. It is used to 
     * populate meta content on your website.
     * @var array
     */
    'info' => [
        'title' => 'My App',
        'description' => 'My Description',
        'author' => 'My Name',
        'version' => '1.0',
        'name' => 'My App Name',
    ],

    /**
    --------------------------------------------------------------------------
      LOG FILE INITIALIZATION
    --------------------------------------------------------------------------
     *
     * If this property is set to true, a log.log file will be created in the 
     * app's root folder to record critical errors.
     * @var bool
     */
    'initLogReportings' => true,   // true | false

    /** 
     --------------------------------------------------------------------------
       DEFAULT LANGUAGE
     --------------------------------------------------------------------------
     *
     * The Locale roughly represents the language and location that your visitor
     * is viewing the site from. It affects the language strings and other
     * strings (like currency markers, numbers, etc) that your program
     * should run under for this request.
     * @var string
     */
    'defaultLanguage' => 'English',

    /**
    --------------------------------------------------------------------------
      DEFAULT LOCALE
    --------------------------------------------------------------------------
     *
     * The Locale roughly represents the language and location that your visitor
     * is viewing the site from. It affects the language strings and other
     * strings (like currency markers, numbers, etc) that your program
     * should run under for this request.
     * @var string
     */
    'defaultLocale' => 'en_EN',

    /**
    --------------------------------------------------------------------------
      APPLICATION TIMEZONE
    --------------------------------------------------------------------------
     *
     * The default timezone used in your application for displaying dates.
     * @var string
     */
    'appTimezone' => 'America/Chicago',

    /**
    --------------------------------------------------------------------------
      DEFAULT CHARACTER SET
    --------------------------------------------------------------------------
     *
     * This determines the default character set used in various methods
     * that require a character set to be provided.
     * @see http://php.net/htmlspecialchars for a list of supported charsets.
     * @var string
     */
    'charset' => 'UTF-8',

    /**
     --------------------------------------------------------------------------
       SESSION EXPIRATION
     --------------------------------------------------------------------------
     *
     * This configuration option determines the duration of a session in seconds.
     * You can set it to a specific value, and the session will expire after 
     * that many seconds of inactivity. 
     * If you set it to 0, the session will expire when the browser is closed.
     * 
     * Example:
     * - 0: Session expires when the browser is closed.
     * - 600: Session lasts for 10 minutes of inactivity.
     * - 3600: Session lasts for 1 hour of inactivity.
     * - 86400: Session lasts for 24 hours of inactivity.
     * @var int
     */
    'sessionExpiration' => env('SESSION_LIFETIME', 300),

    /**
    --------------------------------------------------------------------------
      CSRF TOKEN REGENERATION
    --------------------------------------------------------------------------
     *
     * Regenerate the token on every submission?
     * @var bool
     */
    'CSRFRegenerate' => true,

    /**
    --------------------------------------------------------------------------
      CSRF TOKEN REDIRECT
    --------------------------------------------------------------------------
     *
     * Redirect to the previous page with an error on CSRF token failure?
     * @var bool
     */
    'CSRFRedirect' => true,

    /**
    --------------------------------------------------------------------------
      FORCE GLOBAL SECURE REQUEST
    --------------------------------------------------------------------------
     *
     * Force the scheme to be either 'https://' or 'http://'.
     * @var bool
     */
    'forceGlobalSecureRequests' => false,    // true | false

    /**
    --------------------------------------------------------------------------
      DEBUGBAR
    --------------------------------------------------------------------------
     *
     * If this property is set to true, the debug bar will be displayed.
     * @var bool
     */
    'openDebugBar' => true, // true | false
];
