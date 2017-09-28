<?php
/**
 * Created by PhpStorm.
 * User: chengyang
 * Date: 2017/6/1
 * Time: 下午2:07
 */

namespace app\common\model;


use think\Model;

class ArticleCategory extends Model
{

    public function getLayeredCategory()
    {
        $list = $this->select();
    }

    public function getCategoryTree()
    {
        $list = $this->select();
        $tree = list_to_tree($list);
        return $tree;
    }

}