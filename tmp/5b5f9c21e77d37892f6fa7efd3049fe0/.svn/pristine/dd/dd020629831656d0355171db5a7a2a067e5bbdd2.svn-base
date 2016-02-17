<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableSupplier;

/**
 * User: Lite Scaffold
 * Date: 2016-01-04
 * Time: 21:49:40
 */
class Supplier extends TableSupplier implements ModelInterface {
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