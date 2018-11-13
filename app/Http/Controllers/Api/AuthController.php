<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\LoginRequest;


/**
 * 认证
 * Class AuthController
 * @package App\Http\Controllers\Api
 * @author Xn <1804434@qq.com>
 * @Date 2018/11/13 15:36
 */
class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => 'login']);
    }

    /**
     * 账密登陆
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        $credentials['phone'] = $request->phone;
        $credentials['password'] = $request->password;

        if (!$token = auth()->guard('api')->attempt($credentials)) {
            return $this->response()->errorUnauthorized('验证不通过');
        }

        return $this->respondWithToken($token);

    }


    /**
     * 刷新token
     * @return mixed
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->guard('api')->refresh());
    }

    /**
     * 返回token
     * @param $token
     * @return mixed
     */
    public function respondWithToken($token)
    {
        return $this->response()->array([
            'token' => $token,
            'token_type' => 'Bearer',
            'expires_in' => auth()->guard('api')->factory()->getTTl() * 60
        ])->setStatusCode(201);
    }

}
