<?php
namespace www\model;

use Lite\CRUD\ModelInterface;
use www\db_definition\TableBusinessOrder;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:24:56
 */
class BusinessOrder extends TableBusinessOrder implements ModelInterface {
	//array('0'=>'草稿', '1'=>'确认订单', '2'=>'关闭'),
    const STATE_DRAFT  = 0;
    const STATE_CONFIRM = 1;
    const STATE_CLOSE = 2;

	const DEFAULT_PRODUCE_NUM = 3; //缺省生产数量

	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'customer_id' => array(
				'display' => function(BusinessOrder $item){
					return Customer::findOneByPk($item->customer_id)->company_alias_name;
				},
				'alias' => '公司简称'
			),
			'customer_contact_id' => array(
				'display' => function(BusinessOrder $item){
					return CustomerContact::findOneByPk($item->customer_contact_id)->chinese_name;
				},
				'alias' => '联系人'
			),
			'pay_type_id' => array(
				'options' => function(){
					$tmp = PayType::find('state=?',PayType::STATE_ENABLED)->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				},
				'display' => function(self $item){
					$tmp = PayType::findOneByPk($item->pay_type_id);
					if(!$tmp){
						return '';
					}
					return $tmp->state == PayType::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
				}
			),
			'settle_currency_name' => array(
				'getter' => function (BusinessOrder $item){
					return $item->getPropertiesDefine('settle_currency')['options'][$item->settle_currency];
				}
			),
			'sample_produce_order' => array('getter'=>function(self $item){
				return SampleProduceOrder::find('business_order_id=?', $item->id)->one();
			})
		));
	}

	public static function generateOrderNo(){
		return 'S' . date('Y-m-d') . rand(1000, 9999);
	}

	/**
	 * 获取模型状态key
	 * @return string
	 */
	public function getStateKey(){
		return 'state';
	}
}