<?php

namespace app\api\controller;

use app\api\model\Blog;
use think\Db;
use think\Request;

class Iszmxw
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

    public function create(Request $request)
    {
        Db::startTrans();
        try {
            Blog::AddData([
                'sort_id' => 1,
                'title' => "我是标题",
                'content' => "我是文章内容",
                'excerpt' => "摘录",
                'alias' => "别名"
            ]);
            Db::commit();
        } catch (\Exception $e) {
            dump($e);
            Db::rollback();
        }
        return "添加数据成功";
    }


    public function edit(Request $request)
    {
        Db::startTrans();
        try {
            Blog::EditData([
                'sort_id' => 1
            ], [
                'title' => "我修改了标题",
                'content' => "修改了文章内容",
                'excerpt' => "编辑摘录",
                'alias' => "编辑别名"
            ]);
            Db::commit();
        } catch (\Exception $e) {
            dump($e);
            Db::rollback();
            return "修改数据失败";
        }
        return "添加数据成功";
    }
}
