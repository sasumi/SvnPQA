<?php
namespace www\controller;
use Lite\CRUD\ControllerInterface;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class FlowerPaperController extends BaseController implements ControllerInterface{
	public function supportCRUDList(){
		return array(
			self::OP_INDEX => array(
				'fields' => array('image_url', 'paper_no', 'flower_paper_type')
			),
			self::OP_STATE=>array(),
			self::OP_INFO=>array(),
			self::OP_DELETE=>array(),
			self::OP_UPDATE=>array(),
			self::OP_QUICK_SEARCH => array(
				'fields' => array('paper_no')
			)
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\FlowerPaper';
	}
}