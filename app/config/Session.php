<?php

/**
 * Session Configuration
 */
return [

    /**
     --------------------------------------------------------------------------
      EXPIRATION
     --------------------------------------------------------------------------
     *
     * Here you may specify the number of minutes that you wish 
     * the session
     * @var int
     */
    'expiration' => env('SESSION_LIFETIME', 3),

    /**
     --------------------------------------------------------------------------
      ENCRYPTION
     --------------------------------------------------------------------------
     *
     * This option allows you to easily specify that all of your session data
     * should be encrypted before it is stored.         
     * @var bool
     */
    'encrypt' => false,

    /**
     --------------------------------------------------------------------------
      COOKIE PATH
     --------------------------------------------------------------------------
     *
     * The session cookie path determines the path for which the cookie will
     * be regarded as available.         
     * @var string
     */
    'path' => '/',

    /**
     --------------------------------------------------------------------------
      COOKIE DOMAIN
     --------------------------------------------------------------------------
     *
     * Here you may change the domain of the cookie used to identify a session
     * in your application.
     * @var string
     */
    'domain' => env('SESSION_DOMAIN'),

    /**
     --------------------------------------------------------------------------
      SAMESITE COOKIES
     --------------------------------------------------------------------------
     *
     * This option determines how your cookies behave when cross-site requests
     * take place, and can be used to mitigate CSRF attacks. By default, we
     * will set this value to "lax" since this is a secure default value.
     *
     * Supported: "Lax", "Strict", "None"
     * @var string
     */
    'samesite' => 'Lax',

    /**
     --------------------------------------------------------------------------
      HTTPS ONLY COOKIES
     --------------------------------------------------------------------------
     *
     * By setting this option to true, session cookies will only be sent back
     * to the server if the browser has a HTTPS connection.         
     * @var bool
     */
    'secure' => env('SESSION_SECURE_COOKIE', false),

];
