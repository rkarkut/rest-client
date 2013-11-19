<?php

Route::get('/', 'HomeController@getHome');

Route::resource('bundles', 'BundlesController');
Route::resource('requests', 'RequestsController');

Route::controller('users', 'UsersController');
