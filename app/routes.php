<?php

Route::get('/', 'HomeController@getHome');

Route::resource('bundles', 'BundlesController');

Route::resource('requests', 'RequestsController');

Route::controller('mobile', 'MobileController');

Route::post('requests/make-request', 'RequestsController@makeRequest');

Route::controller('users', 'UsersController');
