<?php

Route::get('/admin', 'App\Modules\Admin\Controllers\HomeController@getHome');

Route::controller('users', 'App\Modules\Admin\Controllers\UsersController');

Route::filter('auth', function()
{
   if (Auth::guest()) return Redirect::guest('users/login');
});
