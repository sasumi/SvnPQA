<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableUser;
use function Lite\func\array_group;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:06
 */
class User extends TableUser implements ModelInterface {
	const STATE_ENABLED = 1;
	const STATE_DISABLED = 0;

	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'user_group_id' => array(
				'options' => function(){
					$tmp = UserGroup::find('state=?',UserGroup::STATE_ENABLED)->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				},
				'display' => function(self $item){
					$tmp = UserGroup::findOneByPk($item->user_group_id);
					return $tmp->state == UserGroup::STATE_ENABLED ? $tmp->name : "<del>{$tmp->name}</del>";
				}
			),
			'password' => array(
				'type' => 'password'
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