<?php

namespace App\Controllers;

use App\Controllers\BaseController;

class LoginControllerController extends BaseController
{

    public function __construct()
    {
        parent::__construct();
    }

    /**
    * Return view
    * @return mixed
    */
    public function index()
    {
        return view('pages.welcome');
    }
}
