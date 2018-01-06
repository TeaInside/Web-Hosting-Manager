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
Route::get("/elfinder", "ElfinderController@index")->name('elfinder');
Route::get("/login", "Auth\\LoginController@index")->name('login');
Route::get("/clientarea", "ClientAreaController@index")->name('clientarea');
Route::post("/login_action", "Auth\\LoginController@action")->name('login_action');
Route::get("/logout", "Auth\\LoginController@logout")->name('logout');