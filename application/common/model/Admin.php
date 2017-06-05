<?php

/**
 * Created by PhpStorm.
 * User: chengyang
 * Date: 2017/5/27
 * Time: 上午11:49
 */
namespace app\common\model;

use think\Model;

class Admin extends Model
{

    public function login($username, $password)
    {
        $user = $this->get(['username' => $username]);
        if ($user) {
            if (md5($password) == $user->getAttr('password')) {
                //登录成功更新用户信息
                $this->updateLoginInfo($user->getAttr('id'));
                return $user->getAttr('id');
            } else {
                return -2; //密码错误；
            }
        } else {
            return -1;//用户不存在
        }
    }

    public function updateLoginInfo($user_id)
    {
        $data = array(
            'last_login_time' => date("Y-m-d H:i:s"),
            'last_login_ip' => request()->ip(),
        );
        Admin::where('id', $user_id)->update($data);
    }

}