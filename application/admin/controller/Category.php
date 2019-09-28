<?php

namespace app\admin\controller;

use app\admin\model\Blog;
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
        foreach ($category_list['data'] as $key => $val) {
            $category_list['data'][$key]['article_num'] = Blog::getCount(['sort_id' => $val['id']], 'id');
        }
        return json(['code' => 200, 'message' => 'ok', 'data' => $category_list]);
    }
}
