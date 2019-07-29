<?php

namespace app\api\controller;

use app\api\model\Blog;
use think\Db;
use think\Request;

class Login
{

    public function login(Request $request)
    {
        $id = $request->get('id');
        $blog = Blog::getOne(['id' => $id], ['id', 'title', 'sort_id']);
        dump($blog);
    }
}
