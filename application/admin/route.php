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


Route::group('admin', function () {
    Route::group('api', function () {
        // 追梦小窝专用测试路由
        Route::any('login', 'admin/Login/login');
        // 获取登录用户信息
        Route::any('info', 'admin/Login/info');

        // 系统首页
        Route::group('dashboard', function () {
            Route::any('index', 'admin/Dashboard/index');
        });

        // 系统管理
        Route::group('system', function () {
            // 系统设置
            Route::any('config', 'admin/System/config');
        });
    });
}, ['after_behavior' => '\app\admin\middleware\AdminCheck']);
