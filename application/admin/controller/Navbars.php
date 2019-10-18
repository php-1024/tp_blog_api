<?php

namespace app\admin\controller;

use app\admin\model\Blog;
use app\admin\model\Navbar;
use app\admin\model\Sort;
use think\Db;
use think\Request;
use think\Controller;

class Navbars extends Controller
{


    /**
     * 网站导航栏列表
     * @param Request $request
     * @return \think\response\Json
     * @author：iszmxw <mail@54zm.com>
     * @time：2019/10/17 20:05
     */
    public function navbar_list(Request $request)
    {
        $navbar_list = Navbar::getList([], [], 0, 'sort', 'ASC');
        return json(['code' => 200, 'message' => 'ok', 'data' => $navbar_list]);
    }


    public function navbar_sort(Request $request)
    {
        $data = $request->param();
        Db::startTrans();
        try {
            foreach ($data as $key => $value) {
                Navbar::EditData(['id' => $value], ['sort' => $key]);
            }
            Db::commit();
            return json(['code' => 200, 'message' => '排序成功！']);
        } catch (\Exception $e) {
            Db::rollback();
            return json(['code' => 500, 'message' => '排序失败，请稍后再试！']);
        }
    }


    public function navbar_add(Request $request)
    {

    }


    public function navbar_delete(Request $request)
    {

    }


    public function navbar_edit(Request $request)
    {

    }

}
