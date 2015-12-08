<?php
//todo 这里的系统入口判断的是单个的权限，并不是整个系统的，因此会出现：如果入口没有权限， 那么系统入口的权限也就没有了。
use function Lite\func\h;
use SvnPQA\Model\Access;
use SvnPQA\ViewBase;

$login_user = array(
	'id'=>'xx',
	'name' => 'Administrator',
	'department_path' => array()
);
?>
