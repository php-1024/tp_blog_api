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

Route::bind('api'); // 绑定到api模块下
Route::group('api', function () {
    // 追梦小窝专用测试路由
    Route::group('iszmxw', function () {
        Route::any('login', 'Iszmxw/login');
        Route::any('create', 'Iszmxw/create');
        Route::any('delete', 'Iszmxw/delete');
        Route::any('edit', 'Iszmxw/edit');
    }, ['after_behavior' => '\app\api\behavior\UserCheck']);

    Route::group('user', function () {
        Route::any('login', 'Login/login');
    });
});
