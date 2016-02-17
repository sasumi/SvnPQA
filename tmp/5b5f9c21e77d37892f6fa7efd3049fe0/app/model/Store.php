<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableStore;

/**
 * User: Lite Scaffold
 * Date: 2015-11-17
 * Time: 16:26:17
 */
class Store extends TableStore implements ModelInterface {
	const STATE_DISABLED = 0;
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