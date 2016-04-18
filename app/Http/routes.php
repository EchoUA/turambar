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
//Route::get('/', 'IndexController@index');
Route::any('items', 'IndexController@items');
Route::any('/', 'IndexController@baskets');

Route::group(['prefix' => 'api/v1', 'middleware' => 'throttle'], function() {

    Route::get('baskets/{baskets}/items', 'ItemController@getBasteWithItems');
    Route::post('baskets/{baskets}/items', 'ItemController@addItemsToBasket');

    Route::resource('items', 'ItemController', [
        'only' => ['index', 'show'],
    ]);

    Route::resource('baskets', 'BasketController', [
        'except' => ['create', 'edit']
    ]);
});
