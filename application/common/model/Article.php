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
        return $this->hasOne('ArticleCategory', 'id', 'category_id');
    }

    public function getDateList($page = 1, $limit = 10)
    {
        return $this->page($page, $limit)->order('created_at', 'desc')->select();
    }

    public function getArticleById($id)
    {
        $data = $this->get($id);
        return $data;
    }

    public function getArticleCountByMonth()
    {
        $data = $this
            ->field('date_format(created_at, "%Y-%m") as create_date, count(date_format(created_at, "%Y-%m")) as count')
            ->group('date_format(created_at, "%Y-%m")')
            ->select();

        return $data;
    }

}