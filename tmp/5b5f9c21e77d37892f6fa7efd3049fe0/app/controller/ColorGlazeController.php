<?php
namespace www\controller;
use Lite\CRUD\ControllerInterface;

/**
 * Created by PhpStorm.
* User: sasumi
* Date: 2014/11/5
* Time: 12:25
*/
class ColorGlazeController extends BaseController implements ControllerInterface{
	public function supportCRUDList(){
		return array(
			self::OP_INDEX=>array(
				'fields' => array('*', '-adapt_material', '-formula', '-desc')
			),
			self::OP_UPDATE=>array(),
			self::OP_INFO=>array(),
			self::OP_DELETE => array(),
			self::OP_QUICK_SEARCH => array(
				'fields' => array('color_no', 'pantone_no')
			)
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\ColorGlaze';
	}
}