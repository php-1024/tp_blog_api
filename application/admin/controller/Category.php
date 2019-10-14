<?php

namespace app\admin\controller;

use app\admin\model\Blog;
use app\admin\model\Sort;
use think\Db;
use think\Request;
use think\Controller;

class Category extends Controller
{

    /**
     * 栏目分类列表
     * @param Request $request
     * @return \think\response\Json
     * @author：iszmxw <mail@54zm.com>
     * @time：2019/10/14 20:26
     */
    public function category_list(Request $request)
    {
        $category_list = Sort::getPaginate();
        foreach ($category_list['data'] as $key => $val) {
            $category_list['data'][$key]['article_num'] = Blog::getCount(['sort_id' => $val['id']], 'id');
        }
        return json(['code' => 200, 'message' => 'ok', 'data' => $category_list]);
    }


    /**
     * 添加栏目
     * @param Request $request
     * @return \think\response\Json
     * @author：iszmxw <mail@54zm.com>
     * @time：2019/10/14 20:34
     */
    public function category_add(Request $request)
    {
        $data = $request->param();
        if (empty($data['name'])) {
            return json(['code' => 500, 'message' => '请输入栏目名称']);
        }
        if (empty($data['description'])) {
            return json(['code' => 500, 'message' => '请输入描述一下该栏目']);
        }
        if (empty($data['alias'])) {
            return json(['code' => 500, 'message' => '请输入栏目别名']);
        }
        Db::startTrans();
        try {
            Sort::AddData($data);
            Db::commit();
            return json(['code' => 200, 'message' => '添加栏目成功！']);
        } catch (\Exception $e) {
            Db::rollback();
            return json(['code' => 500, 'message' => '添加栏目失败，请稍后再试！']);
        }
    }
}
