<?php

declare(strict_types=1);

namespace App\Middlewares;

/**
 * Class BaseMiddleware
 *
 * @author  Juan Cristobal <juancristobalgd1@gmail.com>
 * @package App\Middlewares
 */
abstract class BaseMiddleware
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     * @var array
     */
    public static $httpMiddlewares = [
        \Axm\Middlewares\MaintenanceMiddleware::class,
        \Axm\Middlewares\VerifyCsrfTokenMiddleware::class,
        \Axm\Middlewares\AuthMiddleware::class,
    ];
}
