<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableEmployee;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:00
 */
class Employee extends TableEmployee implements ModelInterface {
	const STATE_ENABLED = 1;
	const STATE_DISABLED = 0;

	const PAY_TYPE_NORMAL = 1;
	const PAY_TYPE_TIME = 2;
	const PAY_TYPE_COUNT = 3;

	public static $state_list = array(
		self::STATE_DISABLED => '禁用',
		self::STATE_ENABLED => '启用'
	);

	public function __construct($data = array()){
		$this->setPropertiesDefine(array(
			'work_process' => array('options' => function(){
				$tmp = WorkProcess::find()->all(true);
				return $tmp ? array_combine(array_column($tmp, 'id'), array_column($tmp, 'name')) : array();
			})
		));
		parent::__construct($data);
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){
		return 'state';
	}
}