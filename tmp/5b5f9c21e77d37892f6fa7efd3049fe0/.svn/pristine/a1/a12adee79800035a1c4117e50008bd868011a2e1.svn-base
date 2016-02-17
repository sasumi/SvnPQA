<?php
namespace www\controller;

use Lite\Core\Result;
use Lite\CRUD\ControllerInterface;
use www\model\BusinessOrder;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: Sasumi
 * Date: 2015/10/27
 * Time: 13:56
 */
class BusinessOrderPaymentController extends BaseController implements ControllerInterface {
	/**
	 * get curd support operation list
	 * @return array
	 */
	public function supportCRUDList() {
		return array(
			self::OP_UPDATE       => array(
				'fields' => array(
					'*', '-business_order_id','-create_time'
				)
			),
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\BusinessOrderPayment';
	}

	/**
	 * @param $get
	 * @param $post
	 * @return \Lite\Core\Result|void
	 */
	public function update($get, $post){
		$id = $get['id'];
		$business_order_id = $get['business_order_id'];

		$r = Result::convert(parent::update($get, $post));
		if($post){
			if($r->isSuccess()){
				if(!$id){

					$order = BusinessOrder::findOneByPk($business_order_id);
					$order->setValue('state',BusinessOrder::STATE_CONFIRM);
					$order->save();
				}
				$r->setJumpUrl($this->getBackUrl());
			}
		}
		return $r;
	}
}