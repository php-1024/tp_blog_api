<?php

namespace app\api\model;

use think\Model;
use traits\model\SoftDelete;

class Base extends Model
{
    use SoftDelete;
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;

    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    protected $deleteTime = 'deleted_at';


    // 获取单字段数据
    public static function getValue($where, $value)
    {
        return self::where($where)->value($value);
    }

    // 获取单组数据
    public static function getOne($where = [], $field = [], $orderby = "id", $sort = 'DESC')
    {
        // 默认获取全部字段
        if (empty($field)) {
            $field = "*";
        }
        $res = self::where($where)->order($orderby, $sort)->get($field);
        if (!empty($res)) {
            return $res;
        } else {
            return false;
        }
    }

}
