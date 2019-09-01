<?php

namespace app\admin\controller;

use app\admin\model\User;
use app\api\model\Blog;
use think\Db;
use think\Log;
use think\Request;
use think\Controller;
use think\Session;

class Login extends Controller
{
    public function login(Request $request)
    {
        $data = $request->param();
        if (empty($data['username'])) {
            return json(['code' => 500, 'message' => '请输入用户名！']);
        }
        if (empty($data['password'])) {
            return json(['code' => 500, 'message' => '请输入密码！']);
        }
        $res = User::getOne(['username' => $data['username']]);
        if ($res) {
            if ($res['password'] === md5($data['password'])) {
                Session::set('admin_data',$res);
                return json(['code' => 200, 'message' => '恭喜您登录成功！']);
            } else {
                return json(['code' => 500, 'message' => '密码不正确请您核对后再试']);
            }
        } else {
            return json(['code' => 500, 'message' => '账户不存在，请您仔细检查用户名是否正确！']);
        }
    }


    public function info(Request $request)
    {
        $admin_data = Session::get('admin_data');
        dump($admin_data);
    }
}
