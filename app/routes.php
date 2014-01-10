<?php

/*
 * Error Functions
 */
App::missing(function($exception) {
    return Response::view('errors.missing', array(), 404);
});

/*
 * Site Functions
 */
Route::get('/', 'SiteController@home');
Route::get('/tos', 'SiteController@tos');
Route::get('/dmca', 'SiteController@dmca');


/*
 * Manager Functions
 */
Route::any('/m/login', array('before' => 'guest', 'uses' => 'AuthController@loginRegister'));
Route::any('/m/logout', array('before' => 'auth', 'uses' => 'AuthController@doLogout'));

Route::get('/m', array('before' => 'auth', 'uses' => 'ManagerController@home'));
