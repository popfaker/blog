<?php
/**
 * Created by PhpStorm.
 * User: xuning
 * Date: 2018/6/24
 * Time: 0:02
 */

namespace App\Http\Controllers;


use App\User;
use http\Env\Request;
use Payjp\Payjp;
use Payjp\Token;

class TestController extends Controller
{
    public function index()
    {
        User::where(function () {

        })->first();
    }

    /**
     * 查看方法
     * @return string
     */
    public function show()
    {
        echo 'this is show page';
        //return view('test.show');

        Payjp::setApiKey("sk_test_c62fade9d045b54cd76d7036");
        $params = [
            'card' => [
                "number" => "4242424242424242",
                "exp_month" => "12",
                "exp_year" => "2020",
            ]
        ];
        $aa = Token::create($params, $options = ['payjp_direct_token_generate' => 'true']);
        dd($aa);
    }

    public function pay(Request $request)
    {
        $token = $request->id;

    }
}