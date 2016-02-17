<?php
namespace www\controller;
use Lite\CRUD\ControllerInterface;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class StoreLogController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_INDEX=>array(),
			self::OP_UPDATE=>array(),
			self::OP_STATE=>array(),
			self::OP_INFO=>array()
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\StoreLog';
	}
}