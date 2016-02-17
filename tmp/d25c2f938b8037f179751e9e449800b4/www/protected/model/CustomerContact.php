<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableCustomerContact;

/**
 * User: Lite Scaffold
 * Date: 2015-11-14
 * Time: 11:20:56
 */
class CustomerContact extends TableCustomerContact implements ModelInterface{
	public function __construct($data = array()){
		parent::__construct($data);

		//extra properties define
		$this->setPropertiesDefine(array(
			'customer' => array('getter' => function(CustomerContact $item){
				return Customer::findOneByPk($item->id);
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