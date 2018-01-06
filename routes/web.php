<?php

use IceTea\Routing\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application.
| This file will be loaded by \App\Providers\RouteServiceProvider.
*/

Route::get("/", "IndexController@index");
Route::any("/elfinder_connector", "ElfinderController@connector")->name('elfin_connector');
Route::get("/elfinder", "ElfinderController@index");
Route::get("/login", "Auth\\LoginController@index");