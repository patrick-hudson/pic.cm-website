<?php

/*
 * Error Routes
 */
//App::error(function($exception, $code) {
//    switch ($code) {
//        case 403:
//            return Response::view('errors.forbidden', array(), 403);
//
//        case 404:
//            return Response::view('errors.missing', array(), 404);
//
//        default:
//            return Response::view('errors.default', array('code' => $code), $code);
//    }
//});


/*
 * Site Routes
 */
Route::get('/', 'SiteController@home');
Route::get('/tos', 'SiteController@tos');
Route::get('/dmca', 'SiteController@dmca');


Route::get('/v/{imageid}', 'SiteController@doViewer');
Route::get('/t/{filename}', 'SiteController@doThumbnail');
Route::get('/i/{filename}', 'SiteController@doImage');

/*
 * API Routes
 */

Route::any('/api', 'ApiController@doApiRequest');
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


// Confide routes
Route::get( 'user/create',                 'UserController@create');
Route::post('user',                        'UserController@store');
Route::get( 'user/login',                  'UserController@login');
Route::post('user/login',                  'UserController@do_login');
Route::get( 'user/confirm/{code}',         'UserController@confirm');
Route::get( 'user/forgot_password',        'UserController@forgot_password');
Route::post('user/forgot_password',        'UserController@do_forgot_password');
Route::get( 'user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password',         'UserController@do_reset_password');
Route::get( 'user/logout',                 'UserController@logout');
