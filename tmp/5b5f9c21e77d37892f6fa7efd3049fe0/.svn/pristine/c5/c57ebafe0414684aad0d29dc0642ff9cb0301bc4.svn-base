<?php
namespace www\controller;

use Lite\CRUD\ControllerInterface;
use www\model\BusinessOrderSamples;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: Sasumi
 * Date: 2015/10/27
 * Time: 13:56
 */
class BusinessOrderSamplesController extends BaseController implements ControllerInterface {
	/**
	 * get curd support operation list
	 * @return array
	 */
	public function supportCRUDList(){
		return array(
			self::OP_UPDATE => array(),
			self::OP_DELETE => array(),
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\BusinessOrderSamples';
	}

	/**
	 * @param $get
	 * @param $post
	 * @return array|\Lite\Core\Result
	 */
	public function update($get,$post){
		$id  = $get['id'];
		$sample = BusinessOrderSamples::findOneByPk($id);
		if($post){
			$sample->setValues($post);
			$sample->save();
			return $this->getCommonResult(true);
		}

		return array(
			'sample'=>$sample,
		);
	}
}