<?php

namespace app\admin\validate;

use think\Validate;

class Category extends Validate
{
    // 验证规则
    protected $rule = [
        'name'        => 'require',
        'description' => 'require',
        'alias'       => 'require',
    ];

    // 返回错误消息
    protected $message = [
        'name.require'        => '请输入栏目名称',
        'description.require' => '请输入描述一下该栏目',
        'alias.require'       => '请输入栏目别名',
    ];

    // 验证场景
    protected $scene = [
        'add'  => ['name', 'description', 'alias'],
        'edit' => ['name', 'description', 'alias'],
    ];
}
