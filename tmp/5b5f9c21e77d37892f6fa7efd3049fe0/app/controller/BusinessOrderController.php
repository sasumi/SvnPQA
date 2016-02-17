<?php
namespace www\controller;

use Lite\Component\Paginate;
use Lite\Core\Result;
use Lite\Core\Router;
use Lite\CRUD\ControllerInterface;
use Lite\DB\Model;
use Lite\Exception\BizException;
use Lite\Exception\Exception;
use www\model\BusinessOrder;
use www\model\BusinessOrderNote;
use www\model\BusinessOrderSamples;
use www\model\Customer;
use www\model\CustomerContact;
use www\model\PayType;
use www\model\SampleProduceOrder;
use www\model\SampleProduceOrderMapSamples;
use www\ViewBase;
use function Lite\func\dump;

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
				'fields' => array('order_no', 'customer_id', 'customer_contact_id','order_type',
					'destination_port','delivery_date','total_price', 'state')
			),
			self::OP_STATE => array(),
			self::OP_INFO => array(),
			self::OP_UPDATE => array(),
			self::OP_QUICK_SEARCH => array(
				'fields' => array('order_no', 'delivery_date')
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
				$r->setJumpUrl(Router::getUrl('BusinessOrder/info', array('id'=>$data['id'])));
			}
			return $r;
		}

		$pay_type_list = PayType::find('state = ?', PayType::STATE_ENABLED)->all();
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

	public function sampleProduceOrder($get){
		$ctrl = new SampleProduceOrderController();
		$r = Result::convert($ctrl->index(array(
			'page_flag' => 'BusinessOrder',
			'produce_type' => SampleProduceOrder::TYPE_ORDER
		)));

		$view = new ViewBase($r);
		return $view->render('sampleproduceorder/index.php', true);
	}

	public function sampleProduceOrderInfo($get){
		$ctrl = new SampleProduceOrderController();
		$r = Result::convert($ctrl->info($get));
		$view = new ViewBase($r);
		return $view->render('sampleproduceorder/sampleproduceorderinfo.php');
	}

	/**
	 * @param $get
	 * @param $post
	 * @return array
	 * @throws Exception
	 */
	public function addSampleProduceOrder($get, $post){
		$business_order_id = $get['id'];
		$business_order = BusinessOrder::findOneByPk($business_order_id);
		$sample_produce_order = new SampleProduceOrder();
		if($post){
			$sample_list = BusinessOrderSamples::find('business_order_id=?', $business_order_id)->all();
			if(empty($sample_list)){
				throw new BizException('样品列表为空，您必须先添加样品');
			}

			$exception = Model::transaction(function()use($sample_produce_order, $post, $sample_list, $business_order){
				$sample_produce_order->setValues($post);
				$sample_produce_order->save();
				$data = array();

				/** @var BusinessOrderSamples $sm */
				foreach($sample_list as $sm){
					$data[] = array(
						'produce_order_id' => $sample_produce_order->id,
						'sample_id' => $sm->sample_id,
						'produce_num' => BusinessOrder::DEFAULT_PRODUCE_NUM,
						'produce_request' => '无',
						'produce_process_state' => 0,
						'produce_employee_id' => 0
					);
				}
				SampleProduceOrderMapSamples::insertMany($data, false);
			});
			if($exception){
				dump($exception, 1);
				throw new BizException($exception);
			}
			return new Result('送样成功', true);
		}

		$sample_produce_order = new SampleProduceOrder();
		$customer = Customer::find('id = ?',$business_order->customer_id)->one();
		$current_contact = CustomerContact::find('id =?', $business_order->customer_contact_id)->one();

		return array(
			'sample_produce_order'                => $sample_produce_order,
			'business_order'       => $business_order,
			'customer'              => $customer,
			'current_contact'       => $current_contact,
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
			$order_sample = BusinessOrderSamples::find('id=? AND sample_id = ?',$order_id, $post['sample_id'])->count();
			if($order_sample){
				return new Result('已经添加了相同包装相同货号的样品');
			}
			$p = new BusinessOrderSamples($post);
			$p->save();
			return $this->getCommonResult(true);
		}
		return array(
			'order' => $order,
		);
	}

}