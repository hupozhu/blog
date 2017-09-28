<?php
/**
 * Created by PhpStorm.
 * User: chengyang
 * Date: 2017/9/28
 * Time: 下午9:53
 */

namespace app\api\controller;


class Index extends ApiCommon
{

    public function getQuickNav()
    {
        //获取按月分类的文章总数
        $article_count_by_month = model('Article')->getArticleCountByMonth();

        $category_tree = model('ArticleCategory')->getCategoryTree();

        $data = [
            'article_count_by_month' => $article_count_by_month,
            'category_tree' => $category_tree
        ];

        return resultArray(['data' => $data]);
    }

}