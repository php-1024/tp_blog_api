<?php

namespace app\admin\controller;

use app\api\model\Blog;
use think\Db;
use think\Log;
use think\Request;
use think\Controller;

class Login extends Controller
{
    public function login(Request $request)
    {
        $id = $request->get('id');
        $title = Blog::getValue(['id' => $id], 'title');
        $blog = Blog::getOne(['id' => $id]);
        $list = Blog::getList();
        $paginate = Blog::getPaginate([], [], 12, 'id', 'ASC');
        if (empty($id)) {
            dump("缺少查询的id");
        } else {
            dump($title);
            dump($blog);
        }
        dump($paginate);
    }
}
