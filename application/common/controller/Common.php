<?php

namespace app\common\controller;


use think\Controller;
use think\Request;

/**
 * Created by PhpStorm.
 * User: chengyang
 * Date: 2017/9/27
 * Time: 下午4:09
 */
class Common extends Controller
{

    public $param;

    public function _initialize()
    {
        parent::_initialize();

        /*防止跨域*/
        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Headers: Origin, X-Requested-With, Content-Type, Accept");
        header('Access-Control-Allow-Methods: GET, POST, PUT');

        $param = Request::instance()->param();
        $this->param = $param;
    }

}