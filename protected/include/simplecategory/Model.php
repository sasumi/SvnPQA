<?php
use Lite\DB\Model as DBModel;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/12
 * Time: 10:42
 */
abstract class SimpleCategory_Model extends DBModel {
	const STATE_ENABLE = 0;
	const STATE_DISABLE = 1;

	public static $state_list = array(
		self::STATE_ENABLE => '正常',
		self::STATE_DISABLE => '禁用'
	);

	public static $state_css_list = array(
		self::STATE_ENABLE => 'state-label-success',
		self::STATE_DISABLE => 'state-label-disable'
	);

	public static function getList(){
		/** @var self $class */
		$class = null;
		$class = get_called_class();

		return $class::find()->all();
	}

	public function __construct(){
		/* @var self $called_class */
		$called_class = get_called_class();

		$this->addPropertiesDefine(array(
			'name' => array('unique'=>'分类名称已存在'),
			'state_text' => array('getter'=>function($item)use($called_class){
				return $called_class::$state_list[$item->is_del];
			}),
			'state_css_class' => array('getter'=>function($item)use($called_class){
				return $called_class::$state_css_list[$item->is_del];
			}),
		));

		$this->addFilterRules(array(
			'name' => array(
				'TO_TRIM' => '',
				'REQUIRE' => '请输入名称'
			),
			'is_del' => array(
				'TO_INT' => '',
				'DEFAULT' => 0
			),
		));
	}
}