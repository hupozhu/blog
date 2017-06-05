<?php
/**
 * Created by PhpStorm.
 * User: chengyang
 * Date: 2017/6/2
 * Time: 下午3:09
 */

namespace app\common\model;


use think\Model;

class Article extends Model
{
    public function category()
    {
        return $this->hasOne('ArticleCategory','id','category_id');
    }

}