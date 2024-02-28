<?php

use Http\Router as Route;

/**
---------------------------------------------------------------
 WEB ROUTES
---------------------------------------------------------------
 *
 * Here is where you can register web routes for your application.
 */

// welcome, login and register
Route::get('/', App\Controllers\HomeController::class);
// Route::get('/auth-redirect-{provider:\w+}', [App\Raxm\AuthRaxm::class, 'handlerAuthRedirect']);
// Route::get('/auth-google-callback', [App\Raxm\AuthRaxm::class, 'handlerRediretGoogleAuth']);

Route::get('/home', App\Controllers\LoginControllerController::class);
// Route::get('/food', App\Raxm\FoodRaxm::class);
// Route::get('/markets', App\Raxm\MarketsRaxm::class);
// Route::get('/pharmacy', App\Raxm\PharmacyRaxm::class);
// Route::get('/profile', App\Raxm\ProfileRaxm::class);

Route::get('/logout', function () {
    app()->logout();
});
