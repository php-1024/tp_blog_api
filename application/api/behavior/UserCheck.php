<?php

namespace app\api\behavior;

use think\Controller;
use think\Request;

class UserCheck extends Controller
{
    //类里面引入jump;类 可以使用跳转的一些方法 还有 success 、error
    public function run(Request $request)
    {
        halt('测试HOOK');
    }
}