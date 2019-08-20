<?php

namespace app\iszmxw\controller;

use app\api\model\Blog;
use app\iszmxw\model\Area;
use app\iszmxw\model\City;
use app\iszmxw\model\Facility;
use app\iszmxw\model\Province;
use app\iszmxw\model\ShopSet;
use think\Db;
use think\Log;
use think\Request;
use think\Controller;

class Tools extends Controller
{
    public function ip_address()
    {
        $ip2region = new \Ip2Region();
        $ip_data = file_get_contents("ip.txt");
        $ip_data = explode("\n", $ip_data);
        $array = [];
        foreach ($ip_data as $key => $val) {
            $array[] = explode(" = ", $val);
        }
        foreach ($array as $key => $val) {
            $info = $ip2region->btreeSearch($val[0]);
            echo "IP地址：{$val[0]} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;尝试登陆了{$val[1]}次，检测到真实地址为{$info['region']}<br>";
        }
    }
}
