<?php
return array(
	array('Home', 'index'),
	array('Repository', 'Repository/index', array(
		'Repository' => array(
			array('Code Store', 'Repository/index'),
			array('Code Review', 'CodeStore/codeReview'),
			array('Commit History', 'CodeStore/history'),
		),
	)),
	array('Statistics', 'CodeStore', array(
		'Dev Statistics' => array(
			array('Dev Statistics', 'CodeStore/statistics'),
		),
	)),
	array('Report', 'Report', array(
		'Report' => array(
			array('Report', 'Report'),
		),
	)),
	array('Setting', 'User/index', array(
		'Setting' => array(
			array('User', 'User'),
			array('User Group', 'UserGroup'),
			array('Access', 'Access'),
		),
	)),
);