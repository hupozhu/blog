<?php
namespace app\admin\controller;

use think\Controller;

/**
 * base
 * User: chengyang
 * Date: 2017/5/26
 * Time: 下午5:21
 */
class BaseController extends Controller
{

    public function _initialize()
    {
        //判断是否登录
        if (!session('blog_user_auth') || !session('blog_user_auth_sign')) {
            $this->redirect('login/login');
        }

        //现实后台主页
        if ($this->request->isPjax()) {
            $this->view->engine->layout(false);
        } else {
            $this->view->engine->layout(true);
        }
    }

}