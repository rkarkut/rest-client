<?php

Route::get('/', 'HomeController@getHome');

Route::resource('bundles', 'BundlesController');

Route::controller('users', 'UsersController');
