<?php
namespace app\api\controller;

/**
 * Created by PhpStorm.
 * User: chengyang
 * Date: 2017/9/14
 * Time: 下午4:27
 */
class Article extends ApiCommon
{
    public function index()
    {
        echo 111;
    }

    public function getallarticles()
    {
        $param = $this->param;
        $limit = $param['limit'];
        $page = $param['page'];
        $article = model('Article');
        $data = $article->getDateList($page, $limit);
        return resultArray(['data' => $data]);
    }

    public function getCountByMonth(){
        $data = model('Article')->getArticleCountByMonth();
        return resultArray(['data' => $data]);
    }
}