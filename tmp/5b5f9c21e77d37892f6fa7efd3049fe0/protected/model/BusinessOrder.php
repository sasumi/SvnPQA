<?php
namespace www\model;

use Lite\CRUD\ModelInterface;
use function Lite\func\dump;
use www\model\table\TableBusinessOrder;

/**
 * User: Lite Scaffold
 * Date: 2015-10-14
 * Time: 19:24:56
 */
class BusinessOrder extends TableBusinessOrder implements ModelInterface {
	public function __construct($data = array()){
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'customer_id' => array(
				'display' => function(BusinessOrder $item){
					return Customer::findOneByPk($item->customer_id)->company_full_name;
				},
				'alias' => '公司名称'
			),
			'customer_contact_id' => array(
				'display' => function(BusinessOrder $item){
					return CustomerContact::findOneByPk($item->customer_contact_id)->chinese_name;
				},
				'alias' => '联系人'
			),
			'pay_type_id' => array(
				'options' => function(){
					$tmp = PayType::find()->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				}
			),
			'settle_currency_name' => array(
				'getter' => function (BusinessOrder $item){
					return $item->getPropertiesDefine('settle_currency')['options'][$item->settle_currency];
				}
			),
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
		// TODO: Implement getStateKey() method.
	}
}