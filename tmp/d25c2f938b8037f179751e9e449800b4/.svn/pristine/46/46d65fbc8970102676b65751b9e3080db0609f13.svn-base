<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use Lite\Exception\Exception;
use www\model\table\TableSampleProduceOrder;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:25:03
 */
class SampleProduceOrder extends TableSampleProduceOrder implements ModelInterface {
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
				'options'=>function($a=null){
					$tmp = Employee::find()->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				},
				'alias'=>'负责人'
			),
			'order_no' => array(
				'unique' => '唯一'
			),
			'product_fee' => array(
				'description' => 'RMB'
			)
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