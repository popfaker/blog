<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Api\CaptchaRequest;
use Gregwar\Captcha\CaptchaBuilder;
use Illuminate\Support\Facades\Cache;


class CaptchaController extends Controller
{
    /**
     * 获取图片验证码
     * @param CaptchaRequest $request
     * @param CaptchaBuilder $captchaBuilder
     * @return mixed
     */
    public function store(CaptchaRequest $request, CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha_' . str_random(15);
        $phone = $request->phone;

        //验证码有效期2分钟
        $expiredAt = now()->addMinutes(2);

        $captcha = $captchaBuilder->build();

        Cache::put($key, ['phone' => $phone, 'code' => $captcha->getPhrase()], $expiredAt);


        return $this->response->array([
            'captcha_key' => $key,
            'captcha_image' => $captcha->inline(),
            'expired_at' => $expiredAt->toDateTimeString()
        ]);
    }
}