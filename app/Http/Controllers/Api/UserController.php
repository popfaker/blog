<?php

namespace App\Http\Controllers\Api;

use App\Services\Test;
use App\Models\User;
use App\Transformer\UserTransformer;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;


/**
 * 用户测试
 * Class UserController
 * @package App\Http\Controllers\Api
 * @author Xn <1804434@qq.com>
 * @Date 2018/11/1 11:15
 */
class UserController extends Controller
{
    /**
     * 用户列表
     */
    public function index()
    {
        return $this->user();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd('1');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        dd();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
