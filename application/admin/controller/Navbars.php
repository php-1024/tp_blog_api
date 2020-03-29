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


    /**
     * 网站导航栏排序
     * @param Request $request
     * @return \think\response\Json
     * @author：iszmxw <mail@54zm.com>
     * @time：2019/10/18 22:15
     */
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


    /**
     * 添加导航栏
     * @param Request $request
     * @return \think\response\Json
     * @author：iszmxw <mail@54zm.com>
     * @time：2019/10/27 21:23
     */
    public function navbar_add(Request $request)
    {
        $data   = $request->param();
        $domain = $request->domain();
        $result = $this->validate($data, 'Navbar');
        if (true !== $result) {
            // 验证失败 输出错误信息
            return json(['code' => 500, 'message' => $result]);
        }
        if ($data['type'] === 1 && empty($data['type_id'])) {
            return json(['code' => 500, 'message' => '请选择要设置为导航的栏目地址']);
        }
        if ($data['type'] === 2 && empty($data['url'])) {
            return json(['code' => 500, 'message' => '请输入导航栏地址']);
        }
        // 添加系统导航栏目
        if ($data['type'] === 1 && isset($data['type_id'])) {
            $data['url'] = $domain . "/category/" . $data['type_id'];
        }
        // 添加网址导航
        if ($data['type'] === 2 && isset($data['url'])) {
            $data['type_id'] = 0;
        }
        // 添加事物包裹进行添加数据
        Db::startTrans();
        try {
            Navbar::AddData($data);
            Db::commit();
            return json(['code' => 200, 'message' => '添加成功！']);
        } catch (\Exception $e) {
            Db::rollback();
            return json(['code' => 500, 'message' => '添加失败，请稍后再试！']);
        }
    }


    /**
     * 删除导航栏
     * @param Request $request
     * @return \think\response\Json
     * @author：iszmxw <mail@54zm.com>
     * @time：2019/10/27 21:33
     */
    public function navbar_delete(Request $request)
    {
        $data = $request->param();
        Db::startTrans();
        try {
            Navbar::selected_delete($data);
            Db::commit();
            return json(['code' => 200, 'message' => '删除导航栏成功！']);
        } catch (\Exception $e) {
            Db::rollback();
            return json(['code' => 500, 'message' => '删除导航栏失败，请稍后再试！']);
        }
    }


    public function navbar_edit(Request $request)
    {

    }

}
