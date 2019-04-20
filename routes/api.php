<?php

use Illuminate\Http\Request;

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

Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@authenticate');

Route::group(['middleware' => ['jwt.verify']], function() {
    Route::post('logout', 'AuthController@logout');
    Route::get('articles', 'ArticleController@index');
    Route::get('article/{id}', 'ArticleController@show');
    Route::post('store', 'ArticleController@store');
    Route::post('update/{id}', 'ArticleController@update');
    Route::delete('delete/{id}', 'ArticleController@delete');
});
