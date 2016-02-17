<?php
namespace www\model;
use www\db_definition\TableSampleProduceOrderDeliverInfo;
use function Lite\func\array_group;
use function Lite\func\dump;

/**
 * User: Lite Scaffold
 * Date: 2015-12-30
 * Time: 18:05:55
 */
class SampleProduceOrderDeliverInfo extends TableSampleProduceOrderDeliverInfo {
	public function __construct($data = array()){
		parent::__construct($data);

		$this->setPropertiesDefine(array(
			'logistics_company' => array(
				'options' => function(){
					$tmp = LogisticsCompany::find('state=?',LogisticsCompany::STATE_ENABLED)->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'name'));
				},
				'display' => function(self $item){
					$tmp = LogisticsCompany::findOneByPk($item->logistics_company);
					if(!$tmp){
						return '';
					}
					return $tmp->state == LogisticsCompany::STATE_ENABLED ? $tmp->name : '<del>'.$tmp->name.'</del>';
				}
			),
			'fee_currency_id' => array(
				'options' => function(){
					$tmp = Currency::find()->all(true);
					return array_combine(array_column($tmp, 'id'), array_column($tmp, 'unit_name'));
				},
				'display' => function(self $item){
					if($item){
						$tmp = Currency::find()->all(true);
						$tmp = array_group($tmp, 'id', true);
						return $tmp[$item->fee_currency_id]['unit_name'];
					}
					return '';
				}
			),
			'deliver_date' => array(
				'default' => date('Y-m-d')
			)
		));
	}
}