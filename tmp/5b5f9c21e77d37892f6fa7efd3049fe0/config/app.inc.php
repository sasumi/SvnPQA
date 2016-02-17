<?php
return array(
	'site_name' => 'ERP管理后台',
	'url' => 'http://localhost/chinaerp/trunk/www/public/',
	'auto_statistics' => true,  //是否开启性能统计
	'auto_process_logic_error' => false,     //自动显示逻辑错误
	'debug' => true,
	'login_captcha' => true,
	'render' => '\www\ViewBase',
	'static' => 'http://localhost/chinaerp/trunk/www/static/',
	'cdn_url' => 'http://localhost/chinaerp/trunk/frontend/',
	'richeditor_home' => 'http://localhost/chinaerp/trunk/frontend/ueditor/',

	'default_image' => 'default_image.png',

	//登录控制
	'login' => array(
		'expired' => 3600,
		'use_captcha' => false,
		'allow_remember_in_frontend' => false,
		'captcha' => array(
			'width' => 100,
			'height' => 45,
			'words' => 4,
			'font_size' => 25
		)
	)
);