<?php
namespace app\admin\controller\article;

use app\admin\controller\BaseController;
use app\common\model\Article;
use app\common\model\ArticleCategory;

/**
 * Created by PhpStorm.
 * User: chengyang
 * Date: 2017/5/31
 * Time: 下午2:14
 */
class Editor extends BaseController
{

    public function index()
    {
        $articlelist = Article::with('category')->order('id desc')->paginate();
        $this->assign('articlelist', $articlelist);
        return view();
    }

    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $data['status'] = input('?post.status') ? $data['status'] : 0;

            $category_info_str = strval($data['category_info']);
            $category_info = explode(',', $category_info_str);

            if ($category_info && count($category_info) > 1) {
                $data['category_id'] = $category_info[0];
                $data['layered_name'] = $category_info[1];
            }
            unset($data['category_info']);

            //如果文章id存在，则为修改文章
            $resultCate = 1;
            if (input('post.id')) {
                $resultArticle = Article::update($data);
            } else {
                $resultArticle = Article::create($data);

                $cateId = $data['category_id'];
                //将article_category表里的count字段加1
                $resultCate = model('ArticleCategory')->where('id=' . $cateId)->setInc('count');
            }

            if ($resultArticle && $resultCate) {
                $this->success("保存成功", cookie("prevUrl"));
            } else {
                $this->error('保存失败', cookie("prevUrl"));
            }
        } else {
            $id = input('param.id');
            //如果有文章ID，则为修改文章
            if ($id) {
                $article = model('app\common\model\Article');
                $articleData = $article->getArticleById($id);
                $this->assign('article', $articleData);
            }
            //如果不是修改文章，则获取文章分类
            $data = ArticleCategory::all();
            if ($data) {
                $this->assign('category', $data);
            } else {
                $this->assign('category', null);
            }
            return view();
        }
    }

}