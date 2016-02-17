<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableSample;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-12-15
 * Time: 12:29:06
 */
class Sample extends TableSample implements ModelInterface {
	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'sample_no' => array(
				'unique' => true
			),
			'sample_type_name' => array('getter'=>function(Sample $item){
				return GlobalConf::$sample_type_desc_map[$item->sample_type];
			}),
			'sample_list' => array('getter'=>function(Sample $item){
				if($item->sample_type != GlobalConf::SAMPLE_TYPE_SUITE){
					throw new \Exception('样品不属于套件');
				}
				$tmp = SuiteSampleMapSingleSample::find('suite_sample_id=?', $item->id)->all(true);
				$sample_id_list = array_column($tmp, 'single_sample_id');
				return Sample::findByPks($sample_id_list);
			}),
			'extend_info' => array('getter'=>function(Sample $item){
				if($item->sample_type != GlobalConf::SAMPLE_TYPE_SINGLE){
					throw new \Exception('样品不属于单品');
				}
				return SingleSample::find('sample_id=?', $item->id)->one() ?: new SingleSample(array('sample_id'=>$item->id));
			}),
			'first_image_src' => array('getter'=>function(Sample $item){
				return SampleImage::find('sample_id=?', $item->id)->ceil('image_url');
			}),
			'package_list' => array('getter'=>function(Sample $item){
				return SamplePackage::find('sample_id = ?',$item->id)->all();
			}),
		));
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey() {
		// TODO: Implement getStateKey() method.
	}
}