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

// Home Routes
Route::get('/', 'DataController@getHome');
Route::get('data', 'DataController@filterData');


// Locale Configure
Route::get('locale/{locale}', 'LocaleController@switchLanguage')->name('locale');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('nodes', 'NodeController', ['except' => ['show', 'destroy']]);
    Route::get('nodes/parameters','NodeController@showAvailableParameters')->name('parameters');
});


Route::get('nodetypes', function(){
    return \App\NodeType::all();
});
