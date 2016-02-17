<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableColorGlaze;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/25
 * Time: 10:49
 */
class ColorGlaze extends TableColorGlaze implements ModelInterface {
	public function __construct($data=array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'adapt_material' => array(
				'options' => function(){
					$data = SampleMaterial::find('state=?', SampleMaterial::STATE_ENABLED)->all(true);
					return array_combine(array_column($data, 'id'), array_column($data, 'name'));
				},
				'display' => function(self $item){
					$tmp = SampleMaterial::findOneByPk($item->adapt_material);
					if(!$tmp){
						return '';
					}
					return $tmp->state == SampleMaterial::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
				}
			),
			'image_url' => array(
				'type' => 'file',
				'rel' => 'upload-image'
			)
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