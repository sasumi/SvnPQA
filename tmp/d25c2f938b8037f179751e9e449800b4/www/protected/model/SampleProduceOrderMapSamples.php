<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableSampleProduceOrderMapSamples;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:03
 */
class SampleProduceOrderMapSamples extends TableSampleProduceOrderMapSamples implements ModelInterface {
	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'sample_no' => array('getter'=>function(SampleProduceOrderMapSamples $item){
				if(!$item->sample_id){
					return '';
				}
				return Sample::findOneByPk($item->sample_id)->sample_no;
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
			})
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