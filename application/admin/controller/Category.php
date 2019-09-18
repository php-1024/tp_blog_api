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
     * @throws \think\exception\DbException
     */
    public function category_list(Request $request)
    {
        $category_list = Sort::field('sort.*,count(blog.sort_id) count')->join('blog', 'blog.sort_id = sort.id', 'LEFT')->where([])->group('sort.id')->paginate(10)->toArray();
        return json(['code' => 200, 'message' => 'ok', 'data' => $category_list]);
    }
}
