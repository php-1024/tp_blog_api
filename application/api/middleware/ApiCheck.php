<?php

namespace app\api\middleware;

use think\Request;

class ApiCheck
{
    //配置tp5的中间件
    public function run()
    {
        $request = Request::instance();
        $request->bind('test', '測試參數');
        return json(['code' => 50000, 'message' => '对不起您没有权限']);
    }
}