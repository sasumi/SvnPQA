<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableSamplePackage;

/**
 * User: Lite Scaffold
 * Date: 2015-11-21
 * Time: 12:32:48
 */
class SamplePackage extends TableSamplePackage implements ModelInterface{
	public function __construct($data = array()){
		parent::__construct($data);

		$this->setPropertiesDefine(array(
			'pack_type_name' => array('getter'=>function($item){
				return $this->getPropertiesDefine('pack_type')['options'][$item->pack_type] ;
			}),
			'inner_box_material_type_name' => array('getter'=>function($item){
				return $this->getPropertiesDefine('inner_box_material_type')['options'][$item->inner_box_material_type] ;
			}),
			'outer_box_material_type_name' => array('getter'=>function($item){
				return $this->getPropertiesDefine('outer_box_material_type')['options'][$item->outer_box_material_type] ;
			}),
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