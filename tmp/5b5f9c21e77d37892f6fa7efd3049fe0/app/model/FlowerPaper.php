<?php
namespace www\model;

use Lite\CRUD\ModelInterface;
use www\db_definition\TableFlowerPaper;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/25
 * Time: 10:49
 */
class FlowerPaper extends TableFlowerPaper implements ModelInterface {
	public function __construct($data=array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'image_url' => array(
				'type' => 'file',
				'rel' => 'upload-image'
			),
			'supplier_id' => array(
				'options' => function(){
					$tmp = Supplier::find()->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				},
				'alias' => '供应商'
			),
			'flower_paper_type' => array(
				'options' => function(){
					$tmp = SampleFlowerPaperType::find('state=?', SampleFlowerPaperType::STATE_ENABLED)->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				},
				'display' => function(self $item){
					$tmp = SampleFlowerPaperType::findOneByPk($item->flower_paper_type);
					if(!$tmp){
						return '';
					}
					return $tmp->state == SampleFlowerPaperType::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
				}
			)
		));
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){
	}
}