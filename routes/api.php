<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::prefix('')->namespace('API')->group(function () {
    Route::post('register', "UserApiAuthController@register");
    Route::post('login', "UserApiAuthController@login");
});
Route::prefix('')->middleware('auth:user')->namespace('API')->group(function () {
    Route::post('update-profile', "UserApiAuthController@updateProfile");
    Route::get('profile', "UserApiAuthController@profile");
});
