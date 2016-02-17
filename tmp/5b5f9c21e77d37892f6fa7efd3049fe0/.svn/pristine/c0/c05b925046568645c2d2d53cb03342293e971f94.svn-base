<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableSampleMould;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:04
 */
class SampleMould extends TableSampleMould implements ModelInterface{
	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'weight' => array(
				'description' => 'KG'
			)
		));
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){
		// TODO: Implement getStateKey() method.
	}
}