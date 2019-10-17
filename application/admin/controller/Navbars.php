<?php

namespace app\admin\controller;

use app\admin\model\Blog;
use app\admin\model\Navbar;
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
        $navbar_list = Navbar::getList([], [], 0, 'id', 'DESC');
        return json(['code' => 200, 'message' => 'ok', 'data' => $navbar_list]);
    }

}
