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

Route::group('api', function () {
    // 追梦小窝专用测试路由
    Route::group('iszmxw', function () {
        Route::any('login', 'api/Iszmxw/login');
        Route::any('create', 'api/Iszmxw/create');
        Route::any('delete', 'api/Iszmxw/delete');
        Route::any('edit', 'api/Iszmxw/edit');
    }, ['after_behavior' => 'UserCheck']);

    Route::group('user', function () {
        Route::any('login', 'api/Login/login');
    });
});
