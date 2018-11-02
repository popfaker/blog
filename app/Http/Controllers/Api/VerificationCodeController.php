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


        //发送验证码

        //return $this->response->item('123', null);
    }
}
