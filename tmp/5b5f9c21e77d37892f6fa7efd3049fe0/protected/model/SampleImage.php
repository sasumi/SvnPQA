<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableSampleImage;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:02
 */
class SampleImage extends TableSampleImage implements ModelInterface{
	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'image_url' => array(
				'rel' => 'upload-image',
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