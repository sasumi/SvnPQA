<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use Lite\Exception\Exception;
use www\db_definition\TableSampleProduceOrder;
use function Lite\func\array_group;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:03
 */
class SampleProduceOrder extends TableSampleProduceOrder implements ModelInterface {
	const STATE_INIT = 0;       //待接受
	const STATE_PRODUCING = 1;  //生产中
	const STATE_FINISH = 2; //已完成
	const STATE_DELIVERED = 3; //已邮寄

	const TYPE_NEW_PRODUCT = 1; //新品开发
	const TYPE_CUSTOMER_REQUEST = 2; //客户来样
	const TYPE_ORDER = 3; //订单确认


	public function __construct($data = array()){
		parent::__construct($data);

		$this->setPropertiesDefine(array(
			'customer_id' => array(
				'options' => function(SampleProduceOrder $item=null){
					if($item && $item->customer_id){
						$company_alias_name = Customer::findOneByPk($item->customer_id)->company_alias_name;
						return array($item->customer_id => $company_alias_name);
					}
					return null;
				},
				'alias' => '客户'
			),
			'customer' => array('getter'=>function(self $item){
				if($item){
					return Customer::findOneByPk($item->customer_id);
				}
				return null;
			}),
			'contact' => array(
				'getter' => function(SampleProduceOrder $item){
					if($item->contact_id){
						return CustomerContact::findOneByPk($item->contact_id);
					}
					return null;
				}
			),
			'contact_id' => array(
				'options' => function(SampleProduceOrder $item=null){
					if($item && $item->contact_id){
						$contact_name = CustomerContact::findOneByPk($item->contact_id)->chinese_name;
						return array($item->contact_id => $contact_name);
					}
					return null;
				},
				'alias' => '联系人'
			),
			'boss_head_employee_id' => array(
				'options'=>function(){
					$tmp = Employee::find('state=?', Employee::STATE_ENABLED)->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				},
				'display' => function(self $item){
					$tmp = Employee::findOneByPk($item->boss_head_employee_id);
					if(!$tmp){
						return '';
					}
					return $tmp->state == Employee::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
				},
				'alias'=>'负责人'
			),
			'produce_finish_date' => array(
				'default' => date('Y-m-d')
			),
			'currency_id' => array(
				'options' => function(){
					$tmp = Currency::find()->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'unit_name'));
				},
				'display' => function(self $item){
					if($item){
						$tmp = Currency::find()->all(true);
						$tmp = array_group($tmp, 'id', true);
						return $tmp[$item->currency_id]['unit_name'];
					}
					return '';
				}
			),
			'product_fee' => array(
				'description' => 'RMB'
			),
			'business_order' => array('getter'=>function(self $item){
				return BusinessOrder::findOneByPk($item->business_order_id);
			})
		));
	}

	/**
	 * 生产单号
	 */
	public static function generateOrderNo(){
		$last_order = SampleProduceOrder::find('create_time >= ?', strtotime(date('Y-m-01 00:00:00')))->order('create_time DESC')->one();
		$no = '00';
		if($last_order){
			$last_no = substr($last_order->order_no, -2);
			if($last_no == 99){
				throw new Exception('order no full');
			}
			$new_no = (int)$last_no + 1;
			$no = str_pad($new_no, 2, '0', STR_PAD_LEFT);
		}
		$no = 'S'.date('ym').$no;
		return $no;
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){
		return 'state';
	}
}