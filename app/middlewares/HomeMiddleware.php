<?php

namespace App\Middlewares;

use App\Middlewares\BaseMiddleware;

/**
 * Class HomeMiddleware
 *
 */
class HomeMiddleware extends BaseMiddleware
{
    public function execute()
    {
        echo 'hola mundo';
        die();
    }
}
