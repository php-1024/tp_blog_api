<?php

namespace app\admin\middleware;

use think\Request;
use think\Session;

class AdminCheck
{
    /**
     * 配置的中间件
     * @return \think\response\Json
     */
    public function run()
    {
        $request = Request::instance();
        $route = $request->path();
        switch ($route) {
            case "admin/api/login":
                break;
            default:
                return self::LoginCheck($request);
                break;
        }
    }


    /**
     * 登录检测
     * @param Request $request
     * @return \think\response\Json
     */
    public static function LoginCheck(Request $request)
    {
        $param = $request->param();
        if (isset($param['token'])) {
            $admin_data = Session::get($param['token']);
            if (empty($admin_data)) {
                return json(['code' => 500, 'message' => '登录过期，请您重新登录！']);
            }
            $request->bind('admin_data', $admin_data);
        } else {
            return json(['code' => 500, 'message' => '请传输token']);
        }
    }

}