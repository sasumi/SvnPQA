<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableCustomerType;

/**
 * User: Lite Scaffold
 * Date: 2015-11-17
 * Time: 13:53:55
 */
class CustomerType extends TableCustomerType implements ModelInterface {
	public function __construct($data = array()){
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