<?php

namespace app\admin\controller;

use app\admin\model\Blog;
use app\admin\model\Comment;
use app\admin\model\LoginLog;
use app\admin\model\Sort;
use app\admin\model\Twitter;
use think\Db;
use think\Log;
use think\Request;
use think\Controller;

class Category extends Controller
{
    /**
     * 栏目分类列表
     * @param Request $request
     * @return \think\response\Json
     */
    public function category_list(Request $request)
    {
        $category_list = Sort::getPaginate();
        return json(['code' => 200, 'message' => 'ok', 'data' => $category_list]);
    }
}
