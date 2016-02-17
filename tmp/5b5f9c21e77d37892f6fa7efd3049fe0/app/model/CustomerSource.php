<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableCustomerSource;

/**
 * User: Lite Scaffold
 * Date: 2015-11-17
 * Time: 13:50:42
 */
class CustomerSource extends TableCustomerSource implements ModelInterface {
	const STATE_DISABLED= 0;
	const STATE_ENABLED = 1;

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