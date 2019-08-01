<?php

namespace app\api\behavior;

use think\Controller;
use think\Request;

class UserCheck
{
    //配置tp5的中间件
    public function run(Request $request)
    {
        dump($request);
    }
}