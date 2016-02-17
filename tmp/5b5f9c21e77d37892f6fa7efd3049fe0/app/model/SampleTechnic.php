<?php
namespace www\model;
use www\db_definition\TableSampleTechnic;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:05
 */
class SampleTechnic extends TableSampleTechnic {
	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'flow_name' => array('getter'=>function($item){
				return (new Sample())->getPropertiesDefine('technic_flow_id_list')['options'][$item->flow_id] ;
			})
		));
	}

	public static function findByFlowIdList($sample_id, $flow_id_list=array()){
		$tmp = array();
		if($flow_id_list){
			$tmp = self::find('sample_id =? AND flow_id IN ?', $sample_id, $flow_id_list)->all(true);
			$tmp = array_combine(array_column($tmp, 'flow_id'), array_column($tmp, 'technic_desc'));
		}

		$options = (new SingleSample())->getPropertiesDefine('technic_flow_id_list')['options'];
		$ret = array();
		foreach($flow_id_list as $id){
			$ret[$id] = array($tmp[$id], $options[$id]);
		}
		return $ret;
	}
}