<?php
namespace SvnPQA\controller;
use function Lite\func\array_merge_recursive_distinct;
use function Lite\func\dump;
use function Lite\func\glob_recursive;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2015/12/7
 * Time: 21:52
 */

class CodeStoreController extends BaseController{
    public function index(){
        $path = 'd:/www/chinaerp/trunk/litephp/';
        $root_tag = 'root/';
        $files = glob_recursive($path . '*', GLOB_ONLYDIR);

        foreach ($files as $k => $f) {
            $f = str_replace('\\', '/', $f);
            $f = str_ireplace($path, '', $f);
            $f = $root_tag . $f;
            $files[$k] = self::convert_path_to_array($f, true);
        }
        $tree_list = array();
        foreach ($files as $dir) {
            $tree_list = array_merge_recursive_distinct($tree_list, $dir);
        }
        $tree_list = self::patch_path($tree_list, '');

        $default_file_list = array();
        $tmp = glob($path.'*');
        foreach($tmp as $k=>$f){
            $f = str_replace('\\', '/', $f);
            $f = str_ireplace($path, '', $f);
            $default_file_list[] = array(
                'name' => $f,
                'type' => ''
            );
        }

        return array(
            'tree_list' => $tree_list,
            'default_file_list' => $default_file_list
        );
    }

    private static function patch_path($tree, $parent_key){
        if (is_array($tree)) {
            $delimiter = '/';
            $ret = array();
            foreach ($tree as $k => $list) {
                if (is_array($list)) {
                    $list = self::patch_path($list, $parent_key ? $parent_key . $delimiter . $k : $k);
                }
                $key = $parent_key . $delimiter . $k;
                $ret[$key] = $list;
            }
            return $ret;
        } else {
            return $tree;
        }
    }

    /**
     * convert path to array
     * @param $path
     * @param array $bind_data
     * @param string $delimiter
     * @return array
     */
    private static function convert_path_to_array($path, $bind_data = array(), $delimiter = '/') {
        $ps = explode($delimiter, $path);
        $ret = array();
        $k = array_shift($ps);
        if (count($ps) > 1) {
            $ret[$k] = self::convert_path_to_array(join($delimiter, $ps), $bind_data, $delimiter);
        } else {
            $ret[$k][$ps[0]] = $bind_data;
        }
        return $ret;
    }
}