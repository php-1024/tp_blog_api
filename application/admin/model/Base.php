<?php

namespace app\admin\model;

use think\Model;
use traits\model\SoftDelete;

class Base extends Model
{
    use SoftDelete;
    // 开启自动写入时间戳字段
    protected $autoWriteTimestamp = true;

    protected $resultSetType = 'collection';

    // 定义时间戳字段名
    protected $createTime = 'created_at';
    protected $updateTime = 'updated_at';
    public $deleteTime = 'deleted_at';


    // 获取单字段数据
    public static function getValue($where, $value)
    {
        return self::where($where)->value($value);
    }

    // 计算总数
    public static function getCount($where, $value)
    {
        return self::where($where)->count($value);
    }

    // 获取单组数据
    public static function getOne($where = [], $field = [], $orderby = "id", $sort = 'DESC')
    {
        // 默认获取全部字段
        if (empty($field)) {
            $field = [];
        }
        $res = self::where($where)->order($orderby, $sort)->field($field)->find();
        if (!empty($res)) {
            return $res->toArray();
        } else {
            return false;
        }
    }

    //获取列表数据
    public static function getList($where = [], $field = [], $limit = 0, $orderby = "", $sort = 'DESC')
    {
        if (empty($field)) {
            $field = '*';
        }
        $model = self::field($field);
        if (!empty($where)) {
            $model = $model->where($where);
        }
        if (!empty($orderby)) {
            $model = $model->order($orderby, $sort);
        }
        if (!empty($limit)) {
            $model = $model->limit($limit);
        }
        $res = $model->select();

        if (!empty($res)) {
            return $res->toArray();
        } else {
            return false;
        }
    }

    //分页获取数据
    public static function getPaginate($where = [], $field = [], $paginate = 10, $orderby = "id", $sort = "DESC")
    {
        if (empty($field)) {
            $field = '*';
        }
        $model = self::field($field);
        if (!empty($where)) {
            $model = $model->where($where);
        }
        if (!empty($orderby)) {
            $model = $model->order($orderby, $sort);
        }
        if (!empty($paginate)) {
            // 默认分页
            $res = $model->paginate($paginate);
        }
        if (!empty($res)) {
            return $res->toArray();
        } else {
            return false;
        }
    }

    // 添加数据
    public static function AddData($data = [], $where = [])
    {
        if (!empty($where)) {
            $res = self::where($where)->find();
            if (empty($res)) {
                $res = self::create($data);
            }
        } else {
            $res = self::create($data);
        }

        if (!empty($res)) {
            return $res->toArray();
        } else {
            return false;
        }
    }


    // 编辑数据
    public static function EditData($where = [], $data = [])
    {
        $res = self::update($data, $where);

        if (!empty($res)) {
            return self::getOne($where);
        } else {
            return false;
        }
    }

    //删除数据
    public static function selected_delete($where, $is_force = false)
    {
        $res = self::destroy($where, $is_force);
        if (!empty($res)) {
            return true;
        } else {
            return false;
        }
    }

}
