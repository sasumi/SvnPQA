<?php
namespace SvnPQA\Model;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:29
 */
use Lite\DB\Model as Model;

class User extends Model {
	const STATE_ENABLE = 1;
	const STATE_DISABLE = 0;

	public static $state_list = array(
		self::STATE_DISABLE => '禁用',
		self::STATE_ENABLE => '启用'
	);

	public function __construct($data=array()){
		$this->setPropertiesDefine(array(
			'name' => array('unique'=>'当前账户名称已存在'),
			'state_text' => array('getter' => function($item){
				return self::$state_list[$item->state];
			})
		));

		$this->setFilterRules(
			array(
				'name' => array(
					'TO_TRIM' => '',
					'UNIQUE' => '账号名已存在',
					'REQUIRE' => '请输入账号名称',
				),
				'password' => array(
					'REQUIRE' => '请输入密码',
				),
				'real_name' => array(
					'TO_TRIM' => '',
				),
				'last_login_time' => array(
					'TO_INT' => '',
					'DEFAULT' => 0
				),
				'create_time' => array(
					'DEFAULT' => time(),
				),
				'update_time' => array(
					'DEFAULT' => time()
				),
				'state' => array(
					'DEFAULT' => 1,
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
		return 'user';
	}

	/**
	 * current mode primary key
	 * @return string
	 */
	public function getPrimaryKey() {
		return 'id';
	}
}