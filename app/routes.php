<?php

Route::get('/', 'HomeController@getHome');

Route::resource('bundles', 'BundlesController');

Route::post('bundles/{id}/update', 'BundlesController@update');

Route::resource('requests', 'RequestsController');

Route::post('requests/make-request', 'RequestsController@makeRequest');
Route::post('requests/{id}/update', 'RequestsController@updateRequest');

Route::controller('users', 'UsersController');
