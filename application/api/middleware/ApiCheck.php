<?php

namespace app\api\middleware;

use think\Controller;
use think\Request;

class ApiCheck
{
    //配置的中间件
    public function run()
    {
        $request = Request::instance();
        $request->bind('test', 'test');
        return json(['code' => 50000, 'message' => '对不起您没有权限，对不起', 'data' => []]);
    }
}