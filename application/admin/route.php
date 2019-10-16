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
        // 登录
        Route::any('login', 'admin/Login/login');
        // 登录
        Route::any('logout', 'admin/Login/logout');
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
            // 系统设置
            Route::any('save_config', 'admin/System/save_config');
            // 访客记录
            Route::any('view_log', 'admin/System/view_log');
        });

        // 栏目管理
        Route::group('category', function () {
            // 栏目分类列表
            Route::any('category_list', 'admin/Category/category_list');
            // 添加栏目
            Route::any('category_add', 'admin/Category/category_add');
            // 编辑栏目
            Route::any('category_edit', 'admin/Category/category_edit');
            // 首页导航栏列表
            Route::any('navbar_list', 'admin/Category/navbar_list');
        });

        // 文章管理
        Route::group('article', function () {
            // 文章列表
            Route::any('article_list', 'admin/Article/article_list');
        });
    });
}, ['after_behavior' => '\app\admin\middleware\AdminCheck']);
