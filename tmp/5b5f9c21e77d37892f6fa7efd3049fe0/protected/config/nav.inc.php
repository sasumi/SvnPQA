<?php
return array(
	array('首页', 'index'),
	array('样品管理', 'Sample/index', array(
		'样品管理' => array(
			array('样品', 'Sample/index'),
			array('样品生产', 'SampleProduceOrder/index'),
			array('工价管理', 'SampleWorkAccount/index'),
			array('色号', 'ColorGlaze/index'),
			array('花纸管理', 'FlowerPaper/index'),
			array('取样管理', 'SampleLendRecord/index'),
			array('参数设置', 'SampleConfig/index'),
		),
	)),
	array('业务管理', 'businessOrder/index', array(
		'业务管理' => array(
			array('订单管理', 'businessOrder/index'),
			array('样品生产', 'SampleProduceOrder/index'),
			array('客户管理', 'customer/index'),
			array('参数设置', 'BusinessConfig/index'),
		),
	)),
	array('生产订单', 'Produce', array(
		'生产订单' => array(
			array('生产审核', 'Produce/task'),
			array('生产布产', 'Produce/assign'),
			array('生产跟踪', 'Produce/track'),
		),
	)),
	array('车间', 'WorkShop', array(
		'成型车间' => array(
			array('订单管理', 'WorkShop/index'),
			array('送样管理', 'WorkShop'),
			array('客户管理', 'WorkShop'),
			array('参数设置', 'WorkShop'),
		),
		'烧成车间' => array(
			array('订单管理', 'FiringWorkshop/showArticleList'),
			array('送样管理', 'FiringWorkshop'),
			array('客户管理', 'FiringWorkshop'),
			array('参数设置', 'FiringWorkshop'),
		),
		'彩画车间' => array(
			array('订单管理', 'painting/showArticleList'),
			array('送样管理', 'painting'),
			array('客户管理', 'painting'),
			array('参数设置', 'painting'),
		),
	)),
	array('仓库管理', 'StoreLog/index', array(
		'仓库管理' => array(
			array('仓库记录', 'StoreLog/index'),
			array('仓库配置', 'Store/index'),
		),
	)),
	array('系统设置', 'department', array(
		'系统设置' => array(
			array('生产部门', 'department'),
			array('员工管理', 'employee'),
			array('权限设置', 'access'),
		),
		'其他设置' => array(
			array('工序设置', 'WorkProcess'),
			array('参数设置', 'configuration'),
			array('用户', 'user'),
			array('用户组', 'UserGroup'),
		),
	)),
);