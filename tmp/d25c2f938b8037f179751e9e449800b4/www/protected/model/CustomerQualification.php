<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\model\table\TableCustomerQualification;
use function Lite\func\dump;

/**
 * User: Lite Scaffoldupload-image
 * Date: 2015-11-15
 * Time: 10:49:24
 */
class CustomerQualification extends TableCustomerQualification implements ModelInterface{
	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'append_file_url' => array(
				'type' => 'file',
				'rel' => 'upload-file'
			),
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