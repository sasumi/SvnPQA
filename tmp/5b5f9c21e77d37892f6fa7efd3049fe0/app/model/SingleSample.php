<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableSingleSample;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-12-15
 * Time: 12:29:06
 */
class SingleSample extends TableSingleSample implements ModelInterface {
	public function __construct($data = array()){
		parent::__construct($data);
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey() {
		// TODO: Implement getStateKey() method.
	}
}