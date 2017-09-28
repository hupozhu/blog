<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
/**
 * 数据签名认证
 * @param  array $data 被认证的数据
 * @return string       签名
 * @author 清月曦 <1604583867@qq.com>
 */

// 应用公共文件
function data_auth_sign($data)
{
    //数据类型检测
    if (!is_array($data)) {
        $data = (array)$data;
    }
    ksort($data); //排序
    $code = http_build_query($data); //url编码并生成query字符串
    $sign = sha1($code); //生成签名
    return $sign;
}

function resultArray($array)
{
    if (isset($array['data'])) {
        $msg = '操作成功';
        $code = 200;
    } else {
        $msg = '操作失败';
        $array['data'] = '';
        $code = 400;
    }

    return json([
        'code' => $code,
        'data' => $array['data'],
        'msg' => $msg,
    ]);
}

//list_to_tree($categorylist, 'id', 'pid', 'sub');
function list_to_tree($list, $pk = 'id', $pid = 'pid', $child = '_child', $keys = 'name', $sort = 'asc', $root = 0)
{
    //创建Tree
    $tree = array();
    $dataArray = array();

    if (is_array($list)) {
        foreach ($list as $item) {
            //将对象变为数组
            $dataArray[] = $item->toArray();
        }

        //创建基于主键的数组引用
        $refer = array();
        foreach ($dataArray as $key => $data) {
            //初始化父目录的子节点
            $dataArray[$key][$child] = [];
            //refer是一个以id为索引的categoryModel列表
            $refer[$data[$pk]] = &$dataArray[$key];
        }

        foreach ($dataArray as $key => $data) {
            //判断该目录是否存在父级目录
            $parentId = $data[$pid];
            if ($root == $parentId) {//如果是一级目录，则将该节点加入到tree数组中
                $tree[] = &$dataArray[$key];
                $tree = my_sort($tree, $keys, $sort, SORT_NUMERIC);
            } else {//如果父目录存在
                if (isset ($refer [$parentId])) {
                    $parent = &$refer[$parentId];
                    $parent[$child][] = &$dataArray[$key];
                    $parent[$child] = my_sort($parent[$child], $keys, $sort, SORT_NUMERIC);
                }
            }
        }
    }
    return $tree;
}

function trim_category($list, $pk = 'id', $pid = 'pid', $child = '_child', $keys = 'name', $sort = 'asc', $root = 0)
{
    $category = array();
    $dataArray = array();

    if (is_array($list)) {
        $refer = array();
        foreach ($list as $item) {
            $dataArray[] = $item;
        }

        foreach ($dataArray as $value) {
            find_root($dataArray, $value, $pid, $keys);
        }
    }

    return $list;
}

function find_root($dataArray, $item, $pid = 'pid', $keys = 'name', $layeredName = 'layered_name')
{
    if (is_null($item[$layeredName])) {
        $item[$layeredName] = $item[$keys];
    } else {
        $item[$layeredName] = $item[$keys] . ' > ' . $item[$layeredName];
    }

    if ($item[$pid] > 0) {

    }
    return;
}

/**
 * 数组按字段排序
 * @param  $arrays  要排序的数组
 * @return SORT_ASC     - 默认，按升序排列。(A-Z)
 * @return SORT_DESC    - 按降序排列。(Z-A)
 * @return SORT_REGULAR - 默认。将每一项按常规顺序排列。
 * @return SORT_NUMERIC - 将每一项按数字顺序排列。
 * @return SORT_STRING  - 将每一项按字母顺序排列
 * @author 清月曦 <1604583867@qq.com>
 */
function my_sort($arrays, $sort_key, $sort_order = 'asc', $sort_type = SORT_NUMERIC)
{
    if ($sort_order == 'asc') $sort_order = SORT_ASC;
    if ($sort_order == 'desc') $sort_order = SORT_DESC;

    //首先排序数组需要是一个数组
    if (is_array($arrays)) {
        foreach ($arrays as $array) {
            $key_arrays[] = $array[$sort_key];
        }
    } else {
        return $arrays;
    }
    array_multisort($key_arrays, $sort_order, $sort_type, $arrays);
    return $arrays;
}