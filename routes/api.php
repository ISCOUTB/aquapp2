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
 * Node Types
 */
Route::resource('nodetypes', 'ApiControllers\NodeType\NodeTypeController', ['only' => ['index', 'show']]);
Route::resource('nodetypes.nodes', 'ApiControllers\NodeType\NodeTypeNodeController', ['only' => ['index']]);

/*
 * Nodes
 */
Route::resource('nodes', 'ApiControllers\Node\NodeController', ['only' => ['index', 'show']]);
Route::resource('nodes.data', 'ApiControllers\Node\NodeDataController', ['only' => ['index']]);

/*
 * Data
 */
Route::resource('data', 'ApiControllers\DataController', ['only' => ['index']]);
