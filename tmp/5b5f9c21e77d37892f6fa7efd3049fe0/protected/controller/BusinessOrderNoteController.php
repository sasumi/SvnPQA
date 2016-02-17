<?php
namespace www\controller;

use Lite\CRUD\ControllerInterface;

/**
 * Created by PhpStorm.
 * User: Sasumi
 * Date: 2015/10/27
 * Time: 13:56
 */
class BusinessOrderNoteController extends BaseController implements ControllerInterface {
	/**
	 * get curd support operation list
	 * @return array
	 */
	public function supportCRUDList(){
		return array(
			self::OP_UPDATE => array(
				'fields' => array('note_content')
			),
			self::OP_DELETE => array(),
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\BusinessOrderNote';
	}
}