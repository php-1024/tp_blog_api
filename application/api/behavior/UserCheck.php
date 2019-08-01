<?php

namespace app\api\behavior;

use think\Request;

class UserCheck
{
    //配置tp5的中间件
    public function run()
    {
        $request = Request::instance();
        $request->bind('test', '測試參數');
    }
}