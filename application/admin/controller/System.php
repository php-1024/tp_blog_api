<?php

namespace app\admin\controller;

use app\admin\model\Options;
use think\Db;
use think\Log;
use think\Request;
use think\Controller;

class System extends Controller
{
    /**
     * 系统设置
     * @param Request $request
     * @return \think\response\Json
     */
    public function config(Request $request)
    {
        $admin_data = $request->__get('admin_data');
        $site_title = Options::getOption('site_title');
        $site_description = Options::getOption('site_description');
        $site_url = Options::getOption('site_url');
        $icp = Options::getOption('icp');
        $footer_info = Options::getOption('footer_info');
        return json(['code' => 200, 'message' => 'ok', 'data' => [
            'site_title' => $site_title,
            'site_description' => $site_description,
            'site_url' => $site_url,
            'icp' => $icp,
            'footer_info' => $footer_info,
        ]]);
    }
}
