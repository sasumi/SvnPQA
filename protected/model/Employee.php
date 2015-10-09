<?php
namespace SvnPQA\Model;

/**
 * Created by PhpStorm.
 * Employee: sasumi
 * Date: 2014/11/5
 * Time: 12:29
 */
use Lite\DB\Model as Model;

class Employee extends Model {
	const STATE_ENABLE = 1;
	const STATE_DISABLE = 0;

	const PAY_TYPE_NORMAL = 1;
	const PAY_TYPE_TIME = 2;
	const PAY_TYPE_COUNT = 3;

	public static $pay_type_list = array(
		self::PAY_TYPE_NORMAL => '固定',
		self::PAY_TYPE_TIME => '计时',
		self::PAY_TYPE_COUNT => '计件'
	);

	public static $state_list = array(
		self::STATE_DISABLE => '禁用',
		self::STATE_ENABLE => '启用'
	);

	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'employee_no' => array('unique'=>'当前工号已存在'),

			'pay_type_text' => array('getter'=>function($item){
				return self::$pay_type_list[$item->pay_type];
			}),
			'work_flow_type_text' => array('getter'=>function($item){
				return 'xx';
			}),
			'state_text' => array('getter' => function($item){
				return self::$state_list[$item->state];
			})
		));

		$this->setFilterRules(
			array(
				'name' => array(
					'TO_TRIM' => '',
					'REQUIRE' => '请输入员工名称',
				),
				'employee_no' => array(
					'TO_TRIM' => '',
				),
				'pay_type' => array(
					'TO_INT' => '',
				),
				'work_flow_type' => array(
					'TO_INT' => '',
				),
				'id_card_number' => array(
					'TO_TRIM' => '',
				),
				'birthday' => array(
					'TO_INT' => '',
					'DEFAULT' => 0
				),
				'address' => array(
					'TO_TRIM' => '',
				),
				'tel' => array(
					'TO_TRIM' => '',
				),
				'urgent_tel' => array(
					'TO_TRIM' => '',
				),
				'entry_time' => array(
					'TO_INT' => ''
				),
				'leave_time' => array(
					'TO_INT' => ''
				),
				'state' => array(
					'TO_INT' => '',
				)
			)
		);
		parent::__construct($data);
	}

	/**
	 * current model table name
	 * @return string
	 */
	public function getTableName() {
		return 'employee';
	}

	/**
	 * current mode primary key
	 * @return string
	 */
	public function getPrimaryKey() {
		return 'id';
	}
}