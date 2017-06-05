<?php
/**
 * Created by PhpStorm.
 * User: chengyang
 * Date: 2017/5/26
 * Time: 下午5:26
 */

namespace app\admin\controller;

use app\common\model\Admin;
use think\Controller;

/**
 * 登录管理
 */
class Login extends Controller
{
    /**
     * 登录页面
     */
    public function login()
    {
        if (request()->isPost()) {
            //如果是来自ajax的提交，直接验证帐号密码

            $data = input('post.');
            $user_id = (new Admin())->login($data['username'], $data['password']);
            if ($user_id > 0) {
                /*记录session和cookie*/
                $group_id = Admin::where('id', $user_id)->value('group_id');

                $auth = [
                    'user_id' => $user_id,
                    'group_id' => $group_id,
                    'username' => $data['username'],
                    'last_login_time' => date("Y-m-d H:i:s"),
                ];
                session('blog_user_auth', $auth);
                session('blog_user_auth_sign', data_auth_sign($auth));
                return json(['status' => 1, 'msg' => '登录成功！']);
            } else {
                switch ($user_id) {
                    case -1:
                        $info = ['status' => 0, 'msg' => '用户不存在或被禁用'];
                        break;
                    case -2:
                        $info = ['status' => 0, 'msg' => '密码错误'];
                        break;
                    default:
                        $info = ['status' => 0, 'msg' => '未知错误'];
                        break;
                }
                return json($info);
            }
        } else {
            //如果是get请求登录页面，则返回登录view

            // 检测登录状态
            if (session('blog_user_auth') && session('blog_user_auth_sign')) {
                $this->redirect('main/index');
            }
            return view();
        }
    }

    public function logout()
    {
        session(null);
        $this->redirect('main/index');
    }

}