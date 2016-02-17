<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableCustomerSource;

/**
 * User: Lite Scaffold
 * Date: 2015-11-17
 * Time: 13:50:42
 */
class CustomerSource extends TableCustomerSource implements ModelInterface {
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