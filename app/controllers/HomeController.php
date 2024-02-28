<?php

namespace App\Controllers;

use App\Models\User;


/**
 *  Class HomeController
 **/
class HomeController extends BaseController
{
    public function index()
    {
        return view('pages.welcome');
    }
}
