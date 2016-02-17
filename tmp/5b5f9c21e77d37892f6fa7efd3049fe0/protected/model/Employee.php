<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableEmployee;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:00
 */
class Employee extends TableEmployee implements ModelInterface {
	const STATE_ENABLE = 1;
	const STATE_DISABLE = 0;

	const PAY_TYPE_NORMAL = 1;
	const PAY_TYPE_TIME = 2;
	const PAY_TYPE_COUNT = 3;

	public static $state_list = array(
		self::STATE_DISABLE => '禁用',
		self::STATE_ENABLE => '启用'
	);

	public function __construct($data = array()){
		$this->setPropertiesDefine(array(
			'employee_no' => array('unique'=>'当前工号已存在'),
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