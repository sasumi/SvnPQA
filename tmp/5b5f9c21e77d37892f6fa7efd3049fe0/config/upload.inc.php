<?php
/**
 * Created by PhpStorm.
 * User: Sasumi
 * Date: 2015/11/2
 * Time: 11:37
 */
use Lite\Core\Config;
use function Lite\func\array_last;
use function Lite\func\dump;

return array(
	'path' => Config::get('app/root').'public/upload/',
	'url' => Config::get('app/url').'upload/',
	'file_name_converter' => function($file_name){
		$ext = array_last(explode('.',$file_name));
		return md5($file_name).'.'.$ext;
	},
	'max_size' => 5e10,
	'file_type' => 'jpg,png,jpeg,doc,txt,pdf',
);