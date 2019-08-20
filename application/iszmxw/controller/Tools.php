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
        $ip_data = file_get_contents("ip.txt");
        $ip_data = explode("\n", $ip_data);
        $array = [];
        foreach ($ip_data as $key => $val) {
            $array[] = explode(" = ", $val);
        }
        dump($array);
    }
}
