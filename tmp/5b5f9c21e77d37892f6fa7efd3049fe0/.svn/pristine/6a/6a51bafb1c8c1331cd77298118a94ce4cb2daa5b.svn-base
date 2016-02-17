<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\Auth;
use www\model\table\TableCustomer;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:24:58
 */
class Customer extends TableCustomer implements ModelInterface {
	public function __construct($data = array()){
		parent::__construct($data);

		//extra properties define
		$this->setPropertiesDefine(array(
			'customer_no' => array(
				'description' => '规则：xxx-xx-33',
			),
			'create_time' => array('setter'=>function(){
				return time();
			}),
			'op_user_id' => array(
				'setter'=>function(){
					return Auth::instance()->getLoginUserId();
				},
				'options' => function(){
					$tmp = User::find()->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				})
		));
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){

	}
}