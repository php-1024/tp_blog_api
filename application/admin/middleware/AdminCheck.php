<?php

namespace app\admin\middleware;

use think\Controller;
use think\Request;

class AdminCheck
{
    //配置的中间件
    public function run()
    {
        $request = Request::instance();
        $request->bind('test', 'test');
        $route = $request->path();
        switch ($route) {
            case "admin/api/login":
            case "admin/api/info":
                break;
            default:
                return json(['code' => 50000, 'message' => '对不起您没有权限，对不起', 'data' => []]);
                break;
        }
    }
}