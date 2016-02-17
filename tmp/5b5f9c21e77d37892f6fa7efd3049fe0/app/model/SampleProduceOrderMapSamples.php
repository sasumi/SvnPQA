<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableSampleProduceOrderMapSamples;
use function Lite\func\array_group;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:03
 */
class SampleProduceOrderMapSamples extends TableSampleProduceOrderMapSamples implements ModelInterface {
	const STATE_NORMAL = 0;
	const STATE_FINISH = 1;

	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'sample_no' => array('getter'=>function(SampleProduceOrderMapSamples $item){
				if(!$item->sample_id){
					return '';
				}
				return Sample::findOneByPk($item->sample_id)->sample_no;
			}),
			'sample' => array('getter'=>function(SampleProduceOrderMapSamples $item){
				if(!$item->sample_id){
					return '';
				}
				return Sample::findOneByPk($item->sample_id);
			}),
			'sample_type_name' => array('getter'=>function(SampleProduceOrderMapSamples $item){
				if(!$item->sample_id){
					return '';
				}
				return Sample::findOneByPk($item->sample_id)->sample_type_name;
			}),
			'produce_type_text' => array('getter'=>function(SampleProduceOrderMapSamples $item){
				$def = self::getPropertiesDefine('produce_type');
				return $def['options'][$item->produce_type];
			}),
			'image_list' => array('getter'=>function(SampleProduceOrderMapSamples $item){
				$tmp = SampleImage::find('sample_id=?', $item->sample_id)->all();
				return array_column($tmp, 'image_url');
			}),
			'produce_state' => array('getter'=>function(self $item){
				if($item->produce_employee_id && $item->produce_process_state){
					$process_n = WorkProcess::findOneByPk($item->produce_process_state)->name;
					$employee_n = Employee::findOneByPk($item->produce_employee_id)->name;
					return "$process_n($employee_n)";
				}
				return '';
			}),
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