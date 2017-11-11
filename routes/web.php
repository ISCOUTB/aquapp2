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
Route::get('about', 'DataController@getAbout');

Route::get('data', 'DataController@filterData');

// Locale Configure
Route::get('locale/{locale}', 'LocaleController@switchLanguage')->name('locale');

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::resource('nodes', 'NodeController', ['except' => ['show', 'destroy']]);
    Route::get('nodes/parameters','NodeController@showAvailableParameters')->name('parameters');
});

Route::get('nodetypes', function(){
    return \App\NodeType::all();
});

// Authentication Routes...
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Registration Routes...
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//Route::post('register', 'Auth\RegisterController@register');

// Password Reset Routes...
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm');
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail');
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm');
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');
