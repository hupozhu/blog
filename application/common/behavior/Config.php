<?php
/**
 * Created by PhpStorm.
 * User: chengyang
 * Date: 2017/5/27
 * Time: 上午12:28
 */
namespace app\common\behavior;

class Config
{

    /**
     * 执行行为 run方法是Behavior唯一的接口
     */
    public function run(&$params)
    {
        $base_file = request()->baseFile();
        $base_dir = preg_replace(['/\/index.php$/', '/admin.php$/'], ['', ''], $base_file);
        defined('PUBLIC_PATH') or define('PUBLIC_PATH', '');
        // 视图输出字符串内容替换
        $view_replace_str = [
            // 静态资源目录
            '__PUBLIC__' => $base_dir . PUBLIC_PATH,
            '__STATIC__' => $base_dir . PUBLIC_PATH . '/static',
            // 文件上传目录
            '__UPLOADS__' => $base_dir . PUBLIC_PATH . '/uploads'
        ];
        config('view_replace_str', $view_replace_str);
    }

}