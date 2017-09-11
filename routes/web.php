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
Route::post('/', 'DataController@downloadData');


// Locale Configure
Route::get('locale/{locale}', 'LocaleController@switchLanguage')->name('locale');

Route::group(['prefix' => 'admin'], function () {
    Route::resource('nodes', 'NodeController', ['except' => ['show', 'destroy']]);
});


// Testing Routes
Route::get('data', function () {

    $node = \App\Node::first();

    $dataA = [
        "value" => "19.51",
        "timestamp" => "20160314130333"
    ];

    $dataB = [
        "value" => "19.54",
        "timestamp" => "20160314150981"
    ];

    $data = [];
    array_push($data, $dataA, $dataB);


    $sensorData = \App\SensorData::create([
        'variable' => 'Temp Out',
        'node_id' => $node->id,
        'data' => $data
    ]);

    $node->data()->save($sensorData);

    return $node->data;
});

Route::get('nodetypes', function(){
    return \App\NodeType::all();
});

