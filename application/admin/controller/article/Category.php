<?php
/**
 * Created by PhpStorm.
 * User: chengyang
 * Date: 2017/6/1
 * Time: 上午10:51
 */

namespace app\admin\controller\article;


use app\admin\controller\BaseController;
use app\common\model\ArticleCategory;

class Category extends BaseController
{

    public function index()
    {
        $data = ArticleCategory::all();
        if ($data) {
            $this->assign('categorylist', $data);
        } else {
            $this->assign('categorylist', null);
        }
        return view();
    }

    //增加分类
    public function add()
    {
        if (request()->isPost()) {
            $data = input('post.');
            $data['status'] = input('?post.status') ? $data['status'] : 0;

            $parentInfo = input('post.pid_and_layered_name') . '';
            $parent = explode('&', $parentInfo);

            if (count($parent) > 1) {//有层级信息
                $data['pid'] = $parent[0];
                $data['layered_name'] = $parent[1] . ' > ' . $data['name'];
            } else {//没有层级信息
                $data['pid'] = 0;
                $data['layered_name'] = $data['name'];
            }
            unset($data['pid_and_layered_name']);

            if (input('post.id')) {
                $result = ArticleCategory::update($data);
            } else {
                $result = ArticleCategory::create($data);
            }

            if ($result) {
                $this->success("保存成功", cookie("prevUrl"));
            } else {
                $this->error('保存失败', cookie("prevUrl"));
            }
        } else {
            $id = input('param.id');
            if ($id) {
                $category = ArticleCategory::find($id);
                $this->assign('category', $category);
            }
            //获取已经有的分类信息
            $parentCategory = ArticleCategory::all();
            $this->assign("parentcategory", $parentCategory);
            return view();
        }
    }

}