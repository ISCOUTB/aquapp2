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


/*
 * API Documentation
 */
Route::get('/', function(){
    return view('api.swagger-api-doc');
});

//Route::middleware('client.credentials')->group(function () {
    /*
    * Node Types
    */
    Route::resource('node-types', 'ApiControllers\NodeType\NodeTypeController', ['only' => ['index', 'show']]);
    Route::resource('node-types.nodes', 'ApiControllers\NodeType\NodeTypeNodeController', ['only' => ['index']]);

    /*
     * Nodes
     */
    Route::resource('nodes', 'ApiControllers\Node\NodeController', ['only' => ['index', 'show']]);
    Route::resource('nodes.data', 'ApiControllers\Node\NodeDataController', ['only' => ['index']]);

    /*
     * Data
     */
    Route::resource('data', 'ApiControllers\DataController', ['only' => ['index']]);

//});