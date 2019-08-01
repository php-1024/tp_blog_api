<?php

namespace app\api\behavior;

use think\Controller;
use think\Request;

class UserCheck extends Controller
{
    //配置tp5的中间件
    public function run()
    {
        $request = Request::instance();
        $request->bind('test', '測試參數');
//        $this->error('对不起您没有权限');
        return ['code' => 50000, 'message' => '对不起您没有权限'];

    }
}