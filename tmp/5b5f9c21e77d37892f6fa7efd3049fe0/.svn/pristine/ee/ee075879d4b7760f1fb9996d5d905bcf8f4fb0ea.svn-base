<?php
namespace www\controller;

use Lite\Component\Paginate;
use Lite\Core\Result;
use Lite\CRUD\ControllerInterface;
use function Lite\func\dump;
use www\model\BusinessOrder;
use www\model\BusinessOrderNote;
use www\model\BusinessOrderSamples;
use www\model\Customer;
use www\model\CustomerContact;
use www\model\PayType;

/**
 * Created by PhpStorm.
 * User: Sasumi
 * Date: 2015/10/27
 * Time: 13:56
 */
class BusinessOrderController extends BaseController implements ControllerInterface {
	/**
	 * get curd support operation list
	 * @return array
	 */
	public function supportCRUDList(){
		return array(
			self::OP_INDEX => array(
				'fields' => array('order_no', 'customer_contact_id', 'order_type', 'fob', 'destination_port', 'pay_type_id', 'delivery_date', 'settle_currency', 'total_price', 'total_volume')
			),
			self::OP_STATE => array(),
			self::OP_INFO => array(),
			self::OP_UPDATE => array(),
			self::OP_QUICK_SEARCH => array(
				'fields' => array('order_no')
			)
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\BusinessOrder';
	}

	public function info($get){
		$id = $get['id'];
		$order = BusinessOrder::findOneByPk($id);
		$p1 = Paginate::instance('p1', array('page_key'=>'sp'));
		$sample_list = BusinessOrderSamples::find('business_order_id=?', $order->id)->paginate($p1);

		$p2 = Paginate::instance('p2', array('page_key'=>'np'));
		$note_list = BusinessOrderNote::find('business_order_id=?', $order->id)->paginate($p2);
		return array(
			'sample_list' => $sample_list,
			'sample_paginate' => $p1,
			'note_paginate' => $p2,
			'note_list' => $note_list,
			'order' => $order,
		);
	}

	/**
	 * 跟新订单
	 * @param $get
	 * @param $post
	 * @return \Lite\Core\Result|void
	 */
	public function update($get, $post){
		$id = $get['id'];
		$order = $id ? BusinessOrder::findOneByPk($id) : (new BusinessOrder());
		if($post){
			$post['order_no'] = $order->order_no ?: BusinessOrder::generateOrderNo();
			$r = Result::convert(parent::update($get, $post));
			if($r->isSuccess()){
				$data = $r->getData();
				$r->setJumpUrl($this->getUrl('BusinessOrder/info', array('id'=>$data['id'])));
			}
			return $r;
		}

		$pay_type_list = PayType::find('state = ?', PayType::STATE_ENABLE)->all();
		$default_customer_list = Customer::find()->order(' id asc ')->limit(10)->all();
		if($order->customer_id){
			$order_customer = Customer::find('id = ?', $order->customer_id)->all();
			if($order_customer){
				$default_customer_list = array_merge($default_customer_list, $order_customer);
			}
		}
		$default_customer_contact_list = array();
		if($order->customer_id){
			$default_customer_contact_list = CustomerContact::find('customer_id = ?', $order->customer_id)->all(true);
		}
		return array(
			'order' => $order,
			'order_type_list' => $order->getPropertiesDefine('order_type')['options'],
			'pay_type_list' => $pay_type_list,
			'default_customer_list' => $default_customer_list,
			'default_customer_contact_list' => $default_customer_contact_list,
		);
	}

	/**
	 * 添加订单的样品
	 * @param $get
	 * @param $post
	 * @return array
	 */
	public function addSample($get, $post){
		$order_id = $get['id'];
		$order = BusinessOrder::findOneByPk($order_id);

		if($post){
			$order_sample = BusinessOrderSamples::find('sample_id = ? and sample_package_id = ?',$post['sample_id'],$post['sample_package_id'])->one();
			if($order_sample){
				return new Result('已经添加了相同包装相同货号的样品',false);
			}
			$p = new BusinessOrderSamples($post);
			$p->save();
			return $this->getCommonResult(true);
		}
		return array(
			'order' => $order,
		);
	}

	/**
	 * 确认订单
	 * @param $get
	 */
	public function confirm($get){

	}

	/**
	 * 取消订单
	 * @param $get
	 */
	public function cancel($get){

	}
}