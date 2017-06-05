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

            //如果文章id存在，则为修改文章
            if (input('post.id')) {
                $result = Article::update($data);
            } else {
                $result = Article::create($data);
            }

            if ($result) {
                $this->success("保存成功", cookie("prevUrl"));
            } else {
                $this->error('保存失败', cookie("prevUrl"));
            }
        } else {
            $id = input('param.id');
            //如果有文章ID，则为修改文章
            if ($id) {
                $article = Article::find($id);
                $this->assign('article', $article);
            }
            //如果不是修改文章，则获取文章分类
            $data = ArticleCategory::all();
            if ($data) {
                $categorylist = $data;
                $tree = list_to_tree($categorylist, 'id', 'pid', 'sub');
                $this->assign('category', $tree);
            } else {
                $this->assign('category', null);
            }
            return view();
        }
    }

}