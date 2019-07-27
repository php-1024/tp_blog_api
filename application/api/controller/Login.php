<?php

namespace app\api\controller;

use think\Db;

class Login
{

    public function login()
    {
        $res = Db::name('tag')->where([])->select();
        dump($res);
    }
}
