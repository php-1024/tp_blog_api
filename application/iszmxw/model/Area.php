<?php

namespace app\iszmxw\model;

use think\Model;

class Area extends Model
{
    protected $resultSetType = 'collection';
    // 直接使用配置参数名
    protected $connection = 'db_config_10wanfen';
}
