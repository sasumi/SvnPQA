<?php
namespace www\controller;
use Lite\Component\Paginate;
use Lite\Core\Result;
use Lite\Core\Router;
use Lite\CRUD\ControllerInterface;
use Lite\DB\Query;
use www\Auth;
use www\model\BusinessOrder;
use www\model\Customer;
use www\model\CustomerContact;
use www\model\LogisticsCompany;
use www\model\SampleProduceOrder;
use www\model\SampleProduceOrderDeliverInfo;
use www\model\SampleProduceOrderMapSamples;
use www\model\WorkProcess;
use www\model\WorkStage;
use function Lite\func\array_group;
use function Lite\func\dump;

/**
 * Created by PhpStorm.
 * User: sasumi
 * Date: 2014/11/5
 * Time: 12:25
 */

class SampleProduceOrderController extends BaseController implements ControllerInterface {
	public function supportCRUDList(){
		return array(
			self::OP_UPDATE => array(),
			self::OP_STATE => array(),
		);
	}

	public function index($search){
		$paginate = Paginate::instance();

		$query = SampleProduceOrder::find();
		if($search['kw']){
			$query->addWhere(Query::OP_AND, 'order_no', 'like', "%{$search['kw']}%");
		}
		if(strlen($search['produce_type'])){
			$query->addWhere(Query::OP_AND, 'produce_type', '=', intval($search['produce_type']));
		}
		if(strlen($search['state'])){
			$query->addWhere(Query::OP_AND, 'state', '=', intval($search['state']));
		}

		$order_list = $query->paginate($paginate);

		$def = SampleProduceOrder::meta()->getPropertiesDefine();
		return array(
			'produce_type_options' => $def['produce_type']['options'],
			'state_options' => $def['state']['options'],
			'search' => $search,
			'order_list' => $order_list,
			'paginate' => $paginate,
		);
	}

	public function info($get){
		$id = $get['id'];
		$base_info = SampleProduceOrder::findOneByPk($id);
		$paginate = Paginate::instance();
		$sample_list = SampleProduceOrderMapSamples::find('produce_order_id = ?',$id)->paginate($paginate);
		$sample_process_list = WorkProcess::find('work_stage_id=? AND state=?', WorkStage::SAMPLE_STATE_ID, WorkProcess::STATE_ENABLED)->all();
		$deliver_info = SampleProduceOrderDeliverInfo::find('produce_order_id=?', $id)->one();

		return array(
			'base_info' => $base_info,
			'deliver_info' => $deliver_info,
			'paginate' => $paginate,
			'sample_list' => $sample_list,
			'sample_process_list' => $sample_process_list
		);
	}

	public function deliver($get, $post){
		$produce_order_id = $get['produce_order_id'];
		$deliver_info = SampleProduceOrderDeliverInfo::find('produce_order_id=?', $produce_order_id)->one() ?: new SampleProduceOrderDeliverInfo();
		if(!$deliver_info->id){
			$tmp = SampleProduceOrder::findOneByPk($produce_order_id);
			/**
			 * @var CustomerContact $ct
			 * @var Customer $customer
			 */
			$ct = $tmp->contact;
			$customer = $tmp->customer;
			$deliver_info->customer_name = $customer->company_full_name;
			$deliver_info->contact = $ct->chinese_name;
			$deliver_info->phone = $ct->mobile;
			$deliver_info->address = $customer->address;
		}
		if($post){
			$deliver_info->setValue('produce_order_id', $produce_order_id);
			$deliver_info->setValues($post);
			$deliver_info->save();
			SampleProduceOrder::updateByPk($produce_order_id, array('state'=>SampleProduceOrder::STATE_DELIVERED));
			return $this->getCommonResult(true);
		}

		$logistics_company_list = LogisticsCompany::find('state=?', LogisticsCompany::STATE_ENABLED)->all();
		return array(
			'logistics_company_list' => $logistics_company_list,
			'deliver_info' => $deliver_info,
			'produce_order_id' => $produce_order_id
		);
	}

	public function update($get, $post){
		$order = SampleProduceOrder::findOneByPk($get['id']) ?: new SampleProduceOrder();

		if($post) {
			if($post['produce_type'] == SampleProduceOrder::TYPE_ORDER){
				if($post['business_order_no']){
					$post['business_order_id'] = BusinessOrder::find('order_no=?', $post['business_order_no'])->ceil('id');
				}
				if(!$post['business_order_id']){
					return new Result('您输入的订单号没有对应的订单:'.$post['business_order_no']);
				}
			}

			$org_id = $order->boss_head_employee_id;
			$order->setValues($post);
			if(!$order->id){
				$order->boss_head_employee_id = Auth::instance()->getLoginUserId();
			} else {
				$order->boss_head_employee_id = $org_id;
			}
			$result = parent::update($get, $post);
			if($result->isSuccess()){
				return new Result('操作成功', true);
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