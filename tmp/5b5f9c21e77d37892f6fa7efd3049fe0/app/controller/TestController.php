<?php
/**
 * Created by PhpStorm.
 * User: Sasumi
 * Date: 2015/10/19
 * Time: 20:49
 */
namespace www\controller;
use Lite\CRUD\ControllerInterface;

class TestController extends BaseController implements ControllerInterface {
	/**
	 * get curd support operation list
	 * @return array
	 */
	public function supportCRUDList(){
		return array(self::OP_DELETE, self::OP_INDEX, self::OP_UPDATE, self::OP_STATE);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\Test';
	}
}