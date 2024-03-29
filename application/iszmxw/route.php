<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

use think\Route;


Route::group('iszmxw', function () {
    // 追梦小窝专用测试路由
    Route::any('export_excel', 'iszmxw/ExportExcel/export_excel');
    // json转换为excel
    Route::any('json_excel', 'iszmxw/ExportExcel/json_excel');
    // 查看IP地址
    Route::any('ip_address', 'iszmxw/Login/ip_address');
});
