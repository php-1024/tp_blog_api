<?php

namespace app\admin\model;

class Options extends Base
{
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = false;

    protected $createTime = false;
    protected $updateTime = false;
    public $deleteTime = false;

    // 获取单字段数据
    public static function getOption($option_name)
    {
        return self::where(['option_name' => $option_name])->value('option_value');
    }
}
