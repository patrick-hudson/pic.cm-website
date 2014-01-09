<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/
App::missing(function($exception)
{
    return Response::view('errors.missing', array(), 404);
});

Route::get('/', function(){return View::make('site.home');});
Route::get('/tos', function(){return View::make('site.tos');});
Route::get('/dmca', function(){return View::make('site.dmca');});

Route::get('/m/', 'ManagerController@home');