<?php

namespace app\admin\validate;

use think\Validate;

class Navbar extends Validate
{
    // 验证规则
    protected $rule = [
        'pid'         => 'require',
        'type'        => 'require',
        'navbar_name' => 'require',
    ];

    // 返回错误消息
    protected $message = [
        'pid.require'         => '请设置导航栏的层级',
        'type.require'        => '请选择导航栏类型',
        'navbar_name.require' => '请输入导航栏名称',
    ];

    // 验证场景
    protected $scene = [
        'add'  => ['pid', 'type', 'navbar_name'],
        'edit' => ['pid', 'type', 'navbar_name'],
    ];
}
