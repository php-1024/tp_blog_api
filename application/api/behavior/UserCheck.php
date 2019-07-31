<?php

namespace app\api\behavior;

use think\Controller;

class UserCheck
{
    use \traits\controller\Jump;

    //类里面引入jump;类 可以使用跳转的一些方法 还有 success 、error
    public function run(&$params)
    {
        halt('测试HOOK');
    }
}