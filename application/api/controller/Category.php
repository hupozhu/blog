<?php
/**
 * Created by PhpStorm.
 * User: chengyang
 * Date: 2017/9/27
 * Time: 下午4:04
 */

namespace app\api\controller;


class Category extends ApiCommon
{

    public function getAllTags()
    {
        $data = model('ArticleCategory')->getCategoryTree();
        return resultArray(['data' => $data]);
    }

}