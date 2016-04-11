<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/
Route::get('/', 'IndexController@index');

Route::group(['prefix' => 'api/v1'/*, 'middleware' => 'throttle'*/], function() {
    Route::resource('items', 'ItemController', [
        'only' => ['index', 'show'],
    ]);

    Route::patch('baskets/{baskets}/add', 'BasketController@addItems');
    Route::resource('baskets', 'BasketController', [
        'except' => ['create', 'edit']
    ]);
});
