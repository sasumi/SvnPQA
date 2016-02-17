<?php
namespace www\controller;
use Lite\CRUD\ControllerInterface;
use function Lite\func\array_filter_subtree;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class DepartmentController extends BaseController implements ControllerInterface{
	public function supportCRUDList(){
		return array(
			self::OP_INDEX => array(),
			self::OP_UPDATE => array(),
			self::OP_STATE => array(),
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\Department';
	}
}