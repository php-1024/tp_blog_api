<?php

namespace app\admin\controller;

use app\admin\model\Blog;
use app\admin\model\Sort;
use think\Request;
use think\Controller;

class Article extends Controller
{
    /**
     * 文章列表
     * @param Request $request
     * @return \think\response\Json
     */
    public function article_list(Request $request)
    {
        $article_list = Blog::getPaginate([], ['id', 'sort_id', 'title', 'views', 'created_at'], 10, 'id', 'DESC');
        foreach ($article_list['data'] as $key => $val) {
            $article_list['data'][$key]['category_name'] = Sort::getValue(['id' => $val['sort_id']], 'name');
        }
        return json(['code' => 200, 'message' => 'ok', 'data' => $article_list]);
    }
}
