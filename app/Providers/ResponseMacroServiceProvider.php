<?php

namespace App\Providers;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class ResponseMacroServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // 注册api响应宏
        Response::macro('api', function ($msg = '', $code = 200, $data = '', $HttpStatus = 200) {
            // 组装数据
            $resultData = [
                'code' => $code,
                'msg'  => $msg,
                'time' => time(),
                'data' => $data,
            ];
            // 返回数据
            return response()->json($resultData, $HttpStatus);
        });

        // 注册微信数据格式的响应宏
        Response::macro('wechat', function ($msg = '', $code = 200, $data = '', $HttpStatus = 200) {
            // 组装数据
            $resultData = [
                'code' => $code,
                'msg'  => $msg,
                'time' => time(),
                'data' => $data,
            ];
            // 返回数据
            return response()->json($resultData, $HttpStatus);
        });
    }
}
