<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableSamplePackageMaterial;

/**
 * User: Lite Scaffold
 * Date: 2015-11-16
 * Time: 23:31:20
 */
class SamplePackageMaterial extends TableSamplePackageMaterial implements ModelInterface {
	const STATE_DISABLED = 0;
	const STATE_ENABLED = 1;

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