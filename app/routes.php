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
//        case 500:
//            return Response::view('errors.broke', array(), 500);
//
//        default:
//            return Response::view('errors.default', array('code' => $code), $code);
//    }
//});


/*
 * Site Routes
 */
Route::get('/', 'SiteController@home');
Route::get('tos', 'SiteController@tos');
Route::get('dmca', 'SiteController@dmca');

Route::get('v/{imageid}', 'SiteController@doViewer');
Route::get('t/{filename}', 'SiteController@doThumbnail');
Route::get('i/{filename}', 'SiteController@doImage');

/*
 * API Routes
 */

Route::any('api', 'ApiController@doApiRequest');
Route::any('ajax', 'ApiController@doAjaxRequest');
Route::get('user/api/key_generate', array('before' => 'auth', 'ApiController@doKeyGeneration'));

/*
 * Route Permissions
 */

Route::when('user*', 'notSuspended');
Route::when('user/admin*', 'isAdmin');

/*
 * User Routes
 */

Route::get('user', array('before' => 'auth', 'uses' => 'UserController@doDashboard'));
Route::get('user/account', array('before' => 'auth', 'uses' => 'UserController@accountSettings'));

Route::get('user/confirm/{code}', 'UserController@confirm');
Route::get('user/logout', array('before' => 'auth', 'uses' => 'UserController@logout'));

Route::get('user/create', array('before' => 'guest', 'uses' => 'UserController@create'));
Route::post('user/create', array('before' => 'guest', 'uses' => 'UserController@do_create'));

Route::get('user/login', array('before' => 'guest', 'uses' => 'UserController@login'));
Route::post('user/login', array('before' => 'guest', 'uses' => 'UserController@do_login'));

Route::get('user/forgot_password', 'UserController@forgot_password');
Route::post('user/forgot_password', 'UserController@do_forgot_password');

Route::get('user/reset_password/{token}', 'UserController@reset_password');
Route::post('user/reset_password', 'UserController@do_reset_password');


/*
 * Admin Routes
 */

Route::get('user/admin', array('before' => 'auth', 'uses' => 'AdminController@doDashboard'));
Route::get('user/admin/users', array('before' => 'auth', 'uses' => 'AdminController@doUsers'));
Route::get('user/admin/user', array('before' => 'auth', 'uses' => 'AdminController@doUserDash'));
Route::get('user/admin/user_edit', array('before' => 'auth', 'uses' => 'AdminController@editUser'));
Route::post('user/admin/user_edit', array('before' => 'auth', 'uses' => 'AdminController@doEditUser'));
