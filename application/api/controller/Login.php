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
        $title = Blog::getValue(['id' => $id],'title');
        $blog = Blog::getOne(['id' => $id]);
        $list = Blog::getList();
        dump($title);
        dump($blog);
        dump($list);
    }
}
