<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableSampleMould;

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
			),
			'sample_mould_category_id' => array(
				'options' => function(){
					$tmp = SampleMouldCategory::find('state=?',SampleMouldCategory::STATE_ENABLED)->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				},
				'display' => function(self $item){
					$tmp = SampleMouldCategory::findOneByPk($item->sample_mould_category_id);
					return $tmp->state == SampleMouldCategory::STATE_ENABLED ? $tmp->name : "<del>{$tmp->name}</del>";
				}
			),
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