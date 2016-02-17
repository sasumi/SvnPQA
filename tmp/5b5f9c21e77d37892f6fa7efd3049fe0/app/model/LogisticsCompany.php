<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableLogisticsCompany;

/**
 * User: Lite Scaffold
 * Date: 2015-12-30
 * Time: 18:09:42
 */
class LogisticsCompany extends TableLogisticsCompany implements ModelInterface {
	const STATE_DISABLED = 0;
	const STATE_ENABLED = 1;

	public function __construct($data = array()){
		parent::__construct($data);
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey() {
		return 'state';
	}
}