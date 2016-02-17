<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TablePayType;

/**
 * User: Lite Scaffold
 * Date: 2015-11-17
 * Time: 13:56:16
 */
class PayType extends TablePayType implements ModelInterface {
	const STATE_DISABLE = '0';
	const STATE_ENABLE =  '1';

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