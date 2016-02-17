<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableCurrency;

/**
 * User: Lite Scaffold
 * Date: 2016-01-05
 * Time: 15:01:38
 */
class Currency extends TableCurrency implements ModelInterface {
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