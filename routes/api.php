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
    $api->group([], function ($api) {

        //查看接口版本
        $api->get('version', function () {
            return 'this is v1';
        });
        //用户列表
        $api->resource('users', 'UserController');
        //注册
        $api->post('register', ['uses' => 'RegisterController@store', 'middleware' => 'api.throttle', 'limit' => 10, 'expires' => 1]);
        //图片验证码
        $api->post('captcha', 'CaptchaController@store');
        //发送短信验证码
        $api->post('verificationCodes', 'VerificationCodeController@store');
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