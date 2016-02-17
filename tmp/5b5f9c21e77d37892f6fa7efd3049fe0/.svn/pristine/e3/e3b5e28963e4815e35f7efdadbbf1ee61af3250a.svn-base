<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableUser;
use function Lite\func\array_group;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:06
 */
class User extends TableUser implements ModelInterface {
	const STATE_ENABLE = 1;
	const STATE_DISABLE = 0;

	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'user_group_id' => array(
				'options' => function(){
					$tmp = UserGroup::find()->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				}
			),
			'name' => array(
				'unique'=>'当前账户名称已存在'
			),
		));
	}

	/**
	 * 校验用户名密码
	 * @param $name
	 * @param $password
	 * @return array
	 */
	public static function validatePsw($name, $password){
		return User::find('name=? AND password=?',$name, md5($password))->one(true);
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){
		return 'state';
	}
}