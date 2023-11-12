<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('users/auth',[\App\Http\Controllers\UserController::class,'auth']);

Route::group(['middleware' => ['auth:api'],'prefix'=>'users'], function() {
    Route::get('countries',[\App\Http\Controllers\UserController::class,'getCountries']);
});

Route::resource('countries',\App\Http\Controllers\CountryController::class);
