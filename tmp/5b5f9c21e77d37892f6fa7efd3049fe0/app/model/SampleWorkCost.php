<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableSampleWorkCost;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:05
 */
class SampleWorkCost extends TableSampleWorkCost implements ModelInterface {
	public function __construct($data = array()){
		parent::__construct($data);
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){
		// TODO: Implement getStateKey() method.
	}
}