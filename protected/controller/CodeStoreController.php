<?php
namespace SvnPQA\controller;
use function Lite\func\array_last;
use function Lite\func\array_merge_recursive_distinct;
use function Lite\func\dump;
use function Lite\func\format_size;
use function Lite\func\get_folder_size;
use function Lite\func\glob_recursive;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2015/12/7
 * Time: 21:52
 */

class CodeStoreController extends BaseController{
    private static $path = 'd:/www/SvnPQA';

    public function index($get){
        $root_tag = 'root';
        $files = glob_recursive(self::$path.'/*', GLOB_ONLYDIR);

        foreach ($files as $k => $f) {
            $f = str_replace('\\', '/', $f);
            $f = str_ireplace(self::$path, '', $f);
            $f = $root_tag . $f;
            $files[$k] = self::convert_path_to_array($f, true);
        }
        $tree_list = array();
        foreach ($files as $dir) {
            $tree_list = array_merge_recursive_distinct($tree_list, $dir);
        }
        $tree_list = self::patch_path($tree_list, '');

        return array(
            'tree_list' => $tree_list,
        );
    }

    public function fileList($get){
        $p = self::$path.$get['p'];
        $default_file_list = array();

        if($get['p'] != '/' && $get['p']){
            $default_file_list[] = array(
                'uri' => preg_replace('/\/[^\/]+$/','',$get['p']),
                'name' => '[parent]',
                'css_class' => self::getTypeCssClass(null, true),
                'is_folder' => true,
                'size' => ''
            );
        }

        $tmp = glob($p.'/*');
        foreach($tmp as $k=>$f){
            $is_dir = is_dir($f);
            $size = format_size(!$is_dir ? filesize($f) : get_folder_size($f));
            $f = str_replace('\\', '/', $f);

            $default_file_list[] = array(
                'uri' => str_replace(self::$path, '', $f),
                'name' => array_last(explode('/',$f)),
                'css_class' => self::getTypeCssClass($f, $is_dir),
                'is_folder' => $is_dir,
                'size' => $size
            );
        }

        return array(
            'list' => $default_file_list
        );
    }

    public function fileInfo($get){
        $uri = $get['f'];
        $f = self::$path.$get['f'];
        if(!is_file($f)){
            return array();
        }

        $current_file_info = file_get_contents($f);
        $type = array_last(explode('.', $f));
        $name = basename($f);

        return array(
            'uri' => $uri,
            'type' => $type,
            'name' => $name,
            'content' => $current_file_info,
            'comments' => self::getComments($uri)
        );
    }

    private static function getComments($uri, $repo=''){
        $cmt = array(
            'author' => 'moon',
            'time' => mktime(),
            'content' => 'test comment',
            'state' => 'xxasdfasd'
        );

        return array(
            1 => array($cmt, $cmt),
            10 => array($cmt)
        );
    }

    private static function getTypeCssClass($file, $is_dir=false){
        if($is_dir){
            return 'fa fa-folder-o';
        }
        $ext = array_pop(explode('.',$file));
        $map = array(
            'text' => array('txt', 'md', 'yaml'),
            'code' => array('php','js','html','css','py'),
            'image' => array('jpg','png','jpeg','gif','bmp'),
            'sound' => array('mp3', 'wav'),
            'word' => array('doc','docx'),
            'pdf' => array('pdf'),
            'excel' => array('xls', 'xlsx'),
            'powerpoint' => array('ppt','pptx'),
            'zip' => array('zip','rar','7z','gz','tar'),
        );

        foreach($map as $t=>$l){
            if(in_array($ext, $l)){
                return 'fa fa-file-'.$t.'-o';
            }
        }
        return 'fa fa-file-o';
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