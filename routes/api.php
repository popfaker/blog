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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});
//
//Route::get('/',function(){
//  return 'hello api';
//});

/**
 * v1版本
 */
$api = app('Dingo\Api\Routing\Router');
$api->version('v1', [
    'namespace' => 'App\Http\Controllers\Api'
], function ($api) {
    $api->group(['middleware' => 'api.throttle', 'limit' => 60, 'expires' => 1], function ($api) {
        $api->get('version', function () {
            return 'this is v1';
        });
        $api->resource('users', 'UserController'); //用户列表
        $api->resource('register', 'RegisterController', ['only' => ['store']]); //注册
    });
});


/**
 * v2版本
 */
$api->version('v2', function ($api) {
    $api->get('version', function () {
        return 'this is v2';
    });
});