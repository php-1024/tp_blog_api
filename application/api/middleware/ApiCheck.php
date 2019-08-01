<?php

namespace app\api\middleware;

use think\Controller;
use think\Request;

class ApiCheck extends Controller
{
    //配置tp5的中间件
    public function run()
    {
        $request = Request::instance();
        $request->bind('test', '测试');
        return json(['code' => 50000, 'message' => '对不起您没有权限啊啊啊']);
    }
}