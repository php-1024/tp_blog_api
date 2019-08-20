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

Route::bind('iszmxw'); // 绑定到api模块下

Route::group('iszmxw', function () {
    // 追梦小窝专用测试路由
    Route::any('export_excel', 'ExportExcel/export_excel');
    // 查看IP地址
    Route::any('ip_address', 'Tools/ip_address');
});
