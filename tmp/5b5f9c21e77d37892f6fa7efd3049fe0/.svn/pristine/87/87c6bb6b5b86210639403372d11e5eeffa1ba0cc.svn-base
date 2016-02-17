<?php
namespace www\controller;
use Lite\Component\Paginate;
use Lite\Core\Result;
use Lite\Core\Router;
use Lite\CRUD\ControllerInterface;
use www\Auth;
use www\model\BusinessOrder;
use www\model\Customer;
use www\model\CustomerContact;
use www\model\SampleProduceOrder;
use www\model\SampleProduceOrderMapSamples;
use function Lite\func\array_group;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class SampleProduceOrderController extends BaseController implements ControllerInterface {
	public function __construct(){
		parent::__construct();
	}

	public function supportCRUDList(){
		return array(
			self::OP_INDEX  => array(),
			self::OP_INFO   => array(),
			self::OP_UPDATE => array(),
			self::OP_STATE => array(),
		);
	}

	public function info($get){
		$id = $get['id'];
		$base_info = SampleProduceOrder::findOneByPk($id);
		$paginate = Paginate::instance();
		$sample_list = SampleProduceOrderMapSamples::find('produce_order_id = ?',$id)->paginate($paginate);

		return array(
			'base_info' => $base_info,
			'paginate' => $paginate,
			'sample_list' => $sample_list,
		);
	}

	public function update($get, $post){
		$order = SampleProduceOrder::findOneByPk($get['id']) ?: new SampleProduceOrder();

		if($post) {
			$org_id = $order->boss_head_employee_id;
			$order->setValues($post);
			if(!$order->id){
				$order->boss_head_employee_id = Auth::instance()->getLoginUserId();
			} else {
				$order->boss_head_employee_id = $org_id;
			}
			$result = parent::update($get, $post);
			if($result->isSuccess()){
				return new Result('操作成功', true, null, $this->getUrl('SampleProduceOrder/info', array('id'=>$result->getData()['id'])));
			}
		}

		$customer_list = Customer::find()->all();
		$current_contact_list = array();
		if($order->id){
			$current_contact_list = CustomerContact::find('customer_id =?', $order->contact->customer_id)->all();
		}

		$all_contact_list = CustomerContact::find()->all(true);
		$all_contact_list = array_group($all_contact_list, 'customer_id');

		return array(
			'order' =>$order,
			'customer_list' => $customer_list,
			'all_contact_list' => $all_contact_list,
			'current_contact_list' => $current_contact_list
		);
	}

	/**
	 * @param $get
	 * @param $post
	 *
	 * @return array
	 */
	public function addFromBusinessOrder($get, $post){
		$business_order_id = $get['business_order_id'];
		$business_order = BusinessOrder::findOneByPk($business_order_id);
		$order = new SampleProduceOrder();

		$customer = Customer::find('id = ?',$business_order->customer_id)->one();
		$current_contact = CustomerContact::find('customer_id =?', $business_order->customer_contact_id)->one();

		return array(
			'order'                => $order,
			'business_order'       => $business_order,
			'customer'              => $customer,
			'current_contact'       => $current_contact,
		);
	}

	public function sampleList($get){
		$id = $get['id'];
		$paginate = Paginate::instance();
		$sample_list = SampleProduceOrderMapSamples::find('sample_produce_id=?', $id)->paginate($paginate);

		return array(
			'sample_list' => $sample_list,
			'paginate' => $paginate
		);
	}

	/**
	 * get relate model name
	 * @return string
	 */
	public function getModel(){
		return 'www\model\SampleProduceOrder';
	}
}