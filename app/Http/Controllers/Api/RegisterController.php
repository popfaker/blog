<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

/**
 * 注册
 * Class RegisterController
 * @package App\Http\Controllers\Api
 * @author Xn <1804434@qq.com>
 * @Date 2018/11/1 16:25
 */
class RegisterController extends Controller
{
    /**
     * @param RegisterRequest $request
     * @return \Dingo\Api\Http\Response|void
     */
    public function store(RegisterRequest $request)
    {
        $verificationCode_key = $request->verificationCode_key;
        $verificationCode = Cache::get($verificationCode_key);
        if (!$verificationCode) {
            return $this->response->error('短信验证码已过期', 422);
        }

        if (!hash_equals($verificationCode['code'], $request->code)) {
            return $this->response->error('短信验证码错误', 422);
        }

        //清除短信验证码
        Cache::forget($verificationCode_key);

        User::query()->create([
            'name' => $request->name,
            'phone' => $verificationCode['phone'],
            'password' => encrypt($request->password)
        ]);
        return $this->response->created();
    }
}
