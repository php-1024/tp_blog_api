<?php

namespace app\api\behavior;

use think\Controller;
use think\Request;

class UserCheck extends Controller
{
    //配置tp5的中间件
    public function run(Request $request)
    {
        dump($request);
    }
}