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

Route::get('/', 'MainController@showIndex');

//Route::get('login/facebook', 'Auth\AuthController@redirectToFacebookProvider');
//Route::get('login/facebook/callback', 'Auth\AuthController@handleFacebookProviderCallback');

Route::group(['prefix'=>'process'], function(){
    Route::get('/change-locale/{lang}', 'ProcessController@getChangeLocale');
    Route::post('/suscribete', 'ProcessController@postSubscribe');
    Route::post('/save-model', 'ProcessController@postSaveModel');
    Route::post('/model', 'ProcessController@postModel');
});

Route::get('product-summary/{id}', array('as' => 'MainController', 'uses' => 'MainController@findProductSummary'));
Route::get('product/{slug}', array('as' => 'MainController', 'uses' => 'MainController@findProduct'));
Route::get('category/{slug}', array('as' => 'MainController', 'uses' => 'MainController@findCategory'));
Route::get('suscribete', array('as' => 'MainController', 'uses' => 'MainController@showSubscribe'));

Route::get('{slug}/{extra_slug?}', array('as' => 'MainController', 'uses' => 'MainController@showPage'));