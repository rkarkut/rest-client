<?php

namespace App\Modules\Admin\Controllers;
use View;

class HomeController extends \BaseController {

    public function getHome()
    {
        return View::make('admin::home');
    }

}
