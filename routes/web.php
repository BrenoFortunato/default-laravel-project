<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes(["verify" => true]);

// TODO: Landing Page
Route::get("/", function () {
    return redirect(route("home"));
});

Route::group(["middleware" => ["auth", "active"]], function () {
    // Home
    Route::get("/home",                                            ["as" => "home",        "uses" => "HomeController@index"]);

    // User
    Route::group(["prefix" => "users"], function () {
        Route::get("/",                                            ["as" => "users.index",   "uses" => "UserController@index"]);
        Route::get("/create",                                      ["as" => "users.create",  "uses" => "UserController@create"]);
        Route::post("/",                                           ["as" => "users.store",   "uses" => "UserController@store"]);
        Route::get("/{user_id}",                                   ["as" => "users.show",    "uses" => "UserController@show"]);
        Route::match(["put", "patch"], "/{user_id}",               ["as" => "users.update",  "uses" => "UserController@update"]);
        Route::delete("/{user_id}",                                ["as" => "users.destroy", "uses" => "UserController@destroy"]);
        Route::get("/{user_id}/edit",                              ["as" => "users.edit",    "uses" => "UserController@edit"]);
    });
});

