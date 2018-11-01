<?php

namespace App\Services;


use Illuminate\Contracts\Support\Arrayable;

/**
 * 测试Arrayable接口
 * Class Test
 * @package App\Services
 * @author Xn <1804434@qq.com>
 * @Date 2018/11/1 15:01
 */
class Test implements Arrayable
{
    public function getData()
    {
        return 1;
    }

    public function toArray()
    {
        return [
            '1112'
        ];
    }
}