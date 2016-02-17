<?php
namespace www\controller;
use Lite\CRUD\ControllerInterface;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class SampleFlowerPaperTypeController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_INDEX => array(),
			self::OP_STATE=>array(),
			self::OP_INFO=>array(),
			self::OP_UPDATE=>array(),
			self::OP_QUICK_SEARCH => array(
				'fields' => array('name')
			)
		);
	}

	public function getModel(){
		return 'www\model\SampleFlowerPaperType';
	}
}