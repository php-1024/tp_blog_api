<?php

namespace app\admin\controller;

use app\admin\model\Blog;
use app\admin\model\Comment;
use app\admin\model\LoginLog;
use app\admin\model\Twitter;
use think\Db;
use think\Log;
use think\Request;
use think\Controller;

class Dashboard extends Controller
{
    /**
     * 首页信息
     * @param Request $request
     * @return \think\response\Json
     * @author：iszmxw <mail@54zm.com>
     * @time：2019/10/14 21:00
     */
    public function index(Request $request)
    {
        $login_log = LoginLog::getPaginate([], [], 10, 'id', 'DESC');
        $blog_num = Blog::getCount([], 'id');
        $comment_num = Comment::getCount([], 'id');
        $twitter_num = Twitter::getCount([], 'id');
        return json(['code' => 200, 'message' => 'ok', 'data' => [
            'blog_num' => $blog_num,
            'comment_num' => $comment_num,
            'twitter_num' => $twitter_num,
            'system' => PHP_OS_FAMILY,
            'php' => PHP_VERSION,
            'serve' => $_SERVER ['SERVER_SOFTWARE'],
            'serve_name' => $_SERVER['SERVER_NAME'],
            'tp_version' => THINK_VERSION,
            'login_log' => $login_log,
        ]]);
    }
}
