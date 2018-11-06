<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\VerificationCodeRequest;
use Illuminate\Support\Facades\Cache;

/**
 * 发送短信验证码
 * Class VerificationCodeController
 * @package App\Http\Controllers\Api
 * @author Xn <1804434@qq.com>
 * @Date 2018/11/2 11:29
 */
class VerificationCodeController extends Controller
{
    /**
     * @param VerificationCodeRequest $request
     * @return mixed
     * @throws \Exception
     */
    public function store(VerificationCodeRequest $request)
    {
        $captcha = Cache::get($request->captcha_key);
        if (!$captcha) {
            $this->response->error('图片验证码已经过期', 422);
        }

        if (!hash_equals($captcha['code'], $request->captcha_code)) {
            //验证码错误就清除验证码缓存
            Cache::forget($request->captcha_key);
            $this->response->error('图片验证码错误', 422);
        }

        $phone = $captcha['phone'];


        if (app()->environment() == 'production') {
            //生成四位短信验证码
            $code = str_pad(random_int(1, 9999), 4, 0, STR_PAD_LEFT);
        } else {
            $code = '1234';
        }


        //发送短信 sendMsg($phone,'content');


        //缓存短信验证码 5分钟
        $key = 'verificationCode_' . str_random(15);
        $expiredAt = now()->addMinutes(5);//过期时间
        Cache::put($key, ['phone' => $phone, 'code' => $code], $expiredAt);

        //清除图片验证码
        Cache::forget($request->captcha_key);
        return $this->response->array([
            'key' => $key,
            'expired_at' => $expiredAt->toDateTimeString()
        ])->setStatusCode(201);
    }
}
