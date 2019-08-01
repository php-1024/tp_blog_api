<?php

namespace app\api\behavior;

use think\Request;

class UserCheck
{
    //配置tp5的中间件
    public function run()
    {
        $request = Request::instance();
        $obj = "我绑定的请求参数";
        $request->bind('caonima', $obj);
        $request->__set('caibi', '12啊飒飒');

    }
}