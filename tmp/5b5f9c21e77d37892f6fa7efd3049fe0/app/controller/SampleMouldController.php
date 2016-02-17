<?php
namespace www\controller;
use Lite\CRUD\ControllerInterface;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class SampleMouldController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_INDEX=>array(),
			self::OP_UPDATE=>array(
				'fields' => array('name', 'weight','mould_num','product_num','freight_space')
			),
			self::OP_INFO=>array(),
			self::OP_DELETE => array(),
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\SampleMould';
	}
}