<?php
namespace www\model;
use Lite\CRUD\ModelInterface;
use www\db_definition\TableBusinessOrderPayment;

/**
 * User: Lite Scaffold
 * Date: 2015-12-29
 * Time: 10:17:07
 */
class BusinessOrderPayment extends TableBusinessOrderPayment implements ModelInterface{
	public function __construct($data = array()){
		parent::__construct($data);
		parent::__construct($data);
		$this->setPropertiesDefine(array(
			'append_file_url' => array(
				'type' => 'file',
				'rel' => 'upload-file'
			),
			'business_order' => array(
				'getter' => function (BusinessOrderPayment $item){
					return BusinessOrder::findOneByPk($item->business_order_id);
				}
			),
			'pay_type_id' => array(
				'options' => function(){
					$tmp = PayType::find('state=?', PayType::STATE_ENABLED)->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				},
				'display' => function(self $item){
					$tmp = PayType::findOneByPk($item->pay_type_id);
					if(!$tmp){
						return '';
					}
					return $tmp->state == PayType::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
				}
			)
		));
	}

	/**
	 * 获取模型状态key
	 *
	 * @return string
	 */
	public function getStateKey(){
		// TODO: Implement getStateKey() method.
	}
}