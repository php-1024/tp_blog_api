<?php

namespace app\api\behavior;

use think\Request;

class UserCheck
{
    //配置tp5的中间件
    public function run()
    {
        $request = Request::instance();
        $request->iszmxw = "我绑定的请求参数";
    }
}