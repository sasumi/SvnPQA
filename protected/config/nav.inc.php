<?php
return array(
	array('首页', 'index'),
	array('代码仓库', 'CodeStore', array(
		'代码库' => array(
			array('代码库', 'CodeStore'),
			array('提交历史', 'CodeStore/history'),
		),
	)),
	array('统计分析', 'CodeStore', array(
		'开发统计' => array(
			array('开发统计', 'articlecategory'),
		),
	)),
	array('报告', 'Report', array(
		'开发统计' => array(
			array('开发统计', 'articlecategory'),
		),
	)),
	array('设置', 'department', array(
		'设置' => array(
			array('用户管理', 'User'),
			array('用户组', 'UserGroup'),
			array('权限设置', 'Access'),
		),
	)),
);