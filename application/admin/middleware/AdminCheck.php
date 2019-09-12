<?php

namespace app\admin\middleware;

use think\Cache;
use think\Request;

class AdminCheck
{
    /**
     * 配置的中间件
     * @return \think\response\Json
     */
    public function run()
    {
        self::cors();
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
        $token = $request->param('token');
        $AdminToken = $request->header('Admin-Token');
        $token = empty($token) ? $AdminToken : $token;
        if (isset($token)) {
            $admin_data = Cache::get($token);
            if (empty($admin_data)) {
                return json(['code' => 500, 'message' => '登录过期，请您重新登录！']);
            }
            $request->bind('admin_data', $admin_data);
        } else {
            return json(['code' => 500, 'message' => '请传输token']);
        }
    }

    //解决跨域问题
    public static function cors()
    {
        // 允许来自任何来源
        if (isset($_SERVER['HTTP_ORIGIN'])) {
            // Decide if the origin in $_SERVER['HTTP_ORIGIN'] is one
            // 决定$_SERVER['HTTP_ORIGIN']是否为一个
            // 您希望允许，如果允许：
            header("Access-Control-Allow-Origin: {$_SERVER['HTTP_ORIGIN']}");
            header('Access-Control-Allow-Credentials: true');
            header('Access-Control-Max-Age: 86400');    // 一天缓存
        }
        // 在选项请求期间接收访问控制头
        if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
                header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
            if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
                header("Access-Control-Allow-Headers: {$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
        }
    }

}