<?php

namespace app\admin\controller;

use app\admin\model\LoginLog;
use app\admin\model\User;
use app\common\Tooling;
use think\Cache;
use think\Db;
use think\Log;
use think\Request;
use think\Controller;

class Login extends Controller
{
    /**
     * 登录
     * @param Request $request
     * @return \think\response\Json
     */
    public function login(Request $request)
    {
        $data = $request->param();
        if (empty($data['username'])) {
            return json(['code' => 500, 'message' => '请输入用户名！']);
        }
        if (empty($data['password'])) {
            return json(['code' => 500, 'message' => '请输入密码！']);
        }
        $ip = $request->ip();
        $address = Tooling::address($ip);
        if ($address === false) {
            $address['location'] = "本地开发登录";
        }
        $res = User::getOne(['username' => $data['username']]);
        if ($res) {
            if ($res['password'] === md5($data['password'])) {
                $token = md5(time() . rand(1000, 9999));
                Cache::set($token, $res);
                LoginLog::AddData([
                    'user_id' => $res['id'],
                    'username' => $res['username'],
                    'role' => $res['role'],
                    'ip' => $ip,
                    'address' => $address['location'],
                ]);
                return json(['code' => 200, 'message' => '恭喜您登录成功！', 'data' => ['token' => $token]]);
            } else {
                return json(['code' => 500, 'message' => '密码不正确请您核对后再试']);
            }
        } else {
            return json(['code' => 500, 'message' => '账户不存在，请您仔细检查用户名是否正确！']);
        }
    }


    /**
     * 退出登录
     * @param Request $request
     * @return array
     */
    public function logout(Request $request)
    {
        $token = $request->param('token');
        $AdminToken = $request->header('Admin-Token');
        $token = empty($token) ? $AdminToken : $token;
        Cache::rm($token);
        return json(['code' => 200, 'message' => '操作成功']);
    }


    /**
     * 获取用户信息
     * @param Request $request
     * @return \think\response\Json
     */
    public function info(Request $request)
    {
        $admin_data = $request->__get('admin_data');
        $domain = $request->domain();
        $admin_data['avatar'] = $domain . "/static/images/user.gif";
        unset($admin_data['password']);
        return json(['code' => 200, 'message' => '获取用户信息成功！', 'data' => $admin_data]);
    }
}
