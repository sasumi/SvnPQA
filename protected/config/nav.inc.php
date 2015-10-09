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
		'代码库' => array(
			array('花纸管理', 'articlecategory'),
		),
	)),
	array('系统设置', 'department', array(
		'系统设置' => array(
			array('部门管理', 'department'),
			array('用户管理', 'user'),
			array('员工管理', 'employee'),
			array('权限设置', 'access'),
		),
		'其他设置' => array(
			array('参数设置', 'configuration'),
		),
	)),
);