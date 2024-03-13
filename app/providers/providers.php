<?php

return [
    /**
     ---------------------------------------------------------------
       APP PROVIDERS
     ---------------------------------------------------------------
     *
     * Here will be registered the classes of the providers that will 
     * be loaded at the start of the system, these will only be stored 
     * in the application container and will be consumed on demand.    
     **/
    'app'        => App::class,
    'config'     => Config::class,
    'session'    => Session\Session::class,
    'request'    => Http\Request::class,
    'response'   => Http\Response::class,
    'router'     => Http\Router::class,
    'view'       => Views\View::class,
    'controller' => App\Controllers\BaseController::class,
    'database'   => Database\Database::class,
    'validator'  => Validation\Validator::class,
    'auth'       => Auth\Auth::class,
    'console'    => Console\ConsoleApplication::class,
    'raxm'       => Raxm\Raxm::class,
    // 'event'      => EventManager::class,
    // 'cache'      => Cache\Cache::class,
];
