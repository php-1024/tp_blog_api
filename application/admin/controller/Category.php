<?php

namespace app\admin\controller;

use app\admin\model\Sort;
use think\Request;
use think\Controller;

class Category extends Controller
{
    /**
     * 栏目分类列表
     * @param Request $request
     * @return \think\response\Json
     * @throws \think\exception\DbException
     */
    public function category_list(Request $request)
    {
        $category_list = Sort::getPaginate();
        return json(['code' => 200, 'message' => 'ok', 'data' => $category_list]);
    }
}
