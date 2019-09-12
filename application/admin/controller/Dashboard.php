<?php

namespace app\admin\controller;

use app\admin\model\Blog;
use app\admin\model\Comment;
use app\admin\model\LoginLog;
use app\admin\model\Twitter;
use app\admin\model\User;
use app\common\Tooling;
use think\Cache;
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
     */
    public function index(Request $request)
    {
        $admin_data = $request->__get('admin_data');
        $login_log = LoginLog::getList([], [], 10, 'id', 'DESC');
        $blog_num = Blog::getCount([], 'id');
        $comment_num = Comment::getCount([], 'id');
        $twitter_num = Twitter::getCount([], 'id');
        return json(['code' => 200, 'message' => 'ok', 'data' => [
            'login_log' => $login_log,
            'blog_num' => $blog_num,
            'comment_num' => $comment_num,
            'twitter_num' => $twitter_num,
        ]]);
    }
}
