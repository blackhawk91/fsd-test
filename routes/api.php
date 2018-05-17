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


Route::group( ['namespace' => 'Api'],function () {

    //Main API routes

    Route::get('book', ['uses' =>'DataController@allBooks']);

    //Api Auth routes

    Route::post('/register', ['uses' => 'AuthController@register']);
    Route::post('/login', ['uses' => 'AuthController@login']);

    //Group of protected routes


    Route::group(['middleware' => 'jwt.auth'], function () {

        Route::get('/logout',   ['uses' => 'AuthController@logout']);

        Route::group(['prefix' => 'book'],function() {

            Route::get('index',            ['uses' => 'BookController@index']);
            Route::get('show/{book}',      ['uses' => 'BookController@show']);
            Route::get('{book}/edit',      ['uses' => 'BookController@edit']);
            Route::post('store',           ['uses' => 'BookController@store']);
            Route::put('update',           ['uses' => 'BookController@update']);
            Route::delete('destroy/{book}',['uses' => 'BookController@destroy']);

        });

    });

    Route::middleware('jwt.refresh')->get('/token/refresh', 'AuthController@refresh');

});
