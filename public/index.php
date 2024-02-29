<?php

/**
|_________________________________________________________________________________________________
|
|  _______                    _______                                                       __
| |   _   |.--.--..--------. |    ___|.----..---.-..--------..-----..--.--.--..-----..----.|  |--.
| |       ||_   _||        | |    ___||   _||  _  ||        ||  -__||  |  |  ||  _  ||   _||    <
| |___|___||__.__||__|__|__| |___|    |__|  |___._||__|__|__||_____||________||_____||__|  |__|__|
|
|-------------------------------------------------------------------------------------------------|*/

define('AXM_BEGIN_TIME', microtime(true));

// Include autoload
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'axm' .
    DIRECTORY_SEPARATOR . 'framework' . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR .
    'bootstrap.php';

// Initialize the application
$app = app();

/*
 *--------------------------------------------------------------- 
 * LAUNCH THE APPLICATION 
 * --------------------------------------------------------------- 
 * Now that everything is set up, it's time to start the 
 * application.
 */
$app->run();
