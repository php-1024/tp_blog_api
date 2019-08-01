<?php

namespace app\api\behavior;

use think\Request;

class UserCheck
{
    //配置tp5的中间件
    public function run()
    {
        $request = Request::instance();
//        dump($request->param());
        $request->cache('iszmxw');
        return false;
    }
}