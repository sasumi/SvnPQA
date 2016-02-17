<?php
namespace www\model;

use Lite\CRUD\ModelInterface;
use www\model\table\TableFlowerPaper;

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
			'flower_paper_type' => array(
				'options' => function(){
					$tmp = SampleFlowerPaperType::find('state=1')->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
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