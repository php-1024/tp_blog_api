<?php

namespace app\api\controller;

use app\api\model\Blog;
use think\Db;

class Login
{

    public function login()
    {
        $blog = Blog::getOne(['id', 1]);
        $blog = Blog::getOne(['id' => 1]);
        dump($blog);
    }
}
