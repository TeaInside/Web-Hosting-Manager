<?php

use IceTea\Routing\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application.
| This file will be loaded by \App\Providers\RouteServiceProvider.
*/

Route::get("/", "TestController@index");
Route::get("/elfinder", "ElfinderController@index");
Route::any("/elfinder/connector", "ElfinderController@connector");
