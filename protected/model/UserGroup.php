<?php
namespace SvnPQA\model;
use Lite\CRUD\ModelInterface;
use SvnPQA\model\table\TableUserGroup;

/**
 * User: Lite Scaffold
 * Date: 2015-11-29
 * Time: 13:40:41
 */
class UserGroup extends TableUserGroup implements ModelInterface {
	public function __construct($data = array()){
		parent::__construct($data);
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){
		return 'state';
	}
}