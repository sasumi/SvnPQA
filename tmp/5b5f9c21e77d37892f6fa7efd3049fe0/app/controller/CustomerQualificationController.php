<?php
namespace www\controller;

use Lite\CRUD\ControllerInterface;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */
class CustomerQualificationController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_INDEX  => array(
				'fields' => array(
					'type',
					'no',
					'append_file_url',
				),
			),
			self::OP_UPDATE => array(
				'fields' => array(
					'type',
					'no',
					'append_file_url',
				),
			),
			self::OP_DELETE => array(),
			self::OP_INFO   => array()
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\CustomerQualification';
	}
}