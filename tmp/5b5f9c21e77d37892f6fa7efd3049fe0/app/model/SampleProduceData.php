<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableSampleProduceData;

/**
 * User: Lite Scaffold
 * Date: 2016-01-05
 * Time: 13:50:13
 */
class SampleProduceData extends TableSampleProduceData implements ModelInterface {
	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'color_glaze_id' => array(
				'options' => function(){
					$tmp = ColorGlaze::find()->all(true);
					return array_combine(array_column($tmp, 'id'),array_column($tmp, 'color_no'));
				},
				'display' => function(self $item){
					if($item){
						return ColorGlaze::findOneByPk($item->color_glaze_id)->color_no;
					}
					return '';
				}
			),
			'flower_paper' => array(
				'options' => function(){
					$tmp = FlowerPaper::find()->all(true);
					return array_combine(array_column($tmp, 'id'),array_column($tmp, 'paper_no'));
				},
				'display' => function(self $item){
					if($item){
						return FlowerPaper::findOneByPk($item->flower_paper)->paper_no;
					}
					return '';
				}
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