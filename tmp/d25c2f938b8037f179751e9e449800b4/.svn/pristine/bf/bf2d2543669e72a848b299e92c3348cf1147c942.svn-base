<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableSamplePackageMaterial;

/**
 * User: Lite Scaffold
 * Date: 2015-11-16
 * Time: 23:31:20
 */
class SamplePackageMaterial extends TableSamplePackageMaterial implements ModelInterface {
	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'thickness' => array(
				'description' => 'cm'
			),
			'weight' => array(
				'description' => 'g/cm²'
			),
		));
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){
		return 'state';
	}
}