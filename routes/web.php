<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get("/installation", "HomeController@checkInstallation");

Route::post("/setenv", "ConfigController@createDatabase");
Route::get("/make-migration", "ConfigController@makeMigration");


Route::get('/', function () {
    return view('welcome');
});


