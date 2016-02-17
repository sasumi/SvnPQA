<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableSample;
use function Lite\func\array_filter_subtree;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-12-15
 * Time: 12:29:06
 */
class Sample extends TableSample implements ModelInterface {
	const STATE_DRAFT = 0; //草稿
	const STATE_NORMAL = 1; //正式

	const SAMPLE_TYPE_SINGLE = 1;
	const SAMPLE_TYPE_SUITE = 2;

	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
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
			'material_id' => array(
				'options' => function(){
					$tmp = SampleMaterial::find('state=?', SampleMaterial::STATE_ENABLED)->all(true);
					return array_combine(array_column($tmp, 'id'),array_column($tmp, 'name'));
				},
				'display' => function(self $item=null){
					$tmp = SampleMaterial::findOneByPk($item->material_id);
					if(!$tmp){
						return '';
					}
					return $tmp->state == SampleMaterial::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
				}
			),
			'category_id' => array(
				'options' => function(){
					$tmp = SampleCategory::find('state=?', SampleCategory::STATE_ENABLED)->all(true);
					$tmp = array_filter_subtree(0, $tmp);
					foreach($tmp as $k=>$item){
						$tmp[$k]['name'] = str_repeat('&nbsp;', $item['tree_level']*5).'|-'.$item['name'];
					}
					return array_combine(array_column($tmp, 'id'),array_column($tmp, 'name'));
				},
				'display' => function(self $item=null){
					if($item->category_id){
						$tmp = SampleCategory::findOneByPk($item->category_id);
						if(!$tmp){
							return '';
						}
						return $tmp->state == SampleCategory::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
					}
					return '';
				}
			),
			'extend_info' => array('getter'=>function(Sample $item){
				if($item->sample_type != GlobalConf::SAMPLE_TYPE_SINGLE){
					throw new \Exception('样品不属于单品');
				}
				return SingleSample::find('sample_id=?', $item->id)->one() ?: new SingleSample(array('sample_id'=>$item->id));
			}),
			'produce_data' => array('getter'=>function(Sample $item){
				if($item && $item->sample_type == GlobalConf::SAMPLE_TYPE_SINGLE){
					return SampleProduceData::find('sample_id=?', $item->id)->one();
				}
				return null;
			}),
			'first_image_src' => array('getter'=>function(Sample $item){
				return SampleImage::find('sample_id=?', $item->id)->ceil('image_url');
			},'rel' => 'upload-image',),
			'key_words' => array(
				'rel' => 'keywords'
			),
			'tags' => array(
				'rel' => 'tags'
			),
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
		return 'state';
	}
}