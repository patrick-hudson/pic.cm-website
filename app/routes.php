<?php

/*
 * Error Routes
 */
App::missing(function($exception) {
    return Response::view('errors.missing', array(), 404);
});

/*
 * Site Routes
 */
Route::get('/', 'SiteController@home');
Route::get('/tos', 'SiteController@tos');
Route::get('/dmca', 'SiteController@dmca');


/*
 * API Routes
 */

Route::any('/api', 'ApiController@doUploadApi');
Route::any('/ajax', 'ApiController@doAjaxRequest');

/*
 * Manager Routes
 */
Route::any('/m/login', array('before' => 'guest', 'uses' => 'AuthController@doLogin'));
Route::any('/m/logout', array('before' => 'auth', 'uses' => 'AuthController@doLogout'));
Route::any('/m/register', array('before' => 'guest', 'uses' => 'AuthController@doRegister'));
Route::any('/m/forgot', array('before' => 'guest', 'uses' => 'AuthController@doLogout'));

Route::get('/m', array('before' => 'auth', 'uses' => 'ManagerController@doDashboard'));
Route::any('/m/account', array('before' => 'auth', 'uses' => 'ManagerController@accountSettings'));

Route::get('/m/api/key_generate', array('before' => 'auth', 'uses' => 'ApiController@doKeyGeneration'));
